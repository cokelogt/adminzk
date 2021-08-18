<?php session_start() ?>
<!doctype html>
<html><head>
    <meta charset="utf-8">
    <title>Precency Control</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Federico Mercau">
    <link rel="shortcut icon" href="img/sys/favi.png" />
    <link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap/css/bootstrap.min.css" />
    <link href="assets/plugins/font-awesome-4.6.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="assets/plugins/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="assets/plugins/sweetalert2/wordpress-admin.min.css">
    <link rel="stylesheet" href="assets/plugins/toastr/toastr.min.css">
    <link href="assets/css/animate.min.css" rel="stylesheet">
    <link href="assets/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet">
    <link href="assets/css/main.css" rel="stylesheet">
    <link href="assets/css/font-style.css" rel="stylesheet">
  </head>
  <body>
  <style type="text/css">
      body {
          padding-top: 60px;
      }
  </style>

    <div class="navbar-nav navbar-inverse navbar-fixed-top">
        <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.html"><img src="img/sys/zkteco.png" height="30" alt=""></a>
        </div>
          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li id="li_home" class="linkmenu active"><a class="linker" onclick="loadContent('modulos/home/home.php','li_home')"><i class="icon-home icon-white"></i> Home</a></li>
              <li id="li_control" class="linkmenu"><a class="linker" onclick="loadContent('modulos/control/control.php', 'li_control')"><i class="icon-th icon-white"></i> Control</a></li>
              <li id="li_users" class="linkmenu"><a class="linker" onclick="loadContent('modulos/users/users.php', 'li_users')"><i class="icon-user icon-white"></i> Users</a></li>
            </ul>
          </div>
        </div>
    </div>

    <div class="container">

      <div id="root"></div>

	</div>
	<div id="footerwrap">
      	<footer class="clearfix"></footer>
      	<div class="container">
      		<div class="row">
      			<div class="col-sm-12 col-lg-12">
      			<p><img src="images/logo.png" alt=""></p>
      			<p></p>
      			</div>
      		</div>
      	</div>
	</div>
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="assets/plugins/toastr/toastr.min.js"></script>
    <script src="assets/plugins/chart.js/Chart.min.js"></script>
    <script src="assets/js/admin.js"></script>
</body>
</html>
