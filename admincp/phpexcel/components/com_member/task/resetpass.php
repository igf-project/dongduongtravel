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
	<div>Các mục đánh dấu <font color="red">*</font> là thông tin bắt buộc<div>
    <table width="100%" border="0" cellspacing="1" cellpadding="3">
      <tr>
        <td width="172" align="right" bgcolor="#EEEEEE"><strong>Tên đăng nhập:</strong></td>
        <td width="744">
          <input type="text" class="required" name="txt_username" id="txt_username" readonly="true" value="<?php echo $id;?>"/>
        </td>
      </tr>
	  <tr>
        <td width="172" align="right" bgcolor="#EEEEEE"><strong>Mật khẩu Mới:</strong></td>
        <td width="744">
			<input type="password" class="required" name="txt_pass" id="txt_pass" value=""/>
		</td>
      </tr>
	  <tr>
        <td width="172" align="right" bgcolor="#EEEEEE"><strong>Nhập Lại Mật khẩu:</strong></td>
        <td width="744">
			<input type="password" class="required" name="txt_rpass" id="txt_rpass" value=""/>
		</td>
      </tr>
    </table>
    </fieldset>
    <label><input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;"></label>
  </form>
</div>
<?php } 
unset($obj);
?>