<?php
defined('ISHOME') or die('Can not acess this page, please come back!');
$id='';
if(isset($_GET['id']))
	$id=$_GET['id'];
$sql="UPDATE `tbl_foodmenu_category` SET `isactive`=if(`isactive`=0,1,0) WHERE `id` in ('$id')";
$objdata->Query($sql);
echo "<script language=\"javascript\">window.location='index.php?com=".COMS."'</script>";
?>