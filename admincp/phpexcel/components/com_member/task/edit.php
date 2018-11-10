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
$obj->getList(" WHERE username='$id'");
$row=$obj->Fetch_Assoc();
?>
<script language='javascript'>
function checkinput(){
	 return true;
}
$(document).ready(function(){	
	$('#txtbirthday').datepicker({
		changeMonth: true,
		changeYear: true,
		yearRange: '1900:<?php echo date("Y");?>'
    });
});
 </script>
<div id="action">
  <form id="frm_action" name="frm_action" method="post" action="">
    <fieldset>
	<legend><strong>Thông tin tài khoản người dùng</strong></legend>
	<div>Các mục đánh dấu <font color="red">*</font> là thông tin bắt buộc<div>
    <table width="100%" border="0" cellspacing="1" cellpadding="3">
      <tr>
        <td width="172" align="right" bgcolor="#EEEEEE"><strong>Id Giới Thiệu:</strong></td>
        <td>
          <input type="text" class="required" name="txt_par_user" id="txt_par_user" readonly="true" value="<?php echo stripslashes($row['par_user']);?>"/>
        </td>
      </tr>
	  <tr>
        <td width="172" align="right" bgcolor="#EEEEEE"><strong>Tên đăng nhập:</strong></td>
        <td>
          <input type="text" class="required" name="txt_username" id="txt_username" readonly="true" value="<?php echo stripslashes($row['username']);?>"/>
        </td>
      </tr>
	  <tr>
        <td width="172" align="right" bgcolor="#EEEEEE"><strong>Mật khẩu:</strong></td>
        <td><a href='?com=member&task=resetpass&id=<?php echo $id;?>'>Reset Mật khẩu</a></td>
      </tr>
    </table>
    </fieldset>
    <fieldset>
	<legend><strong>Thông tin chi tiết người dùng</strong></legend>
      <table width="100%" border="0" cellspacing="1" cellpadding="3">
      <tr>
        <td width="172" align="right" bgcolor="#EEEEEE"><strong>Họ và tên<font color="red"> *</font></strong></td>
        <td>
			<input type="text" name="txt_fullname" id="txt_fullname" value="<?php echo stripslashes($row['fullname']);?>" class="required" />
			<input name="txtid" type="hidden" id="txtid" value="<?php echo stripslashes($row['username']);?>" />
		</td>
      </tr>
	  <tr>
		<td width="172" align="right" bgcolor="#EEEEEE"><strong>Ngày sinh&nbsp;</strong></td>
        <td><input type="text" name="txt_birthday" id="txt_birthday" value="<?php echo date("d-m-Y",strtotime($row['birthday']));?>" /></td>
	  </tr>
      <tr>
        <td width="172" align="right" bgcolor="#EEEEEE"><strong>CMT <font color="red">*</font></strong></td>
        <td><input type="text" name="txt_cmt" id="txt_cmt" value="<?php echo stripslashes($row['cmt']);?>" class="required"/></td>
      </tr>
	  <tr>
        <td align="right" bgcolor="#EEEEEE"><strong>Địa chỉ&nbsp;</strong></td>
        <td><input type="text" name="txt_address" id="txt_address" value="<?php echo stripslashes($row['address']);?>" /></td>
      </tr>
	  <tr>
		<td align="right" bgcolor="#EEEEEE"><strong>Điện thoại&nbsp;</strong></td>
        <td><input type="text" name="txt_phone" id="txt_phone" value="<?php echo stripslashes($row['phone']);?>" /></td>
	  </tr>
      <tr>
        <td align="right" bgcolor="#EEEEEE"><strong>Email&nbsp;</strong></td>
        <td><input type="text" name="txt_email" id="txt_email" value="<?php echo stripslashes($row['email']);?>" class="required email"/></td>
      </tr>
	</table>
	</fieldset>
	<fieldset>
	  <legend><strong>Thông tin tài khoản ngân hàng</strong></legend>
	  <table width="100%" border="0" cellspacing="1" cellpadding="3">
		  <tr>
			<td width="172" align="right" bgcolor="#EEEEEE"><strong>Chủ tài khoản&nbsp;</strong></td>
			<td><input type="text" name="txt_chutk" id="txt_chutk" value="<?php echo stripslashes($row['chutk']);?>" class=""/></td>
		  </tr>
		  <tr>
			<td align="right" bgcolor="#EEEEEE"><strong>Số tài khoản&nbsp;</strong></td>
			<td><input type="text" name="txt_stk" id="txt_stk" value="<?php echo stripslashes($row['stk']);?>" class=""/></td>
		  </tr>
		  <tr>
			<td align="right" bgcolor="#EEEEEE"><strong>Tại ngân hàng&nbsp;</strong></td>
			<td><input type="text" name="txt_bank" id="txt_bank" value="<?php echo stripslashes($row['bank']);?>" class=""/></td>
		  </tr>
	  </table>
	</fieldset>
  </form>
</div>
<?php } 
unset($obj);
?>