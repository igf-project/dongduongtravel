<?php
defined('ISHOME') or die('Can not acess this page, please come back!');
$id='';
if(isset($_GET['id']))
    $id=(int)$_GET['id'];
$sql="DELETE  FROM `tbl_foodmenu_category` WHERE `id` in ('$id')";
$objdata->Query($sql);
echo "<script language=\"javascript\">window.location='index.php?com=".COMS."'</script>";
?>