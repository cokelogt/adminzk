<?php
require "../../config/datapg.php";
require 'zk/zklibrary.php';

$con = pg_query("SELECT device_ip, device_port FROM admin WHERE id = 1");
$dev = pg_fetch_assoc($con);

$zk = new ZKLibrary("$dev[device_ip]", "$dev[device_port]");
$zk->connect();
$users = $zk->getAttendance();
$sql = pg_query("SELECT uid FROM attendance ORDER BY id DESC LIMIT 1");
$last = pg_fetch_assoc($sql);
$c = 0;
foreach($users as $key => $user) {
    if ($user[0] > $last['uid']) {
        $upd = pg_query("INSERT INTO attendance (uid, legajo, state, fecha, hora) VALUES ($user[0], $user[1], $user[4], '$user[3]', '$user[3]')");
        if($upd) {++$c;}
    }
}

$zk->enableDevice();
$zk->disconnect();

$jsons = "{'dif': '$c'}";

echo str_replace ("'",'"',trim(json_encode($jsons, JSON_HEX_QUOT),'"'));
header("Content-Type: application/json;charset=utf-8");

?>
