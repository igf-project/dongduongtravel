<?php
defined("ISHOME") or die("Can not acess this page, please come back!");
define('TASK_NAME', 'Thêm user');
write_path();
$flag=false;
if(!isset($UserLogin)) $UserLogin=new CLS_USERS;
if($UserLogin->isAdmin()==true)
    $flag=true;
if($flag==false){
    echo ('<div id="action" style="background-color:#fff"><h4>Bạn không có quyền truy cập. <a href="index.php">Vui lòng quay lại trang chính</a></h4></div>');
    return false;
}

if(isset($_POST['cmdsave']) && !isset($_POST['txtnewpass'])){
    $post_UserName=addslashes($_POST['txtusername']);
    $post_FirstName=addslashes($_POST['txtfirstname']);
    $post_LastName=addslashes($_POST['txtlastname']);
    $post_Birthday=date('Y-m-d',strtotime($_POST['txtbirthday']));
    $post_Gender=addslashes($_POST['optgender']);
    $post_Address=addslashes($_POST['txtaddress']);
    $post_Phone=addslashes($_POST['txtphone']);
    $post_Mobile=addslashes($_POST['txtmobile']);
    $post_Email=addslashes($_POST['txtemail']);
    $post_Gmember=addslashes($_POST['cbo_gmember']);
    $post_isActive=(int)$_POST['optactive'];
    $post_Password= addslashes($_POST['txtpassword']);
    $post_Joindate = time();
    $sql="INSERT INTO `tbl_user` (`username`,`password`,`firstname`,`lastname`,`birthday`,`gender`,`address`,`phone`,`mobile`,`email`,`joindate`,`guser_id`,`isactive`) VALUES ";
    $sql.=" ('".$post_UserName."','".md5(sha1(trim($post_Password)))."','".$post_FirstName."','";
    $sql.=$post_LastName."','".$post_Birthday."','".$post_Gender."','".$post_Address."','";
    $sql.=$post_Phone."','".$post_Mobile."','".$post_Email."','";
    $sql.=$post_Joindate."','".$post_Gmember."','".$post_isActive."') ";
    $objdata->Query($sql);
    echo "<script language=\"javascript\">window.location='index.php?com=".COMS."'</script>";
}
?>
<div id="action">
    <script language="javascript">
        $(document).ready(function(){
            $("#txtusername").change(function() {
                var username = $('#txtusername').val();  
                $.post("ajaxs/user/getuser.php", {username: username },function(result){
                    if(result=='0'){
                        $('#username_result').html('<img src="images/icon_true.png" width="20" align="middle"/> Tên có thể sử dụng');  
                        $('#chk_user').val('1');
                        $('#err-username').text('');
                        return true;
                    }else{
                        $('#username_result').html('<img src="images/delete.png" width="20" align="middle"/> Tên đã tồn tại. Vui lòng nhập tên khác');  
                        $('#chk_user').val('0');
                        $('#err-username').text('');
                        return false;
                    }  
                });  
            })
        });
    </script>
    <h1 align='center'>Thêm user</h1><hr/>
    <form id="frm_action" name="frm_action" method="post" action="">
        <p>Các mục đánh dấu <font color="red">*</font> là thông tin bắt buộc</p>
        <div class="row">
            <span id="msgbox" style="display:none"></span>
            <input type="hidden" name="checkuser" id="checkuser" value="" />
            <input name="txttask" type="hidden" id="txttask" value="1" />
            <div class='form-group col-md-6'>
                <label>Tên đăng nhập</label><font color="red">*</font>
                <input type="text" name="txtusername" class="form-control" id="txtusername">
                <input type="hidden" name="chk_user" id="chk_user" value=""/>
                <span id="username_result"></span>
                <font id='err-username' color="red"></font>
            </div>
            <div class='form-group col-md-6'>
                <label>Mật khẩu</label><font color="red">*</font><small> ( 6-12 ký tự )</small>
                <input type="password" name="txtpassword" class="form-control" id="txtpassword">
                <font id='err-password' color="red"></font>
                <div class="clearfix"></div>
            </div>
            <div class='form-group col-md-6'>
                <label>Nhập lại mật khẩu</label><font color="red">*</font>
                <input type="password" name="txtrepass" class="form-control" id="txtrepass">
                <font id='err-repassword' color="red"></font>
                <div class="clearfix"></div>
            </div>
        </div>
        <h4>Thông tin người dùng</h4>
        <div class="row">
            <div class='form-group col-md-6'>
                <label>Họ & đệm</label><font color="red">*</font>
                <input type="text" name="txtfirstname" class="form-control" id="txtfirstname">
                <font id='err-firstname' color="red"></font>
                <div class="clearfix"></div>
            </div>
            <div class='form-group col-md-6'>
                <label>Tên</label><font color="red">*</font>
                <input type="text" name="txtlastname" class="form-control" id="txtlastname">
                <font id='err-lastname' color="red"></font>
                <div class="clearfix"></div>
            </div>
            <div class='form-group col-md-6'>
                <label>Ngày sinh</label><font color="red">*</font>
                <input type="date" name="txtbirthday" class="form-control" id="txtbirthday">
                <font id='err-birthday' color="red"></font>
                <div class="clearfix"></div>
            </div>
            <div class='form-group col-md-6'>
                <label>Địa chỉ</label>
                <input type="text" name="txtaddress" class="form-control" id="txtaddress">
                <div class="clearfix"></div>
            </div>
            <div class='form-group col-md-6'>
                <label>Điện thoại</label><font color="red">*</font>
                <input type="text" name="txtphone" class="form-control" id="txtphone">
                <font id='err-phone' color="red"></font>
                <div class="clearfix"></div>
            </div>
            <div class='form-group col-md-6'>
                <label>Email</label><font color="red">*</font>
                <input type="text" name="txtemail" class="form-control" id="txtemail">
                <font id='err-email' color="red"></font>
                <div class="clearfix"></div>
            </div>
            <div class='form-group col-md-6'>
                <label>Điện thoại di động</label>
                <input type="text" name="txtmobile" class="form-control" id="txtmobile">
                <div class="clearfix"></div>
            </div>
            <div class='form-group col-md-6'>
                <label>Nhóm quyền</label>
                <select name="cbo_gmember" id="cbo_gmember" class="form-control">
                    <option value="">Chọn nhóm quyền</option>
                    <?php $obj_guser->getListGmem(0,0); ?>
                </select>
                <font id='err-gmember' color="red"></font>
                <div class="clearfix"></div>
            </div>
            <div class='col-md-6'>
                <label>Giới tính</label><font color="red">*</font>
                <div class="form-group">
                    <label class="radio-inline"><input type="radio" name="optgender" value="0" checked>Nam</label>
                    <label class="radio-inline"><input type="radio" name="optgender" value="1">Nữ</label>
                    <font id='err-gender' color="red"></font>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class='form-group col-md-6'>
                <label>Tình trạng</label>
                <label class="radio-inline"><input name="optactive" type="radio" value="1" checked>Active</label>
                <label class="radio-inline"><input name="optactive" type="radio" value="0">Deactive</label>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="text-center">
            <br/>
            <a href="?com=users" class="btn btn-default">Quay lại</a>
            <input type="submit" name="cmdsave" id="cmdsave"  class="btn btn-primary" value="Lưu thông tin">
        </div>
    </form>
