<?php if($_GET['p'] == 'config') {
    require "../../config/datapg.php";
    $sql = pg_query("SELECT * FROM admin WHERE id = 1");
    $data = pg_fetch_assoc($sql);
    ?>
    <center><h2>System Configuration</h2></center>
    <hr/>

    <form id="formCfg" role="form" class="form-horizontal" enctype="multipart/form-data">
        <div class="row">
            <label class="col-sm-3 control-label">Username</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" name="username" value="<?php echo $data['username'] ?>" autocomplete="off" required>
            </div>
        </div>
        <br/>
        <div class="row">
            <label class="col-sm-3 control-label">Pasword</label>
            <div class="col-sm-7">
                <input type='password' id='pass' name='pass' value="<?php echo decript($data['password']) ?>" class="form-control">
            </div>
        </div>
        <br/>
        <div class="row">
            <label class="col-sm-3 control-label">Ip Address</label>
            <div class="col-sm-7">
                <input class="form-control" onkeyup="validIp('nroip')" value="<?php echo $data['device_ip'] ?>" id="nroip" name="nroip" required>
            </div>
        </div>
        <br/>
        <div class="row">
            <label class="col-sm-3 control-label">Port</label>
            <div class="col-sm-4">
                <input type="number" min="0" class="form-control" value="<?php echo $data['device_port'] ?>" name="port" autocomplete="off" >
            </div>
        </div>
    </form>
    <div class="col-md-12">
        <hr>
        <center><button type="button" onclick="guarConfig()" class="btn btn-sm btn-success btn-submit pull-center">Save</center>
    </div>
<?php } ?>
