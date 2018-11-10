<?php
defined('ISHOME') or die('Can not acess this page, please come back!');
define('TASK_NAME', 'Sửa thông tin user');
write_path();
$id='';
if(isset($_GET['id']))
    $id=(int)$_GET['id'];

$flag=true;
if(!isset($UserLogin)) $UserLogin=new CLS_USERS;
if($id!=$_SESSION[MD5($_SERVER['HTTP_HOST']).'_USERID']){
    if($UserLogin->isAdmin()==false)
        $flag=false;
    if($UserLogin->isAdmin()==true)
        $flag=true;
}
if($flag==false)
    echo ('<div id="action" style="background-color:#fff"><h4>Bạn không có quyền truy cập. <a href="index.php">Vui lòng quay lại trang chính</a></h4></div>');
else {
    if(isset($_GET['memid']))
        $id=(int)$_GET['memid'];
    $sql="SELECT * FROM tbl_user WHERE id=$id";
    $objdata->Query($sql);
    $row = $objdata->Fetch_Assoc();

    // Save
    if(isset($_POST['cmdsave'])){
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
        $post_ID=(int)$_POST['txtid'];

        $sql="UPDATE `tbl_user` SET 
        `firstname`='".$post_FirstName."',
        `lastname`='".$post_LastName."',
        `birthday`='".$post_Birthday."',
        `gender`='".$post_Gender."',
        `address`='".$post_Address."',
        `phone`='".$post_Phone."',
        `mobile`='".$post_Mobile."',
        `email`='".$post_Email."',
        `guser_id`='".$post_Gmember."',
        `isactive`='".$post_isActive."' ";
        $sql.=" WHERE `id`='".$post_ID."'";
        $objdata->Query($sql);
        echo "<script language=\"javascript\">window.location='index.php?com=".COMS."'</script>";
    }
    ?>
    <div id="action">
        <h1 align='center'>Sửa thông tin user</h1><hr/>
        <form id="frm_action" name="frm_action" method="post" action="">
            <input name="txtid" type="hidden" id="txtid" value="<?php echo $row['id'];?>" /> 
            <p>Các mục đánh dấu <font color="red">*</font> là thông tin bắt buộc</p>  
            <div class="row">
                <div class='form-group col-md-6'>
                    <label>Tên đăng nhập</label>
                    <input type="text" required class="form-control" name="txtusername" id="txtusername" readonly="true" value="<?php echo $row['username'];?>"/>
                    <div class="clearfix"></div>
                </div>
            </div>

            <h4>Thông tin chi tiết người dùng</h4>
            <div class="row">
                <div class='form-group col-md-6'>
                    <label>Họ & đệm</label><font color="red">*</font>
                    <input type="text" name="txtfirstname" id="txtfirstname" value="<?php echo $row['firstname'];?>" required class="form-control"/>
                    <font id='err-firstname' color="red"></font>
                    <div class="clearfix"></div>
                </div>
                <div class='form-group col-md-6'>
                    <label>Tên</label><font color="red">*</font>
                    <input type="text" name="txtlastname" id="txtlastname" value="<?php echo $row['lastname'];?>" required class="form-control"/>
                    <font id='err-lastname' color="red"></font>
                    <div class="clearfix"></div>
                </div>
                <div class='form-group col-md-6'>
                    <label>Ngày sinh</label><font color="red">*</font>
                    <input type="date" name="txtbirthday" id="txtbirthday" value="<?php echo date("Y-m-d",strtotime($row['birthday']));?>" required class="form-control"/>
                    <font id='err-birthday' color="red"></font>
                    <div class="clearfix"></div>
                </div>
                <div class='form-group col-md-6'>
                    <label>Địa chỉ</label>
                    <input type="text" name="txtaddress" id="txtaddress" value="<?php echo $row['address'];?>" class="form-control"/>
                    <div class="clearfix"></div>
                </div>
                <div class='form-group col-md-6'>
                    <label>Điện thoại</label><font color="red">*</font>
                    <input type="text" name="txtphone" id="txtphone" value="<?php echo $row['phone'];?>" class="form-control"/>
                    <font id='err-phone' color="red"></font>
                    <div class="clearfix"></div>
                </div>
                <div class='form-group col-md-6'>
                    <label>Email</label><font color="red">*</font>
                    <input type="email" name="txtemail" id="txtemail" value="<?php echo $row['email'];?>" class="form-control"/>
                    <font id='err-email' color="red"></font>
                    <div class="clearfix"></div>
                </div>
                <div class='form-group col-md-6'>
                    <label>Điện thoại di động</label>
                    <input type="text" name="txtmobile" id="txtmobile" value="<?php echo $row['mobile'];?>" class="form-control"/>
                    <div class="clearfix"></div>
                </div>
                <?php
                if($UserLogin->isAdmin()) {
                    ?>
                    <div class='form-group col-md-6'>
                        <label>Nhóm quyền</label>
                        <select name="cbo_gmember" id="cbo_gmember" class="form-control">
                            <?php
                            if(!isset($obju)) $obju = new CLS_GUSER();
                            $obju->getListGmem(0,0);
                            unset($obju);
                            ?>
                            <script language="javascript">
                                cbo_Selected('cbo_gmember',<?php echo $row['guser_id'];?>);
                            </script>
                        </select>
                        <div class="clearfix"></div>
                    </div>
                    <div class='form-group col-md-6'>
                        <label>Tình trạng</label>
                        <label class="radio-inline"><input name="optactive" type="radio" value="1" <?php if($row['isactive']==1) echo ' checked="checked"';?> /> Active</label>
                        <label class="radio-inline"><input name="optactive" type="radio" value="0" <?php if($row['isactive']==0) echo ' checked="checked"';?> /> Deactive</label>
                        <div class="clearfix"></div>
                    </div>
                    <?php 
                } else { 
                    ?>
                    <input type="hidden" id="cbo_gmember" name="cbo_gmember" value="<?php echo $row['guser_id'];?>" />
                    <input type="hidden" name="optactive" value="<?php echo $row['isactive'];?>" />
                    <?php 
                } ?>
                <div class='col-md-6'>
                    <label>Giới tính</label><font color="red">*</font>
                    <div class="form-group">
                        <label class="radio-inline"><input type="radio" name="optgender" value="0" <?php if($row['gender']==0) echo ' checked="checked"';?> /> Nam</label>
                        <label class="radio-inline"><input type="radio" name="optgender" value="1" <?php if($row['gender']==1) echo ' checked="checked"';?>/>Nữ</label>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="text-center">
                <br/>
                <a href="?com=users" class="btn btn-default">Quay lại</a>
                <input type="submit" name="cmdsave" id="cmdsave"  class="btn btn-primary" value="Lưu thông tin">
            </div>
        </form>
        <div class="clearfix"></div>
    </div>
    <?php 
} unset($obj); ?>

<script>
    $(document).ready(function() {
        $('#frm_action').submit(function(){
            return checkinput();
        })
    })
    function checkinput(){
        var cur_date = new Date();
        var cur_time = cur_date.getTime();
        var birthday = $('#txtbirthday').val();
        var int_birthday = Math.round(new Date(birthday).getTime());
        var valuePhone=$("#txtphone").val();
        var phoneno =/^[\d\.\-]+$/;
        var valueEmail=$("#txtemail").val();
        var re_email = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;

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