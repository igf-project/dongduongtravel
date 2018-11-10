<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
include_once(libs_path.'cls.member.php');
$UserLogin=new CLS_USERS();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="robots" content="noindex,nofollow"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>CMS Control panel</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.6 -->
	<link rel="stylesheet" href="<?php echo THIS_TEM_ADMIN_PATH;?>bootstrap/css/bootstrap.min.css">
	<!-- Login style -->
	<link href="<?php echo THIS_TEM_ADMIN_PATH;?>pages/css/login.css?v=1" rel="stylesheet" type="text/css"/>
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo THIS_TEM_ADMIN_PATH;?>css/AdminLTE.min.css">
	<!-- AdminLTE Skins. Choose a skin from the css/skins
	folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="<?php echo THIS_TEM_ADMIN_PATH;?>css/skins/_all-skins.min.css">
	<!-- iCheck -->
	<link rel="stylesheet" href="<?php echo THIS_TEM_ADMIN_PATH;?>plugins/iCheck/flat/blue.css">
	<!-- Morris chart -->
	<link rel="stylesheet" href="<?php echo THIS_TEM_ADMIN_PATH;?>plugins/morris/morris.css">
	<!-- jvectormap -->
	<link rel="stylesheet" href="<?php echo THIS_TEM_ADMIN_PATH;?>plugins/jvectormap/jquery-jvectormap-1.2.2.css">
	<!-- Date Picker -->
	<link rel="stylesheet" href="<?php echo THIS_TEM_ADMIN_PATH;?>plugins/datepicker/datepicker3.css">
	<!-- Daterange picker -->
	<link rel="stylesheet" href="<?php echo THIS_TEM_ADMIN_PATH;?>plugins/daterangepicker/daterangepicker-bs3.css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body class="<?php if(!$UserLogin->isLogin()){ echo 'login'; }else{ echo 'hold-transition skin-blue sidebar-mini'; } ?>">
	<div class="wrapper">
		<?php
		if(!$UserLogin->isLogin()){
			include_once(COM_PATH."com_users/task/login.php");
		}else{
			?>
			<?php require_once(MOD_PATH."mod_header/layout.php");?>
			<?php require_once(MOD_PATH."mod_leftmenu/layout.php");?>
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<?php $this->loadComponent();?>
			</div>
			<!-- /.content-wrapper -->
			<?php require_once(MOD_PATH."mod_footer/layout.php");?>
			<!-- Control Sidebar -->
			<?php require_once(MOD_PATH."mod_right/control_sidebar.php");?>
			<!-- /.control-sidebar -->
			<!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
			<div class="control-sidebar-bg"></div>
			<?php 
		} ?>
	</div>
	<!-- ./wrapper -->

	<!-- jQuery 2.2.0 -->
	<script src="<?php echo THIS_TEM_ADMIN_PATH;?>plugins/jQuery/jQuery-2.2.0.min.js"></script>
	<!-- jQuery UI 1.11.4 -->
	<!-- Bootstrap 3.3.6 -->
	<script src="<?php echo THIS_TEM_ADMIN_PATH;?>bootstrap/js/bootstrap.min.js"></script>

	<!-- Slimscroll -->
	<script src="<?php echo THIS_TEM_ADMIN_PATH;?>plugins/slimScroll/jquery.slimscroll.min.js"></script>

	<!-- AdminLTE App -->
	<script src="<?php echo THIS_TEM_ADMIN_PATH;?>js/app.min.js"></script>

	<!-- AdminLTE for demo purposes -->
	<script src="<?php echo THIS_TEM_ADMIN_PATH;?>js/demo.js"></script>
	<script src="<?php echo EDIT_FULL_PATH; ?>"></script>
	<script src="<?php echo THIS_TEM_ADMIN_PATH;?>js/gfscript.js"></script>
</body>
</html>
