<?php
session_start();
include_once('../../includes/gfinnit.php');
include_once('../../libs/cls.mysql.php');
include_once('../../libs/cls.member.php');
$objmem=new CLS_MEMBER;
$data=isset($_POST['pdata'])?$_POST['pdata']:'';
if($data!=''){
	$objmem->First_name=addslashes($data['first_name']);
	$objmem->Last_name=addslashes($data['last_name']);
	$objmem->Username=addslashes(str_replace(' ','',$data['username']));
	$objmem->Password=md5(sha1(addslashes($data['password'])));
	if(!$objmem->Add_new()){
		echo "Register failse!";
	}
}else{ echo "System don't see data";}
?>