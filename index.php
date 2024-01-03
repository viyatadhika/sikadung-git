<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login Sistem Informasi Kerusakan Gedung</title>
  <link rel="icon" href="images/web_hi_res_512.png" type="image/png" />
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="css/AdminLTE.min.css">
  <link rel='stylesheet' href='css/animate.css'>
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box zoomIn animated">
  <div class="login-logo">
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
  <p class='fadeIn animated'><center><img src='images/web_hi_res_512.png' width="67" height="67"></center></p>
  <center><h3><small><b>SISTEM INFORMASI KERUSAKAN GEDUNG</b></small></h3>
    Silahkan Masukan Username dan Password</center><br>
    <form action="cek_login.php" method="post">
	<?php
				if (!empty($_GET['msg'])){
				if($_GET['msg']==1){
				echo '<div class="alert alert-error"><h6>Username dan password tidak boleh kosong</h6></div>';
				}elseif ($_GET['msg']==2){
				echo '<div class="alert alert-error"><h6>Pastikan username dan password benar</h6></div>';
				}
				}
				?>
	  <div class="form-group has-feedback">
        <input type="user" class="form-control" placeholder="Username" name="username" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat" value="login">Login</button>
        </div>
        <!-- /.col -->
      </div>
    </form>   
  </div>
  <?php
  $waktu = date("Y");
  echo "
  <div class='box-footer'>
  <center><strong>Copyright &copy; $waktu <a href='http://bldk.mahkamahagung.go.id' target='_blank'><p>Badan Litbang Diklat Hukum dan Peradilan</a></strong></center>
  </div>";
  ?>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- page script -->
</body>
</html>