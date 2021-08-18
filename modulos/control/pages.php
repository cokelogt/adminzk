<?php require "../../config/datapg.php" ?>

<?php if($_GET['p'] == 'lista') {
    $fh = explode('-',$_GET['fecha']);
    if(checkdate ($fh[1],$fh[2],$fh[0]) AND is_numeric($_GET['leg'])) {
        if($_GET['leg'] == 0) {$leg = "";} else {$leg = "AND legajo = $_GET[leg]";}
    ?>

    <table class="table table-sm table-responsive-sm" style="color: white">
        <thead>
        <tr>
            <td width="25">No</td>
            <td>UID</td>
            <td>User Id</td>
            <td>User Name</td>
            <td>Type</td>
            <td>Date</td>
            <td>Time</td>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql = pg_query("SELECT * FROM attendance WHERE fecha = '$_GET[fecha]' $leg ORDER by id ASC");
        $no = 1;
        while($data = pg_fetch_assoc($sql))
        {
            $sql2 = pg_query("SELECT id, username, uid FROM users WHERE uid = $data[legajo]");
            $leg = pg_fetch_assoc($sql2);
            if($data['state']==0)
            {
                $inst = 'In';
            }
            else if($data['state']==1)
            {
                $inst = 'Out';
            }
            else if($data['state']==2)
            {
                $inst ='breakOut';
            }
            else if($data['state']==3)
            {
                $inst ='breakIn';
            }
            else if($data['state']==4)
            {
                $inst = 'otIn';
            }
            else if($data['state']==5) {
                $inst = 'otOut';
            }
            ?>
            <tr>
                <td align="right"><?php echo $no; ?></td>
                <td><?php echo $data['uid']; ?></td>
                <td><?php echo $leg['uid']; ?></td>
                <td><?php echo $leg['username']; ?></td>
                <td><?php echo $inst; ?></td>
                <td><?php echo date('d-m-Y',strtotime($data['fecha'])); ?></td>
                <td><?php echo $data['hora']; ?></td>
            </tr>
            <?php
            $no++;
        }
        ?>
        </tbody>
    </table>
<?php } } ?>

<?php if($_GET['p'] == 'em') { ?>
  <h2>Download List</h2>
  <hr/>
    <form method="post" action="<?php echo $_GET['url'] ?>" target="_blank">
        <center>
            <div class="row ">Beginning
                <div class="input-group input-group-sm mb-3">
                    <input type="date" class="form-control form-control-sm" name="i" title="Ingrese Fecha de Inicio" required >
                </div>
                End
                <div class="input-group input-group-sm mb-3">
                    <input type="date" class="form-control form-control-sm" name="f" title="Ingrese Fecha de Fin" required >
                </div>
            </div>
            <hr />
            <button type="submit" onclick="Swal.close()" class="btn btn-sm btn-success">Generar</button></center>
    </form>
<?php } ?>
