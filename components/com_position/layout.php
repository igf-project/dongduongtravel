<?php
global $AR_POSITION_GROUP;
include_once(LIB_PATH.'cls.location.php');
include_once(LIB_PATH.'cls.position.php');
include_once(EXT_PATH.'cls.upload.php');
include_once(LIB_PATH.'cls.positiongallery.php');
include_once(LIB_PATH.'cls.positionservices.php');
include_once(LIB_PATH.'cls.positiontype.php');
include_once(LIB_PATH.'cls.content.php');
$objCon=new CLS_CONTENTS();
$objLo=new CLS_LOCATION();
$objPoSer=new CLS_POSITIONSERVICES();
$objPoType=new CLS_POSITIONTYPE();
$objPo=new CLS_POSITION();
$objGa=new CLS_POSITIONGALLERY();
$objdata=new CLS_MYSQL();

$obj=new CLS_POSITION();
define('COMS', 'position');
$com=isset($_GET['com'])? $_GET['com']:'';
$viewtype=isset($_GET['viewtype'])? addslashes($_GET['viewtype']):'list';
$arr=array('list', 'block', 'detail');
if($com!=COMS OR in_array($viewtype, $arr)==false OR !is_file(COM_PATH.'com_'.$com.'/tem/'.$viewtype.'.php')){ //Check
    die('PAGE NOT FOUND!');
}
include_once('tem/'.$viewtype.'.php');
unset($viewtype); unset($com); unset($arr);unset($obj);unset($objCon); unset($objPoSer); unset($objPo); unset($objGa);; unset($objdata);
?>

