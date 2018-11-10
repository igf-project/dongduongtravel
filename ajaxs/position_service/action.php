<?php

include_once('../../includes/gfinnit.php');
include_once('../../includes/gffunction.php');
include_once('../../includes/gfconfig.php');
include_once('../../libs/cls.mysql.php');
include_once('../../libs/cls.positionservices.php');


define('THIS_COM','position_service');
/*khai báo url ajax xử lý form*/
$url_ajax_delete=ROOTHOST."ajaxs/".THIS_COM."/comAction.php";/* xử lý del, active*/
$url_ajax_action=ROOTHOST."ajaxs/".THIS_COM."/action.php"; /*xử lý add, update*/
$url_ajax_formedit=ROOTHOST."ajaxs/".THIS_COM."/actionFormEdit.php"; /*show popup form edit*/




$obj=new CLS_POSITIONSERVICES();
$obj->PositionId=(int)$_POST['txt_position_id'];
$positioncontact_id=(int)$_POST['txt_positioncontact_id'];
$obj->PositionContactId=$positioncontact_id;
$obj->Name=addslashes($_POST['txt_name']);
$obj->Code=un_unicode($_POST['txt_name']);
$obj->Thumb=addslashes($_POST['txt_icon-service']);
$obj->Intro=addslashes($_POST['txt_intro']);
$obj->Fulltext=addslashes($_POST['txt_fulltext']);
if(isset($_POST['txtid'])){
    $obj->ID=$_POST['txtid'];
    $obj->Update();
}
else{
    $obj->Add_new();
}
$str="WHERE `positioncontact_id`=".$positioncontact_id;
$obj->listAjax($str, $limit=''); /*load list width call ajax*/
?>

<script language="javascript">
    function submitAddnew(){
        if(checkinput() == true){
            var form = $('#frm-addnew');
            var postData = form.serializeArray();
            var url =form.attr('action');
            $.post(url, postData, function(response_data){
                $('#respon-data').html(response_data);
            });
        }
    };

    function submitUpdate(){
        if(checkinput() == true){
            var form = $('#frm-edit');
            var postData = form.serializeArray();
            var url =form.attr('action');
            $.post(url, postData, function(response_data){
                $('#respon-data').html(response_data);
                $('#myModal').modal('hide');
            });

        }
    };

    function checkinput(){
        if($("#txt_name").val()==""){
            alert('Name is require!');
            $("#txt_name").focus();
            return false;
        }
        if($("#txt_content").val()==""){
            alert('Content is require!');
            $("#txt_content").focus();
            return false;
        }
        return true;
    }

    function confirm_mes(act){
        if(confirm('Bạn có muốn ' +act+ ' bản ghi này!')){
            return true;
        }
        return false;
    }


    $(document).ready(function() {
        $('.actEdit').click(function(){
            var val=$(this).attr('value');
            var position_code=$('#position_code').attr('value');
            $.get('<?php echo $url_ajax_formedit;?>',{val, position_code},function(response_data){
                $('#myModal').modal('show');
                $('#myModalLabel').html('Edit record');
                $('#data-frm').html(response_data);
            })
        });
        $('.actAjax').click(function(){
            var data = {
                'val': $(this).attr('value'),
                'act': $(this).attr('act')
            }
            if(data['act']=='del'){/* check confirm nếu xóa item*/
                if(confirm_mes('xóa')==false){
                    return;
                };

            }
            $.post('<?php echo $url_ajax_delete;?>',data,function(response_data){
                //$('#respon-data').html(response_data);
            });
            $("#tr-"+ data['val']).remove();
        });
    });

</script>