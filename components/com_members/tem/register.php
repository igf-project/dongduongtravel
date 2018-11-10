<?php
$flag='';
if(isset($_POST['cmd_register'])){
	$code=$_POST['txt_name'];
	$obj=new CLS_MEMBERLEVEL;
	
	$obj->Username=addslashes(str_replace(' ','',$_POST['txt_user']));
	$obj->Password=md5(sha1(addslashes($_POST['txt_pas'])));
	
	$obj->Fullname=addslashes($_POST['txt_name']);
	$sn=explode('/',$_POST['txt_ns']);
	$obj->Birthday=$sn[2].'-'.$sn[1].'-'.$sn[0];
	$cmtdate=explode('/',$_POST['txt_cmt_date']);
	$obj->CMT=addslashes($_POST['txt_cmt']);
	$obj->CMTDate=$cmtdate[2].'-'.$cmtdate[1].'-'.$cmtdate[0];
	$obj->CMTPlace=addslashes($_POST['txt_cmt_place']);
	
	$obj->BankNumber=addslashes($_POST['txt_bank_number']);
	$obj->BankName=addslashes($_POST['txt_bank_name']);
	$obj->BankAddress=addslashes($_POST['txt_bank_add']);
	
	$obj->Address=addslashes($_POST['txt_dc']);
	$obj->Phone=addslashes($_POST['txt_tel']);
	$obj->Email=addslashes($_POST['txt_email']);
		
	if($obj->Add_New()){
		$flag='Success';
	}else $flag = 'Fail';
}
if($flag!='Success') {
?>
<script language='javascript'>
$(document).ready(function() {  
        //the min chars for username  
        var min_chars = 3;
        //result texts  
        var characters_error = 'Tên đăng nhập có ít nhất 3 ký tự';  
        var checking_html = 'Kiểm tra...';  
  
        //when button is clicked  
        $('#txt_user').blur(function(){  
			//run the character number check  
			if($('#txt_user').val().length < min_chars){  
				//if it's bellow the minimum show characters_error text '  
				$('#username_availability_result').html(characters_error);  
			}else{  
				//else show the cheking_text and run the function to check  
				$('#username_availability_result').html(checking_html);  
				check_availability();  
			}  
        });  
		$('#txt_pas').blur(function(){ 
			if($('#txt_pas').val().length>=6)
				$('#pass_availability_result').html("<span class='available'>&nbsp;</span>");
			else
				$('#pass_availability_result').html("<span class='not_available'>&nbsp;</span>");
		});
		$('#txt_rpas').blur(function(){ 
			if($('#txt_rpas').val()==$('#txt_pas').val())
				$('#rpass_availability_result').html("<span class='available'>&nbsp;</span>");
			else
				$('#rpass_availability_result').html("<span class='not_available'>&nbsp;</span>");
		});
  });  
  
//function to check username availability  
function check_availability(){  
//get the username  
var username = $('#txt_user').val();  

//use ajax to run the check  
$.post("check_username.php", { username: username },  
	function(result){  
		//if the result is 1  
		if(result == 1){  
			//show that the username is available  
			$('#username_availability_result').html("<span class='available'>&nbsp;</span> "+username + ' khả dụng');  
			$('#txtcheck').val(1);
		}else{  
			//show that the username is NOT available  
			$('#username_availability_result').html("<span class='not_available'>&nbsp;</span> "+username + ' không khả dụng');		
			$('#txtcheck').val(0);		
		}  
});  
  
}  
function checkinput(){
	var fillter=/^([0-9])+$/;
	if($('#txt_user').val()==''){
		alert('Mời bạn nhập tên đăng nhập');$('#txt_user').focus(); return false;
	}
	if($('#txt_user').val().length<3){
		alert('Tên đăng nhập có ít nhất 3 ký tự');$('#txt_user').focus(); return false;
	}
	if($('#txtcheck').val()==0) {
		alert('Tên đăng nhập không khả dụng. Vui lòng nhập tên khác');$('#txt_user').focus(); return false;
	}
	if($('#txt_pas').val()==''){
		alert('Mời bạn nhập mật khẩu đăng nhập');$('#txt_pas').focus(); return false;
	}
	if($('#txt_pas').val().length<6){
		alert('Mật khẩu chứa ít nhất 6 ký tự');$('#txt_pas').focus(); return false;
	}
	if($('#txt_pas').val()!=$('#txt_rpas').val()){
		alert('Gõ lại mật khẩu không chính xác'); $('#txt_rpas').focus();return false;
	}
	if($('#txt_name').val()==''){
		alert('Vui lòng nhập tên đầy đủ của bạn!'); $('#txt_name').focus();return false;
	}
	if($('#txt_ns').val()==''){
		alert('Vui lòng nhập ngày sinh của bạn!'); $('#txt_ns').focus();return false;
	}
	if(fillter.test($('#txt_cmt').val())==false || $('#txt_cmt').val().length<9 ){
		alert('Bạn phải nhập CMT đúng của bạn');
		$('#txt_cmt').focus();
		return false;
	}
	if($('#txt_cmt_date').val()==''){
		alert('Vui lòng nhập ngày cấp CMT'); $('#txt_cmt_date').focus();return false;
	}
	if($('#txt_cmt_place').val()==''){
		alert('Vui lòng nhập nơi cấp CMT'); $('#txt_cmt_place').focus();return false;
	}
	if($('#txt_code').val()==''){
		alert('Vui lòng nhập mã bảo mật'); $('#txt_code').focus();return false;
	}
	if($('#txt_chk').is(':checked')==false){
		alert('Vui lòng đọc kỹ và chấp nhận các điều khoản thành viên của thanksaivietnam.com'); $('#txt_chk').focus();return false;
	}
}
$(document).ready(function(){	
	$('#txt_ns').datepicker({
		changeMonth: true,
		changeYear: true,
		yearRange: '1950:<?php echo date("Y");?>'
    });
	$('#txt_cmt_date').datepicker({
		changeMonth: true,
		changeYear: true,
		yearRange: '1950:<?php echo date("Y");?>'
    });
});
</script>
<div style='padding:11px; background:#fff;'>
<form method='POST' id="frmregis" name="frmregis" action='' autocomplete="off">
<?php if($flag=='Fail'){?>
<h2 align='center' style='color:red;'>Đăng ký không thành công, mời bạn liên hệ với ban quản trị thanksaivietnam.com!</h2>
<?php } else if($flag=='Error'){?>
<h2 align='center' style='color:red;'>Mã bảo mật không đúng, mời bạn thử lại một lần nữa!</h2>
<?php }?>
<h2 align='center'>ĐĂNG KÝ THÀNH VIÊN</h2>
<p align='center'>Để đảm bảo quyền lợi các thành viên tham gia. Mỗi thành viên chỉ được đăng ký một tài khoản duy nhất với một số CMT xác định. 
Bạn hãy cung cấp đúng số CMT của bạn để đảm bảo quyền lợi cộng tác viên theo quy định của <strong>Vạn Thọ</strong>.
<strong>Vạn Thọ</strong> cam kết bảo mật thông tin của các thành viên tham gia.</p>
<h4>Dấu <span class='star'>*</span> là thông tin bắt buộc.</h4>
<div class="title_regis">Thông tin đăng nhập</div>
<table width="100%">
	<tr>
		<td align='center'><input type='text' name='txt_user' id='txt_user' placeholder='Tên đăng nhập' value='<?php if(isset($_POST['txt_user'])) echo $_POST['txt_user'];?>'/>
		<input type="hidden" name="txtcheck" id="txtcheck" value='<?php if(isset($_POST['txt_user'])) echo '1';?>'/> <br/><span id='username_availability_result'><?php if(isset($_POST['txt_user'])) echo"<span class='available'>&nbsp;</span>";?></span>  </td>
	</tr>
	<tr>
		<td align='center'><input type='password' name='txt_pas' id='txt_pas' placeholder='Mật khẩu' value='<?php if(isset($_POST['txt_pas'])) echo $_POST['txt_pas'];?>'/> <span id='pass_availability_result'><?php if(isset($_POST['txt_rpas'])) echo"<span class='available'>&nbsp;</span>";?></span></td>
	</tr>
	<tr>
		<td align='center'><input type='password' name='txt_rpas' id='txt_rpas' placeholder='Xác nhận mật khẩu' value='<?php if(isset($_POST['txt_rpas'])) echo $_POST['txt_rpas'];?>'/> <span id='rpass_availability_result'><?php if(isset($_POST['txt_rpas'])) echo"<span class='available'>&nbsp;</span>";?></span></td>
	</tr>
</table>
<div class="title_regis">Thông tin cá nhân</div>
<table width="100%">
	<tr>
		<td align='center'><input type='text' name='txt_name' id='txt_name' placeholder='Họ Tên' value='<?php if(isset($_POST['txt_name'])) echo $_POST['txt_name'];?>'/></td>
	</tr>
	<tr>
		<td align='center'><input type='text' name='txt_ns' id='txt_ns' placeholder='Ngày sinh' value='<?php if(isset($_POST['txt_ns'])) echo $_POST['txt_ns'];?>'/></td>
	</tr>
	<tr>
		<td align='center'><input type='text' name='txt_cmt' id='txt_cmt' placeholder='Số CMT' value='<?php if(isset($_POST['txt_cmt'])) echo $_POST['txt_cmt'];?>'/> 
		<input type='text' name='txt_cmt_date' id='txt_cmt_date' placeholder='Ngày cấp' value='<?php if(isset($_POST['txt_cmt_date'])) echo $_POST['txt_cmt_date'];?>'/> 
		<input type='text' name='txt_cmt_place' id='txt_cmt_place' placeholder='Nơi cấp' value='<?php if(isset($_POST['txt_cmt_place'])) echo $_POST['txt_cmt_place'];?>'/></td>
	</tr>
	<tr>
		<td align='center'><input type='text' name='txt_bank_number' id='txt_bank_number' placeholder='Số TKNH' value='<?php if(isset($_POST['txt_bank_number'])) echo $_POST['txt_bank_number'];?>'/> 
		<input type='text' name='txt_bank_name' id='txt_bank_name' placeholder='Ngân hàng' value='<?php if(isset($_POST['txt_bank_name'])) echo $_POST['txt_bank_name'];?>'/> 
		<input type='text' name='txt_bank_add' id='txt_bank_add' placeholder='Chi nhánh' value='<?php if(isset($_POST['txt_bank_add'])) echo $_POST['txt_bank_add'];?>'/></td>
	</tr>
	<tr>
		<td align='center'><input type='text' name='txt_dc' id='txt_dc' placeholder='Địa chỉ' value='<?php if(isset($_POST['txt_dc'])) echo $_POST['txt_dc'];?>'/></td>
	</tr>
	<tr>
		<td align='center'><input type='text' name='txt_tel' id='txt_tel' placeholder='Điện thoại' value='<?php if(isset($_POST['txt_tel'])) echo $_POST['txt_tel'];?>'/></td>
	</tr>
	<tr>
		<td align='center'><input type='text' name='txt_email' id='txt_email' placeholder='Hòm thư' value='<?php if(isset($_POST['txt_email'])) echo $_POST['txt_email'];?>'/></td>
	</tr>
	<!--
	<tr>
		<td align='center'><input style='float:left;margin-right:5px;' type='text' name='txt_code' id='txt_code' placeholder='Mã bảo mật' /><img align="middle" style='float:left;margin:5px' height='30' src='http://thanksaivietnam.com/extensions/captcha/CaptchaSecurityImages.php'/></td>
	</tr>
	-->
	<tr>
		<td align='center'><label><input type='checkbox' name='txt_chk' id='txt_chk'/> Tôi đồng ý với nội quy, quy định của website (<a href=''>chi tiết)</a></label></td>
	</tr>
	<tr>
		<td colspan='2' align=center>
			<input type='submit' name='cmd_register' id='cmd_register' value='Đăng ký' onclick='return checkinput();'/>
			<input type='reset' name='cmd_reset' id='cmd_reset' value='Làm lại'/>
		</td>
	</tr>
</table>
<br/>
</form>
</div>
<?php }?>