</div>
<script>
    $(document).ready(function() {
        $('#frm_action').submit(function(){
            return checkinput();
        })
    })
    function checkinput(){
        var lenght_pass = $("#txtpassword").val().length;
        var cur_date = new Date();
        var cur_time = cur_date.getTime();
        var birthday = $('#txtbirthday').val();
        var int_birthday = Math.round(new Date(birthday).getTime());
        var valuePhone=$("#txtphone").val();
        var phoneno =/^[\d\.\-]+$/;
        var valueEmail=$("#txtemail").val();
        var re_email = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;

        if($('#chk_user').val()=="0") {
            $('#err-username').text('Tên đăng nhập đã có trong hệ thống. Vui lòng nhập tên khác');
            return false;
        }else if($('#chk_user').val()==""){
            $('#err-username').text('Không được để trống');
            return false;
        }else{
            $('#err-username').text('');
        }

        if($("#txtpassword").val()=="" || lenght_pass<6 || lenght_pass>12){
            $('#err-password').text('Lỗi !');
            return false;
        }else{
            $('#err-password').text('');
        }

        if($("#txtrepass").val()!=$("#txtpassword").val()){
            $('#err-repassword').text('Lỗi !');
            return false;
        }else{
            $('#err-repassword').text('');
        }

        if($("#txtfirstname").val()==''){
            $('#err-firstname').text('Không được để trống !');
            return false;
        }else{
            $('#err-firstname').text('');
        }

        if($("#txtlastname").val()==''){
            $('#err-lastname').text('Không được để trống !');
            return false;
        }else{
            $('#err-lastname').text('');
        }

        if(int_birthday>=cur_time){
            $('#err-birthday').text('Lỗi !');
            return false;
        }else{
            $('#err-birthday').text('');
        }

        if(!valuePhone.match(phoneno)){
            $("#err-phone").text("Không đúng định dạng");
            return false;
        }else{
            $("#err-phone").text('');
        }

        if(!valueEmail.match(re_email)){
            $('#err-email').text('Không đúng định dạng');
            return false;
        }
        return true;
    }
</script>