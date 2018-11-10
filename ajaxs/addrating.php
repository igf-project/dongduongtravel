<?php
session_start();
include_once('../includes/gfinnit.php');
include_once('../libs/cls.mysql.php');
include_once('../libs/cls.rating.php');
include_once('../libs/cls.member.php');
$objrate=new CLS_RATING;

if(isset($_POST['posid'])){
	$objmem=new CLS_MEMBER;
	$arr=$objmem->getUserLogin();
	$objrate->FbID=$arr['fbid'];
	
	$objrate->PosID=(int)$_POST['posid'];
	$objrate->Location=(int)$_POST['mark_loc'];
	$objrate->Quality=(int)$_POST['mark_qua'];
	$objrate->Price=(int)$_POST['mark_pri'];
	$objrate->Service=(int)$_POST['mark_ser'];
	$objrate->Space=(int)$_POST['mark_spa'];
	$objrate->AddMark();
	echo 'Success';
}else{
	echo 'notdata';
} 
?>