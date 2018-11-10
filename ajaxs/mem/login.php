<?php
session_start();
include_once('../../includes/gfinnit.php');
include_once('../../libs/cls.mysql.php');
include_once('../../libs/cls.member.php');
$objmem=new CLS_MEMBER;
$data=isset($_POST['pdata'])?$_POST['pdata']:'';
if($data!=''){
	$user=addslashes(str_replace(' ','',$data['username']));
	$pass=addslashes($data['password']);
	if(!$objmem->SystemLogin($user,$pass)){
		echo "Login Failse!";
	}
}else{ echo "System don't see data";}
?>