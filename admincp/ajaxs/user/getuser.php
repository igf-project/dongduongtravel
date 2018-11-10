<?php
session_start();
include_once('../../../includes/gfinnit.php');
include_once('../../../includes/gfconfig.php');
include_once('../../../libs/cls.mysql.php');
$objdata=new CLS_MYSQL;
if(isset($_POST['username'])){
	$username = addslashes($_POST['username']);
	$sql = "SELECT username FROM tbl_user WHERE username='$username'";
	$objdata->Query($sql);
	if($objdata->Num_rows()>0) echo '1';
	else echo '0';
}
else echo '-1';
?>