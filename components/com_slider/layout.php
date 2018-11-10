<?php
include_once(LIB_PATH.'cls.location.php');
$com=isset($_GET['com'])? $_GET['com']:'';
$viewtype=isset($_GET['viewtype'])? $_GET['viewtype']:'';
$arrCom=array('position', 'tour');
$arrViewtype=array('detail', 'article');

/* if($MEMBER_LOGIN->isLogin()){*/
if(!in_array($com, $arrCom) OR !in_array($viewtype, $arrViewtype)){
//if($com!='position' OR $viewtype!='detail'){
    include_once(COM_PATH.'com_slider/tem/list_main.php');
}
/* }
else{
	echo '<h2>afsdfdsfdsfdfdsffd df </h2>h2>';
}*/

unset($viewtype); unset($com); unset($arr);unset($obj);
?>