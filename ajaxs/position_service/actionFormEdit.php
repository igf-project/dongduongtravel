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
if(isset($_GET["val"])):
    $id=(int)$_GET["val"];
else:
    echo "Not acset Program";
endif;
$strwhere="";
$obj->getList("WHERE `tbl_position_services`.`id`=".$id);
$row=$obj->Fetch_Assoc();
?>
<form id="frm-edit" name="frm-edit" method="post" action="<?php echo $url_ajax_action;?>" enctype="multipart/form-data">
    <input name="txtid" type="hidden" value="<?php echo $id;?>"/>
    <input name="txt_positioncontact_id" type="hidden" id="txt_positioncontact_id" value="<?php echo $row['positioncontact_id'];?>"/>
    <input name="txt_position_id" type="hidden" id="txt_position_id" value="<?php echo $row['position_id'];?>"/>
    <input name="txt_location_id" type="hidden" id="txt_location_id" value="<?php echo $row['location_id'];?>"/>
    <div class="row">
        <div class='form-group col-md-12'>
            <label class="control-label"><strong>Tên dịch vụ</strong></label>
            <input name="txt_name" type="text" id="txt_name" size="45" class='form-control' value="<?php echo $row['name'];?>" placeholder='' />
        </div>
    </div>
    <div class='form-group'>
        <label class="control-label relative-box"><strong>Ảnh đại diện dịch vụ<span id="respon-ic"></span> </strong></label>
        <ul class="row list-icon-service">
            <input id="default-ic" type="hidden" name="txt_icon-service" value="<?php echo $row['thumb'];?>">
            <li class=""><span name="ic-service-default" class="ic-service-default">default</span></li>
            <li class=""><span name="ic-service-restaurent" class="ic-service-restaurent <?php echo $row['thumb']=='ic-service-restaurent'?'active':'';?>"></span></li>
            <li class=""><span name="ic-service-spa" class="ic-service-spa <?php echo $row['thumb']=='ic-service-spa'?'active':'';?>"></span></li>
            <li class=""><span name="ic-service-gym" class="ic-service-gym  <?php echo $row['thumb']=='ic-service-gym'?'active':'';?>"></span></li>
            <li class=""><span name="ic-service-cafe" class="ic-service-cafe <?php echo $row['thumb']=='ic-service-cafe'?'active':'';?>"></span></li>
            <li class=""><span name="ic-service-relax" class="ic-service-relax <?php echo $row['thumb']=='ic-service-relax'?'active':'';?>"></span></li>
            <li class=""><span name="ic-service-music" class="ic-service-music <?php echo $row['thumb']=='ic-service-music'?'active':'';?>"></span></li>
        </ul>
    </div>
    <div class="form-group clearfix">
        <label><strong>Tóm tắt dịch vụ</strong></label>
        <textarea name="txt_intro" id="txt_intro" size="45" placeholder='' style="min-height: 80px !important;"><?php echo $row['intro'];?></textarea>
    </div>
    <div class="form-group">
        <label><strong>Nội dung chi tiết</strong></label>
        <textarea id="txt_fulltext" name="txt_fulltext" placeholder='Nội dung chi tiết' ><?php echo $row['fulltext'];?></textarea>
    </div>

<div class="clearfix"></div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary" onclick="submitUpdate()">Save changes</button>
</div>
</form>
<link rel="stylesheet" type="text/css" href="<?php echo ROOTHOST;?>global/plugins/bootstrap-summernote/summernote.css">
<script src="<?php echo ROOTHOST;?>global/plugins/bootstrap-summernote/summernote.min.js" type="text/javascript"></script>
<script>
    $('#frm-edit .list-icon-service li span').click(function(){
        $('#default-ic').remove();
        var val=$(this).attr('name');
        var input='<input type="hidden" name="txt_icon-service" value="'+val+'">';
        $('.list-icon-service li span').find('input').remove();
        $('.list-icon-service li span').removeClass('active');
        $(this).toggleClass('active');
        $(this).append(input);
    });

    function submitUpdate(){
        if(checkinputedit() == true){
            var form = $('#frm-edit');
            var postData = form.serializeArray();
            var url =form.attr('action');
            $.post(url, postData, function(response_data){
                $('#respon-data').html(response_data);
                $('#myModal').modal('hide');
            });
        }
    };


    var ComponentsEditors = function () {
        var handleWysihtml5 = function () {
            if (!jQuery().wysihtml5) {
                return;
            }
            if ($('.wysihtml5').size() > 0) {
                $('.wysihtml5').wysihtml5({
                    "stylesheets": ["global/plugins/bootstrap-wysihtml5/wysiwyg-color.css"]
                });
            }
        }
        var handleSummernote = function () {
            $('#txt_fulltext').summernote({height: 180});
        }
        return {
            //main function to initiate the module
            init: function () {
                handleWysihtml5();
                handleSummernote();
            }
        }
    }();

    $(document).ready(function() {
        ComponentsEditors.init();
    })

</script>



