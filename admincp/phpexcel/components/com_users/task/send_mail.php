<style>
    #menus{
        display: none;
    }
    .title-header{
        background-color: #eee;
        padding: 20px;
        font-size: 24px;
        margin-top: 0px;
        margin-bottom: 20px;
    }
    .page-content-wrapper .page-content {
        min-height: 700px;
    }
</style>
<h2 class="title-header" title="Gửi tin tới khách hàng">Gửi tin tới khách hàng</h2>
<?php
require_once(libs_path.'cls.category.php');
require_once(libs_path.'cls.content.php');
require_once(libs_path.'cls.mail.php');
if (!isset($objmysql)) $objmysql=new CLS_MYSQL;

$tmp_box="";$tmp_mailto="";$list_mail=array();$message="";
if(!isset($_SESSION['BOX_ID'])) $_SESSION['BOX_ID']="";
if(!isset($_SESSION['MAIL_TO'])) $_SESSION['MAIL_TO']="";
if(isset($_POST['sl_box']) AND $_POST['sl_box'] !="all") {
	 // echo "<pre>";
 	// print_r($_POST);
 	// echo "</pre>";
	$_SESSION['BOX_ID']=$_POST['sl_box'];
	$_SESSION['MAIL_TO']=$_POST['sl_mailto'];
}

$tmp_box=$_SESSION['BOX_ID'];
 $tmp_mailto=$_SESSION['MAIL_TO'];
//lay mail nguoi gui
 $conf = new CLS_CONFIG();
 $conf->getList();
 if ($conf->Num_rows()>0) {
 	$row_conf=$conf->Fetch_Assoc();
 	$email_conf=$row_conf['email'];
 	$email_exp=explode(',,|', $email_conf);
 	$email_from=$email_exp[0];
 	// echo $email_from;
 	// echo "<pre>";
 	// print_r($row_conf);
 	// echo "</pre>";
 }

 if(isset($_POST['cmdsend'])){
 	 // lấy danh sách mail người tới
 	$txt_difmail=isset($_POST['txt_difmail']) ? trim($_POST['txt_difmail']) :"";
 	$txt_subject=isset($_POST['txt_subject']) ? trim($_POST['txt_subject']) :"";
 	$txt_content=isset($_POST['txt_content']) ? trim($_POST['txt_content']) :"";
 	// lay ds mail trong csdl
 	// type=1 là vip
 	// type=2 là thường
 	// type=3 là khác
	$sql=" SELECT DISTINCT `email` FROM `tbl_customer_info` WHERE `isactive`=1  ";
	if ($tmp_mailto !="all") $sql.=" AND `type`=$tmp_mailto";
	// lay ds mail trong txt_difmail
	$list_mail=explode(",", $txt_difmail);
	$objmysql->Query($sql);
	while ($row=$objmysql->Fetch_Assoc()) {
		$list_mail[]=$row['email'];
	}
	$count=count($list_mail);
	$email_to="";
	$objMailer=new CLS_MAILER();
	for ($i=0; $i <$count ; $i++) { 
		if($list_mail[$i] !="") {
			$body=$txt_content;
			$header='MIME-Version: 1.0' . "\r\n";
			$header.='Content-type: text/html; charset=utf-8' . "\r\n";//Content-type: text/html; charset=iso-8859-1′ . “\r\n
			$header.="FROM: <".$email_from."> \r\n";

			$objMailer->FROM=$email_from;//WEB_MAIL;
			$objMailer->HEADER=$header;
			$objMailer->SUBJECT = $txt_subject;
			$objMailer->TO =$list_mail[$i];
			$objMailer->CONTENT = $body;
			 // echo "<pre>";print_r($objMailer);echo "</pre>";die();
			$objMailer->SendMail();
			$message="Chúc mừng bạn đã gửi mail thành công!";

	}
	}

 }

