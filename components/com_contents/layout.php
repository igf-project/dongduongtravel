
<?php
	define('COMS', 'contents');
	include_once(LIB_PATH.'cls.content.php');
	include_once(EXT_PATH.'cls.upload.php');
    $obj=new CLS_CONTENTS();
    
    $com=isset($_GET['com'])? $_GET['com']:'';
    $viewtype=isset($_GET['viewtype'])? addslashes($_GET['viewtype']):'detail';
	$arr=array('list', 'block', 'seach', 'detail', 'add', 'edit', 'delete', 'active', 'article', 'list_member');
	if($com!=COMS OR in_array($viewtype, $arr)==false OR !is_file(COM_PATH.'com_'.$com.'/tem/'.$viewtype.'.php')){ //Check
        die('PAGE NOT FOUND!');
    }
    
    include_once('tem/'.$viewtype.'.php');

 //    if(isset($_POST['cmdsave'])){
		
 //        /*contents*/
	// 	 if($_POST['txt_code']==''){
 //            $obj->Code=un_unicode($_POST['txt_title']);
 //        }
 //        else{
 //            $obj->Code=un_unicode($_POST['txt_code']);
 //        }
	// 	$obj->CatID=(int)$_POST['cbo_category'];
 //        $obj->locationId=(int)$_POST['cbo_location'];
	// 	$obj->positionId=(int)$_POST['cbo_position'];
 //        $obj->Title=addslashes($_POST['txt_title']);
	// 	$obj->Author=addslashes($_POST['txt_author']);
 //        $obj->Intro=addslashes($_POST['txt_intro']);
 //        $obj->Fulltext=addslashes($_POST['txt_fulltext']);
	// 	$obj->GmID='';
 //        $obj->Meta_title=addslashes($_POST['txt_meta_title']);
 //        $obj->Meta_key=addslashes($_POST['txt_meta_key']);
 //        $obj->Meta_desc=addslashes($_POST['txt_meta_desc']);
 //        $obj->Order=0;
            
	// 	if(isset($_POST['txtid'])){
	// 		$obj->ID=(int)$_POST['txtid'];
	// 		/*upload ThumbIMG*/
	// 		if(isset($_FILES['fileImg']) AND $_FILES['fileImg']['name']!=''){
	// 			$objUpload=new CLS_UPLOAD();
	// 			$path=PATH_THUMB;
	// 			$obj->ThumbIMG=$objUpload->UploadFile('fileImg', $path);
	// 		}
	// 		else $obj->ThumbIMG=$_POST['url_image'];
	// 		$obj->Update();
	// 	}else{
	// 		/*upload ThumbIMG*/
	// 		if(isset($_FILES['fileImg']) AND $_FILES['fileImg']['name']!=''){
	// 			$objUpload=new CLS_UPLOAD();
	// 			$path=PATH_AVATAR;
	// 			$obj->ThumbIMG=$objUpload->UploadFile('fileImg', $path);
	// 		}
	// 		else $obj->ThumbIMG='';
			
	// 		$obj->Add_new();

	// 	}
	// 	echo "<script language=\"javascript\">window.location.href='".ROOTHOST."member/tin-tuc/danh-sach'</script>";   
	// }
    unset($viewtype); unset($com); unset($arr);unset($obj);unset($objPoContact);
?>

