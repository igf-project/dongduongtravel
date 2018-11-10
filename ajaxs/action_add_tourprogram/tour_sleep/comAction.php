<?php
include_once('../../../includes/gfinnit.php');
include_once('../../../includes/gffunction.php');
include_once('../../../includes/gfconfig.php');
include_once('../../../libs/cls.mysql.php');
include_once('../../../libs/cls.tourprogramsleep.php');
$obj=new CLS_TOURPROGRAMSLEEP();
    $act=$_POST['act'];
    $id=$_POST['val'];
    $tour_id=$_POST['tour_id'];
if($act=='active'){
    $obj->setActive($id);
}
if($act=='del'){
    $obj->Delete($id);
}
$str="WHERE `tour_id`=$tour_id AND `day_id`=$day_active.";
/*$strWhere="`tbl_tour_programsleep`.`id`=".$id."";*/
$obj-> $objTourProWh->getListItemForm($str, $limit='');
?>