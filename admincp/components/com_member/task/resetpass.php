<?php
defined('ISHOME') or die('Can not acess this page, please come back!');
$id='';
if(isset($_GET['id']))
	$id=addslashes($_GET['id']);

$flag=true;
if($id!=$_SESSION[MD5($_SERVER['HTTP_HOST']).'_USERID']){
	if($UserLogin->isAdmin()==false)
		$flag=false;
	if($UserLogin->isAdmin()==true)
		$flag=true;
}
if($flag==false)
	echo ('<div id="action" style="background-color:#fff"><h3 align="center">Bạn không có quyền truy cập. <a href="index.php">Vui lòng quay lại trang chính</a></h3></div>');
else {
	?>
	<script language='javascript'>
		function checkinput(){
			if($('#txt_pass').val()==''){
				alert('Bạn phải nhập vào mật khẩu mới'); return false;
			}
			if($('#txt_rpass').val()==''){
				alert('Bạn phải nhập lại mật khẩu'); return false;
			}
			if($('#txt_rpass').val()!=$('#txt_pass').val()){
				alert('Xác nhận mật khẩu không khớp'); $('#txt_rpass').focus(); return false;
			}
			return true;
		}
	</script>
	<div id="action">
		<form id="frm_action" name="frm_action" method="post" action="">
			<fieldset>
				<legend><strong>Thông tin tài khoản người dùng</strong></legend>
				<p>Các mục đánh dấu <font color="red">*</font> là thông tin bắt buộc</p>
				<div class="row">
					<div class="col-md-10">
						<div class="form-group">
							<label for="" class="col-sm-3 form-control-label">Tên đăng nhập*</label>
							<div class="col-sm-9">
							<input type="text" class="form-control" name="txt_username" id="txt_username" readonly="true" value="<?php echo $id;?>" required>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="col-md-10">
						<div class='form-group'>
							<label class="col-sm-3 control-label">Mật khẩu Mới:*</label>
							<div class="col-sm-9">
								<input type="password" class="form-control" name="txt_pass" id="txt_pass" value="" required/>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="col-md-10">
						<div class='form-group'>
							<label class="col-sm-3 control-label">Nhập Lại Mật khẩu:*</label>
							<div class="col-sm-9">
								<input type="password" class="form-control" name="txt_rpass" id="txt_rpass" value="" required/>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</fieldset>
			<input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;">
		</form>
	</div>
	<?php 
} ?>