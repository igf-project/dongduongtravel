<?php
define('COMS', 'foodmenucate');
define('COMS_NAME',' Nhóm ẩm thực');
$task=isset($_GET['task'])?$_GET['task']:'';
$objdata = new CLS_MYSQL();


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
    if(isset($_SESSION['messager_'.COMS])) echo $_SESSION['messager_'.COMS];
    $task='list';
}
include_once(THIS_COM_PATH.'task/'.$task.'.php');
unset($task); unset($ids); unset($obj);
?>