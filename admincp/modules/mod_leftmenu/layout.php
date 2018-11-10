<?php
defined('ISHOME') or die('Can not acess this page, please come back!');
if(!isset($objuser)) $objuser = new CLS_USERS();
?>
<aside class="main-sidebar">
	<section class="sidebar">
		<div class="user-panel">
			<div class="pull-left image">
				<img src="images/user2-160x160.jpg" class="img-circle" alt="User Image">
			</div>
			<div class="pull-left info">
				<p><?php echo $_SESSION[MD5($_SERVER['HTTP_HOST']).'_USERLOGIN']; ?></p>
				<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
			</div>
		</div>
		<ul class="sidebar-menu">
			<li class="treeview">
				<a href="index.php?com=tourpersonrequest">
					<i class="fa fa fa-newspaper-o"></i> <span>Đặt tour theo yêu cầu</span>
				</a>
			</li>
			<li class="treeview">
				<a href="index.php?com=tourperson">
					<i class="fa fa fa-newspaper-o"></i> <span>DS đặt tour</span>
				</a>
			</li>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-newspaper-o"></i>
					<span>Địa danh</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li><a href="index.php?com=location"><i class="fa fa-circle-o"></i> Tỉnh thành</a></li>
					<li><a href="index.php?com=position"><i class="fa fa-circle-o"></i> Địa điểm</a></li>
				</ul>
			</li>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-newspaper-o"></i>
					<span>Tour</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li><a href="index.php?com=tour"><i class="fa fa-circle-o"></i> Danh sách Tour</a></li>
					<li><a href="index.php?com=tourtype"><i class="fa fa-circle-o"></i> Kiểu Tour</a></li>
				</ul>
			</li>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-cutlery" aria-hidden="true"></i>
					<span>Ẩm thực</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li><a href="index.php?com=foodmenu"><i class="fa fa-circle-o"></i> Danh sách món ăn</a></li>
					<li><a href="index.php?com=foodmenucate"><i class="fa fa-circle-o"></i> Nhóm món ăn</a></li>
					<li><a href="index.php?com=foodmenurecommend"><i class="fa fa-circle-o"></i> Nhóm đối tượng</a></li>
				</ul>
			</li>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-cutlery" aria-hidden="true"></i>
					<span>Quà tặng</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li><a href="index.php?com=product"><i class="fa fa-circle-o"></i> Danh sách quà tặng</a></li>
					<li><a href="index.php?com=catalogs"><i class="fa fa-circle-o"></i> Nhóm quà tặng</a></li>
				</ul>
			</li>
			<li class="treeview">
				<a href="index.php?com=slider">
					<i class="fa fa-desktop"></i> <span>Banner slide</span>
				</a>
			</li>
		</ul>
	</section>
	<!-- /.sidebar -->
</aside>
