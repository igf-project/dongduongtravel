<?php
include_once('../../includes/gfinnit.php');
include_once('../../libs/cls.mysql.php');
include_once('../../libs/cls.tourservices.php');
$obj=new CLS_TOURSERVICES();
if(isset($_GET["val"])):
	$id=(int)$_GET["val"];
	$tour_id=(int)$_GET["tour_id"];
else:
	echo "Not acset Program";
endif;
$strwhere="";
$obj->getList("WHERE `tbl_tour_services`.`id`=".$id);
$row=$obj->Fetch_Assoc();
?>
<form id="frm-edit" name="frm_action" method="post" action="" enctype="multipart/form-data">
	<input name="txtid" type="hidden" value="<?php echo $id;?>"/>
	<input name="txt_tour_id" type="hidden" value="<?php echo $tour_id;?>"/>
			
			  <div class="row">
				<div class='form-group col-md-12'>
					 <label class="control-label"><strong>Name</strong></label>
					 <input name="txt_name" type="text" id="txt_name" size="45" class='form-control' value="<?php echo $row['name'];?>" placeholder='' />
				 </div>
			 </div>
			  <div class="row">
				<div class='form-group col-md-6'>
					 <label class="control-label"><strong>Đơn giá</strong></label>
					 <input name="txt_price" type="text" id="txt_price" size="45" class='form-control' value="<?php echo $row['price'];?>" placeholder='' />
				 </div>
				 <div class='form-group col-md-6'>
					 <label class="control-label"><strong>Số lượng</strong></label>
					 <input name="txt_quantity" type="text" id="txt_quantity" size="45" class='form-control' value="<?php echo $row['quantity'];?>" placeholder='' />
				 </div>
			 </div>
			 <div class="row">
				<div class='form-group col-md-12'>
					 <label class="control-label"><strong>Loại dịch vụ</strong></label>
					<select name="cbo_type" id="cbo_type" class='form-control'>
						<option value='1'>Dịch vụ chung</option>
						<option value='2'>Dịch vụ khác (Có tính phí)</option>
					</select>
				 </div>
			 </div>
			 <div class="form-group">
				 <label><strong>Nội dung mô tả</strong></label>
				 <textarea name="txt_content" id="txt_content" size="45" placeholder='Mô tả hành trình trong ngày'><?php echo $row['content'];?></textarea>
			 </div>
		</form>
		
<div class="clearfix"></div>

