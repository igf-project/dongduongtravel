
<?php
include_once('../../../includes/gfinnit.php');
include_once('../../../includes/gffunction.php');
include_once('../../../includes/gfconfig.php');
include_once('../../../libs/cls.mysql.php');
include_once('../../../libs/cls.tourprogramfood.php');
include_once('../../../libs/cls.positioncontact.php');
$objdata=new CLS_MYSQL();
$obj=new CLS_TOURPROGRAMFOOD();

if(isset($_GET["val"])):
    $id=(int)$_GET["val"];
    $tour_id=(int)$_GET["tour_id"];
else:
    echo "Not acset Program";
endif;
$strwhere="";
$sql="SELECT * FROM `tbl_tour_programfood` WHERE `tbl_tour_programfood`.`id`=$id ORDER BY `tbl_tour_programfood`.`title`";
$objdata->Query($sql);
$row=$objdata->Fetch_Assoc();

$sql="SELECT arr_location FROM tbl_tour WHERE isactive=1 AND id=".$row['tour_id'];
$objdata->Query($sql);
$row_Lo = $objdata->Fetch_Assoc();
$arr_location = stripcslashes($row_Lo['arr_location']);
?>
<div id="action">
    <form id="frm-edit-food" name="frm_action" method="post" action="<?php echo ROOTHOST;?>ajaxs/action_add_tourprogram/tour_food/action.php">
        <input name="txtid" type="hidden" value="<?php echo $id;?>"/>
        <input name="txt_tour_id" type="hidden" id="txt_tour_id" value="<?php echo $tour_id;?>"/>
        <input name="txt_day_id" type="hidden" id="txt_day_id" value="<?php echo $row['day_id'];?>" />
        <div class='form-group'>
            <label class="control-label">Tên </label></label><small><font color="red"> *</font></small>
            <input name="txt_title_food" type="text" id="txt_title_food_ajaxs" size="45" class='form-control' value="<?php echo $row['title'];?>"/>
        </div>
        <div class='form-group'>
            <label class="control-label">Thời gian </label></label><small><font color="red"> *</font></small>
            <input name="txt_time_food" type="text" id="txt_time_food_ajaxs" size="45" class='form-control' value="<?php echo $row['time'];?>"/>
        </div>
        <div class='form-group'>
            <label class="control-label">Tại nhà hàng </label></label><small><font color="red"> *</font></small>
            <div class='form-group'>
                <select id="cbo_position_food_ajaxs" name="cbo_position" class="form-control">
                    <option value="">-- Chọn nhà hàng --</option>
                    <?php
                    $strWhere="AND `tbl_position`.`positiongrouptype_id`='63' AND `location_id` IN($arr_location) ORDER BY `name` ASC";
                    $sql="SELECT * FROM `tbl_position` WHERE isactive=1 ";
                    $objdata->Query($sql);
                    while($row_Po=$objdata->Fetch_Assoc()){
                        if($row_Po['id'] == $row['position_id']){
                            echo '<option value="'.$row_Po['id'].'" selected>'.$row_Po['name'].'</option>';
                        }else{
                            echo '<option value="'.$row_Po['id'].'">'.$row_Po['name'].'</option>';
                        }
                    }
                    ?>
                </select>
            </div>
        </div>
        <label class="control-label">Thực đơn </label><small> (Chọn nhà hàng trước)</small>
        <div id="respon-foodmenu" class="form-group">
            <select id="txt_arr_foodid_ajaxs" class="form-control" name="txt_arr_foodid[]" multiple="multiple">
                <?php
                $arr_food_id = explode(',',$row['arr_food_id']);
                $sql="SELECT id, name FROM tbl_foodmenu WHERE position_id=".$row['position_id']." AND `isactive`='1' ORDER BY `name` ASC";
                $objdata->Query($sql);
                while($row_Food=$objdata->Fetch_Assoc()){
                    $id=$row_Food['id'];
                    $name=$row_Food['name'];
                    if(in_array($id,$arr_food_id)){
                        $selected='selected';
                    }else{
                        $selected='';
                    }
                    echo '<option value="'.$id.'" '.$selected.'>'.$name.'</option>';
                }
                ?>
            </select>
            <script>
                $('#txt_arr_foodid_ajaxs').searchableOptionList({
                    showSelectAll: true,
                    texts:{
                        selectAll: 'Click all',
                        selectNone: 'Remove',
                        searchplaceholder: 'chọn thực đơn'
                    }
                });
            </script>
        </div>
        <div class="form-group">
            <label>Nội dung mô tả</label>
            <textarea id="txt_content_food_ajaxs" class="form-control" name="txt_content_food" rows="5"><?php echo $row['content'];?></textarea>
        </div>
    </form>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
    <button type="button" class="btn btn-primary" onclick="submitUpdateFood()">Lưu thay đổi</button>
</div>
