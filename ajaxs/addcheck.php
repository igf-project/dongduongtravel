<?php
session_start();
include_once('../includes/gfinnit.php');
include_once('../libs/cls.mysql.php');
include_once('../libs/cls.checkin.php');
include_once('../libs/cls.member.php');
$obj=new CLS_CHECKIN;

if(isset($_POST['act'])){
	$obj->PosID=$_POST['posid'];
	$obj->$_POST['act']=1;
	$objmem=new CLS_MEMBER;
	$arr=$objmem->getUserLogin();
	$obj->FbID=$arr['fbid'];
	if($obj->PosID==0 or $obj->FbID==0) { echo 'empty';return;}
	
	$obj->plusField($_POST['act']);
	echo 'success';return;
}else{
	echo 'fail';
} 
?>