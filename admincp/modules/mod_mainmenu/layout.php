<?php

if($UserLogin->isLogin()){
?>
<div class="page-header navbar navbar-fixed-top">
<div class="page-header-inner">
	<div class="page-logo">
		<a href="<?php echo ROOTHOST;?>">DXWeb development</a>
		<div class="menu-toggler sidebar-toggler hide"></div>
	</div>
	<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
	</a>
	<div class="top-menu">
		<ul class="nav navbar-nav pull-right">
			<li class="dropdown dropdown-user">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
				<i class="fa fa-user"></i>
                    <?php
                    if(!isset($objmember)) $objmember = new CLS_USERS();
                    echo $objmember->getUsername();
                    ?>
				<span class="username username-hide-on-mobile">	<?php /*echo $UserLogin->getFullname();*/?> </span>
				<i class="fa fa-angle-down"></i>
				</a>
				<ul class="dropdown-menu dropdown-menu-default">
                    <?php

                    $flag=false;
                    if(!isset($UserLogin)) $UserLogin=new CLS_USERS;
                    if($UserLogin->isAdmin()==true){?>
                        <li>
                            <a href="index.php?com=gusers">
                                <i class="fa fa-users" aria-hidden="true"></i>Quản lý nhóm user</a>
                        </li>
                        <li>
                            <a href="index.php?com=users">
                                <i class="fa fa-user" aria-hidden="true"></i> Quản lý user</a>
                        </li>

                        <li class="divider">
                        </li>
                        <li>
                            <a href="index.php?com=users&task=send_mail">
                                <i class="fa fa-envelope-o" aria-hidden="true"></i> Gửi tin tới khách hàng</a>
                        </li>
                        <li>
                            <a href="index.php?com=slider">
                                <i class="fa fa-sliders" aria-hidden="true"></i> Cấu hình slider</a>
                        </li>
                    <?php } ?>
					<li>
						<a href="index.php?com=users&task=changepass">
                            <i class="fa fa-unlock-alt" aria-hidden="true"></i> Đổi mật khẩu</a>
					</li>
					<li>
						<a href="index.php?com=users&task=logout">
                            <i class="fa fa-sign-out" aria-hidden="true"></i> Log Out </a>
					</li>
				</ul>
			</li>
			<!-- END USER LOGIN DROPDOWN -->
			<!-- BEGIN QUICK SIDEBAR TOGGLER -->
			<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
			<li class="dropdown dropdown-quick-sidebar-toggler">
				<a href="javascript:;" class="dropdown-toggle">
				<i class="icon-logout"></i>
				</a>
			</li>
			<!-- END QUICK SIDEBAR TOGGLER -->
		</ul>
	</div>
	<!-- END TOP NAVIGATION MENU -->
</div>
</div>
<?php }?>