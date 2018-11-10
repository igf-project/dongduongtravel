<?php 
	global $AR_TOUR_TYPE;
	global $AR_EXPEDIENCY;
	defined('ISHOME') or die('Can not acess this page, please come back!');
	define('COMS', 'tour');
	define('COMS_NAME',' Đặt tour');
	$task=isset($_GET['task'])?$_GET['task']:'';
	include_once(LIB_PATH.'cls.tour.php');
	include_once(LIB_PATH.'cls.location.php');
	include_once(LIB_PATH.'cls.position.php');
	include_once(EXT_PATH.'cls.upload.php');
	include_once(LIB_PATH."cls.tourprogramwhere.php");
	include_once(LIB_PATH."cls.tourprogramfood.php");
	include_once(LIB_PATH."cls.tourprogramsleep.php");


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

	$obj=new CLS_TOUR();
	$objdata=new CLS_MYSQL();
	$obj_Location = new CLS_LOCATION();
	
	define('THIS_COM_PATH',COM_PATH.'com_'.COMS.'/');

	if(!is_file(THIS_COM_PATH.'task/'.$task.'.php')){
		$task='list';
	}
	include_once(THIS_COM_PATH.'task/'.$task.'.php');
	unset($viewtype); unset($com); unset($arr);unset($obj);
?>

