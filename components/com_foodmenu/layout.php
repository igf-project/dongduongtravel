<?php
    define('COMS', 'foodmenu');
    global $AR_POSITION_GROUP;
    include_once(LIB_PATH.'cls.location.php');
    include_once(LIB_PATH.'cls.position.php');
    include_once(LIB_PATH.'cls.foodmenu.php');
    include_once(EXT_PATH.'cls.upload.php');
    include_once(LIB_PATH.'cls.content.php');
    include_once(LIB_PATH.'cls.positiontype.php');
    $objPoCon=new CLS_CONTENTS();
    $objLo=new CLS_LOCATION();
    $objPo=new CLS_POSITION();
    $objPoType=new CLS_POSITIONTYPE();
    $objdata=new CLS_MYSQL();
    $obj=new CLS_FOODMENU();


    $com=isset($_GET['com'])? $_GET['com']:'';
    $viewtype=isset($_GET['viewtype'])? $_GET['viewtype']:'list';
    $arr=array('list','list_member', 'block', 'seach', 'detail', 'edit','active','delete', 'add', 'add_gallery','add_video', 'add_contentrelate',  'edit_gallery','edit_video', 'edit_contentrelate');
    if($com!=COMS OR in_array($viewtype, $arr)==false){
      die('PAGE NOT FOUND!');
    }
      
    include_once('tem/'.$viewtype.'.php');
    unset($obj); unset($objPoCon); unset($objGa); unset($objLo);unset($objdata);
?>