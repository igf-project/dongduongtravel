<?php
	defined("ISHOME") or die("Can not acess this page, please come back!")
?>
<script language='javascript'>
function checkinput(){
	if($('#txt_par_user').val()=="") {
		alert("Vui lòng nhập ID giới thiệu");
		$('#txt_par_user').focus();
		return false;
	}
	if($('#chk_paruser').val()=="0") {
		alert("ID giới thiệu không chính xác");
		$('#txt_par_user').focus();
		return false;
	}
	if($('#txt_username').val()=="") {
		alert("Vui lòng nhập tên đăng nhập");
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
		$.post("ajaxs/getuser.php", {username: username },  
			function(result){  
				//if the result is 0  
				if(result=='0'){  
					//show that the username is available  
					$('#username_result').html('<img src="images/icon_true.png" width="20" align="middle"/> Tên có thể sử dụng');  
					$('#chk_user').val('1');
					return true;
				}else{  
					//show that the username is NOT available  
					$('#username_result').html('<img src="images/icon_false.png" width="20" align="middle"/> Tên đã tồn tại. Vui lòng nhập tên khác');  
					$('#chk_user').val('0');
					return false;
				}  
		});  
	})
	$("#txt_par_user").keyup(function() {
		var keyword = $("#txt_par_user").val();
		if (keyword.length >= 3) {
			$.post("ajaxs/getuser.php", {username: keyword },  
				function(result){  
					//if the result is 1  
					if(result=='1'){  
						$('#paruser_result').html('<img src="images/icon_true.png" width="20" align="middle"/> ID giới thiệu đúng');  
						$('#chk_paruser').val('1');
						return true;
					}else{   
						$('#paruser_result').html('<img src="images/icon_false.png" width="20" align="middle"/> ID giới thiệu sai');  
						$('#chk_paruser').val('0');
						return false;
					}  
			});  
		}
	});

});
</script>
<div id="action">
  <form id="frm_action" name="frm_action" method="post" action="">
    <fieldset>
	<legend><strong>Thông tin tài khoản người dùng</strong></legend>
    <table width="100%" border="0" cellspacing="1" cellpadding="3">
		<tr>
        <td width="172" align="right" bgcolor="#EEEEEE"><strong>ID Giới Thiệu:<font color="red"> *</font></strong></td>
        <td>
          <input type="text" class="required" name="txt_par_user" id="txt_par_user" value=""/>
		  <input type="hidden" name="chk_paruser" id="chk_paruser" value=""/>
		  <span id="paruser_result"></span>
        </td>
      </tr>
      <tr>
        <td width="172" align="right" bgcolor="#EEEEEE"><strong>Tên đăng nhập:<font color="red"> *</font></strong></td>
        <td>
          <input type="text" class="required" name="txt_username" id="txt_username" value=""/>
          <input type="hidden" name="chk_user" id="chk_user" value=""/>
		  <span id="username_result"></span>
        </td>
      </tr>
	  <tr>
        <td width="172" align="right" bgcolor="#EEEEEE"><strong>Mật khẩu:<font color="red"> *</font></strong></td>
        <td>
		<input type="password" class="required" name="txtpassword" id="txtpassword" value=""/>
		</td>
      </tr>
    </table>
    </fieldset>
    <fieldset>
	<legend><strong>Thông tin chi tiết người dùng</strong></legend>
      <table width="100%" border="0" cellspacing="1" cellpadding="3">
      <tr>
        <td width="172" align="right" bgcolor="#EEEEEE"><strong>Họ và tên<font color="red"> *</font></strong></td>
        <td><input type="text" name="txt_fullname" id="txt_fullname" value="" class="required" /></td>
      </tr>
	  <tr>
		<td width="172" align="right" bgcolor="#EEEEEE"><strong>Ngày sinh&nbsp;</strong></td>
        <td><input type="text" name="txt_birthday" id="txt_birthday" value="" /></td>
	  </tr>
      <tr>
        <td width="172" align="right" bgcolor="#EEEEEE"><strong>CMT&nbsp;</strong></td>
        <td><input type="text" name="txt_cmt" id="txt_cmt" value="" class="required"/></td>
      </tr>
	  <tr>
        <td align="right" bgcolor="#EEEEEE"><strong>Địa chỉ&nbsp;</strong></td>
        <td><input type="text" name="txt_address" id="txt_address" value="" /></td>
      </tr>
	  <tr>
		<td align="right" bgcolor="#EEEEEE"><strong>Điện thoại&nbsp;</strong></td>
        <td><input type="text" name="txt_phone" id="txt_phone" value="" /></td>
	  </tr>
      <tr>
        <td align="right" bgcolor="#EEEEEE"><strong>Email&nbsp;</strong></td>
        <td><input type="text" name="txt_email" id="txt_email" value="" class="required email"/></td>
      </tr>
	</table>
    <label><input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;"></label>
    </fieldset>
	<fieldset>
	  <legend><strong>Thông tin tài khoản ngân hàng</strong></legend>
	  <table width="100%" border="0" cellspacing="1" cellpadding="3">
		  <tr>
			<td width="172" align="right" bgcolor="#EEEEEE"><strong>Chủ tài khoản&nbsp;</strong></td>
			<td><input type="text" name="txt_chutk" id="txt_chutk" value="" class=""/></td>
		  </tr>
		  <tr>
			<td align="right" bgcolor="#EEEEEE"><strong>Số tài khoản&nbsp;</strong></td>
			<td><input type="text" name="txt_stk" id="txt_stk" value="" class=""/></td>
		  </tr>
		  <tr>
			<td align="right" bgcolor="#EEEEEE"><strong>Tại ngân hàng&nbsp;</strong></td>
			<td><input type="text" name="txt_bank" id="txt_bank" value="VIETTINBANK" class=""/></td>
		  </tr>
	  </table>
	</fieldset>
  </form>
</div>