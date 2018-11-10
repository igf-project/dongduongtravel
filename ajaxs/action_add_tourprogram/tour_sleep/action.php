<?php
include_once('../../../includes/gfinnit.php');
include_once('../../../includes/gffunction.php');
include_once('../../../includes/gfconfig.php');
include_once('../../../libs/cls.mysql.php');
include_once('../../../libs/cls.tourprogramsleep.php');
$objdata = new CLS_MYSQL();
$obj = new CLS_TOURPROGRAMSLEEP();

$TourId=(int)$_POST['txt_tour_id'];
$DayId=(int)$_POST['txt_day_id'];
$PositionId=addslashes($_POST['cbo_position']);
$Title=addslashes($_POST['txt_title_sleep']);
$Content=addslashes($_POST['txt_content_sleep']);

if(isset($_POST['txtid'])){
    $ID=$_POST['txtid'];
    $sql = "UPDATE tbl_tour_programsleep SET `title`='".$Title."', `content`='".$Content."' WHERE id='".$ID."'";
    $objdata->Query($sql);
}
else{
    $sql="INSERT INTO `tbl_tour_programsleep`(`tour_id`, `day_id`, `position_id`, `title`, `content`) VALUES
          ('".$TourId."', '".$DayId."', '".$PositionId."', '".$Title."', '".$Content."')";
    $objdata->Query($sql);
}
$str="WHERE `tour_id`=$TourId AND `day_id`=$DayId";
$obj->getListItemForm($str, $limit='');
?>

<script>
    $('#sleep .actAjax').click(function(){
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
        $.post('<?php echo ROOTHOST;?>ajaxs/action_add_tourprogram/tour_sleep/comAction.php',data,function(response_data){
            //$("#tr-"+ data['val']).html(response_data);

        });
        $("#tr-"+ data['val']).remove();
    });
    $('#sleep .actEdit').click(function(){
        var val=$(this).attr('value');
        var tour_id=$(this).attr('tourId');
        $.get('<?php echo ROOTHOST;?>ajaxs/action_add_tourprogram/tour_sleep/actionFormEdit.php',{val, tour_id},function(response_data){
            $('#myModal').modal('show');
            $('#data-frm').html(response_data);
        })
    });

</script>