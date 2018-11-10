<?php
include_once('../../includes/gfinnit.php');
include_once('../../includes/gffunction.php');
include_once('../../includes/gfconfig.php');
include_once('../../libs/cls.mysql.php');
include_once('../../libs/cls.foodmenu.php');
$obj=new CLS_FOODMENU();
$obj->Name=addslashes($_POST['txt_name']);
$obj->Content=addslashes($_POST['txt_content']);
$positioncontact_id=(int)$_POST['txt_positioncontact_id'];
$obj->PositionContactId=$positioncontact_id;
$obj->PositionId=(int)$_POST['txt_positioncontact_id'];
$obj->LocationId=(int)$_POST['txt_positioncontact_id'];
/*upload thumb*/
if(isset($_FILES['fileImg']) AND $_FILES['fileImg']['name']!=''){
    $objUpload=new CLS_UPLOAD();
    $obj->Thumb=$objUpload->UploadFile('fileImg', $path);
}
else $obj->Thumb=$_POST['url_image'];
//var_dump($obj->Thumb); die();
if(isset($_POST['txtid'])){
    $obj->ID=$_POST['txtid'];
    $obj->Update();
}
else{
    $obj->Add_new();
}
$str="WHERE `tbl_foodmenu`.`positioncontact_id`=$positioncontact_id";
$obj->listAjax($str);
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