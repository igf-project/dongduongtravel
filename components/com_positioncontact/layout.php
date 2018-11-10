<?php
	define('COMS', 'positioncontact');
	$com=isset($_GET['com'])? $_GET['com']:'';
	$viewtype=isset($_GET['viewtype'])? $_GET['viewtype']:'list';
	$arr=array('list', 'block', 'seach', 'detail', 'edit','active','delete', 'add', 'add_service', 'add_gallery', 'add_video', 'add_contentrelate' ,'edit_map', 'edit_service', 'edit_gallery', 'edit_video', 'edit_contentrelate');
	if($com!=COMS OR in_array($viewtype, $arr)==false){ //Check
		die('PAGE NOT FOUND!');
	}
	else{
		include_once(LIB_PATH.'cls.positioncontact.php');
        include_once(EXT_PATH.'cls.upload.php');
		$obj=new CLS_POSITIONCONTACT();

		include_once('tem/'.$viewtype.'.php');
	}
if(isset($_POST['cmdsave'])){

    $obj->countryId=(int)$_POST['cbo_countries'];
    $obj->locationId=(int)$_POST['cbo_location'];
    $obj->contactName=addslashes($_POST['txt_contact_name']);
    $obj->Phone=addslashes($_POST['txt_phone']);
    $obj->Address=addslashes($_POST['txt_address']);
    $obj->Email=addslashes($_POST['txt_email']);
    $obj->Website=addslashes($_POST['txt_website']);
    $obj->Latlng='';
    $obj->isActive='1';
    $obj->Order=0;
   

    if(isset($_POST['txtid'])){
        $position_id=isset($_POST['txt_position_id']) ? $_POST['txt_position_id']:'';
        $position_code=isset($_POST['txt_position_code']) ? $_POST['txt_position_code']:'';
        $id=(int)$_POST['txtid'];
		
		 /*upload avatar*/
		if(isset($_FILES['fileImg']) AND $_FILES['fileImg']['name']!=''){
			$objUpload=new CLS_UPLOAD();
			$path=PATH_AVATAR;
			$obj->Avatar=$objUpload->UploadFile('fileImg', $path);
		}
		else $obj->Avatar=$_POST['url_image'];
	
        $obj->ID=$id;
        $obj->updatePositionContact();

        if(in_array($positiontype_id, $arr_type_position))//check xem có phải là dạng nhà hàng hay không
            echo "<script language=\"javascript\">window.location.href='".ROOTHOST."member/".$position_code."/co-so/cap-nhat-thuc-don/".$id."'</script>";
        else
            echo "<script language=\"javascript\">window.location.href='".ROOTHOST."member/".$position_code."/co-so/cap-nhat-thu-vien-anh/".$id."'</script>";

    }else{
        $position_id=isset($_POST['txt_position_id']) ? $_POST['txt_position_id']:'';
        $obj->positionId=$position_id;
		/*upload avatar*/
		if(isset($_FILES['fileImg']) AND $_FILES['fileImg']['name']!=''){
			$objUpload=new CLS_UPLOAD();
			$path=PATH_AVATAR;
			$obj->Avatar=$objUpload->UploadFile('fileImg', $path);
		}
		else $obj->Avatar='';
		
        $obj->Add_new();
        $id=$obj->getLastId();
        if(in_array($positiontype_id, $arr_type_position))//check xem có phải là dạng nhà hàng hay không
            echo "<script language=\"javascript\">window.location.href='".ROOTHOST."member/".$position_code."/co-so/them-thuc-don/".$id."'</script>";
        else
            echo "<script language=\"javascript\">window.location.href='".ROOTHOST."member/".$position_code."/co-so/them-thu-vien-anh/".$id."'</script>";

    }
}




unset($obj);
?>