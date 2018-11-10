<?php 
	define('COMS', 'products');
	include_once(LIB_PATH.'cls.products.php');
	include_once(EXT_PATH.'cls.upload.php');
	include_once(LIB_PATH."cls.member.php");
	include_once(LIB_PATH.'cls.catalog.php');
	include_once(LIB_PATH."cls.location.php");
	include_once(LIB_PATH.'cls.content.php');
	$objCon= new CLS_CONTENTS();
	$objLo=new CLS_LOCATION();
	$obj_Cata=new CLS_CATALOG();
	$objdata=new CLS_MYSQL();
	$obj=new CLS_PRODUCTS();
	
	$com=isset($_GET['com'])? $_GET['com']:'';
	$viewtype=isset($_GET['viewtype'])? addslashes($_GET['viewtype']):'list';
	$arr=array('list','hot', 'block', 'seach', 'detail', 'add', 'edit', 'delete', 'active', 'article', 'list_member');
	if($com!=COMS OR in_array($viewtype, $arr)==false OR !is_file(COM_PATH.'com_'.$com.'/tem/'.$viewtype.'.php')){ //Check
		die('PAGE NOT FOUND!');
	}
	
	include_once('tem/'.$viewtype.'.php');

	// if(isset($_POST['cmdsave'])){
	// 	if($_POST['txt_code']==''){
	// 		$obj->Code=un_unicode($_POST['txt_name']);
	// 	}
	// 	else{
	// 		$obj->Code=un_unicode($_POST['txt_code']);
	// 	}
	// 	$obj->CataId=(int)$_POST['cbo_catalog'];
	// 	$obj->LocationId=(int)$_POST['cbo_location'];
	// 	$obj->PositionId=(int)$_POST['cbo_position'];
	// 	$obj->Name=addslashes($_POST['txt_name']);
	// 	$obj->Author=addslashes($_POST['txt_author']);
	// 	$obj->Intro=addslashes($_POST['txt_intro']);
	// 	$obj->Cur_price=addslashes($_POST['txt_price']);
	// 	$obj->Fulltext=addslashes($_POST['txt_fulltext']);
	// 	$obj->MTitle=addslashes($_POST['txt_meta_title']);
	// 	$obj->MKey=addslashes($_POST['txt_meta_key']);
	// 	$obj->MDesc=addslashes($_POST['txt_meta_desc']);
	// 	$obj->Order=0;

	// 	if(isset($_POST['txtid'])){
	// 		$obj->ID=(int)$_POST['txtid'];
	// 		/*upload Thumb*/
	// 		if(isset($_FILES['fileImg']) AND $_FILES['fileImg']['name']!=''){
	// 			$objUpload=new CLS_UPLOAD();
	// 			$path=PATH_THUMB;
	// 			$obj->Thumb=$objUpload->UploadFile('fileImg', $path);
	// 		}
	// 		else $obj->Thumb=$_POST['url_image'];
	// 		$obj->Update();
	// 	}else{
	// 		/*upload Thumb*/
	// 		if(isset($_FILES['fileImg']) AND $_FILES['fileImg']['name']!=''){
	// 			$objUpload=new CLS_UPLOAD();
	// 			$path=PATH_AVATAR;
	// 			$obj->Thumb=$objUpload->UploadFile('fileImg', $path);
	// 		}
	// 		else $obj->Thumb='';

	// 		$obj->Add_new();

	// 	}
	// 	echo "<script language=\"javascript\">window.location.href='".ROOTHOST."member/qua-tang/danh-sach'</script>";
	// }


	unset($viewtype); unset($com); unset($arr);unset($obj);unset($obj_Cata);unset($objLo);unset($objdata);unset($objCon);
?>

