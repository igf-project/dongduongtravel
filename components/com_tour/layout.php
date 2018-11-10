<?php
	define('COMS', 'tour');
	include_once(LIB_PATH."cls.location.php");
	include_once(LIB_PATH."cls.tourtype.php");
    $obj_TourType=new CLS_TOURTYPE();
	$objLo=new CLS_LOCATION();
	

    $com=isset($_GET['com'])? $_GET['com']:'';
    $viewtype=isset($_GET['viewtype'])? addslashes($_GET['viewtype']):'list';
	$arr=array('search', 'list', 'block', 'detail', 'article', 'add', 'edit', 'delete', 'active', 'list_member', 'add_gallery', 'edit_gallery', 'detail1', 'detail2');
	if($com!=COMS OR in_array($viewtype, $arr)==false OR !is_file(COM_PATH.'com_'.$com.'/tem/'.$viewtype.'.php')){ //Check
        die('PAGE NOT FOUND!');
    }
    include_once(LIB_PATH.'cls.tour.php');
    include_once(EXT_PATH.'cls.upload.php');
    $obj=new CLS_TOUR();
    include_once('tem/'.$viewtype.'.php');
    unset($viewtype); unset($com); unset($arr);unset($obj);
?>

