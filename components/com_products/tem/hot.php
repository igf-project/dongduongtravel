<?php
	defined('ISHOME') or die('Can not acess this page, please come back!');
	$id='';
	if(isset($_GET['id']))
		$id=(int)$_GET['id'];
		$obj->setHot($id);
	echo "<script language=\"javascript\">window.location='".ROOTHOST."member/qua-tang/danh-sach'</script>";
?>