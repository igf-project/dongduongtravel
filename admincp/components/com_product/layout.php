<?php
defined('ISHOME') or die('Can not acess this page, please come back!');
define('COMS','product');
define('COMS_NAME','quà tặng');
$task=isset($_GET['task'])?$_GET['task']:'';
require_once(libs_path.'cls.catalogs.php');
require_once(libs_path.'cls.product.php');
include_once(EXT_PATH.'cls.upload.php');
$obj_cata = new CLS_CATALOGS();
$objUpload = new CLS_UPLOAD();
$objdata = new CLS_MYSQL();
$obj = new CLS_PRODUCTS();



function write_path(){
    $str="<div class='panel-top path'><a href='index.php'>Trang chủ</a> ";
    if(isset($_GET['com'])){
        $com=$_GET['com'];
        $str.=" <i class='fa fa-angle-double-right' aria-hidden='true'></i> <a href='?com=$com'>{com}</a>";
    }
    if(isset($_GET['task'])){
        $task=$_GET['task'];
        $str.=" <i class='fa fa-angle-double-right' aria-hidden='true'></i> {task}";
    }
    $str.="</div>";
    $str=str_replace(array('{com}','{task}'), array(COMS_NAME,TASK_NAME), $str);
    echo $str;
}

define('THIS_COM_PATH',COM_PATH.'com_'.COMS.'/');
if(!is_file(THIS_COM_PATH.'task/'.$task.'.php')){
	$task='list';
}
include_once(THIS_COM_PATH.'task/'.$task.'.php');
unset($obj); unset($task);	unset($objUpload); unset($ids); unset($objdata);
?>