<?php
defined("ISHOME") or die("Can not acess this page, please come back!")
?>
<script language='javascript'>
	function checkinput(){
		var length = $('#txt_username').val().length;
		if($('#txt_username').val()=="" && length>3) {
			alert("Vui lòng nhập tên đăng nhập lớn hơn 3 ký tự");
			$('#txt_username').focus();
			return false;
		}
		if($('#chk_user').val()=="0") {
			alert("Tên đăng nhập đã có trong hệ thống. Vui lòng nhập tên khác");
			$('#txt_username').focus();
			return false;
		}
		if($('#txt_fullname').val()=="") {
			alert("Vui lòng nhập họ tên");
			$('#txt_fullname').focus();
			return false;
		}
		return true;
	}
	$(document).ready(function() {
		$("#txt_username").blur(function() {
			var username = $('#txt_username').val();
			var length = $('#txt_username').val().length;
			if(length>3){
				$.post("ajaxs/member/getmember.php", {username: username },function(result){
					if(result=='0'){
						$('#username_result').html('<img src="images/icon_true.png" width="20" align="middle"/> Tên có thể sử dụng');  
						$('#chk_user').val('1');
						return true;
					}else{
						$('#username_result').html('<img src="images/icon_false.png" width="20" align="middle"/> Tên đã tồn tại. Vui lòng nhập tên khác');  
						$('#chk_user').val('0');
						return false;
					}  
				});
			}
		})
	});
</script>
<div id="action" class="table-responsive">
	<form id="frm_action" name="frm_action" method="post" action="">
		<fieldset>
			<legend><strong>Thông tin tài khoản người dùng</strong></legend>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="" class="col-sm-3 form-control-label">Tên đăng nhập:<font color="red"> *</font></label>
						<div class="col-sm-9">
							<input type="text" class="form-control" name="txt_username" id="txt_username" value=""/>
							<input type="hidden" name="chk_user" id="chk_user" value=""/>
							<span id="username_result"></span>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="" class="col-sm-3 form-control-label">Mật khẩu:<font color="red"> *</font></label>
						<div class="col-sm-9">
							<input type="password" class="form-control" name="txtpassword" id="txtpassword" value=""/>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="" class="col-sm-3 form-control-label">Nhóm</label>
						<div class="col-sm-9">
							<select class="form-control" id="cbo_gmember" name="cbo_gmember">
								<option value="0">Root</option>
								<?php $obj_gmember->getListGmem(0,0) ?>
							</select>
							<script type="text/javascript">
								$(document).ready(function() {
									$("#cbo_gmember").select2();
								});
							</script>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</fieldset>
		<div style="height: 20px;"></div>
		<fieldset>
			<legend><strong>Thông tin chi tiết người dùng</strong></legend>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="" class="col-sm-3 form-control-label">Họ </label>
						<div class="col-sm-9">
							<input type="text" name="txt_lastname" class="form-control" id="txt_lastname" placeholder="" required>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="" class="col-sm-3 form-control-label">Tên</label>
						<div class="col-sm-9">
							<input type="text" name="txt_firstname" class="form-control" id="txt_firstname" placeholder="" required>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="" class="col-sm-3 form-control-label">Ngày sinh</label>
						<div class="col-sm-9">
							<input type="date" name="txt_birthday" class="form-control" id="txt_birthday" placeholder="">
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="" class="col-sm-3 form-control-label">CMT</label>
						<div class="col-sm-9">
							<input type="text" name="txt_cmt" class="form-control" id="txt_cmt" placeholder="">
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="" class="col-sm-3 form-control-label">Địa chỉ</label>
						<div class="col-sm-9">
							<input type="text" name="txt_address" class="form-control" id="txt_address" placeholder="">
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="" class="col-sm-3 form-control-label">Điện thoại</label>
						<div class="col-sm-9">
							<input type="text" name="txt_phone" class="form-control" id="txt_phone" placeholder="">
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="" class="col-sm-3 form-control-label">Email</label>
						<div class="col-sm-9">
							<input type="text" name="txt_email" class="form-control" id="txt_email" placeholder="">
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="" class="col-sm-3 form-control-label">Giới tính</label>
						<div class="col-sm-9">
							<label class="radio-inline"><input type="radio" value="0" name="opt_gender" checked>Nam</label>
							<label class="radio-inline"><input type="radio" value="1" name="opt_gender">Nữ</label>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			<label><input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;"></label>
		</fieldset>
	</form>
</div>