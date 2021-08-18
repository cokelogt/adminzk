<?php require "config/datapg.php";
$name = $_POST['name'];
$pass = $_POST['pass'];
$sql = pg_sql($connect,'myq',"select * FROM admin WHERE id = $1",array(1));
$data = pg_fetch_assoc($sql);
if($name == $data['username'] AND cript($pass) == $data['password']) {
    $json = 1;
} else {$json = 2;}
echo json_encode($json);