<?php
defined("ISHOME") or die("Can not acess this page, please come back!");
$id='';
if(isset($_GET['id'])){
	$id=addslashes($_GET['id']);
}
$obj->getList(" WHERE username='$id'");
$r=$obj->Fetch_Assoc();
?>
<div id="action">
<script language="javascript">
function checkinput(){
	return true;
}
</script>
<form id="frm_action" name="frm_action" method="post" action="">
    <fieldset>
	<legend><strong>Kích hoạt thành viên</strong></legend>
    <table width="100%" border="0" cellspacing="1" cellpadding="3">
      <tr>
        <td width="160" align="right" bgcolor="#EEEEEE"><strong>Tên Đăng Nhập:</strong></td>
        <td width="788">
		<input type='hidden' name='txt_add_account' id='txt_add_account' value='1'/>
		<input type='hidden' name='txt_paruser' id='txt_paruser' value='<?php echo $r['par_user'];?>'/>
		<input type='hidden' name='txt_username' id='txt_username' value='<?php echo $r['username'];?>'/>
		<?php echo $r['username'];?>
        </td>
      </tr>
	  <tr>
        <td width="160" align="right" bgcolor="#EEEEEE"><strong>Họ Và Tên:</strong></td>
        <td width="788"><?php echo $r['fullname'];?></td>
      </tr>
	  <tr>
        <td width="160" align="right" bgcolor="#EEEEEE"><strong>ID Giới Thiệu:</strong></td>
        <td width="788"><?php echo $r['par_user'];?></td>
      </tr>
	  <tr>
        <td width="160" align="right" bgcolor="#EEEEEE"><strong>Điện Thoại:</strong></td>
        <td width="788"><?php echo $r['phone'];?></td>
      </tr>
	  <tr>
        <td width="160" align="right" bgcolor="#EEEEEE"><strong>CMT:</strong></td>
        <td width="788"><?php echo $r['cmt'];?></td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EEEEEE"><strong>Số mã thêm mới:</strong></td>
        <td>
			<input type='number' value='1' name='txt_number' id='txt_number' min="1"/>
			<input type="submit" name="cmdsave" id="cmdsave" value="Thêm mới mã số" >
		</td>
      </tr>
    </table>
    </fieldset>
    
  </form>
</div>