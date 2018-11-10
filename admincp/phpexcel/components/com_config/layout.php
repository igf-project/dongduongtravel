<?php
	defined('ISHOME') or die('Can not acess this page, please come back!');
	define('COMS','config');
if(!isset($objuser)) $objuser = new CLS_USERS();
$check_isadmin = $objuser->isAdmin();
  if($check_isadmin==true):
?>
<script language="javascript" src="../js/checkform.js"></script>
<script language="javascript">
	function checkinput() {
		var  email = document.getElementById('email_contact');
		var  title = document.getElementById('web_title');
		
		if(title.value=='') {
			alert('Vui lòng nhập đầy đủ thông tin cấu hình. Các thông tin sẽ này ảnh hưởng đến việc hiển thị trên website');
			title.focus();
			return false;
		}
		//if(email.value!='' && !checkEmail(email.value)){email.focus();return false;}
		return true;
	}
</script>
	<div id="menus" class="toolbars">
	  <form id="frm_menu" name="frm_menu" method="post" action="">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td><h2 style="margin:0px; padding:0px;">THÔNG TIN CẤU HÌNH WEBSITE</h2></td>
            <label>
			  <input type="hidden" name="txtids" id="txtids" />
			  <input type="hidden" name="txtaction" id="txtaction" />
			</label>
            </td>
			<td align="right">
			<ul>
                <li><a class="save"  href="#" onclick="dosubmitAction('frm_action','save');" title="<?php echo MSAVE;?>"><?php echo MSAVE;?></a></li>
                <li><a class="help"  href="index.php?com=<?php echo COMS;?>&task=help" title="<?php echo MHELP;?>"><?php echo MHELP;?></a></li>
            </ul>
			</td>
		  </tr>
		</table>
	  </form>
	</div>
