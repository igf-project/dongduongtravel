<?php
session_start();
include_once('../../includes/gfconfig.php');
include_once('../../includes/gfinnit.php');
include_once('../../libs/cls.mysql.php');
?>
<div id="BoxRegister" class='row'>
	<form class="book-frm frm-register">
		<div class='col-md-2'></div>
		<div class='col-md-8'>
			<h3 class='text-center' style='margin:0px;padding:0px; padding-bottom:21px;'>Create your account</h3>
			<div class="form-group"><div class='row'>
				<div class='col-md-6'>
					<input type="text" id='last_name' class="form-control" placeholder="Họ">
				</div>
				<div class='col-md-6'>
					<input type="text" id='first_name' class="form-control" placeholder="Tên">
				</div>
			</div></div>
			<div class="form-group">
				<input type="email" id='username' class="form-control" placeholder="Email hoặc tên đăng nhập">
			</div>
			<div class="form-group">
				<input type="password" id='password' class="form-control" placeholder="Mật khẩu">
			</div>
			<div class="form-group">
				<input type="password" id='repassword' class="form-control" placeholder="Xác nhận mật khẩu">
			</div>
			<div class="form-group">
				<button type="button" class="btn btn-success btn-login btn-block" id='btn_register'>Đăng ký</button>
			</div>
			<div class="form-group">
			Bằng cách nhấp vào Đăng ký, bạn đồng ý với Các điều khoản của chúng tôi và bạn đã đọc kỹ và chấp nhận chính sách dữ liệu của chúng tôi.
			</div>
		</div>
		<div class='col-md-2'></div>
	</form>
</div>
<script>
$(document).ready(function(){
	$('#btn_register').click(function(){
		if(!checkinput()) return;
		var data={};
		data['first_name']=$('#first_name').val();
		data['last_name']=$('#last_name').val();
		data['username']=$('#username').val();
		data['password']=$('#password').val();
		$.post('<?php echo ROOTHOST;?>ajaxs/mem/register.php',{'pdata':data},function(req){
			$('#popup_openlearn .modal-body').html('Loadding');
			if(req!=''){
				alert('Bạn đã đăng ký không thành công!');
			}else{
				$('#popup_openlearn').modal('hide');
				alert('Đăng ký thành công! Hãy đăng nhập ngay hôm nay');
				$('#popup_openlearn').modal('show');
				$('#popup_openlearn .modal-footer').hide();	
				$('#popup_openlearn .modal-header h4').html('Sing In');
				$('#popup_openlearn .modal-body p').html('Loadding');
				$.get('<?php echo ROOTHOST;?>ajaxs/mem/frm_login.php',function(req){
					$('#popup_openlearn .modal-body').html(req);
				})
			}
			
		});
	});
	function checkinput(){
		var user=$('#username').val().trim();
		if(user=='' || user.length<=3){
			alert('Username không được để trống và phải lớn hơn 3 ký tự');
			return false;
		}else if($('#password').val().trim()=='' || $('#password').val()!=$('#repassword').val()){
			alert('Mật khẩu không được để trống và phải được gõ lại chính xác');
			return false;
		}
		return true;
	}
});
</script>