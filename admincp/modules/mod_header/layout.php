<?php 
if(!isset($objmember)) $objmember = new CLS_USERS(); 
if(!isset($UserLogin)) $UserLogin=new CLS_USERS;
?>
<header class="main-header">
	<!-- Logo -->
	<a href="<?php echo ROOTHOST_ADMIN;?>" class="logo">
		<!-- mini logo for sidebar mini 50x50 pixels -->
		<span class="logo-mini"><b>A</b>DM</span>
		<!-- logo for regular state and mobile devices -->
		<span class="logo-lg"><b>Admin</b></span>
	</a>
	<!-- Header Navbar: style can be found in header.less -->
	<nav class="navbar navbar-static-top">
		<!-- Sidebar toggle button-->
		<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
			<span class="sr-only">Toggle navigation</span>
		</a>
		<?php
		if($UserLogin->isLogin()){
			?>
			<div class="navbar-custom-menu">
				<ul class="nav navbar-nav">
					<!-- User Account: style can be found in dropdown.less -->
					<li class="dropdown user user-menu">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<img src="images/user2-160x160.jpg" class="user-image" alt="User Image">
							<span class="hidden-xs"><?php echo $objmember->getUsername(); ?></span>
						</a>
						<ul class="dropdown-menu">
							<!-- Menu Body -->
							<?php
							$flag=false;
							if(!isset($UserLogin)) $UserLogin=new CLS_USERS;
							if($UserLogin->isAdmin()==true){?>
							<li>
								<a href="index.php?com=gusers">
									<i class="fa fa-users" aria-hidden="true"></i>Quản lý nhóm user
								</a>
							</li>
							<li>
								<a href="index.php?com=users">
									<i class="fa fa-user" aria-hidden="true"></i> Quản lý user
								</a>
							</li>
							<li class="divider">
							</li>
							<!-- <li>
								<a href="index.php?com=customer">
									<i class="fa fa-envelope-o" aria-hidden="true"></i> Gửi tin tới khách hàng
								</a>
							</li>
							<li>
								<a href="index.php?com=slider">
									<i class="fa fa-sliders" aria-hidden="true"></i> Cấu hình slider
								</a>
							</li> -->
							<?php } ?>
							<li>
								<a href="index.php?com=users&task=changepass">
									<i class="fa fa-unlock-alt" aria-hidden="true"></i> Đổi mật khẩu
								</a>
							</li>
							<!-- Menu Footer-->
							<li class="user-footer">
								<div class="pull-left">
									<a class="btn btn-default btn-flat" href="index.php?com=users&task=profile">Thông tin cá nhân</a>
								</div>
								<div class="pull-right">
									<a class="btn btn-default btn-flat" href="index.php?com=users&task=logout">Đăng xuất</a>
								</div>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</nav>
	</header>
	<?php 
}?>