<?php
require "../../config/datapg.php";
$fecha = date('d/m/Y');
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=fichero al $fecha.xls");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Exportar Control de Acceso</title>
    <meta charset="UTF-8">
</head>
<body>
<table class="table table-striped table-sm">
    <thead>
    <tr>
        <td width="25">No</td>
        <td>Registro</td>
        <td>Legajo</td>
        <td>Nombre</td>
        <td>Instancia</td>
        <td>Fecha</td>
        <td>Hora</td>
    </tr>
    </thead>
    <tbody>
    <?php
    $in = $_POST['i'];
    $out = $_POST['f'];
    $sql = pg_query("SELECT * FROM attendance WHERE fecha between '$in' and '$out' ORDER by id ASC");
    $no = 1;
    while($data = pg_fetch_assoc($sql))
    {
        $sql2 = pg_query("SELECT uid, username FROM users WHERE uid = $data[legajo]");
        $leg = pg_fetch_assoc($sql2);
        if($data['state']==0)
        {
            $inst = 'Ingreso';
        }
        else if($data['state']==1)
        {
            $inst = 'Egreso';
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
</body>
</html>
