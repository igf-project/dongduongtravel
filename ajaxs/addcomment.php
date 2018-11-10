<?php
session_start();
include_once('../includes/gfinnit.php');
include_once('../libs/cls.mysql.php');
include_once('../libs/cls.comment.php');
include_once('../libs/cls.member.php');
$obj=new CLS_COMMENT;

if(isset($_POST['subject'])){
	$obj->Title=$_POST['subject'];
	$obj->Content=$_POST['content'];
	$obj->PosID=$_POST['posid'];
	$obj->Cdate=date("Y-m-d H:i:s");
	$objmem=new CLS_MEMBER;
	$arr=$objmem->getUserLogin();
	$obj->UserID=$arr['fbid'];
	$obj->Add_New();
	echo 'Success';
}else{
	echo 'notdata';
} 
?>