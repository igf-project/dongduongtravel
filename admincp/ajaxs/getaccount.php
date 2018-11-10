<?php
session_start();
include_once('../../includes/gfinnit.php');
include_once('../../includes/gfconfig.php');
include_once('../../libs/cls.mysql.php');
$objdata=new CLS_MYSQL;
if(isset($_POST['user'])){
	$username = addslashes($_POST['user']);
	$sql = "SELECT account FROM tbl_accounts WHERE username='$username' AND status=1";
	$objdata->Query($sql);$str=''; 
	if($objdata->Num_rows()>0) {
		while($r=$objdata->Fetch_Assoc())
			$str.="<option value='".$r['account']."'>".$r['account']."</option>";
		echo $str;
	} else echo '';
}
else echo '';
?>