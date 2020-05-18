<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Monitoring Tanaman | Log in</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="<?= base_url('assets/backend/bootstrap/css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<link rel="stylesheet" href="<?= base_url('assets/backend/dist/css/AdminLTE.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/backend/plugins/iCheck/square/blue.css'); ?>">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body class="hold-transition login-page bg-login">
<div class="login-box">
	<?php echo $this->session->flashdata('info');?>
	<div class="login-logo">
		<img src="<?= base_url('assets/img/motan3.png'); ?>" style="height: 80px;"/><br>
		<!-- <a href="<?= base_url(); ?>" style="color: #ffffff"><b>Masuk</b></a> -->
	</div><!-- /.login-logo -->
	<div class="login-box-body">
		<p class="login-box-msg">Silahkan Masuk</p>
		<form action="<?= base_url('Login/login_exe'); ?>" method="post">
			<div class="form-group has-feedback">
				<input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username..." required>
				<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback">
				<input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
				</div>
			</div>
		</form>
	</div>
</div>

<script src="<?= base_url('assets/backend/plugins/jQuery/jQuery-2.1.4.min.js'); ?>"></script>
<script src="<?= base_url('assets/backend/bootstrap/js/bootstrap.min.js')?>"></script>
</body>
</html>
