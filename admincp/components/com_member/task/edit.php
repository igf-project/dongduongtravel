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
	$obj->getList(" WHERE mem_id='$id'",'');
	$row=$obj->Fetch_Assoc();
	?>
	<script language='javascript'>
		function checkinput(){
			return true;
		}
	</script>
	<div id="action">
		<form id="frm_action" name="frm_action" method="post" action="">
			<fieldset>
				<legend><strong>Thông tin tài khoản người dùng</strong></legend>
				<p>Các mục đánh dấu <font color="red">*</font> là thông tin bắt buộc</p>
				<div class="row">
					<div class="form-group">
						<label for="" class="col-sm-2 form-control-label">Tên đăng nhập:<font color="red"> *</font></label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="txt_username" id="txt_username" value="<?php echo stripslashes($row['username']);?>" readonly/>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="row">
					<div class="form-group">
						<label for="" class="col-sm-2 form-control-label">Đổi mật khẩu:<font color="red"> *</font></label>
						<div class="col-sm-5">
							<a href='?com=member&task=resetpass&id=<?php echo $row['username'];?>'>Reset Mật khẩu</a>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="row">
					<div class="form-group">
					<label for="" class="col-sm-2 form-control-label">Nhóm</label>
						<div class="col-sm-5">
							<select class="form-control" id="cbo_gmember" name="cbo_gmember">
								<option value="0">Root</option>
								<?php $obj_gmember->getListGmem(0,0) ?>
							</select>
							<script type="text/javascript">
								cbo_Selected('cbo_gmember','<?php echo $row['gmem_id'];?>');
								$(document).ready(function() {
									$("#cbo_gmember").select2();
								});
							</script>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</fieldset>
			<fieldset>
				<legend><strong>Thông tin chi tiết người dùng</strong></legend>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="" class="col-sm-3 form-control-label">Họ </label>
							<div class="col-sm-9">
								<input type="text" name="txt_lastname" class="form-control" id="txt_lastname" placeholder="" value="<?php echo stripslashes($row['lastname']);?>" required>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="" class="col-sm-3 form-control-label">Tên</label>
							<div class="col-sm-9">
								<input type="text" name="txt_firstname" class="form-control" id="txt_firstname" placeholder="" value="<?php echo stripslashes($row['firstname']);?>" required>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="" class="col-sm-3 form-control-label">Ngày sinh</label>
							<div class="col-sm-9">
								<input type="date" name="txt_birthday" class="form-control" id="txt_birthday" placeholder="" value="<?php echo date('Y-m-d',strtotime($row['birthday']));?>">
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="" class="col-sm-3 form-control-label">CMT</label>
							<div class="col-sm-9">
								<input type="text" name="txt_cmt"  class="form-control" id="txt_cmt" placeholder="" value="<?php echo $row['cmtnd'] ?>">
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="" class="col-sm-3 form-control-label">Địa chỉ</label>
							<div class="col-sm-9">
								<input type="text" name="txt_address" class="form-control" id="txt_address" value="<?php echo stripcslashes($row['address']);?>">
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="" class="col-sm-3 form-control-label">Điện thoại</label>
							<div class="col-sm-9">
								<input type="text" name="txt_phone" class="form-control" id="txt_phone" value="<?php echo stripcslashes($row['phone']);?>">
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="" class="col-sm-3 form-control-label">Email</label>
							<div class="col-sm-9">
								<input type="text" name="txt_email" class="form-control" id="txt_email" value="<?php echo stripcslashes($row['email']);?>">
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="" class="col-sm-3 form-control-label">Giới tính</label>
							<div class="col-sm-9">
								<label class="radio-inline"><input type="radio" value="0" name="opt_gender" <?php if($row['gender']==0) echo 'checked';?>>Nam</label>
								<label class="radio-inline"><input type="radio" value="1" name="opt_gender" <?php if($row['gender']==1) echo 'checked';?>>Nữ</label>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
				<input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;">
				<input name="txtid" type="hidden" id="txtid" value="<?php echo stripslashes($row['mem_id']);?>" />
			</fieldset>
		</form>
	</div>
	<?php } 
	unset($obj);
	?>