<?php
	define('COMS', 'tourperson');
    $com=isset($_GET['com'])? $_GET['com']:'';
    $viewtype=isset($_GET['viewtype'])? addslashes($_GET['viewtype']):'list';
	$arr=array('list', 'block', 'detail', 'add', 'edit', 'delete', 'active', 'list_member');
	if($com!=COMS OR in_array($viewtype, $arr)==false OR !is_file(COM_PATH.'com_'.$com.'/tem/'.$viewtype.'.php')){ //Check
        die('PAGE NOT FOUND!');
    }
    include_once(LIB_PATH.'cls.tourperson.php');
    $obj=new CLS_TOURPERSON();
    include_once('tem/'.$viewtype.'.php');
    if(isset($_POST['cmdsave'])){
		$tour_code=addslashes($_GET['code']);
        $obj->TourId=(int)$_POST['txt_tour_id'];
        $obj->Fullname=addslashes($_POST['txt_fullname']);
        $obj->Cmt=addslashes($_POST['txt_cmt']);
        $obj->Email=addslashes($_POST['txt_email']);
        $obj->Phone=addslashes($_POST['txt_phone']);
        $obj->Address=addslashes($_POST['txt_address']);
		if(isset($_POST['txtid'])){
			$obj->ID=(int)$_POST['txtid'];
			$obj->Update();
			echo "<script language=\"javascript\">window.location.href='".ROOTHOST."member/tour/".$tour_code."/cap-nhat-thu-vien-anh'</script>";   
		}else{
			$obj->Add_new();
			echo "<script language=\"javascript\">window.location.href='".ROOTHOST."member/tour/".$tour_code."/them-thu-vien-anh'</script>";   
		}
	}
    unset($viewtype); unset($com); unset($arr);unset($obj);
?>

