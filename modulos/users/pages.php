<?php require "../../config/datapg.php"; ?>

<?php if($_GET['p'] == 'listau') {
            $no = 1;

            $query = pg_query("SELECT * FROM users WHERE username ILIKE '%$_GET[q]%' ORDER BY username ASC");

            while ($data = pg_fetch_assoc($query)) {

            if ($data['status'] == 'f') $status="Inactive";
            if ($data['status'] == 't') $status="Active"; ?>
<div class="col-sm-3 col-lg-3">
    <div class="dash-unit">
        <dtitle>ZK User <?php echo $data['uid'] ?></dtitle>
        <hr>
        <div class="thumbnail">
            <?php
            if ($data['foto']=="") { ?>
                <img class='img-circle linker' title="Change Image" src='img/user/default.jpg' width='120' onclick="sweetModal('modulos/users/pages.php?p=archivos&id=<?php echo $data['id'] ?>',500,'username','animate__flipInX','animate__zoomOut');loadDropzone(<?php echo $data['id'] ?>)">
                <?php
            } else { ?>
                <img class='img-circle linker' title="Change Image" style="filter: grayscale(1);" src='img/user/<?php echo $data['foto']; ?>' width='120' onclick="sweetModal('modulos/users/pages.php?p=archivos&id=<?php echo $data['id'] ?>',500,'username','animate__flipInX','animate__zoomOut');loadDropzone(<?php echo $data['id'] ?>)">
                <?php
            }
            ?>
        </div>
        <h1><?php echo $data['username'] ?></h1>
        <h3><?php echo $status ?></h3>
        <br>
        <div class="info-user">
            <span class="li_settings fs1 linker" title="Update User" onclick="sweetModal('modulos/users/pages.php?p=edit&id=<?php echo $data['id'] ?>',500,'username','animate__flipInX','animate__zoomOut')"></span>
            <span class="li_key fs1 linker" title="Change Status" onclick="actDes('<?php echo $data['id'] ?>')"></span>
        </div>
    </div>
</div>
<?php $no++; } ?>
</div>
<?php }
?>
<?php if($_GET['p'] == 'new') { ?>
    <center><h2>New User</h2></center>
    <hr/>

    <form id="forNewmUsr" role="form" class="form-horizontal" enctype="multipart/form-data">
        <div class="row">
            <label class="col-sm-3 control-label">Name</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="username" autocomplete="off" required>
            </div>
        </div>
        <br/>
        <div class="row">
            <label class="col-sm-3 control-label">UID</label>
            <div class="col-sm-3">
                <input type="number" min="0" class="form-control" name="uid" autocomplete="off" required>
            </div>
        </div>
    </form>
    <div class="col-md-12">
        <hr>
        <center><button type="button" onclick="guarNewUsr()" class="btn btn-sm btn-success btn-submit pull-center">Save</center>
    </div>

    <br />

<?php } ?>

<?php if($_GET['p'] == 'edit') {

    $q = $_GET['id'];
    if(is_numeric($q)) {
        $sql = pg_sql($connect,'myq',"SELECT * FROM users WHERE id = $1",array($q));
        $data = pg_fetch_assoc($sql);
        ?>
        <center><h2>Edit User</h2></center>
        <hr/>

        <form id="formUpdUsr" role="form" class="form-horizontal" enctype="multipart/form-data">
            <div class="row">
                <label class="col-sm-3 control-label">Name</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="username" value="<?php echo $data['username'] ?>" autocomplete="off" required>
                </div>
            </div>
            <br/>
            <div class="row">
                <label class="col-sm-3 control-label">UID</label>
                <div class="col-sm-3">
                    <input type="number" min="0" value="<?php echo $data['uid'] ?>" class="form-control" name="uid" autocomplete="off" required>
                    <input type="hidden" name="old" value="<?php echo $data['uid'] ?>">
                    <input type="hidden" name="id" value="<?php echo $data['id'] ?>">
                </div>
            </div>
        </form>
        <div class="col-md-12">
            <hr>
            <center><button type="button" onclick="updUser()" class="btn btn-sm btn-success btn-submit pull-center">Save</center>
        </div>

        <br />
    <?php } }?>

<?php if($_GET['p'] == 'archivos') { ?>
<?php
$idv = $_GET['id'];
if(is_numeric($idv)) {
$sql = pg_sql($connect,'myq',"SELECT * FROM users WHERE id = $1",array($idv));
$row = pg_fetch_assoc($sql);
?>
<br>
<style type="text/css">
    .borde-dropzone{
        border: 2px dashed #47a447 !important;
        border-radius: 5px !important;
        background: #3d3d3d !important;
        min-height: 150px !important;;
    }
</style>
<h2>Change profile image</h2>
    <hr/>
        <div class="row">
            <div class="col-md-12">
                <div class="panel-body text-center" >
                    <div class="col-md-12" id="formDropZone"></div>
                    <br>
                    <div class="row" id="divMostrarArchivos"></div>
                </div>
            </div>
        </div>


    <?php } }?>

    <?php if($_GET['p'] == 'myimage') {
        $idv = $_GET['id'];
        if (is_numeric($idv)) {
            $sql = pg_query("SELECT username, foto FROM users WHERE id = $idv");
            $row = pg_fetch_assoc($sql);
            echo '<div class="row col-md-12">
                    <br>
                    <center>
                        <img title="' . $row['username'] . '" src="img/user/' . $row['foto'] . '" style="width:150px; height:150px !important; border-radius: 4px">
                    </center>
                    <br/>
                  <div>';
        }
    }
    ?>
