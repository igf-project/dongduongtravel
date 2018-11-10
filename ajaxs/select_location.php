<?php
session_start();
include_once('../includes/gfinnit.php');
include_once('../libs/cls.mysql.php');
include_once('../libs/cls.location.php');
$obj=new CLS_LOCATION;

if(isset($_POST['par_id'])){
	$obj->selectBox($_POST['par_id']);
}else{
	echo 'fail';
} 
?>