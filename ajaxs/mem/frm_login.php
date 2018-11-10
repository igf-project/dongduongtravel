<?php
session_start();
include_once('../../includes/gfconfig.php');
?>
<div id="BoxLogin" class='row'>
	<p align='center' class='mess' style='font-weight:bold;'></p>
	<form>
		<div class='col-md-6' style='border-right:#ccc 1px solid;height:300px; padding:0px 20px;'>
			<h3>Tài khoản khác</h3>
			<p class="notic">Đăng nhập nhanh bằng Facebook hoặc Google</p>
			<div class="form-group">
				<a href="" class="btn btn-block btn-social btn-facebook" id='fbloginBtn'>
				</a>
			</div>
			<div class="form-group">
				<a href="" class="btn btn-block btn-social btn-google" id='glloginBtn'>
				</a>
			</div>
		</div>
		<div class='col-md-6' style='padding:0px 20px;'>
			<h3>Đăng nhập</h3>
			<div class="form-group">
				<input type="email" id='username' class="form-control" placeholder="Email hoặc tên đăng nhập">
			</div>
			<div class="form-group">
				<input type="password" id='password' class="form-control" placeholder="Mật khẩu">
			</div>
			<div class="form-group">
				<button type="button" class="btn btn-success btn-login btn-block" id='btn_login'>Đăng nhập</button>
				<div class="checkbox text-center">
					<label><a href="" class="link">Quên mật khẩu</a></label>
				</div>
			</div>
		</div>
	</form>
</div>
<script>
$(document).ready(function(){
	$('#btn_login').click(function(){
		$('.mess').html('&nbsp;');
		if(!checkinput()) return;
		var data={};
		data['username']=$('#username').val();
		data['password']=$('#password').val();
		$.post('<?php echo ROOTHOST;?>ajaxs/mem/login.php',{'pdata':data},function(req){
			if(req!=''){
				$('.mess').html('Đăng nhập không thành công, hãy thử lại!').css('color','#f00');
			}else{
				location.reload();
			}
			
		});
	});
	function checkinput(){
		if($('#username').val().trim()==''){
			$('.mess').html('Username không được để trống').css('color','#f00');
			return false;
		}else if($('#password').val().trim()==''){
			$('.mess').html('Mật khẩu không được để trống').css('color','#f00');
			return false;
		}
		return true;
	}
	$('#fbloginBtn').click(function(){
		FB.login(
			function(response) {
				console.log("helo"+response.authResponse);
				if (response.authResponse) {
					getUserData();
				}
			}, {scope: 'email,public_profile', return_scopes: true}
		);
		return false;
	});
	function getUserData() {
		FB.api('/me',{fields: 'gender, first_name, last_name, email, picture'},function(response) {
			$.post('<?php echo ROOTHOST;?>ajaxs/mem/fblogin.php',{'value':response},function(data){
				//console.log(data);
			location.reload();
			})
		});
	}
});
</script>