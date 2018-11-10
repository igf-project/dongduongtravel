<?php
defined('ISHOME') or die('Can not acess this page, please come back!');
define('COMS','member');
set_time_limit(-1);
// Begin Toolbar
require_once(LAG_PATH.'vi/lang_default.php');
require_once(libs_path.'cls.event.php');
require_once(libs_path.'cls.member_level.php');
$task='';
if(isset($_GET['task']))
$task = addslashes($_GET['task']);
switch($task) {
	case 'add': $title_manager = 'Thêm mới đại lý';break;
	case 'edit': $title_manager = 'Sửa thông tin đại lý';break;
	case 'active_account': $title_manager = 'Kích Hoạt Thành Viên';break;
	case 'add_account': $title_manager = 'Thêm Mã Số';break;
	case 'list_active': $title_manager = 'Danh sách chưa kích hoạt';break;
	case 'changepass': $title_manager = 'Đổi mật khẩu';break;
	case 'network': $title_manager = 'SƠ ĐỒ THÀNH VIÊN'; break;
	default: $title_manager = 'Quản lý đại lý';
}
require_once('includes/toolbar.php');
// End toolbar
if(!isset($obj)) $obj =new CLS_MEMBER_LEVEL();
if(isset($_POST['cmdsave'])){
	if(isset($_POST['txt_fullname'])){ 
		$obj->Par_User=addslashes($_POST['txt_par_user']);
		$obj->UserName=addslashes($_POST['txt_username']);
		if(isset($_POST['txt_password']))
		$obj->Password=addslashes($_POST['txt_password']);
		$obj->Fullname=addslashes($_POST['txt_fullname']);
		if($_POST['txt_birthday']!=''){
			$sn=explode('-',$_POST['txt_birthday']);
			$obj->Brithday=$sn[2].'-'.$sn[1].'-'.$sn[0];
		}
		$obj->CMT=addslashes($_POST['txt_cmt']);
		$obj->Address=addslashes($_POST['txt_address']);
		$obj->Phone=addslashes($_POST['txt_phone']);
		$obj->Email=addslashes($_POST['txt_email']);
		$obj->ChuTK=addslashes($_POST['txt_chutk']);
		$obj->STK=addslashes($_POST['txt_stk']);
		$obj->Bank=addslashes($_POST['txt_bank']);
		
		if(isset($_POST['txtid'])){
			$obj->UserName=addslashes($_POST['txtid']);
			$obj->Update();
		}else{
			$obj->Password= addslashes($_POST['txtpassword']);
			$obj->Cdate=date("Y-m-d H:i:s");
			$obj->isActive=0;
			$obj->Add_new();
		}
	}elseif(isset($_POST['txt_kichhoat'])){
		$objdata=new CLS_MYSQL;
		$username=addslashes($_POST['txt_username']);
		$paruser=addslashes($_POST['txt_paruser']);
		$value=$_POST['txt_number'];
		$date=date('Y-m-d H:i:s');
		// update member level isactive = 1
		$sql="UPDATE tbl_member_level SET mdate='$date',isactive=1 WHERE username='$username'";
		$objdata->Exec($sql);
		// insert account
		for($i=1;$i<=$value;$i++) {
			$sql="INSERT INTO tbl_accounts(`username`,`account`,`cdate`) VALUES('$username','$username$i','$date')";
			$objdata->Exec($sql);
			// Update cay ma so, cong tien thuong xep cay
			$obj->calc_level(0);
		}
		// Insert tien thuong cho nguoi gioi thieu
		$obj->thuong_hh_tructiep($username,$paruser,$value);
		echo "<script language=\"javascript\">window.location='index.php?com=".COMS."&task=list_active'</script>";
		
	}elseif(isset($_POST['txt_add_account'])){
		$objdata=new CLS_MYSQL;
		$username=addslashes($_POST['txt_username']);
		$paruser=addslashes($_POST['txt_paruser']);
		$value=$_POST['txt_number'];
		$date=date('Y-m-d H:i:s');
		// insert account
		$stt=$obj->count_user($username); // tong ma hien tai
		for($i=1;$i<=$value;$i++) {
			$stt++;
			$sql="INSERT INTO tbl_accounts(`username`,`account`,`cdate`) VALUES('$username','$username$stt','$date')";
			$objdata->Exec($sql);
			// Update cay ma so, cong tien thuong xep cay
			$obj->calc_level(0);
		}
		// Insert tien thuong cho nguoi gioi thieu
		$obj->thuong_hh_tructiep($username,$paruser,$value);
	}elseif(isset($_POST['txt_rpass'])){
		$pass=md5(sha1($_POST['txt_pass']));
		$username=addslashes($_POST['txt_username']);
		$sql="UPDATE tbl_member_level SET password='$pass' WHERE username='$username'";
		$objdata=new CLS_MYSQL;
		$objdata->Exec($sql);
	}else{
		echo '';
	}
	echo "<script language=\"javascript\">window.location='index.php?com=".COMS."'</script>";
}
if(isset($_POST['txtaction'])){
	$ids=$_POST['txtids'];
	$ids=str_replace(",","','",$ids);
	switch ($_POST['txtaction']){
		case 'public': 		$obj->setActive($ids,1); 	break;
		case 'unpublic': 	$obj->setActive($ids,0); 	break;
		case 'edit': 	
			$id=explode("','",$ids);
			echo "<script language=\"javascript\">window.location='index.php?com=".COMS."&task=edit&id=".$id[0]."'</script>";
			exit();
			break;
		case 'delete': 		$obj->Delete($ids); 		break;
	}
	echo "<script language=\"javascript\">window.location='index.php?com=".COMS."'</script>";
}
define('THIS_COM_PATH',COM_PATH.'com_'.COMS.'/');
if(isset($_GET['task']))
	$task=$_GET['task'];
if(!is_file(THIS_COM_PATH.'task/'.$task.'.php'))
	$task='list';
include(THIS_COM_PATH.'task/'.$task.'.php'); 
// close object
unset($obj); unset($objlag);
?>