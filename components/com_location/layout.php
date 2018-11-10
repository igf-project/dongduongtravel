<?php
    global $AR_CATE_CONTENT;
    global $AR_POSITION_GROUP;
    global $AR_CATE_CONTENT;
	define('COMS', 'location');
    include_once(LIB_PATH.'cls.location.php');
	include_once(LIB_PATH.'cls.locationcontent.php');
    include_once(EXT_PATH.'cls.upload.php');
    include_once(LIB_PATH.'cls.tour.php');
    include_once(LIB_PATH.'cls.position.php');
    include_once(LIB_PATH.'cls.positiongallery.php');
    include_once(LIB_PATH.'cls.positiontype.php');
    include_once(LIB_PATH.'cls.foodmenu.php');
    include_once(LIB_PATH.'cls.category.php');
    include_once(LIB_PATH.'cls.content.php');
    $objFood=new CLS_FOODMENU();
    $obj=new CLS_LOCATION();
    $objdata=new CLS_MYSQL();
    $objTour=new CLS_TOUR();
    $objPo=new CLS_POSITION();
    $objGa=new CLS_POSITIONGALLERY();
    $objPoType=new CLS_POSITIONTYPE();
    $objCat=new CLS_CATE();
    $objCon=new CLS_CONTENTS();

    $com=isset($_GET['com'])? $_GET['com']:'';
    $viewtype=isset($_GET['viewtype'])? addslashes($_GET['viewtype']):'list';
	$arr=array('list', 'block', 'seach', 'detail', 'block_history', 'block_cultutar', 'list_member', 'block_festival', 'detail_history', 'detail_cultutar', 'detail_festival');
	if($com!=COMS OR in_array($viewtype, $arr)==false OR !is_file(COM_PATH.'com_'.$com.'/tem/'.$viewtype.'.php')){ //Check
		die('PAGE NOT FOUND!');
	}

    include_once('tem/'.$viewtype.'.php');
    unset($viewtype); unset($com); unset($arr);unset($obj);unset($objTour); unset($objFood); unset($objGa); unset($objPo); unset($objPoType); unset($objdata);
?>