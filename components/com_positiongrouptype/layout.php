<?php
    global $AR_POSITION_GROUP;
    include_once(LIB_PATH.'cls.position.php');
    include_once(LIB_PATH.'cls.location.php');
    include_once(LIB_PATH.'cls.positiontype.php');
    $objPo=new CLS_POSITION();
    $objLo=new CLS_LOCATION();
    $objPoType=new CLS_POSITIONTYPE();

    define('THIS_COM', 'positiongrouptype');
    $com=isset($_GET['com'])? $_GET['com']:'';
    $viewtype=isset($_GET['viewtype'])? addslashes($_GET['viewtype']):'list';
    $arr=array('list', 'block', 'seach', 'detail');
    if($com!=THIS_COM OR in_array($viewtype, $arr)==false OR !is_file(COM_PATH.'com_'.$com.'/tem/'.$viewtype.'.php')){
        die('PAGE NOT FOUND!');
    }
    include_once('tem/'.$viewtype.'.php');

    unset($viewtype); unset($com); unset($arr);unset($obj);unset($objPo); unset($objLo);
?>