<?php
include_once('../../includes/gfinnit.php');
include_once('../../includes/function.php');
include_once('../../includes/gfconfig.php');
include_once('../../libs/cls.mysql.php');
include_once('../../libs/cls.tourprogram.php');
$obj=new CLS_TOURPROGRAM();
$obj->TourId=(int)$_POST['txt_tour_id'];
$obj->NumDay=addslashes($_POST['txt_num_day']);
$obj->Title=addslashes($_POST['txt_title']);
$obj->Content=addslashes($_POST['txt_content']);

if(isset($_POST['txt_id'])){
    $obj->ID=$_POST['txt_id'];
    $obj->Update();
}
else{
    $obj->Add_new();
   
}
$ajax='';
$str="WHERE `tour_id`=".$obj->TourId;
$obj->listAjax($str, $limit=''); /*load list width call ajax*/
?>

<script>
    $('.actAjax').click(function(){
        var data = {
            'val': $(this).attr('value'),
            'posId': $(this).attr('posId'),
            'act': $(this).attr('act')
        }
        $.post('ajaxs/comAction.php',data,function(response_data){
            $("#tr-"+ data['val']).html(response_data);
        })
        //console.log('aa');
    });
    $('.actEdit').click(function(){
        var txt_position_id=$('#txt_position_id').val();
        var val=$(this).attr('value');
        $.get('ajaxs/actionFormEdit.php',{val, txt_position_id},function(response_data){
            $('#myModal').modal('show');
            $('#data-frm').html(response_data);
        })
    });
</script>