<?php
	defined('ISHOME') or die('Can not acess this page, please come back!');
   //include(LIB_PATH."cls.positioncontact.php");
  
	$id='';
	if(isset($_GET['id']))
		$id=(int)$_GET['id'];
  
    $obj->Delete($id);
echo "<script language=\"javascript\">window.location='".ROOTHOST."member/slider/danh-sach'</script>";
?>