<?php
include_once('../../includes/gfinnit.php');
include_once('../../libs/cls.mysql.php');
include_once('../../libs/cls.tourprogram.php');
$obj=new CLS_TOURPROGRAM();
if(isset($_GET["val"])):
	$id=(int)$_GET["val"];
	$tour_id=(int)$_GET["tour_id"];
else:
	echo "Not acset Program";
endif;
$strwhere="";
$obj->getList("WHERE `tbl_tour_program`.`id`=".$id);
$row=$obj->Fetch_Assoc();
?>
<div id="action">
	<form id="frm-edit" name="frm_action" method="post" action="" enctype="multipart/form-data">
		<input name="txtid" type="hidden" value="<?php echo $id;?>"/>
		<input name="txt_tour_id" type="hidden" value="<?php echo $tour_id;?>"/>
		 <div class="row">
			 <div class='form-group col-md-12'>
				 <label class="control-label"><strong>Lịch trình ngày:</strong></label>
				 <input name="txt_num_day" type="text" id="txt_num_day" size="45" class='form-control' value="<?php echo $row['num_day'];?>" placeholder='Ví dụ: Ngày thứ nhất:' />
			 </div>
			  
		 </div>
		  <div class="row">
			<div class='form-group col-md-12'>
				 <label class="control-label"><strong>Tiêu đề</strong></label>
				 <input name="txt_title" type="text" id="txt_title" size="45" class='form-control' value="<?php echo $row['title'];?>" placeholder='' />
			 </div>
		 </div>
		 <div class="form-group">
			 <label><strong>Nội dung mô tả</strong></label>
			 <textarea name="txt_content" id="txt_content" size="45" placeholder='Mô tả hành trình trong ngày'><?php echo $row['content'];?></textarea>
		 </div>
	</form>
			
	<div class="clearfix"></div>
</div>
