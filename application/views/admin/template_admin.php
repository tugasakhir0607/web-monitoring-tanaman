<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Monitoring Tanaman</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="<?= base_url("assets/backend/bootstrap/css/bootstrap.min.css")?>">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<link rel="stylesheet" href="<?= base_url("assets/backend/plugins/datatables/dataTables.bootstrap.css")?>">
	<link rel="stylesheet" href="<?= base_url("assets/backend/dist/css/AdminLTE.min.css")?>">
	<link rel="stylesheet" href="<?= base_url("assets/backend/dist/css/skins/_all-skins.min.css")?>">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<script src="<?= base_url("assets/backend/plugins/jQuery/jQuery-2.1.4.min.js")?>"></script>
	<script src="<?= base_url("assets/backend/bootstrap/js/bootstrap.min.js")?>"></script>
	<script src="<?= base_url('assets/backend/plugins/jquery-validation-1.15.0/dist/jquery.validate.js')?>" type="text/javascript"></script>
	<script src="<?= base_url("assets/backend/plugins/datatables/jquery.dataTables.min.js")?>"></script>
	<script src="<?= base_url("assets/backend/plugins/datatables/dataTables.bootstrap.min.js")?>"></script>


	<script src="<?= base_url("assets/backend/plugins/slimScroll/jquery.slimscroll.min.js")?>"></script>
	<script src="<?= base_url("assets/backend/plugins/fastclick/fastclick.min.js")?>"></script>
	<script src="<?= base_url('assets/backend/plugins/chartjs/Chart.min.js'); ?>"></script>
	<script src="<?= base_url("assets/backend/dist/js/app.min.js")?>"></script>
	<script src="<?= base_url("assets/backend/dist/js/demo.js")?>"></script>
</head>
<style>
	.error{
		color: red;
	}
</style>
<script>
    jQuery.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || /^[a-z," "]+$/i.test(value);
    }, "Letters only please");
</script>
<body class="hold-transition skin-green sidebar-mini fixed">
<div class="wrapper">
    <header class="main-header">
        <a href="<?= base_url('Admin');?>" class="logo">
            <span class="logo-mini"><b>S</b>PK</span>
            <span class="logo-lg"><b>Admin</b> </span>
        </a>
        <nav class="navbar navbar-static-top" role="navigation">
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="<?= base_url('assets/img/logo1.png');?>" class="user-image" alt="User Image">
                            <span class="hidden-xs">Admin</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="user-header">
                                <img src="<?= base_url('assets/img/logo1.png');?>" class="img-circle" alt="User Image">
                                <p>
                                    <span>Nama</span> - Admin
                                </p>
                            </li>
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="<?= base_url('Admin/profil');?>" class="btn btn-default btn-flat">Profil</a>
                                </div>
                                <div class="pull-right">
                                    <a href="<?= base_url('Admin/log_out');?>" class="btn btn-default btn-flat">Keluar</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <aside class="main-sidebar">
        <section class="sidebar">
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="<?= base_url('assets/img/logo1.png');?>" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>Admin</span></p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <ul class="sidebar-menu">
                <li class="header">MAIN NAVIGATION</li>
                <li><a href="<?= base_url('Admin');?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
                <li><a href="<?= base_url('Admin/pengguna');?>"><i class="fa fa-users"></i> <span>Daftar Pengguna</span></a></li>
                <li><a href="<?= base_url('Admin/tanaman');?>"><i class="fa fa-tree"></i> <span>Daftar Tanaman</span></a></li>
            </ul>
        </section>
    </aside>
    <?= $content;?>
	<footer class="main-footer">
		<div class="pull-right hidden-xs">
			<b>Version</b> 1.0
		</div>
		<strong>Copyright &copy; 2020 <a href="<?= base_url();?>">Monitoring Tanaman </a>.</strong> All rights reserved.
	</footer>
</div>

</body>
</html>
