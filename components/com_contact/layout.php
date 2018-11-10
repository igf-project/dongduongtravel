<script language="javascript">
	function chechemail(){
		var sur_name=document.getElementById("contact_sur_name");
		var givenname=document.getElementById("contact_given_name");
		var capchar=document.getElementById("contact_txt_sercurity");
		var subject=document.getElementById("contact_subject");
		var content=document.getElementById("contact_content");
		var email=document.getElementById("contact_email");
		reg1=/^[0-9A-Za-z]+[0-9A-Za-z_\.]*@[\w\d.]+.\w{2,4}$/;
		testmail=reg1.test(email.value);
		if(!testmail){
			alert("Invalid format E-mail address!");
			email.focus();
			return false;
		}
		if(subject.value==""){
			alert("Please enter the message header!");
			subject.focus();
			return false;
		}
		if(content.value==""){
			alert("Please enter message mess!");
			content.focus();
			return false;
		}
		if(capchar.value==""){
			alert("Please enter capchar!");
			capchar.focus();
			return false;
		}
	}
</script>
<?php
$err='';
$noidung="<h2>Thông tin liên hệ:</h2>";
$conf = new CLS_CONFIG();
$conf->load_config();

if(isset($_POST["cmd_send_contact"])){
	$surname=addslashes($_POST["contact_sur_name"]);
	$givenname=addslashes($_POST["contact_given_name"]);
	$email=addslashes($_POST["contact_email"]);
	$subject=addslashes($_POST["contact_subject"]);
	$text=addslashes($_POST["contact_content"]);
	$capchar=addslashes($_POST["contact_txt_sercurity"]);
	if($_SESSION['SERCURITY_CODE']!=$capchar){
		$err='<font color="red">Mã bảo mật không chính xác</font>';die($err);
	}
	else{
		//error_reporting(E_ALL);
		error_reporting(E_STRICT);
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		require_once('extensions/PHPMailer/class.phpmailer.php');
		
		if($surname!="")
			$noidung.="<strong>Surname:</strong> ".$surname."<br />";
		if($givenname!="")
			$noidung.="<strong>Given name:</strong> ".$givenname."<br />";
		if($email!="")
			$noidung.="<strong>Email:</strong> ".$email."<br />";
		if( $text!="")
			$noidung.="<hr>".$text."<br />";
		
		$body             = $noidung;
		$mail             = new PHPMailer();
		$mail->IsSMTP(); // telling the class to use SMTP
		$mail->charSet = "UTF-8";
		$mail->Host       = "mail.adventure4x4tours.com"; // SMTP server
		$mail->SMTPDebug  = false;                     // enables SMTP debug information (for testing)
												   // 1 = errors and messages
												   // 2 = messages only
		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
		$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
		$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
		$mail->Username   = "hoangtucoc321@gmail.com";  // GMAIL username
		$mail->Password   = "nsn2651984";            // GMAIL password

		$mail->SetFrom($email,  $surname." ".$givenname);
		$mail->AddReplyTo($email, $surname." ".$givenname);
		$mail->Subject    = $subject;;
		$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
		$mail->MsgHTML($body);
		$address = $conf->Email;;
		$mail->AddAddress($address, $surname." ".$givenname);

		$mail->Send();
	}
	?>
	<script language="javascript"> 
		alert('Your Email has been sent successfully!');
		window.location.href="index.php?com=contact";
	</script>
	<?php
}
?>
<style type="text/css">
	.box-comment{margin: 0 auto; width: 1000px;}
	.box-comment h3{color: #e54a1a;  font-size: 23px;  margin: 50px 0 50px 0;}
	input[type="text"], textarea {display: block;margin-bottom: 20px;padding: 7px 8px;max-width: 100%;border: 1px solid #e54a1a;border-radius: 3px;color: #959595;}
	input[type="submit"] {background-color: #e54a1a;display: block;margin-bottom: 20px;padding: 7px 8px;max-width: 100%;width: 90px;border: 1px solid #e54a1a;border-radius: 3px;color: #fff;float: left;margin-right: 8px;}
	input[type="reset"] {background-color: #e54a1a;display: block;margin-bottom: 20px;padding: 7px 8px;max-width: 100%;width: 90px;border: 1px solid #e54a1a;border-radius: 3px;color: #fff;float: left;margin-right: 8px;}
</style>
<div class="content content-center margin-bottom-40" id="team">
	<hgroup class='text-center' style='padding-top:35px;'>
		<h2 class='title'>Liên hệ với chúng tôi</h2>
		<h4 class='sub_title margin-bottom-50'>Vui lòng hoàn thành form dưới đây, chúng tôi sẽ liên lạc với bạn trong thời gian sớm nhất!</h4>
	</hgroup>
	<div class="container">
		<div class="row">
			<div class='col-lg-6 col-sm-12 text-left'>
				<h3>Công Ty Cổ Phần Giải Pháp Và Ứng Dụng Công Nghệ Mới IGF</h3>
				<strong>Main Office:</strong> Số 6/30 Ngõ 28 đường Tăng Thiết Giáp - Cổ Nhuế - Bắc Từ Liêm - Hà Nội<br/>
				<strong>Phone:</strong> 043.2121.015 <strong>Hotline:</strong> 0936.831.277 - 0984.486.830<br/>
				<strong>Website:</strong> http://igf.com.vn - http://openlearn.vn <strong>Email:</strong> nxtuyen.pro@gmail.com<br/>
				<hr/>
				<h3>Nguyễn Thị Thủy</h3>
				<strong>Chức vụ:</strong> Hỗ trợ kỹ thuật - Kinh doanh<br/>
				<strong>Tel:</strong> 0984.486.830<br/>
				<hr/>
				<h3>Nguyễn Đức Thắng</h3>
				<strong>Chức vụ:</strong> Kinh doanh<br/>
				<strong>Tel:</strong> 0984.486.830<br/>
				<hr/>
				<h3>Nguyễn Đức Khánh</h3>
				<strong>Chức vụ:</strong> Kỹ thuật<br/>
				<strong>Tel:</strong> 0984.486.830<br/>
			</div>
			<div class='col-lg-6 col-sm-12'>
				<form action="" method="post" style="padding: 0px; margin:0px;" >
					<center><strong><?php echo $err; ?></strong></center>
					<table style="border: 0px;width:600px;" id="frmContact" width="100%" border="0" cellpadding="5" cellspacing="1">
						<tr>
							<td align="left" width='20%'><strong>Họ tên:</strong></td>
							<td align="left" width='80%'><input type="text" name="contact_sur_name" size="50" /></td>
						</tr>
						<tr>
							<td align="left"><strong>Điện thoại:</strong></td>
							<td align="left"><input type="text" name="contact_given_name" size="50" /></td>
						</tr>
						<tr>
							<td align="left"><strong>Email <font color="#FF0000">*</font></strong></td>
							<td align="left"><input type="text" name="contact_email" size="50" id="contact_email" /></td>
						</tr>
						<tr>
							<td align="left"><strong>Tiêu đề thư <font color="#FF0000">*</font></strong></td>
							<td align="left"><input name="contact_subject" type="text" id="contact_subject" size="50"/></td>
						</tr>
						<tr>
							<td align="left"><strong>Nội dung <font color="#FF0000">*</font></strong></td>
							<td align="left" ><textarea style='width:385px' rows="8" cols='20' name="contact_content" id="contact_content"></textarea></td>
						</tr>
						<tr>
							<td align="left"><strong>Mã bảo mật <font color="#FF0000">*</font></strong></td>
							<td align="left">
								<input style="float:left;" type="text" size="7" name="contact_txt_sercurity" id="contact_txt_sercurity" class="text"/>
								<img style='margin-left: 5px;margin-top: 5px;' src="extensions/captcha/CaptchaSecurityImages.php?width=75&height=24" align="left" alt="" />
							</td>
						</tr>
						<tr>
							<td align="left"></td>
							<td align="left"><input type="submit" id="cmd_send_contact" name="cmd_send_contact" value="Gửi" class="btninput" onclick="return chechemail();" /><input type="reset" value="Hủy" class="btninput btnright" /></td>
						</tr>
					</table>
				</form>
			</div>
		</div>
		<div class='row'>
			<div class="embed-responsive embed-responsive-16by9">
				<iframe class="embed-responsive-item" width="100%" height="450" src="https://www.google.com/maps/embed?pb=!1m25!1m12!1m3!1d3723.3621524823375!2d105.77995925532039!3d21.058193098781267!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m10!1i0!3e6!4m3!3m2!1d21.0582922!2d105.7812625!4m3!3m2!1d21.0583082!2d105.7813218!5e0!3m2!1svi!2s!4v1428985321284" frameborder="0" style="border:0"></iframe>
			</div>
		</div>
	</div>
</div>