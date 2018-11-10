<?php
defined('ISHOME') or die('Can not acess this page, please come back!');
define('COMS','food');
define('OBJ','Thực đơn');
define('THIS_COM_PATH',COM_PATH.'com_'.COMS.'/');
// Begin Toolbar
require_once(libs_path.'cls.food.php');
//require_once(libs_path.'cls.catalogs.php');
include_once(EXT_PATH.'cls.upload.php');
$obj=new CLS_FOOD();
$objUpload=new CLS_UPLOAD();
$title_manager="Danh sách ".OBJ;
if(isset($_GET['task']) && $_GET['task']=='add')
	$title_manager = "Thêm mới ".OBJ;
if(isset($_GET['task']) && $_GET['task']=='edit')
	$title_manager = "Sửa ".OBJ;
	
require_once("includes/toolbar.php");
// End toolbar
if(isset($_POST["cmdsave"])){		
	$obj->Cata_ID=(int)$_POST['cbo_cata'];
	$obj->Name= addslashes($_POST['txt_name']);
	$obj->Code= un_unicode(addslashes($_POST['txt_name']));
	$obj->Price=addslashes($_POST['txt_price']);
	$obj->PriceBig=addslashes($_POST['txt_pricebig']);
	$obj->isHot=(int)$_POST['opt_ishot'];
	$obj->Intro=addslashes($_POST['txt_intro']);
	$obj->Fulltext=	addslashes($_POST['txt_fulltext']);
	$obj->MTitle=addslashes($_POST['txt_metatitle']);	
	$obj->MKey=addslashes($_POST['txt_metakey']);	
	$obj->MDesc=addslashes($_POST['txt_metadesc']);
    $date=date('Y-m-d H:i:s');
    $path=PATH_THUMB;
    if(isset($_POST['txtid'])){
        $obj->Mdate=$date;
        /*upload thumb*/
        if(isset($_FILES['fileImg']) AND $_FILES['fileImg']['name']!=''){
            $obj->Thumb=LINK_THUMB.$objUpload->UploadFile('fileImg', $path);
        }
        else $obj->Thumb=$_POST['url_image'];
		$obj->ID=$_POST['txtid'];
		$obj->Update();
	}else{
        $obj->Cdate=$date;
        /*upload thumb*/
        if(isset($_FILES['fileImg']) AND $_FILES['fileImg']['name']!=''){
            $obj->Thumb=LINK_THUMB.$objUpload->UploadFile('fileImg', $path);
        }
        else $obj->Thumb='';
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
		case "order"	: include(THIS_COM_PATH."tem/order.php"); break;	
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