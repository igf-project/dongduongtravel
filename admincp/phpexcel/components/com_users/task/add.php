<?php
	defined("ISHOME") or die("Can not acess this page, please come back!");
    $flag=false;
    if(!isset($UserLogin)) $UserLogin=new CLS_USERS;
    if($UserLogin->isAdmin()==true)
        $flag=true;
    if($flag==false){
        echo ('<div id="action" style="background-color:#fff"><h4>Bạn không có quyền truy cập. <a href="index.php">Vui lòng quay lại trang chính</a></h4></div>');
        return false;
    }
?>
<div id="action">
<script language="javascript">

function checkinput(){
	return true;
}
$(document).ready(function()
{
	$("#txtusername").blur(function(){
		$("#msgbox").removeClass().addClass('messagebox').text('Kiểm tra dữ liệu...').fadeIn("slow");
		$.post("user_availabity.php",{ user_name:$(this).val() } ,function(data){
		  if($.trim(data)=='nodata' || $.trim(data)=='') {
		  	$("#msgbox").fadeTo(200,0.1,function(){ 
			  //add message and change the class of the box and start fading
			  $(this).html('Vui lòng nhập tên đăng nhập').addClass('messageboxerror').fadeTo(900,1);
			});
		  }
		  else if($.trim(data)=='no'){
		  	$("#msgbox").fadeTo(200,0.1,function(){ 
			  $(this).html('Tên đăng nhập này đã tồn tại. Vui lòng nhập tên đăng nhập khác').addClass('messageboxerror').fadeTo(900,1);
			});		
			document.getElementById("checkuser").value="false";
          }
		  else {
			$("#msgbox").fadeTo(200,0.1,function(){ 
			  $(this).html('Tên đăng nhập có thể sử dụng').addClass('messageboxok').fadeTo(900,1);	
			});
			document.getElementById("checkuser").value="true";
		  }
        });
	});
});
 </script>
  <form id="frm_action" name="frm_action" method="post" action="">
      <div class="row">
          <div class="col-sm-6">
              <p>Các mục đánh dấu <font color="red">*</font> là thông tin bắt buộc</p>
              <span id="msgbox" style="display:none"></span>
              <input type="hidden" name="checkuser" id="checkuser" value="" />
              <input name="txttask" type="hidden" id="txttask" value="1" />
              <div class="form-group">
                  <label for="" class="col-sm-3 form-control-label">Tên đăng nhập*</label>
                  <div class="col-sm-9">
                      <input type="text" name="txtusername" class="form-control" id="txtusername" placeholder="">
                      <div id="txt_name_err" class="mes-error"></div>
                  </div>
                  <div class="clearfix"></div>
              </div>
              <div class="form-group">
                  <label for="" class="col-sm-3 form-control-label">Mật khẩu*</label>
                  <div class="col-sm-9">
                      <input type="text" name="txtpassword" class="form-control" id="txtpassword" placeholder="">
                      <div id="txt_name_err" class="mes-error"></div>
                  </div>
                  <div class="clearfix"></div>
              </div>
              <div class="form-group">
                  <label for="" class="col-sm-3 form-control-label">Nhập lại mật khẩu*</label>
                  <div class="col-sm-9">
                      <input type="text" name="txtrepass" class="form-control" id="txtrepass" placeholder="">
                      <div id="txt_name_err" class="mes-error"></div>
                  </div>
                  <div class="clearfix"></div>
              </div>
          </div>
      </div>
      <div class="row">

      <div class="col-sm-6">
          <h4>Thông tin người dùng</h4>
          <div class="form-group">
              <label for="" class="col-sm-3 form-control-label">Họ & đệm*</label>
              <div class="col-sm-9">
                  <input type="text" name="txtfirstname" class="form-control" id="txtfirstname" placeholder="">
                  <div id="txt_name_err" class="mes-error"></div>
              </div>
              <div class="clearfix"></div>
          </div>
          <div class="form-group">
              <label for="" class="col-sm-3 form-control-label">Ngày sinh*</label>
              <div class="col-sm-9">
                  <input type="date" name="txtbirthday" class="form-control" id="txtbirthday" placeholder="">
                  <div id="txt_name_err" class="mes-error"></div>
              </div>
              <div class="clearfix"></div>
          </div>
          <div class="form-group">
              <label for="" class="col-sm-3 form-control-label">Tên*</label>
              <div class="col-sm-9">
                  <input type="text" name="txtlastname" class="form-control" id="txtlastname" placeholder="">
                  <div id="txt_name_err" class="mes-error"></div>
              </div>
              <div class="clearfix"></div>
          </div>
          <div class="form-group">
              <label for="" class="col-sm-3 form-control-label">Giới tính*</label>
              <div class="col-sm-9">
                  <input type="radio" name="optgender" value="0" checked="checked" />Nam
                  <input type="radio" name="optgender" value="1" />N&#7919;</td>
              </div>
              <div class="clearfix"></div>
          </div>
          <div class="form-group">
              <label for="" class="col-sm-3 form-control-label">Địa chỉ</label>
              <div class="col-sm-9">
                  <input type="text" name="txtaddress" class="form-control" id="txtaddress" placeholder="">
                  <div id="txt_name_err" class="mes-error"></div>
              </div>
              <div class="clearfix"></div>
          </div>
          <div class="form-group">
              <label for="" class="col-sm-3 form-control-label">Điện thoại bàn</label>
              <div class="col-sm-9">
                  <input type="text" name="txtphone" class="form-control" id="txtphone" placeholder="">
                  <div id="txt_name_err" class="mes-error"></div>
              </div>
              <div class="clearfix"></div>
          </div>
          <div class="form-group">
              <label for="" class="col-sm-3 form-control-label">Email</label>
              <div class="col-sm-9">
                  <input type="text" name="txtemail" class="form-control" id="txtemail" placeholder="">
                  <div id="txt_name_err" class="mes-error"></div>
              </div>
              <div class="clearfix"></div>
          </div>
          <div class="form-group">
              <label for="" class="col-sm-3 form-control-label">Điện thoại di động</label>
              <div class="col-sm-9">
                  <input type="text" name="txtmobile" class="form-control" id="txtmobile" placeholder="">
                  <div id="txt_name_err" class="mes-error"></div>
              </div>
              <div class="clearfix"></div>
          </div>
          <div class="form-group">
              <label for="" class="col-sm-3 form-control-label">Nhóm quyền</label>
              <div class="col-sm-9">
                  <select name="cbo_gmember" id="cbo_gmember" class="form-control">
                      <option value="0" style="font-weight:bold; background-color:#cccccc">Chọn nhóm quyền</option>
                      <?php
                      if(!isset($obju)) $obju = new CLS_GUSER();
                      $obju->getListGmem(0,1);
                      unset($obju);
                      ?>
                  </select>
              </div>
              <div class="clearfix"></div>
          </div>
          <div class="form-group">
              <label for="" class="col-sm-3 form-control-label">Tình trạng</label>
              <div class="col-sm-9">
                  <input name="optactive" type="radio" value="1" checked /> Active
                  <input name="optactive" type="radio" value="0" /> Deactive
              </div>
              <div class="clearfix"></div>
          </div>
          </div>
      </div>
        <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;">
  </form>
</div>