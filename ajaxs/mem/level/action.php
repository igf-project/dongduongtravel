<?php
include_once('../../../includes/gfinnit.php');
include_once('../../../includes/gffunction.php');
include_once('../../../includes/gfconfig.php');
include_once('../../../libs/cls.mysql.php');
include_once('../../../libs/cls.member.php');
$obj=new CLS_MEMBER();
$objdata=new CLS_MYSQL();
if(isset($_POST['arrGmemId'])){
	$user=$_POST['txt_username'];
	/* $sql="select username FROM tbl_account_gmem WHERE `username`=$user";
	$objdata->Query($sql);
	var_dump($objdata->Num_rows()); */
	$str_arr = implode(',', $_POST['arrGmemId']);
	$obj->GmemId=$str_arr;
	$obj->Username=$_POST['txt_username'];
	$obj->ChangeLevel();
	/* $obj->Username=$_POST['txt_username'];
	 $post=$_POST['arrGmemId'];
	 $obj->DeleteLevel();
	foreach($post as $vl){
		$obj->GmemId=$vl;
		$obj->ChangeLevel();
	} */
}	
?>
