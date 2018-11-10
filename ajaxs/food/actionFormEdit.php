<?php
include_once('../../includes/gfinnit.php');
include_once('../../includes/gffunction.php');
include_once('../../includes/gfconfig.php');
include_once('../../libs/cls.mysql.php');
include_once('../../libs/cls.foodmenu.php');
$obj=new CLS_FOODMENU();
if(isset($_GET["val"])):
	$id=(int)$_GET["val"];
    $position_code=addslashes($_GET["position_code"]);
else:
	echo "Not acset Program";
endif;
$strwhere="";
$obj->getList("WHERE `tbl_foodmenu`.`id`=".$id);
$row=$obj->Fetch_Assoc();
?>
<form id="frm_action_edit" name="frm_action_edit" method="post" action="" enctype="multipart/form-data">
    <input name="txt_act" type="hidden" value="1"/><!-- check ative edit-->
	<input name="txtid" type="hidden" value="<?php echo $id;?>"/>
    <input name="txt_positioncontact_id" type="hidden" id="txt_positioncontact_id" value="<?php echo $row['positioncontact_id'];?>"/>
    <input name="txt_position_id" type="hidden" id="txt_position_id" value="<?php echo $row['position_id'];?>"/>
    <input name="txt_location_id" type="hidden" id="txt_location_id" value="<?php echo $row['location_id'];?>"/>
    <input name="txt_position_code" type="hidden" id="txt_position_code" value="<?php echo $position_code;?>"/>
      <div class="row">
        <div class='form-group col-md-12'>
             <label class="control-label"><strong>Tên thực đơn</strong></label>
             <input name="txt_name" type="text" id="txt_name" size="45" class='form-control' value="<?php echo $row['name'];?>" placeholder='' />
         </div>
     </div>
    <div class='form-group col-md-6'>
        <label class="control-label"><strong>Thumb ảnh</strong></label>
        <input name="fileImg" type="file" id="file-thumb" size="45" class='form-control' value="<?php echo $row['thumb'];?>" placeholder='' />
        <input name="url_image" type="hidden" value="<?php echo $row['thumb'];?>"/>
        <div id="show-img">
            <img class="img-display" src="<?php echo $row['thumb']==''? ROOTHOST.THUMB_DEFAULT:ROOTHOST.$row['thumb'];?>">
        </div>
    </div>
     <div class="form-group clearfix">
         <label><strong>Nội dung mô tả</strong></label>
         <textarea name="txt_content" id="txt_content" size="45" placeholder='Mô tả hành trình trong ngày'><?php echo $row['content'];?></textarea>
     </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input class="btn btn-success" type="submit" name="submitsave" value="Cập nhật"/>
    </div>
</form>
<div class="clearfix"></div>



