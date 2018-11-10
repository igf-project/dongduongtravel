<?php
	defined('ISHOME') or die('Can not acess this page, please come back!');
	$id='';
	$objdata=new CLS_MYSQL();
	if(isset($_GET['id']))	$id=(int)$_GET['id'];
	if(isset($_GET['loc']))	$location_id=(int)$_GET['loc'];
	$sql="UPDATE `tbl_location_content_festival` SET `isactive`=if(`isactive`=0,1,0) WHERE `id` in ('$id')";
	$objdata->Query($sql);
	echo "<script>window.location.href='index.php?com=".COMS."&task=list-lichsu&loc=".$location_id."'</script>";
?>