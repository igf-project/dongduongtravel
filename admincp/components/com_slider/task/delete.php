<?php
	defined('ISHOME') or die('Can not acess this page, please come back!');
    $flag=false;
    if(!isset($UserLogin)) $UserLogin=new CLS_USERS;
    if($UserLogin->isAdmin()==true)
        $flag=true;
    if($flag==false){
        echo ('<div id="action" style="background-color:#fff"><h4>Bạn không có quyền truy cập. <a href="index.php">Vui lòng quay lại trang chính</a></h4></div>');
        return false;
    }
	$id='';
	if(isset($_GET['id']))
		$id=$_GET['id'];
	$obj->Delete($id);
	echo "<script language=\"javascript\">window.location='index.php?com=".COMS."'</script>";
?>