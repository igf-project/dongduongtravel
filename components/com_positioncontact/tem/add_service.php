<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
define('THIS_COM','position_service');
if(isset($_GET['positioncontact_id']) and (int)$_GET['positioncontact_id']){
    $positioncontact_id=$_GET['positioncontact_id'];
    $position_code=$_GET['code'];
}
else die('PAGE NOT FOUND');

/*khai báo url ajax xử lý form*/
$url_ajax_delete=ROOTHOST."ajaxs/".THIS_COM."/comAction.php";/* xử lý del, active*/
$url_ajax_action=ROOTHOST."ajaxs/".THIS_COM."/action.php"; /*xử lý add, update*/
$url_ajax_formedit=ROOTHOST."ajaxs/".THIS_COM."/actionFormEdit.php"; /*show popup form edit*/


include_once(LIB_PATH.'cls.positionservices.php');
$obj=new CLS_POSITIONSERVICES();

/*lấy ra positiontype_id*/
include_once(LIB_PATH.'cls.position.php');
$objPo=new CLS_POSITION();
$positiontype_id=$objPo->getPositionTypeByCode($position_code);
$arr_type_position=explode(',', ARR_TYPEPOSITION);

$arr=$objPo->getIdAndNameByCode($position_code);
$position_id=$arr['id'];
$position_name=$arr['name'];

?>
<div class="container">
    <span id="position_code" value="<?php echo $position_code;?>"></span>
    <div class="frm-control">
        <div class="link-header">
            <h3><span class="color-1"><?php echo $position_name;?></span> > Thêm dịch vụ</h3>
        </div>
        <div class="box-step column-4">
            <ul>
                <li class="">
                    <span class="number num1">01</span>
                    <span class="name">Thông tin cơ sở</span>
                </li>
                <li class="">
                    <span class="number num3">02</span>
                    <span class="name">Thư viện ảnh</span>
                </li>
                <li class="">
                    <span class="number num4">03</span>
                    <span class="name">Thư viện video</span>
                </li>
                <li>
                    <span class="number num5">04</span>
                    <span class="name">Tin liên quan</span>
                </li>
            </ul>
        </div>
        <div class="box-form" style="padding-top: 15px">
            <div class="box-btn-ctrl">
                <a class="save-continues btn-default btn-primary"  href="<?php echo ROOTHOST."member/".$position_code."/co-so/them-thu-vien-anh/".$positioncontact_id;?>">Lưu và tiếp tục</a>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <form id="frm-addnew" name="frm-addnew" method="post" action="<?php echo $url_ajax_action;?>"  enctype="multipart/form-data">
                        <input name="txt_positioncontact_id" type="hidden" id="txt_positioncontact_id" value="<?php echo $positioncontact_id;?>"/>
                        <input name="txt_position_id" type="hidden" id="txt_position_id" value="<?php echo $position_id;?>"/>
                        <div class='form-group'>
                            <label class="control-label"><strong>Tên dịch vụ</strong></label>
                            <input name="txt_name" type="text" id="txt_name" size="45" class='form-control' value="" placeholder='' />
                        </div>
                        <div class='form-group'>
                            <label class="control-label relative-box"><strong>Ảnh đại diện dịch vụ<span id="respon-ic"></span> </strong></label>
                                <ul class="row list-icon-service">
                                    <li class=""><span name="ic-service-default" class="ic-service-default">default<input type="hidden" name="txt_icon-service" value="ic-service-default"></span></li>
                                    <li class=""><span name="ic-service-restaurent" class="ic-service-restaurent"></span></li>
                                    <li class=""><span name="ic-service-spa" class="ic-service-spa"></span></li>
                                    <li class=""><span name="ic-service-gym" class="ic-service-gym"></span></li>
                                    <li class=""><span name="ic-service-cafe" class="ic-service-cafe"></span></li>
                                    <li class=""><span name="ic-service-relax" class="ic-service-relax"></span></li>
                                    <li class=""><span name="ic-service-music" class="ic-service-music"></span></li>
                                </ul>
                        </div>
                        <div class="form-group clearfix">
                            <label><strong>Tóm tắt về dịch vụ</strong></label>
                            <textarea name="txt_intro" id="txt_intro" size="45"></textarea>
                        </div>
                        <div class="form-group">
                            <label><strong>Nội dung chi tiết</strong></label>
                            <textarea id="txt_fulltext" name="txt_fulltext" placeholder='Nội dung chi tiết'></textarea>
                        </div>
                        <span class="btn btn-success" onclick="submitAddnew()">Addnew</span>
                    </form>
                </div>
                <div class="col-md-6">
                    <div class="box-respon list-result">
                        <h4>Danh sách dịch vụ</h4>
                        <div class="box-scroll">
                            <table class="table">
                                <tr>
                                    <th>#</th>
                                    <th>Icon</th>
                                    <th>Name</th>
                                    <th>Sửa</th>
                                    <th>Xóa</th>
                                </tr>
                                <tbody id="respon-data">
                                <?php
                                $str="WHERE `positioncontact_id`=".$positioncontact_id;
                                $obj->listAjax($str, $limit=''); /*load list width call ajax*/
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" type="text/css" href="<?php echo ROOTHOST;?>global/plugins/bootstrap-summernote/summernote.css">
<script src="<?php echo ROOTHOST;?>global/plugins/bootstrap-summernote/summernote.min.js" type="text/javascript"></script>
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


function checkinput(){
    if($("#frm-addnew #txt_name").val()==""){
        alert('Name is require!');
        $("#frm-addnew #txt_name").focus();
        return false;
    }
    if($("#frm-addnew #txt_intro").val()==""){
        alert('Content is require!');
        $("#frm-addnew #txt_intro").focus();
        return false;
    }
    return true;
}
function checkinputedit(){
    if($("#frm-edit #txt_name").val()==""){
        alert('Name is require!');
        $("#frm-edit #txt_name").focus();
        return false;
    }
    if($("#frm-edit #txt_intro").val()==""){
        alert('Content is require!');
        $("#frm-edit #txt_intro").focus();
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
        });
        $("#tr-"+ data['val']).remove();
    });
    $('.list-icon-service li span').click(function(){
        var val=$(this).attr('name');
        var input='<input type="hidden" name="txt_icon-service" value="'+val+'">';
        $('.list-icon-service li span').find('input').remove();
        $('.list-icon-service li span').removeClass('active');
        $(this).toggleClass('active');
        $(this).append(input);
        $('#respon-ic').html('Bạn đã chọn stype icon: <span class="'+val+'"></span>');
    });

});

</script>
