<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
define('TASK_NAME', 'Đổi password user');
write_path();
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

    $sql="UPDATE `tbl_user` SET `password`='".md5(sha1(trim($newpass)))."'";
    $sql.=" WHERE username='$user'";
    if($objdata->Query($sql)) {
        echo "<script>alert('Mật khẩu đã được đổi thành công !')</script>";
        echo "<script language=\"javascript\">window.location='index.php?com=".COMS."'</script>";
    }else{
        echo '<div id="action"><h3 style="color:red">Lỗi trong quá trình lưu trữ. Mật khẩu chưa được đổi.</h3></div>';
    }
}
?>

<div id="action">
    <h1 align='center'>Đổi password user</h1><hr/>
    <form method="post" action="" name="frm_action" id="frm_action">
        <p class="text-center">Các mục đánh dấu <font color="red">*</font> là thông tin bắt buộc</p>
        <div class="row">
        <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Tên đăng nhập</label><font color="red">*</font>
                    <input name="txtusername" type="text" class="form-control" required id="txtusername" value="<?php echo $username;?>" minlength="3" readonly="readonly">
                    <span id="msgbox" style="display:none"></span>
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
                <div class="form-group">
                    <label>Mật khẩu mới</label><font color="red">*</font><small> ( 6-12 ký tự )</small>
                    <input type="password" name="txtnewpass" id="txtnewpass" class="form-control" required value=""/>
                    <font color="red" id="err-newpass"></span>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label>Nhập lại mật khẩu mới</label><font color="red">*</font>
                    <input type="password" name="txtnewpass2" id="txtnewpass2"  class="form-control" required/>
                    <font color="red" id="err-renewpass"></span>
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
                <div class="text-center">
                    <br/>
                    <a href="?com=users" class="btn btn-default">Quay lại</a>
                    <input type="submit" name="cmdsave" id="cmdsave"  class="btn btn-primary" value="Lưu thông tin">
                </div>
            </div>
        </div>
    </form>
</div>
<script language="javascript">
    function checkinput(){
        var pass1 = $("#txtnewpass").val();
        var pass2 = $("#txtnewpass2").val();
        var lenght_pass = $("#txtnewpass").val().length;

        if($("#txtnewpass").val()=="" || lenght_pass<6 || lenght_pass>12){
            $('#err-newpass').text('Lỗi !');
            return false;
        }else{
            $('#err-newpass').text('');
        }

        if(pass2!=pass1){
            $("#err-renewpass").text('Lỗi !');
            return false;
        }else{
            $("#err-renewpass").text('');
        }
        return true;
    }
    $(document).ready(function() {
        $('#frm_action').submit(function(){
            return checkinput();
        })
    })
</script>