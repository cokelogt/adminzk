<?php require "../../config/datapg.php";
$sql = pg_query("SELECT fecha FROM attendance ORDER by id DESC LIMIT 1");
$tm = pg_fetch_assoc($sql);

$sql2 = pg_query("SELECT id FROM users WHERE status = 't'");
$act = pg_num_rows($sql2);

$sql3 = pg_query("SELECT DISTINCT legajo FROM attendance WHERE fecha = '$tm[fecha]' AND state = 0");
$pres = pg_num_rows($sql3);

$miss = $act -  $pres;

?>
<br/>
<div class="row">
    <div class="col-sm-12 col-lg-12">
        <div class="wrap-unit">
            <dtitle>Precency Control</dtitle><button style="margin:4px" type="button" class="btn btn-info btn-sm pull-right" onclick="actualizar_fich()"><i class="fa fa-refresh"></i> Update</button>
            <hr>
            <div class="row">
              <div class="col-md-7">
                <div id="clockdate">
                    <div class="clockdate-wrapper">
                        <div id="clock"></div>
                        <div id="date"></div>
                    </div>
                </div>
              </div>
                <div class="col-md-5">
                    <div class="col-md-4">
                        <strong style="color:#b2c831">Last Date: </strong><?php echo $tm['fecha'] ?><br/><br/>
                        <strong style="color:#b2c831">Present: </strong><?php echo $pres ?><br/>
                        <strong style="color:#b2c831">Missing: </strong><?php echo $miss ?>
                    </div>
                    <div class="col-md-8">
                          <div class="chart-responsive">
                            <canvas id="pieChart" class="chartjs-render-monitor" width="240" height="120"></canvas>
                          </div>
                    </div>
                  </div>
                </div>
            </div>
            <br>
            <div class="info-user">
                <span aria-hidden="true" class="li_settings fs1 linker" onclick="sweetModal('modulos/home/pages.php?p=config',450,'','animate__flipInX','animate__zoomOut')"></span>
            </div>
    </div>
</div>
    <script>

      function loadDash() {
        	var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
        	var pieData        = {
        		labels: [
        				'Present',
        				'Missing',
        		],
        		datasets: [
        			{
        				data: [<?php echo $pres.','.$miss ?>],
        				backgroundColor : ['#b2c831', '#1f1f1f'],
        			}
        		]
        	}
        	var pieOptions     = {
        		legend: {
        			display: false
        		}
        	}
        	//Create pie or douhnut chart
        	// You can switch between pie and douhnut using the method below.
        	var pieChart = new Chart(pieChartCanvas, {
        		type: 'doughnut',
        		data: pieData,
        		options: pieOptions
        	})

        }
          $(document).ready(function () {
            startTime();
            loadDash()
          })

        function guarConfig() {
            const element = document.getElementById('nroip');
            const patronIp = new RegExp(/^(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/gm);
            if (element.value.search(patronIp) == 0) {
                $.ajax({
                    url: 'modulos/home/ajax.php',
                    type: 'post',
                    data: $('#formCfg').serialize(),
                    success: function (data) {
                        if(data == 1) {
                            toastr.success('New Configuration Was Updated!!!');
                            loadDash()
                        } else if(data == 3) {
                            toastr.warning('The device does not respond with the ip address... Try Another')
                        } else {
                            toastr.error(data);
                        }
                    }
                })
            } else {
                toastr.warning('The IP address is not valid')
            }
        }
    </script>