<?php
$title =''; $desc=''; $key='';$email_contact=''; $nickyahoo=''; $nameyahoo='';
$footer=''; $contact=''; $banner=''; $gallery=''; $logo='';
include_once('libs/cls.configsite.php');
$obj = new CLS_CONFIG();
if(isset($_POST['web_title']) && $_POST['web_title']!='') {
	
	if($_POST['web_title']!='') 	$obj->Title = addslashes($_POST['web_title']);
	if($_POST['web_desc']!='') 		$obj->Meta_descript = addslashes($_POST['web_desc']);
	if($_POST['web_keywords']!='') 	$obj->Meta_keyword = addslashes($_POST['web_keywords']);

	if($_POST['email_contact']!='') $obj->Email = addslashes($_POST['email_contact']);
	/*if($_POST['txtlogo']!='') 		$obj->Logo = addslashes($_POST['txtlogo']);
	if($_POST['txtnickyahoo']!='') 	$obj->Nickyahoo = addslashes($_POST['txtnickyahoo']);
	if($_POST['txtnameyahoo']!='') 	$obj->Nameyahoo = addslashes($_POST['txtnameyahoo']);
	
	if($_POST['txtcontact']!='')	$obj->Contact = addslashes($_POST['txtcontact']);
	if($_POST['txtfooter']!='')  	$obj->Footer = addslashes($_POST['txtfooter']);*/
	if($_POST['txtphone']!='')  	$obj->Phone = addslashes($_POST['txtphone']);
	if($_POST['txttwitter']!='')  	$obj->Twitter = addslashes($_POST['txttwitter']);
	if($_POST['txtgplus']!='')  	$obj->Gplus = addslashes($_POST['txtgplus']);
	if($_POST['txtfacebook']!='')  	$obj->Facebook = addslashes($_POST['txtfacebook']);
	if($_POST['txtyoutube']!='')  	$obj->Youtube = addslashes($_POST['txtyoutube']);

	$obj->Update2();
}	 
$obj->getList();
if($obj->Num_rows()<=0) {
	echo 'Dữ liệu trống.';
}
else{
$row = $obj->Fetch_Assoc();
$title 			= stripslashes($row['title']);
$desc  			= stripslashes($row['meta_descript']);
$key 			= stripslashes($row['meta_keyword']);
$email_contact 	= stripslashes($row['email']);
/*$logo		 	= stripslashes($row['logo']);*/
$phone			= stripslashes($row['phone']);
$facebook	    = stripslashes($row['facebook']);
$youtube		= stripslashes($row['youtube']);
$gplus			= stripslashes($row['gplus']);
$twitter		= stripslashes($row['twitter']);
/*$contact		= stripslashes($row['contact']);
$footer 		= stripslashes($row['footer']);
$nickyahoo		= stripslashes($row['nick_yahoo']);
$nameyahoo 		= stripslashes($row['name_yahoo']);*/
}
unset($obj);
?>
<div id='action'>
    <p><strong>Các thông tin cấu hình yêu cầu nhập đầy đủ trước khi lưu trữ. </strong></p>
    <form name="frm_action" id="frm_action" action="" method="post">
        <div class="form-group row">
            <label for="" class="col-sm-3 form-control-label">Tên website*</label>
            <div class="col-sm-9">
                <input type="text" name="web_title" class="form-control" id="web_title" value="<?php echo $title;?>" placeholder="">
                <div id="txt_name_err" class="mes-error"></div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="form-group row">
            <label for="" class="col-sm-3 form-control-label">Mô tả website*</label>
            <div class="col-sm-9">
                <input type="text" name="web_desc" class="form-control" id="web_desc" value="<?php echo $desc;?>" placeholder="">
                <div id="txt_name_err" class="mes-error"></div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="form-group row">
            <label for="" class="col-sm-3 form-control-label">Từ khóa*</label>
            <div class="col-sm-9">
                <input type="text" name="web_keywords" class="form-control" id="web_keywords" value="<?php echo $key;?>" placeholder="">
                <div id="txt_name_err" class="mes-error"></div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="form-group row">
            <label for="" class="col-sm-3 form-control-label">Email liên hệ*</label>
            <div class="col-sm-9">
                <input type="text" name="email_contact" class="form-control" id="email_contact" value="<?php echo $email_contact;?>" placeholder="">
                <div id="txt_name_err" class="mes-error"></div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="form-group row">
            <label for="" class="col-sm-3 form-control-label">Số điện thoại</label>
            <div class="col-sm-9">
                <input type="text" name="txtphone" class="form-control" id="txtphone" value="<?php echo $phone;?>" placeholder="">
                <div id="txt_name_err" class="mes-error"></div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="form-group row">
            <label for="" class="col-sm-3 form-control-label">Twitter</label>
            <div class="col-sm-9">
                <input type="text" name="txttwitter" class="form-control" id="txttwitter" value="<?php echo $twitter;?>" placeholder="Link Twitter của bạn">
                <div id="txt_name_err" class="mes-error"></div>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="form-group row">
            <label for="" class="col-sm-3 form-control-label">G+</label>
            <div class="col-sm-9">
                <input type="text" name="txtgplus" class="form-control" id="txtgplus" value="<?php echo $gplus;?>"placeholder="Link G+ của bạn">
                <div id="txt_name_err" class="mes-error"></div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="form-group row">
            <label for="" class="col-sm-3 form-control-label">Facebook</label>
            <div class="col-sm-9">
                <input type="text" name="txtfacebook" class="form-control" id="txtfacebook" value="<?php echo $facebook;?>" placeholder="Link Facebook của bạn">
                <div id="txt_name_err" class="mes-error"></div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="form-group row">
            <label for="" class="col-sm-3 form-control-label">Youtube</label>
            <div class="col-sm-9">
                <input type="text" name="txtyoutube" class="form-control" id="txtyoutube" value="<?php echo $youtube;?>" placeholder="Link Youtube của bạn">
                <div id="txt_name_err" class="mes-error"></div>
            </div>
            <div class="clearfix"></div>
        </div>
<!--	<tr>
       <td colspan="2" bgcolor="#CCCCCC"><strong>Hỗ trợ trực tuyến (danh sách cách nhau bởi dấu ,) </strong></td></tr>
    <tr>
      <td>Tên Nick Yahoo </td>
      <td><input name="txtnickyahoo" type="text" id="txtnickyahoo" style="width:100%;" value="<?php /*echo $nickyahoo; */?>"></td>
    </tr>
    <tr>
      <td>Tiêu đề Nick Yahoo</td>
      <td><input name="txtnameyahoo" type="text" id="txtnameyahoo"  style="width:100%;" value="<?php /*echo $nameyahoo; */?>"></td>
    </tr>
    -->
	<input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;" />
  </table>
</form>
</div>
<?php endif;?>