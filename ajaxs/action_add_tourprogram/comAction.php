<?php
include_once('../../includes/gfinnit.php');
include_once('../../includes/gffunction.php');
include_once('../../includes/gfconfig.php');
include_once('../../libs/cls.mysql.php');
include_once('../../libs/cls.tourprogram.php');
$obj=new CLS_TOURPROGRAM();
    $act=$_POST['act'];
    $id=$_POST['val'];
    $tour_id=$_POST['tour_id'];
if($act=='active'){
    $obj->setActive($id);
}
if($act=='del'){
    $obj->Delete($id);
}

$strWhere="`tbl_tour_program`.`id`=".$id."";
$obj->listTable($strWhere, $ajax=true);
?>