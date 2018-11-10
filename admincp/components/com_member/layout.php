<?php
defined('ISHOME') or die('Can not acess this page, please come back!');
define('COMS','member');
set_time_limit(-1); // Tắt thông báo lỗi
// Begin Toolbar
require_once(LAG_PATH.'vi/lang_default.php');
require_once(libs_path.'cls.gmember.php');
require_once(libs_path.'cls.member.php');
$UserLogin=new CLS_USERS;
$task='';
if(isset($_GET['task']))
$task = addslashes($_GET['task']);
switch($task) {
	case 'add': $title_manager = 'Thêm mới thành viên';break;
	case 'edit': $title_manager = 'Sửa thông tin thành viên';break;
	case 'changepass': $title_manager = 'Đổi mật khẩu';break;
	default: $title_manager = 'Quản lý thành viên';
}
require_once('includes/toolbar.php');
// End toolbar
if(!isset($obj_gmember)) $obj_gmember =new CLS_GMEMBER();
if(!isset($obj)) $obj =new CLS_MEMBER();
if(isset($_POST['cmdsave'])){
	if(isset($_POST['txt_firstname'])){ 
		$obj->Gmember=(int)$_POST['cbo_gmember'];
		$obj->UserName=addslashes($_POST['txt_username']);
		if(isset($_POST['txt_password']))
			$obj->Password=addslashes($_POST['txt_password']);
		$obj->FirstName=addslashes($_POST['txt_firstname']);
		$obj->LastName=addslashes($_POST['txt_lastname']);
		if($_POST['txt_birthday']!=''){
			$obj->Brithday=$_POST['txt_birthday'];
		}
		$obj->CMTND=addslashes($_POST['txt_cmt']);
		$obj->Address=addslashes($_POST['txt_address']);
		$obj->Phone=addslashes($_POST['txt_phone']);
		$obj->Email=addslashes($_POST['txt_email']);
		$obj->Gender=(int)$_POST['opt_gender'];
		
		if(isset($_POST['txtid'])){
			$obj->ID=addslashes($_POST['txtid']);
			$obj->Update();
		}else{
			$obj->Joindate=date("Y-m-d H:i:s");
			$obj->isActive=1;
			$obj->Add_new();
		}
	}elseif(isset($_POST['txt_rpass'])){
		$pass=md5(sha1($_POST['txt_pass']));
		$username=addslashes($_POST['txt_username']);
		$sql="UPDATE tbl_member SET password='$pass' WHERE username='$username'";
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