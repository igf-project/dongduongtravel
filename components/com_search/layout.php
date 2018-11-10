<?php
include_once(LIB_PATH.'cls.location.php');
$com=isset($_GET['com'])? $_GET['com']:'';
$viewtype=isset($_GET['viewtype'])? $_GET['viewtype']:'list';
$arrCom=array('search');
$arrViewtype=array('list','list-where-go');

if(!in_array($com, $arrCom) OR !in_array($viewtype, $arrViewtype)){
    die('PAGE NOT FOUND!');
}

include_once(LIB_PATH.'cls.location.php');
include_once(LIB_PATH.'cls.tour.php');
include_once(LIB_PATH.'cls.foodmenu.php');
$obj_tour = new CLS_TOUR;
$obj_foodmn =new CLS_FOODMENU;
$obj_news =new CLS_CONTENTS;
$obj_location =new CLS_LOCATION;

include_once('tem/'.$viewtype.'.php');
unset($viewtype); unset($com); unset($arr);unset($obj);
unset($obj_tour);
unset($obj_foodmn);
unset($obj_news);
unset($obj_location);
?>