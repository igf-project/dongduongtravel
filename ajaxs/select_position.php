<?php
session_start();
include_once('../includes/gfinnit.php');
include_once('../libs/cls.mysql.php');
include_once('../libs/cls.position.php');
$obj=new CLS_POSITION;

if(isset($_POST['name'])){
	$arr = $obj->getListName(stripslashes($_POST['name']));
	print_r($arr);
}else{
	echo '';
} 
?>