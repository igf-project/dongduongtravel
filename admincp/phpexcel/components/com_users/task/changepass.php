<?php
ini_set('display_errors', '1');
defined("ISHOME") or die("Can't acess this page, please come back!");
$memid="";
if(!isset($objmember)) $objmember = new CLS_USERS();
if(isset($_GET["id"])){
    $memid=(int)$_GET["id"];
    $objmember->getMemberByID($memid);
    $username=$objmember->UserName;
}
else
    $username=$objmember->getUsername();
if(isset($_POST["txtnewpass"])) {
	$user = addslashes($_POST["txtusername"]);
	$newpass = addslashes($_POST["txtnewpass"]);
	$result = $objmember->ChangePass_User($user,$newpass);
	if($result) {
		echo '<div id="action"><h3 style="color:#3399FF">Mật khẩu đã được đổi thành công !</h3></div>';
	}
	else
		echo '<div id="action"><h3 style="color:red">Lỗi trong quá trình lưu trữ. Mật khẩu chưa được đổi.</h3></div>';
}
?>
<script language="javascript">
  function checkinput(){
	  if($("#txtnewpass").val()==''){
	  	$("#newpass_error").fadeTo(200,0.1,function() //start fading the messagebox
		{
			$(this).html('Vui lòng nhập mật khẩu mới').addClass('check_error').fadeTo(900,1);
		})
		$("#txtnewpass").focus();
		return false;
	  }
	  if($("#txtnewpass2").val()==''){
	  	$("#newpass2_error").fadeTo(200,0.1,function() //start fading the messagebox
		{
			$(this).html('Vui lòng nhập lại mật khẩu mới lần 2').addClass('check_error').fadeTo(900,1);
		})
		$("#txtnewpass2").focus();
		return false;
	  }
	  if($("#txtnewpass").val()!='' && $("#txtnewpass2").val()!='' && $("#txtnewpass").val()!=$("#txtnewpass2").val() ){
	  	$("#newpass2_error").fadeTo(200,0.1,function() //start fading the messagebox
		{
			$(this).html('Mật khẩu mới nhập 2 lần không khớp nhau. Vui lòng nhập chính xác.').addClass('check_error').fadeTo(900,1);
		})
		$("#txtnewpass2").focus();
		return false;
	  }
	  return true;
  }
</script>
<div id="action">
<form method="post" action="" name="frm_action" id="frm_action" class="col-md-8">
<h4>Các mục đánh dấu <font color="red">*</font> là thông tin bắt buộc</h4>
    <div class="form-group">
        <label for="" class="col-sm-3 form-control-label">Tên đăng nhập*</label>
        <div class="col-sm-9">
            <input name="txtusername" type="text" class="form-control" required id="txtusername" value="<?php echo $username;?>" minlength="3" readonly="readonly">
            <span id="msgbox" style="display:none"></span>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="form-group">
        <label for="" class="col-sm-3 form-control-label">Mật khẩu mới*</label>
        <div class="col-sm-9">
            <input type="password" name="txtnewpass" id="txtnewpass" class="form-control" required value=""/>
                <span id="newpass_error" class="check_error mes-error"></span>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="form-group">
        <label for="" class="col-sm-3 form-control-label">Nhập lại mật khẩu mới*</label>
        <div class="col-sm-9">
            <input type="password" name="txtnewpass2" id="txtnewpass2"  class="form-control" required/>
            <span id="newpass2_error" class="check_error mes-error"></span>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="form-group">
        <label for="" class="col-sm-3 form-control-label"></label>
        <div class="col-sm-9">
            <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;">
        </div>
        <div class="clearfix"></div>
    </div>

</form>
</div>