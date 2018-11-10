<div id="colmain" class="container">
	<div class="form_add">
<?php 
$objmem = new CLS_MEMBER;
$arr = $objmem->getUserLogin(); 
if(!isset($arr)) echo '<div class="height20"></div><div class="error">Vui lòng đăng nhập để thực hiện chức năng này</div><div class="height20"></div>';
else {
	$fbid = $arr['fbid'];
	$avar = $arr['avatar'];
	if(isset($_FILES["file"])){
		//echo '<pre>'; print_r($_FILES["file"]); echo '</pre>';
		if($_FILES["file"]["tmp_name"] != '') {
			include_once(libs_path."cls.upload.php");
			$objup = new CLS_UPLOAD;
			$path = $_SERVER['DOCUMENT_ROOT']."/data/images/avatar/"; 
			$objup->setPath($path);
			$objup->UploadFile('file','');
		}

		$objmem->ID = $fbid;
		$objmem->Avatar = ROOTHOST."images/avatar/".$_FILES["file"]['name'];
		$objmem->UpdateAvar(); 
	}
	$avar = $objmem->getAvarByUser($fbid); 
?>
<h2>Ảnh đại diện</h2>
<div>Chọn ảnh từ máy tính của bạn. Chấp nhận GIF, JPEG, PNG với kích thước tối đa 5.0 MB</div>
<hr/>
<a href="<?php echo $avar;?>" class="imgs_fancybox" rel="group"><img src="<?php echo $avar;?>" height="100" width="100"/></a>
<div class="height20"></div>
<!-- The file upload form used as target for the file upload widget -->
<form id="fileupload" action="#" method="POST" enctype="multipart/form-data">
	<span class="btn btn-success fileinput-button">
		<input id="fileinput" type="file" name="file" multiple>
	</span>
	<button type="submit" class="btn btn-primary start">
		<i class="glyphicon glyphicon-upload"></i>
		<span>Tải lên</span>
	</button>
</form>
<?php } ?>
</div></div>