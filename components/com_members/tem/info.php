<?php 
$objmem = new CLS_MEMBER;
$arr = $objmem->getUserLogin(); 
$fbid = $arr['fbid'];
$error = false;
if(!isset($arr)) {
	$error = true;
}
if(isset($_POST['txtfullname'])) {
	$objmem->Fullname = $_POST['txtfullname'];
	//$ns = $_POST['txtyear'].'-'.$_POST['cbomonth'].'-'.$_POST['cbodate'];
	//$objmem->Birthday = date("Y-m-d",strtotime($ns));
	$objmem->Address = $_POST['txtaddress'];
	$objmem->Phone = $_POST['txtphone'];
	$row = $objmem->getUserLogin(); 
	$objmem->ID = $row['fbid'];
	unset($_POST);
	$objmem->Update();
}
$objmem->getList(" AND fbid=$fbid");
$row = $objmem->Fetch_Assoc();
?>
<div id="colmain" class="container">
	<div class="form_add">
	<?php if($error==true) {?>
	<div class="error">Vui lòng đăng nhập để thực hiện chức năng này</div>
	<?php } else {?>
		<h2>Thông tin tài khoản</h2>
		<form name="frm_update_member" id="frm_update_member" action="#"  method="POST">
			<div class="box">
				<div class="txt">Họ tên</div>
				<div class="detail"><input type="text" id="txtfullname" name="txtfullname" value="<?php echo $row['fullname'];?>"><span class="mess_pos"></span></div>
			</div>
			<?php /* <div class="box">
				<div class="txt">Ngày sinh</div>
				<div class="detail">
					<?php 
					$year = $month = $day = '';
					if(isset($row['birthday'])) {
						$ns = explode("-",$row['birthday']);
						$year = $ns[0]; $month = (int)$ns[1]; $day = (int)substr($ns[2],0,2);
					}
					?> 
					<select name="cbodate" id="cbodate" class="pull-left">
						<?php 
						for($i=1;$i<=31;$i++) {
							$str='';
							if($i==$day) $str='selected="selected"';
						?>
						<option value="<?php echo $i;?>" <?php echo $str;?>><?php echo $i;?></option>
						<?php } ?>
					</select>
					<select name="cbomonth" id="cbomonth" class="pull-left">
						<?php for($i=1;$i<=12;$i++) {
							$str='';
							if($i==$month) $str='selected="selected"';
						?>
						<option value="<?php echo $i;?>" <?php echo $str;?>><?php echo $i;?></option>
						<?php } ?>
					</select>
					<input type="text" id="txtyear" name="txtyear" class="pull-left" value="<?php echo $year;?>"/>
					<span class="mess_pos"></span>
				</div>
			</div> */ ?>
			<div class="box">
				<div class="txt">Phòng ban</div>
				<div class="detail"><input type="text" id="txtaddress" name="txtaddress" value="<?php echo $row['address'];?>"><span class="mess_pos"></span></div>
			</div>
			<div class="box">
				<div class="txt">Điện thoại</div>
				<div class="detail"><input type="text" id="txtphone" name="txtphone" value="<?php echo $row['phone'];?>"><span class="mess_pos"></span></div>
			</div>
			<div class="box">
				<div class="txt">Email</div>
				<div class="detail"><?php echo $row['email'];?></div>
			</div>
			<div class="text-center"><input type="submit" name="save" id="save" value="Lưu thay đổi" onclick="return checkAddMem();"/></div>
		</form>
	<?php } ?>
	</div>
</div>
<script>
function checkAddMem() {
	if($('#txtfullname').val()=='') {
		//$('.mess_pos').html('Vui lòng nhập');
		$('#txtfullname').focus();
		return false;
	}
	if($('#cbodate').val()=='') {
		//$('.mess_add').html('Địa chỉ không được trống');
		$('#cbodate').focus();
		return false;
	}
	if($('#cbomonth').val()=='') {
		//$('.mess_ser').html('Vui lòng chọn loại hình');
		$('#cbomonth').focus();
		return false;
	}
	if($('#txtyear').val()=='') {
		//$('.mess_ser').html('Vui lòng chọn loại hình');
		$('#txtyear').focus();
		return false;
	}
	if($('#txtaddress').val()=='') {
		//$('.mess_ser').html('Vui lòng chọn loại hình');
		$('#txtaddress').focus();
		return false;
	}
	if($('#txtphone').val()=='') {
		//$('.mess_ser').html('Vui lòng chọn loại hình');
		$("#txtphone").focus();
		return false;
	}
	return true;
}
</script>