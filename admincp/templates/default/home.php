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
	<meta content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.6 -->
	<link rel="stylesheet" href="<?php echo THIS_TEM_ADMIN_PATH;?>bootstrap/css/bootstrap.min.css">
	<!-- Login style -->
	<link href="<?php echo THIS_TEM_ADMIN_PATH;?>pages/css/login.css?v=1" rel="stylesheet" type="text/css"/>
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo THIS_TEM_ADMIN_PATH;?>css/font-awesome.min.css">
	<link href="<?php echo THIS_TEM_ADMIN_PATH;?>plugins/select2/select2.min.css" type="text/css" rel="stylesheet" media="all">
	<!-- AdminLTE Skins. Choose a skin from the css/skins
	folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="<?php echo THIS_TEM_ADMIN_PATH;?>css/skins/_all-skins.min.css">
	<!-- Date Picker -->
	<link rel="stylesheet" href="<?php echo THIS_TEM_ADMIN_PATH;?>plugins/datepicker/datepicker3.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo THIS_TEM_ADMIN_PATH;?>css/AdminLTE.min.css">
	<link href="<?php echo THIS_TEM_ADMIN_PATH;?>layout/css/layout.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo THIS_TEM_ADMIN_PATH;?>css/fonts.css" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet" href="<?php echo THIS_TEM_ADMIN_PATH;?>css/gfstyle.css">
	<!-- jQuery 2.2.0 -->
	<script src="<?php echo THIS_TEM_ADMIN_PATH;?>plugins/jQuery/jQuery-2.2.0.min.js"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="<?php echo THIS_TEM_ADMIN_PATH;?>js/gfscript.js"></script>
	<link rel="stylesheet" href="<?php echo ROOTHOST;?>global/plugins/bootstrap-summernote/summernote.css">
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
				<div class="page-content-wrapper">
					<div class="page-content">
						<?php $this->loadComponent();?>
					</div>
				</div>
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
	<div class="modal fade" id='myModal' role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Sing in</h4>
				</div>
				<div class="modal-body" id="data-frm">
					<p>One fine body&hellip;</p>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<!-- Bootstrap 3.3.6 -->
	<script src="<?php echo THIS_TEM_ADMIN_PATH;?>bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo THIS_TEM_ADMIN_PATH; ?>plugins/select2/select2.min.js"></script>
	<!-- Slimscroll -->
	<script src="<?php echo THIS_TEM_ADMIN_PATH;?>plugins/slimScroll/jquery.slimscroll.min.js"></script>

	<!-- AdminLTE App -->
	<script src="<?php echo THIS_TEM_ADMIN_PATH;?>js/app.min.js"></script>

	<!-- AdminLTE for demo purposes -->
	<script src="<?php echo THIS_TEM_ADMIN_PATH;?>js/demo.js"></script>
	<script src="<?php echo ROOTHOST;?>global/plugins/bootstrap-summernote/summernote.min.js"></script>
</body>
</html>
