<?php
	defined('ISHOME') or die('Can not acess this page, please come back!');
	$id='';
	$objdata=new CLS_MYSQL();
	if(isset($_GET['id']))	$id=(int)$_GET['id'];
	if(isset($_GET['pos']))	$position_id=(int)$_GET['pos'];
	$sql="DELETE FROM `tbl_location_content_festival` WHERE `id` in ('$id')";
	$objdata->Query($sql);
	echo "<script>window.location.href='index.php?com=".COMS."&task=list-lichsu&pos=".$position_id."'</script>";
?>