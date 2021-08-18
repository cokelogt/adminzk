<?php require "../../config/datapg.php" ?>
<link rel="stylesheet" href="././assets/plugins/dropzone/dropzone.min.css">
<div class="col-md-12 col-sm-12">
    <section class="content-header">

        <h2 style="color:#b2c831"><i class="fa fa-lock"></i> Users</h2><br/>
    </section>
    <div class="wrap-unit">
            <section class="content-header">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-3"><br/>
                            <input class="form-control form-control-sm" id="q_user" onkeyup="cargaUsr()" placeholder="Search">
                        </div>
                        <div class="col-md-9"><br/>
                            <a class="btn btn-info btn-sm pull-right" style="color: #ffffff;" onclick="sweetModal('modulos/users/pages.php?p=new',500,'username','animate__flipInX','animate__zoomOut')" title="agregar">
                                <i class="fa fa-plus"></i> Add
                            </a>
                        </div>
                    </div>
                </div>
            </section>
    </div>
    <div class="col-md-12">
        <br />
        <div class="row">
            <div id="lista-usr"></div>
        </div>
    </div>
  </div>
<script src="././assets/plugins/dropzone/dropzone.min.js"></script>
<script>

    function cargaUsr() {
        $.ajax({
            url: 'modulos/users/pages.php?p=listau&q=' + $('#q_user').val(),
            success: function (data) {
                $('#lista-usr').html(data)
                $('#tbl-usr').dataTable()
            }
        })
    }

    $(document).ready(function () {
        cargaUsr();
    });

    function getArchivos(id) {
        $.ajax({
            type: 'GET',
            url: 'modulos/users/pages.php?p=myimage&id=' + id,
            success: function (data) {
                $("#divMostrarArchivos").html("");
                $("#divMostrarArchivos").html(data);
            }
        });
    }

    function loadDropzone(id) {
        sleep(250).then(() => {
            $("#formDropZone").append("<form id='dZUpload' class='dropzone borde-dropzone' style='cursor: pointer;'>" +
                "<div class='dz-default dz-message text-center'>" +
                "<br>" +
                "</div></form>");
            myAwesomeDropzone = {
                url: "modulos/users/update.php?u=uplimg&id=" + id,
                paramName: "file",
                maxFilesize: 1,
                parallelUploads: 1,
                maxFiles: 1,
                thumbnailWidth: 160,
                thumbnailHeight: 160,
                resizeWidth: 240,
                resizeHeight: 240,
                thumbnailMethod: 'contain',
                acceptedFiles: '.jpg',
                autoQueue: true,
                success: function () {
                    sleep(100).then(() => {
                        cargaUsr();
                        getArchivos(id);
                        toastr.success('Perfect!!! The image was uploaded!!!')
                    });
                },
                error: function () {
                    toastr.error('Error... The image could not be uploaded')
                }
            } // FIN myAwesomeDropzone
            var myDropzone = new Dropzone("#dZUpload", myAwesomeDropzone);
        })
    }
    function guarNewUsr() {
        $.ajax({
            url: 'modulos/users/update.php?u=newusr',
            type: 'post',
            data: $('#forNewmUsr').serialize(),
            success: function (data) {
                if (data == 1) {
                    toastr.success('New User insert correctly!!!');
                    cargaUsr();
                    Swal.close()
                } else if (data == 3) {
                    toastr.warning('The user exist...')
                } else {
                    toastr.error('Error... The New user could not be insert')
                }
            }
        })
    }

    function updUser() {
        $.ajax({
            url: 'modulos/users/update.php?u=updusr',
            type: 'post',
            data: $('#formUpdUsr').serialize(),
            success: function (data) {
                if (data == 1) {
                    toastr.success('New User updated correctly!!!');
                    cargaUsr();
                    Swal.close()
                } else if (data == 3) {
                    toastr.warning('The user exist...')
                } else {
                    toastr.error(data)
                }
            }
        })
    }

function actDes(id) {
  $.ajax({
      url: 'modulos/users/update.php?u=activate&id=' + id,
      success: function (data) {
          if (data == 1) {
              toastr.success('New User updated correctly!!!');
              cargaUsr();
              Swal.close()
          } else {
              toastr.error('Error... The New user could not be updated')
          }
      }
  })
}

</script>
