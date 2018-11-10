<?php
	define('COMS', 'positionservice');
	$com=isset($_GET['com'])? $_GET['com']:'';
	$viewtype=isset($_GET['viewtype'])? $_GET['viewtype']:'list';
	$arr=array('list', 'block', 'seach', 'detail', 'edit','active','delete', 'add');
	if($com!=COMS OR in_array($viewtype, $arr)==false){ //Check
		die('PAGE NOT FOUND!');
	}
	else{
		include_once(LIB_PATH.'cls.positionservices.php');
		$obj=new CLS_POSITIONSERVICES();
		include_once('tem/'.$viewtype.'.php');
	}
unset($obj);
?>