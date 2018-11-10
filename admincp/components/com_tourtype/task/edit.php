<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
define('TASK_NAME', 'Sửa kiểu tour');
write_path();

$id=isset($_GET["id"])?(int)$_GET["id"]:"";
$obj->getList('WHERE `id`='.$id.'');
$row=$obj->Fetch_Assoc();


if(isset($_POST['cmdsave'])){
	$obj->Name=addslashes($_POST['txt_name']);
	$obj->Code=un_unicode($obj->Name);
	$obj->ID=(int)$_POST['txtid'];
	$obj->Update();
	echo "<script language=\"javascript\">window.location='index.php?com=".COMS."'</script>";
}
?>
<h1 align='center'>Sửa kiểu Tour </h1><hr/>
<div class="container">
	<div class="frm-control">
		<form id="frm_action" name="frm_action" method="post" action=""  enctype="multipart/form-data">
			<input name="txtid" type="hidden" value="<?php echo $row['id'];?>"/>
			<div class="row">
				<div class='form-group col-md-6'>
					<label class="control-label"><strong>Tên</strong></label>
					<input name="txt_name" type="text" id="txt_name" size="45" class='form-control' value="<?php echo $row['name'];?>" placeholder='' />
				</div>
			</div>
			<div class="text-center">
                <br/>
                <a href="?com=tour" class="btn btn-default">Quay lại</a>
                <input type="submit" name="cmdsave" id="cmdsave"  class="btn btn-primary" value="Lưu thông tin">
            </div>
		</form>
	</div>
</div>

<script language="javascript">
	function checkinput(){
		if($("#txt_name").val()==""){
			alert('Title is require!');
			$("#txt_name").focus();
			return false;
		}
		return true;
	}
</script>