<?php require "../../config/datapg.php" ?>

<?php
    if ($_GET['u'] == 'newusr') {
        $name = ucwords(strtolower(trim($_POST['username'])));
        $uid = $_POST['uid'];
        $old = $_POST['old'];
        if($uid == $old) {
            $usr = pg_sql($connect, 'myq',"SELECT id FROM users WHERE username = $1",array($name, $uid));
        } else {
            $usr = pg_sql($connect, 'myq', "SELECT id FROM users WHERE username = $1 or uid = $2", array($name, $uid));
        }
        $q = pg_num_rows($usr);
        if ($q == 0) {
            $ins = pg_sql($connect, 'myq1',"INSERT INTO users (username, uid) VALUES ($1, $2)",array($name, $uid));
            if ($ins) {
                $json = 1;
            } else {
                $json = 2;
            }
        } else {
            $json = 3;
        }
        echo json_encode($json);
    }
    ?>

<?php

if ($_GET['u'] == 'updusr') {
    $name = ucwords(strtolower(trim($_POST['username'])));
    $uid = $_POST['uid'];
    $id = $_POST['id'];
    $old = $_POST['old'];
    if($uid == $old) {
        $usr = pg_sql($connect, 'myq', "SELECT id FROM users WHERE username = $1", array($name));
    } else {
        $usr = pg_sql($connect, 'myq', "SELECT id FROM users WHERE uid = $1", array($uid));
    }
    $q = pg_num_rows($usr);
    if ($q == 0) {
        $ins = pg_sql($connect, 'myq1',"UPDATE users SET username = $1, uid = $2 WHERE id = $3",array($name, $uid, $id));
        if ($ins) {
            $json = 1;
        } else {
            $json = 2;
        }
    } else {
        $json = 3;
    }
    echo json_encode($json);
}
?>
<?php if($_GET['u'] == 'uplimg') {
    $id = $_GET['id'];
    $ds = DIRECTORY_SEPARATOR;
    $storeFolderImg = '../../img/user/';
    if (!empty($_FILES)) {
        $extension = "jpg";
        $tempFile = $_FILES['file']['tmp_name'];
        $targetPath = dirname(__FILE__) . $ds . $storeFolderImg . $ds;
        $targetFile = $targetPath . $id . '.' . $extension;
        move_uploaded_file($tempFile, $targetFile);
    }
}
?>

<?php if($_GET['u'] == 'activate') {
  if(is_numeric($_GET['id'])) {
    $sql = pg_sql($connect, 'query', "SELECT status FROM users WHERE id = $1", array($_GET['id']));
    $st = pg_fetch_assoc($sql);
    if($st['status'] == 't') $status = 'f';
    if($st['status'] == 'f') $status = 't';
      $upd = pg_sql($connect, 'myq', "UPDATE users SET status = $1 WHERE id = $2", array($status, $_GET['id']));
      if($upd) {
        $json = 1;
      } else  {
        $json = 2;
      }
      echo json_encode($json);
  }
} ?>
