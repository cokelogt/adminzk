<?php require "../../config/datapg.php";
$sql3 = pg_query("SELECT fecha, hora FROM attendance ORDER by id DESC LIMIT 1");
$tm = pg_fetch_assoc($sql3);
?>
<div class="col-md-12 col-sm-12">
    <section class="content-header">
        <h2 style="color:#b2c831"><i class="fa fa-lock"></i> Precency Control</h2><br/>
    </section>
        <div class="wrap-unit">
            <section class="content-header">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-2">Date
                            <input type="date" class="form-control form-control-sm" id="last_fecha" onchange="listAttendance()" value="<?php echo $tm['fecha'] ?>">
                        </div>
                        <div class="col-md-3">User
                            <?php elegir("SELECT id, username FROM users WHERE status = 't' ORDER BY username ASC",0,'l_legajo',1,'onchange=listAttendance()') ?>
                        </div>
                        <div class="col-md-7"><br/>
                            <button type="button" class="btn btn-info btn-sm pull-right" onclick="actualizar_fich()"><i class="fa fa-refresh"></i> Update</button>
                            <a type="button" onclick="sweetModal('modulos/control/pages.php?p=em&url=modulos/control/listar.php',350,'','animate__flipInX','animate__zoomOut')" title="Download List" class="btn btn-sm btn-default pull-right" style="margin-right: 5px;cursor:pointer"><i class="fa fa-download"></i></a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="col-md-12">
            <div class="card card-default">
                <div id="list_fichero"></div>
            </div>
        </div>
    </div>
<script>
    $(document).ready(function () {
        listAttendance();
    });
</script>
