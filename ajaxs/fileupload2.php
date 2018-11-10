<?php 
if(isset($_FILES["file"])){
	//echo '<pre>'; print_r($_FILES["file"]); echo '</pre>';
	if($_FILES["file"]["tmp_name"] != '') {
		include_once(libs_path."cls.upload.php");
		$objup = new CLS_UPLOAD;
		//$path = $_SERVER['DOCUMENT_ROOT']."/data/images/position/".(int)$_GET['id']; 
		$path = $_SERVER['DOCUMENT_ROOT']."/data/images/position/"; 
		$objup->setPath($path);
		$objup->UploadFile('file','');
		$id = (int)$_GET['id'];
		if(!isset($_SESSION["file$id"])) 
			$_SESSION["file$id"][0]=$_FILES["file"]["name"];
		else {
			// kiem tra neu ten file do da ton tai, thi k add vao session nua
			$flag = false;
			for($i=0;$i<count($_SESSION["file$id"]);$i++){
				if($_SESSION["file$id"][$i]==$_FILES["file"]["name"]) {
					$flag=true; break;
				}
			}
			if ($flag==false) {
				$_SESSION["file$id"][]=$_FILES["file"]["name"];
			}
		}
	}
}
?>
<!-- The file upload form used as target for the file upload widget -->
<form id="fileupload" action="#" method="POST" enctype="multipart/form-data">
	<span class="btn btn-success fileinput-button">
		<input id="fileinput" type="file" name="file" multiple required>
	</span>
	<button type="submit" class="btn btn-primary start">
		<i class="glyphicon glyphicon-upload"></i>
		<span>Tải lên</span>
	</button>
</form>
<div class="height20"></div>
<!-- Read directory, if exist files then show file -->
<?php
$path = $_SERVER['DOCUMENT_ROOT']."/data/images/position/"; 
if(isset($_SESSION["file$id"])) { 
	echo '<ul id="image-list">';
	$num=0;
	for($i=0;$i<count($_SESSION["file$id"]);$i++) {
		$filePath = $_SERVER['DOCUMENT_ROOT']."/data/images/position/".$_SESSION["file$id"][$i];
		//if(is_file($filePath) && file_exists($filePath)) {
			echo '<li class="col-md-3 text-center">
				<img src="'.ROOTHOST.'images/position/'.$_SESSION["file$id"][$i].'" class="img-responsive" height="150"/>
				<button name="delfile" class="button" onclick="delfile'."('".$_SESSION["file$id"][$i]."')".'">Xóa ảnh</button></li>';
			$num++;
		//}
	}
	echo '</ul>';
	if($num==0) unset($_SESSION["file$id"]);
}
?>
<div class="height20"></div>
<script>
function delfile(name) {
	$.post('<?php echo ROOTHOST;?>ajaxs/del_file.php',{'id':<?php echo $id;?>,'name':name,'path':'<?php echo $path;?>'},function(data){
		window.location.reload();
	})
}
</script>