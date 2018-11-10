<?php
defined('ISHOME') or die('Can not acess this page, please come back!');
define('COMS','slider');
define('COMS_NAME','Banner slider');
$task=isset($_GET['task'])?$_GET['task']:'';
// Begin Toolbar
require_once(libs_path.'cls.slider.php');
include_once(EXT_PATH.'cls.upload.php');
$obj=new CLS_SLIDER();
$objdata=new CLS_MYSQL();
$objUpload=new CLS_UPLOAD();


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
unset($obj); unset($task);	unset($objlang); unset($ids);
?>