
<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
if(isset($_GET['positioncontact_id']) and (int)$_GET['positioncontact_id']){
    $positioncontact_id=(int)$_GET['positioncontact_id'];
    $position_id=(int)$_GET['position_id'];
}
else die('PAGE NOT FOUND');
include_once(LIB_PATH.'cls.positioncontact.php');
$objPoCon=new CLS_POSITIONCONTACT();
$row=$objPoCon->getListById($positioncontact_id);
/*lấy ra positiontype_id*/
include_once(LIB_PATH.'cls.position.php');
$objPo=new CLS_POSITION();
$positiontype_id=$objPo->getPositionTypeById($position_id);
$arr_type_position=explode(',', ARR_TYPEPOSITION);
$position_name=$objPo->getNameById($position_id);
?>
<div class="container">
    <div class="link-header">
        <h3><span class="color-1"><?php echo $position_name;?></span> > Thêm thực đơn</h3>
    </div>
    <div class="frm-control">
        <h3 class="h3-header">Thêm mới thực đơn</h3>
        <div class="box-step column-4">
            <ul>
                <li class="active">
                    <span class="number num1">01</span>
                    <span class="name">Thông tin thực đơn</span>
                </li>
                <li class="">
                    <span class="number num2">02</span>
                    <span class="name">Thư viện ảnh</span>
                </li>
                <li class="">
                    <span class="number num3">03</span>
                    <span class="name">Thư viện video</span>
                </li>
                <li>
                    <span class="number num4">04</span>
                    <span class="name">Tin liên quan</span>
                </li>
            </ul>
        </div>
        <form id="frm_action" name="frm_action" method="post" action=""  enctype="multipart/form-data">
                <input name="txt_positioncontact_id" type="hidden" id="txt_positioncontact_id" value="<?php echo $positioncontact_id;?>"/>
                <input name="txt_position_id" type="hidden" id="txt_position_id" value="<?php echo $row['position_id'];?>"/>
                <input name="txt_location_id" type="hidden" id="txt_location_id" value="<?php echo $row['location_id'];?>"/>
                <input name="txt_position_code" type="hidden" id="txt_position_code" value="<?php echo $position_code;?>"/>
                <div class="row">
                    <div class='form-group col-md-6'>
                        <label class="control-label"><strong>Tên thực đơn</strong></label>
                        <input name="txt_name" type="text" id="txt_name" size="45" class='form-control' value="" placeholder='' />
                    </div>
                    <div class='form-group col-md-6'>
                        <label class="control-label"><strong>Thể loại</strong></label>
                        <select name="cbo_cateid" id="cbo_cateid" class='form-control'>
                            <option value="">-- Thuộc thể loại --</option>
                            <?php
                            echo $obj->getListCbFoodCategory();
                            ?>
                        </select>
                    </div>
                    <div class='form-group col-md-6'>
                        <label class="control-label"><strong>Phù hợp</strong></label>
                        <select name="cbo_recomid" id="cbo_recomid" class='form-control'>
                            <option value="">-- Phù hợp với --</option>
                            <?php
                            echo $obj->getListCbFoodRecommend();
                            ?>
                        </select>
                    </div>

                    <div class='form-group col-md-6'>
                        <label class="control-label"><strong>Thumb ảnh</strong></label>
                        <input name="fileImg" type="file" id="file-thumb" size="45" class='form-control' value="" placeholder='' />
                        <div id="show-img">
                            <img class="img-display" src="<?php echo ROOTHOST.THUMB_DEFAULT;?>">
                        </div>
                    </div>
                </div>
                    <div class="form-group clearfix">
                        <label><strong>Tóm tắt</strong></label>
                        <textarea id="txt_intro" name="txt_intro" placeholder='Mô tả bài viết' ></textarea>
                    </div>
                    <div class="form-group">
                        <label><strong>Nội dung chi tiết</strong></label>
                        <textarea id="txt_fulltext" name="txt_fulltext" placeholder='Nội dung bài viết' ></textarea>
                    </div>
                    <a class="save btn-default btn-primary"  href="#" onclick="dosubmitAction('frm_action','save');" title="Save">Save</a>
                    <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;">


            </form>
    </div>
</div>
<?php
unset($objcountry);
?>

<link rel="stylesheet" type="text/css" href="<?php echo ROOTHOST;?>global/plugins/bootstrap-summernote/summernote.css">
<script src="<?php echo ROOTHOST;?>global/plugins/select2/select2.min.js"></script>
<script src="<?php echo ROOTHOST;?>global/plugins/bootstrap-summernote/summernote.min.js" type="text/javascript"></script>
<script language="javascript">
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

    function submitAddnew(){
        if(checkinput() == true){
            var form = $('#frm-food');
            var postData = form.serializeArray();
            var url =form.attr('action');
            $.post(url, postData, function(response_data){
                $('#respon-food').html(response_data);
            });
        }
    };

    function checkinput(){
        if($("#txt_name").val()==""){
            alert('Name is require!');
            $("#txt_name").focus();
            return false;
        }
        if($("#txt_intro").val()==""){
            alert('Intro is require!');
            $("#txt_intro").focus();
            return false;
        }
        if($("#cbo_cateid").val()==""){
            alert('Category food is require!');
            $("#cbo_cateid").focus();
            return false;
        }
        if($("#cbo_recomid").val()==""){
            alert('Recoment Food is require!');
            $("#cbo_recomid").focus();
            return false;
        }
        if($("#file-thumb").val()==""){
            alert('Thumb image is require!');
            $("#file-thumb").focus();
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
        ComponentsEditors.init();
        $('.actEdit').click(function(){
            var val=$(this).attr('value');
            var position_code=$('#txt_position_code').val();
            console.log(position_code);
            $.get('<?php echo ROOTHOST;?>ajaxs/food/actionFormEdit.php',{val, position_code},function(response_data){
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
            $.post('<?php echo ROOTHOST;?>ajaxs/food/comAction.php',data,function(response_data){
            });
            $("#tr-"+ data['val']).remove();
        });

        /* load thumb when select File*/
        $("input#file-thumb").change(function(e) {

            for (var i = 0; i < e.originalEvent.srcElement.files.length; i++) {
                var file = e.originalEvent.srcElement.files[i];
                var img = document.createElement("img");
                var reader = new FileReader();
                reader.onloadend = function() {
                    img.src = reader.result;
                }
                reader.readAsDataURL(file);
                $('#show-img').addClass('show-img');
                $('#show-img').html(img);
            }
        });
    });

</script>