<?php require "../../config/datapg.php";
include('../control/zk/zklibrary.php');
$ip = trim($_POST['nroip']);
$port = $_POST['port'];
$zk = new ZKLibrary("$ip", $port);
$zk->connect();
$zk->disableDevice();
$users = $zk->getVersion();
echo $users

?>