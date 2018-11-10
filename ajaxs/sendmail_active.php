<?php
session_start();
require_once('../includes/gfconfig.php');
require_once('../includes/gfinnit.php');
require_once('../libs/cls.mysql.php');
require_once('../libs/cls.content.php');
require_once('../libs/cls.category.php');
require_once('../libs/cls.configsite.php');
require_once('../libs/cls.member.php');
require_once '../libs/cls.mail.php';
$obj=new CLS_MEMBER;

if(isset($_POST['fbid'])){
	$conf = new CLS_CONFIG();
	$conf->load_config();
	$fbid=$_POST['fbid'];
	$email_active=$_POST['email_active'];
	$body =file_get_contents('../tem/mail_active_accoutn.html');
	
	$sql="SELECT * FROM tbl_member WHERE fbid='$fbid'";
	$obj->getList($sql);
	$name=$obj->getNameById($fbid);
	$link=ROOTHOST.'kich-hoat/key-'.'Top'.md5($fbid).'ica';
	$body=str_replace('{name}',$name,$body);
	$body=str_replace('{link}',$link,$body);
	//echo $body;die;	
	date_default_timezone_set('Asia/Ho_Chi_Minh');
	$objMailer=new CLS_MAILER();
    $header='MIME-Version: 1.0' . "\r\n";
	$header.='Content-type: text/html; charset=utf-8' . "\r\n";//Content-type: text/html; charset=iso-8859-1′ . “\r\n
	$header.="FROM: <".$conf->Email."> \r\n";

   	$objMailer->FROM=$conf->Email;//WEB_MAIL;
	$objMailer->HEADER=$header;
	$objMailer->SUBJECT = "Kích hoạt tài khoản";
	$objMailer->TO =$email_active;
	$objMailer->CONTENT = $body;
	
	//Cap nhat Email vao tai khoan
	$obj->set_email($email_active,$_POST['fbid']);
	
	if(!$objMailer->SendMail()) {
	  //echo "Mailer Error: " . $objMailer->ErrorInfo;
	} else {
	 echo "OK";
	}
	echo "OK";
}
?>