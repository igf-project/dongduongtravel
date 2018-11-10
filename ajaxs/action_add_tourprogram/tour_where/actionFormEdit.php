<?php
include_once('../../../includes/gfinnit.php');
include_once('../../../includes/gffunction.php');
include_once('../../../includes/gfconfig.php');
include_once('../../../libs/cls.mysql.php');
include_once('../../../libs/cls.tourprogramwhere.php');
$objdata=new CLS_MYSQL();
$obj=new CLS_TOURPROGRAMWHERE();

if(isset($_GET["val"])):
	$id=(int)$_GET["val"];
	$tour_id=(int)$_GET["tour_id"];

else:
	echo "Not acset Program";
endif;
$strwhere="";
$obj->getList("WHERE `tbl_tour_programwhere`.`id`=".$id);
$row=$obj->Fetch_Assoc();

$sql="SELECT arr_location FROM tbl_tour WHERE isactive=1 AND id=".$row['tour_id'];
$objdata->Query($sql);
$row_Lo = $objdata->Fetch_Assoc();
$arr_location = stripcslashes($row_Lo['arr_location']);
?>
<div id="action">
    <form id="frm-edit-where" name="frm_action" method="post" action="<?php echo ROOTHOST;?>ajaxs/action_add_tourprogram/tour_where/action.php">
		<input name="txtid" type="hidden" value="<?php echo $id;?>"/>
		<input name="txt_tour_id" type="hidden" value="<?php echo $tour_id;?>"/>
        <input name="txt_day_id" type="hidden" value="<?php echo $row['day_id'];?>"/>
		  <div class="row">
			<div class='form-group col-md-12'>
				 <label class="control-label">Tiêu đề</label>
				 <input name="txt_title_where" type="text" id="txt_title_where_ajaxs" class='form-control' value="<?php echo $row['title'];?>" placeholder='' />
			 </div>
		 </div>
        <div class='form-group'>
            <label class="control-label">Địa điểm thăm quan</label>
            <select id="cbo_position_where_ajaxs" class="cbo_position" name="cbo_position" class="form-control cbo_position1" style="width: 100%;">
                <option value="">-- Chọn một địa điểm --</option>
                <?php
                $sql="SELECT `name`, `id` FROM tbl_position WHERE isactive=1 AND `positiongrouptype_id`='62' AND `location_id` IN($arr_location) ORDER BY `name` ASC ";
                echo $sql;
                $objdata->Query($sql);
                $objdata->Fetch_Assoc();
                while($row_Po=$objdata->Fetch_Assoc()){
                    if($row_Po['id']==$row['position_id']){
                        echo '<option value="'.$row_Po['id'].'" selected>'.$row_Po['name'].'</option>';
                    }else{
                        echo '<option value="'.$row_Po['id'].'">'.$row_Po['name'].'</option>';
                    }
                }
                ?>
            </select>
        </div>
        <div class="row">
            <div class='form-group col-md-12'>
                <label class="control-label">Thời gian</label>
                <input name="txt_time_where" type="text" id="txt_time_where_ajaxs" class='form-control' value="<?php echo $row['time'];?>" placeholder='' />
            </div>
        </div>
		 <div class="form-group">
			 <label>Nội dung mô tả</label>
			 <textarea name="txt_content_where" id="txt_content_where1" rows="5" class="form-control" placeholder='Mô tả hành trình trong ngày'><?php echo $row['content'];?></textarea>
		 </div>
	</form>
			
	<div class="clearfix"></div>
</div>


<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
    <button type="button" class="btn btn-primary" onclick="submitUpdateWhere()">Lưu thay đổi</button>
</div>

<script>
    $(document).ready(function(){
        $(".cbo_position").select2();
    })
</script>