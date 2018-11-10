<?php
defined('ISHOME') or die('Can not acess this page, please come back!');
define('COMS','showroom');
define('OBJ','Hệ thống nhà hàng');
define('THIS_COM_PATH',COM_PATH.'com_'.COMS.'/');
// Begin Toolbar
require_once(libs_path.'cls.showroom.php');
include_once(EXT_PATH.'cls.upload.php');
$obj=new CLS_SHOWROOM();
$objUpload=new CLS_UPLOAD();
$title_manager="Danh sách ".OBJ;
if(isset($_GET['task']) && $_GET['task']=='add')
	$title_manager = "Thêm mới ".OBJ;
if(isset($_GET['task']) && $_GET['task']=='edit')
	$title_manager = "Sửa ".OBJ;
	
require_once("includes/toolbar.php");
// End toolbar
if(isset($_POST["cmdsave"])){		
	$obj->Title= addslashes($_POST['txt_name']);
	$obj->Code= un_unicode(addslashes($_POST['txt_name']));
	$obj->Address=addslashes($_POST['txt_address']);
	$obj->Phone=addslashes($_POST['txt_phone']);
	$obj->Tel=addslashes($_POST['txt_tel']);
	$obj->Map=addslashes($_POST['txt_map']);
	$obj->Intro=addslashes($_POST['txt_intro']);
	$obj->Fulltext=	addslashes($_POST['txt_fulltext']);
    $date=date('Y-m-d H:i:s');
    if(isset($_POST["txtthumb"]))
        $obj->Thumb=addslashes($_POST["txtthumb"]);
    if(isset($_POST['txtid'])){
		$obj->ID=$_POST['txtid'];
		$obj->Update();
	}else{
        $obj->Cdate=$date;
		$obj->Add_new();
	}
	echo "<script language=\"javascript\">window.location='index.php?com=".COMS."'</script>";
}
if(isset($_POST["txtaction"]) && $_POST["txtaction"]!=""){
	$ids=$_POST["txtids"];
	$ids=str_replace(",","','",$ids);
	switch ($_POST["txtaction"]){
		case "public": 		$obj->setActive($ids,1); 		break;
		case "unpublic": 	$obj->setActive($ids,0); 		break;
		case "edit": 	
			$id=explode("','",$ids);
			echo "<script language=\"javascript\">window.location='index.php?com=".COMS."&task=edit&id=".$id[0]."'</script>";
			exit();
			break;
		case "order"	: include(THIS_COM_PATH."task/order.php"); break;
		case "delete": 		$obj->Delete($ids); 		break;
	}
	echo "<script language=\"javascript\">window.location.href='index.php?com=".COMS."'</script>";
}
if(isset($_GET['task']))
	$task=$_GET['task'];
if(!is_file(THIS_COM_PATH.'task/'.$task.'.php')){
	$task='list';
}
include_once(THIS_COM_PATH.'task/'.$task.'.php');
unset($obj); unset($task);	unset($objlang); unset($ids);
?>