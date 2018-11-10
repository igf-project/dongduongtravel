<?php
include_once('../../../includes/gfinnit.php');
include_once('../../../includes/gffunction.php');
include_once('../../../includes/gfconfig.php');
include_once('../../../libs/cls.mysql.php');
include_once('../../../libs/cls.tourprogramfood.php');
$objdata = new CLS_MYSQL();
$obj=new CLS_TOURPROGRAMFOOD();

$TourId=(int)$_POST['txt_tour_id'];
$DayId=(int)$_POST['txt_day_id'];
$PositionId=addslashes($_POST['cbo_position']);
$Title=addslashes($_POST['txt_title_food']);
$Content=addslashes($_POST['txt_content_food']);
$Time=addslashes($_POST['txt_time_food']);
if(isset($_POST['txt_arr_foodid'])){
    $ArrFoodId = $_POST['txt_arr_foodid'];
    $ArrFoodId= implode(',',$ArrFoodId);
} else{
    $ArrFoodId='';
}


if(isset($_POST['txtid'])){
    $ID=$_POST['txtid'];
    $sql="UPDATE tbl_tour_programfood SET
            `title`='".$Title."',
            `content`='".$Content."',
            `time`='".$Time."',
            `arr_food_id`='".$ArrFoodId."'
            WHERE id='".$ID."'";
    $objdata->Query($sql);
} else{
    $sql="INSERT INTO `tbl_tour_programfood`(`tour_id`, `day_id`, `position_id`, `title`, `content`, `time`, `arr_food_id`) VALUES
          ('".$TourId."', '".$DayId."', '".$PositionId."', '".$Title."', '".$Content."', '".$Time."',
            '".$ArrFoodId."')";
    $objdata->Query($sql);
}
$str="WHERE `tour_id`=$TourId AND `day_id`=$DayId.";
$obj->getListItemForm($str, $limit='');
?>

<script>
    $('#food .actEdit').click(function(){
        var val=$(this).attr('value');
        var tour_id=$(this).attr('tourId');
        $.get('<?php echo ROOTHOST;?>ajaxs/action_add_tourprogram/tour_food/actionFormEdit.php',{val, tour_id},function(response_data){
            $('#myModal').modal('show');
            $('#data-frm').html(response_data);
        })
    });

    $('#food .actAjax').click(function(){
        var data = {
            'val': $(this).attr('value'),
            'tour_id': $(this).attr('tourId'),
            'act': $(this).attr('act')
        }
        if(data['act']=='del'){/* check confirm nếu xóa item*/
            if(confirm_mes('xóa')==false){
                return;
            };

        }
        $.post('<?php echo ROOTHOST;?>ajaxs/action_add_tourprogram/tour_food/comAction.php',data,function(response_data){
            //$("#tr-"+ data['val']).html(response_data);

        });
        $("#tr-"+ data['val']).remove();
    });
</script>