
<?php
include_once('../../../includes/gfinnit.php');
include_once('../../../includes/gffunction.php');
include_once('../../../includes/gfconfig.php');
include_once('../../../libs/cls.mysql.php');
include_once('../../../libs/cls.tourprogramsleep.php');
include_once('../../../libs/cls.positioncontact.php');
$objdata = new CLS_MYSQL();
$obj=new CLS_TOURPROGRAMSLEEP();

if(isset($_GET["val"])):
    $id=(int)$_GET["val"];
    $tour_id=(int)$_GET["tour_id"];
else:
    echo "Not acset Program";
endif;
$strwhere="";
$sql="SELECT * FROM `tbl_tour_programsleep` WHERE `tbl_tour_programsleep`.`id`=$id ORDER BY `tbl_tour_programsleep`.`title`";
$objdata->Query($sql);
$row=$objdata->Fetch_Assoc();

$sql="SELECT arr_location FROM tbl_tour WHERE isactive=1 AND id=".$row['tour_id'];
$objdata->Query($sql);
$row_Lo = $objdata->Fetch_Assoc();
$arr_location = stripcslashes($row_Lo['arr_location']);
?>
<form id="frm-edit-sleep" name="frm_action" method="post" action="<?php echo ROOTHOST;?>ajaxs/action_add_tourprogram/tour_sleep/action.php">
    <input name="txtid" type="hidden" value="<?php echo $id;?>"/>
    <input name="txt_tour_id" type="hidden" id="txt_tour_id" value="<?php echo $tour_id;?>"/>
    <input name="txt_day_id" type="hidden" value="<?php echo $row['day_id'];?>"/>
    <div class='form-group'>
        <label class="control-label"><strong>Title </strong></label>
        <input name="txt_title_sleep" type="text" id="txt_title_sleep_ajaxs" class='form-control' value="<?php echo $row['title'];?>"/>
    </div>

    <div class='form-group'>
        <label class="control-label"><strong>Tại Khách sạn / Nhà nghỉ</strong></label>
        <div class='form-group'>
            <select id="cbo_position_sleep_ajaxs" name="cbo_position" class="form-control" data-live-search="true" title="Chọn một khách sạn/ nhà hàng ..." style="width: 100%;">
                <option value="">-- Chọn khách sạn / nhà nghỉ --</option>
                <?php
                $strWhere="AND `tbl_position`.`positiongrouptype_id`='64' AND `location_id` IN($arr_location) ORDER BY `name` ASC";
                $sql="SELECT `id`, `name` FROM tbl_position WHERE isactive=1 ".$strWhere;
                $objdata->Query($sql);
                while($row_Po=$objdata->Fetch_Assoc()){
                    if($row_Po['id']==$row['position_id']){
                        $checked='checked';
                    }else{
                        $checked='';
                    }
                    echo '<option value="'.$row_Po['id'].'" '.$checked.'>'.$row_Po['name'].'</option>';
                }
                ?>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label><strong>Nội dung mô tả</strong></label>
        <textarea class="form-control" name="txt_content_sleep" id="txt_content_sleep_ajaxs" rows="5"><?php echo $row['content'];?></textarea>
    </div>

</form>

<div class="clearfix"></div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary" onclick="submitUpdateSleep()">Save changes</button>
</div>
<script>
    $(document).ready(function(){
        $("#cbo_position_where_ajaxs").select2();
    })
</script>



