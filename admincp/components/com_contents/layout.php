
<?php
	defined('ISHOME') or die('Can not acess this page, please come back!');
	define('COMS', 'contents');
	define('OBJ',' Tin tức');
	include_once(LIB_PATH.'cls.content.php');
	include_once(EXT_PATH.'cls.upload.php');


	$title_manager="Danh sách ".OBJ;
	if(isset($_GET['task']) && $_GET['task']=='add')
		$title_manager = "Thêm mới ".OBJ;
	if(isset($_GET['task']) && $_GET['task']=='edit')
		$title_manager = "Sửa ".OBJ;
	require_once('includes/toolbar.php');


    
    $obj=new CLS_CONTENTS();
    $objUpload=new CLS_UPLOAD();
    include_once('tem/'.$viewtype.'.php');

    if(isset($_POST['cmdsave'])){
		 if($_POST['txt_code']==''){
            $obj->Code=un_unicode($_POST['txt_title']);
        }
        else{
            $obj->Code=un_unicode($_POST['txt_code']);
        }
		$obj->CatID=(int)$_POST['cbo_category'];
        $obj->locationId=(int)$_POST['cbo_location'];
		$obj->positionId=(int)$_POST['cbo_position'];
        $obj->Title=addslashes($_POST['txt_title']);
		$obj->Author=addslashes($_POST['txt_author']);
        $obj->Intro=addslashes($_POST['txt_intro']);
        $obj->Fulltext=addslashes($_POST['txt_fulltext']);
		$obj->GmID='';
        $obj->Meta_title=addslashes($_POST['txt_meta_title']);
        $obj->Meta_key=addslashes($_POST['txt_meta_key']);
        $obj->Meta_desc=addslashes($_POST['txt_meta_desc']);
        $obj->Order=0;
        $path='../'.PATH_THUMB;
            
		if(isset($_POST['txtid'])){
			$obj->ID=(int)$_POST['txtid'];
			/*upload ThumbIMG*/
			if(isset($_FILES['fileImg']) AND $_FILES['fileImg']['name']!=''){
				$obj->ThumbIMG = str_replace('../', '', $objUpload->UploadFile('fileImg', $path));
			}
			else $obj->ThumbIMG=$_POST['url_image'];
			$obj->Update();
		}else{
			/*upload ThumbIMG*/
			if(isset($_FILES['fileImg']) AND $_FILES['fileImg']['name']!=''){
				$obj->ThumbIMG = str_replace('../', '', $objUpload->UploadFile('fileImg', $path));
			}
			else $obj->ThumbIMG='';
			
			$obj->Add_new();

		}
		echo "<script language=\"javascript\">window.location.href='".ROOTHOST."member/tin-tuc/danh-sach'</script>";   
	}
    unset($viewtype); unset($com); unset($arr);unset($obj);unset($objPoContact);
?>

