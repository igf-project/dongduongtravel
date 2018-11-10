<?php
include_once('../../includes/gfinnit.php');
include_once('../../includes/gffunction.php');
include_once('../../includes/gfconfig.php');
include_once('../../libs/cls.mysql.php');
include_once('../../libs/cls.positionservices.php');
$obj=new CLS_POSITIONSERVICES();
$act=$_POST['act'];
$id=$_POST['val'];
if($act=='active'){
    $obj->setActive($id);
}
if($act=='del'){
    $obj->Delete($id);
}

$strWhere="`tbl_position_services`.`id`=".$id."";
$obj->listTable($strWhere, $ajax=true);
?>