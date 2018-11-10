<?php
include_once('../../../includes/gfinnit.php');
include_once('../../../includes/gffunction.php');
include_once('../../../includes/gfconfig.php');
include_once('../../../libs/cls.mysql.php');
include_once('../../../libs/cls.tourprogramwhere.php');
$obj=new CLS_TOURPROGRAMWHERE();
    $act=$_POST['act'];
    $id=$_POST['val'];
    $tour_id=$_POST['tour_id'];
if($act=='active'){
    $obj->setActive($id);
}
if($act=='del'){
    $obj->Delete($id);
}

$strWhere="`tbl_tour_programwhere`.`id`=".$id."";

?>