?>
<form id="frm_sendmail" name="frm_sendmail" method="POST" action="#" class="col-md-8">
	<div style="color:red;text-align:center;"><?php if($message !="") echo $message ;?></div>

    <div class="form-group">
        <label for="" class="col-sm-4 form-control-label">Nhóm Box chuyên mục*</label>
        <div class="col-sm-8">
            <select name="sl_box" class="form-control" id="sl_box" onchange="document.frm_sendmail.submit();">
                <option value="all">Mời chọn nhóm chuyên mục</option>
                <?php
                if(!isset($obj_cate)) $obj_cate=new CLS_CATEGORY();
                // var_dump($objbox);
                echo $obj_cate->getListCate();
                ?>
                <script language="javascript">
                    cbo_Selected('sl_box','<?php echo $tmp_box;?>');
                </script>
            </select>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="form-group">
        <label for="" class="col-sm-4 form-control-label">Bài viết thuộc nhóm chuyên mục*</label>
        <div class="col-sm-8">
            <select  class="form-control"  id="sl_post" name="sl_post">
                <option value="">Mời chọn bài viết</option>
                <?php
                if(!isset($objcontent)) $objcontent=new CLS_CONTENTS;
                $objcontent->getList(" WHERE `cate_id`=$tmp_box");
                while($row=$objcontent->Fetch_Assoc()){ ?>
                    <option value="<?php echo $row['id'] ;?>">&nbsp;&nbsp;&nbsp;<?php echo trim($row['title']) ;?></option>
                <?php }?>
            </select>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="form-group">
        <label for="" class="col-sm-4 form-control-label">Tiêu đề thư*</label>
        <div class="col-sm-8">
            <input name="txt_subject" type="text" id="txt_subject" class="form-control"/>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="form-group">
        <label for="" class="col-sm-4 form-control-label">Nội dung thư*</label>
        <div class="col-sm-8">
            <textarea rows="10" id="txt_content" name="txt_content" class="form-control"></textarea>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="form-group">
        <label for="" class="col-sm-4 form-control-label">Chọn mail gửi*</label>
        <div class="col-sm-8">
            <select name="sl_mailto" id="sl_mailto" class="form-control">
                <!-- <option>Mời chọn loại tài khoản</option> -->
                <option value="all">&nbsp; &nbsp; Tất cả tài khoản</option>
                <option value="1">&nbsp; &nbsp; Tài khoản vip</option>
                <option value="2">&nbsp; &nbsp; Tài khoản thường</option>
                <option value="3">&nbsp; &nbsp; Tài khoản khác</option>
                <script language="javascript">
                    cbo_Selected('sl_mailto','<?php echo $tmp_mailto?>');
                </script>
            </select>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="form-group">
        <label for="" class="col-sm-4 form-control-label">Hoặc vui lòng điền email (cách nhau dấu ,) vào hộp thoại sau:</label>
        <div class="col-sm-8">
            <textarea id="txt_difmail" name="txt_difmail" class="form-control"><?php if(isset($_POST['txt_difmail'])) echo $_POST['txt_difmail'];?></textarea>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="form-group">
        <label for="" class="col-sm-4 form-control-label"></label>
        <div class="col-sm-8">
            <input type="submit" name="cmdsend" id="cmdsend"  class="btn btn-primary" value="Gửi mail">
            <input type="reset" name="cmdreset" id="cmdreset"  class="btn btn-default" value="Huỷ bỏ">
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
</form>
<script type="text/javascript">
	$(document).ready(function(){
		var arr=[];
		// var sl_box=document.forms['frm_sendmail'].sl_box;
		var sl_post=document.forms['frm_sendmail'].sl_post;
		$("#sl_post").change(function(){
			var index_post=sl_post.selectedIndex;
			var post_id=sl_post[index_post].value;
			 // console.log(post_id);
			$.get('<?php echo ROOTHOST ;?>ajaxs/load_post.php',{'id_post':post_id},function(data){
				// $("#result").html(data);
				var getData=$.parseJSON(data);
				 // console.log(getData);
				$("#txt_subject").val("Thông báo từ Bò tơ Tây Ninh Tài Sanh - "+getData['0']['title_post']);
				$("#txt_content").val(getData['0']['content_post']);

			});

		});
		
	});
</script>

