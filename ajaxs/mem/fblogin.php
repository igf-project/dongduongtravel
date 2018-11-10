<?php
session_start();
include_once('../../includes/gfinnit.php');
include_once('../../includes/gfconfig.php');
include_once('../../libs/cls.mysql.php');
include_once('../../libs/cls.member.php');
$objmem=new CLS_MEMBER;
$objdata=new CLS_MYSQL;
if(isset($_POST['value'])){
	$value=$_POST['value'];
	if(isset($value['id'])) $fbid=$value['id'];
	if($fbid=='false' or $fbid==false) echo 'Không tìm thấy Facebook ID đăng nhập !';
	else{
		$sql="SELECT * FROM tbl_member_account WHERE uid='$fbid' AND driver='facebook' ";
		$objdata->Query($sql);
		if($objdata->Num_rows()==1){
			$r=$objdata->Fetch_Assoc();
			$objmem->setUserLogin($r);
			$objmem->setActionTime();
			$objmem->setInfoLogin($r['username']);
		}else{
			$objmem->Username=$value['email'];
			$objmem->Password='';
			$objmem->First_name=$value['first_name'];
			$objmem->Last_name=$value['last_name'];
			$objmem->Driver='facebook';
			$objmem->Uid=$value['id'];
			$objmem->GmemId='1';
			$objmem->Avatar='https://graph.facebook.com/'.$fbid.'/picture?type=large';
			if(!$objmem->Add_new()){
				echo "Register failse!";
			}
			$r=$objdata->Fetch_Assoc();
			$objmem->setUserLogin($r);
			$objmem->setActionTime();
			$objmem->setInfoLogin($value['email']);
			$_SESSION['username']=$objmem->Username;
		}
	}
}else{
	echo 'Không tìm thấy Facebook ID đăng nhập';
}
?>