<?php
	defined('ISHOME') or die('Can not acess this page, please come back!');
	$id='';
	if(isset($_GET['positioncontact_id']))
		$id=(int)$_GET['positioncontact_id'];
	$obj->Delete($id);
	echo "<script language=\"javascript\">window.location='".ROOTHOST."member/dia-diem/danh-sach'</script>";
?>