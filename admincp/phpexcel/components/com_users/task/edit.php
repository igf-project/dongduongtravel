<?php
defined('ISHOME') or die('Can not acess this page, please come back!');
$id='';
if(isset($_GET['id']))
	$id=(int)$_GET['id'];

$flag=true;
if($id!=$_SESSION[MD5($_SERVER['HTTP_HOST']).'_USERID']){
    if(!isset($UserLogin)) $UserLogin=new CLS_USERS;
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
$obj->getList(' WHERE mem_id='.$id,'');
$row=$obj->Fetch_Assoc();
?>
<script language='javascript'>
function checkinput(){
	 return true;
}
 </script>
<div id="action">
  <form id="frm_action" name="frm_action" method="post" action="" class="col-md-8">
	<h4>Thông tin tài khoản người dùng</h4>
	<div>Các mục đánh dấu <font color="red">*</font> là thông tin bắt buộc<div>
        <div class="form-group">
            <label for="" class="col-sm-3 form-control-label">Tên đăng nhập*</label>
            <div class="col-sm-9">
                <input type="text" required class="form-control" name="txtusername" id="txtusername" readonly="true" value="<?php echo $row['username'];?>"/>
                <span id="msgbox" style="display:none"></span>
                <input type="hidden" name="checkuser" id="checkuser" value="" />
                <input type="hidden" name="txtuser" value="<?php echo $row['username'];?>" id="txtuser" />
            </div>
            <div class="clearfix"></div>
        </div>
	<h4>Thông tin chi tiết người dùng</h4>
            <div class="form-group">
                <label for="" class="col-sm-3 form-control-label">Họ & đệm*</label>
                <div class="col-sm-9">
                    <input type="text" name="txtfirstname" id="txtfirstname" value="<?php echo $row['firstname'];?>" required class="form-control"/>
                    <input name="txtid" type="hidden" id="txtid" value="<?php echo $row['mem_id'];?>" />
                </div>
                <div class="clearfix"></div>
            </div>

            <div class="form-group">
                <label for="" class="col-sm-3 form-control-label">Tên*</label>
                <div class="col-sm-9">
                    <input type="text" name="txtlastname" id="txtlastname" value="<?php echo $row['lastname'];?>" required class="form-control"/>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-3 form-control-label">Ngày sinh*</label>
                <div class="col-sm-9">
                    <input type="text" name="txtbirthday" id="txtbirthday" value="<?php echo date("d-m-Y",strtotime($row['birthday']));?>" required class="form-control"/>
                </div>
                <div class="clearfix"></div>
            </div>

            <div class="form-group">
                <label for="" class="col-sm-3 form-control-label">Giới tính*</label>
                <div class="col-sm-9">
                    <input type="radio" name="optgender" value="0" <?php if($row['gender']==0) echo ' checked="checked"';?> /> Nam
                    <input type="radio" name="optgender" value="1" <?php if($row['gender']==1) echo ' checked="checked"';?>/> N&#7919;
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-3 form-control-label">Địa chỉ</label>
                <div class="col-sm-9">
                    <input type="text" name="txtaddress" id="txtaddress" value="<?php echo $row['address'];?>" class="form-control"/>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-3 form-control-label">Điện thoại bàn</label>
                <div class="col-sm-9">
                    <input type="text" name="txtphone" id="txtphone" value="<?php echo $row['phone'];?>" class="form-control"/>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-3 form-control-label">Email</label>
                <div class="col-sm-9">
                    <input type="email" name="txtemail" id="txtemail" value="<?php echo $row['email'];?>" class="form-control"/>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-3 form-control-label">Điện thoại di động</label>
                <div class="col-sm-9">
                    <input type="text" name="txtmobile" id="txtmobile" value="<?php echo $row['mobile'];?>" class="form-control"/>
                </div>
                <div class="clearfix"></div>
            </div>
      <?php
	  if($UserLogin->isAdmin()==true) {
	  ?>
          <div class="form-group">
              <label for="" class="col-sm-3 form-control-label">Nhóm quyền*</label>
              <div class="col-sm-9">
                  <select name="cbo_gmember" id="cbo_gmember" class="form-control">
                      <?php
                      if(!isset($obju)) $obju = new CLS_GUSER();
                      $obju->getListGmem(0,1);
                      unset($obju);
                      ?>
                      <script language="javascript">
                          cbo_Selected('cbo_gmember',<?php echo $row['gmem_id'];?>);
                      </script>
                  </select>
              </div>
              <div class="clearfix"></div>
          </div>
          <div class="form-group">
              <label for="" class="col-sm-3 form-control-label">Tình trạng người dùng</label>
              <div class="col-sm-9">
                  <input name="optactive" type="radio" value="1" <?php if($row['isactive']==1) echo ' checked="checked"';?> /> Active
                  <input name="optactive" type="radio" value="0" <?php if($row['isactive']==0) echo ' checked="checked"';?> /> Deactive
              </div>
              <div class="clearfix"></div>
          </div>
      <?php }
	  else {
	  ?>
      <input type="hidden" id="cbo_gmember" name="cbo_gmember" value="<?php echo $obj->Gmember;?>" />
      <input type="hidden" name="optactive" value="<?php echo $row['isactive'];?>" />
      <?php } ?>
      <label>
        <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;">
      </label>
  </form>
</div>
<?php } 
unset($obj);
?>