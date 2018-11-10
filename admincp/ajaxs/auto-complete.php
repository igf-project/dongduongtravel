<?php
session_start();
include_once('../../includes/gfinnit.php');
include_once('../../includes/gfconfig.php');
include_once('../../libs/cls.mysql.php');
$objdata=new CLS_MYSQL;
if(isset($_POST['keyword'])){
	$keyword = addslashes($_POST['keyword']);
	$sql = "SELECT username FROM tbl_member_level WHERE username LIKE '%$keyword%'"; 
	$objdata->Query($sql);
	$str = '';
	if($objdata->Num_rows()>0) {
		while($row=$objdata->Fetch_Assoc())
			$str.=$row['username'].',';
		if($str!='') $str=substr($str,0,strlen($str)-1);
		echo $str;
	}
	echo '';
}
else{
	echo '';
}
?>