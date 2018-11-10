
<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
if(isset($_GET['positioncontact_id']) and (int)$_GET['positioncontact_id']){
    $positioncontact_id=(int)$_GET['positioncontact_id'];
    $position_code=addslashes($_GET['code']);
}
else die('PAGE NOT FOUND');
include_once(LIB_PATH.'cls.foodmenu.php');
$obj=new CLS_FOODMENU();
include_once(LIB_PATH.'cls.positioncontact.php');
$objPoCon=new CLS_POSITIONCONTACT();
$row=$objPoCon->getListById($positioncontact_id);
?>
<div class="container">
    <div class="frm-control">
        <div class="link-header">
            <h3>Thêm thực đơn > <?php echo $position_code;?></h3>
            <a class="save-continues btn-default btn-primary"  href="<?php echo ROOTHOST."member/".$position_code."/co-so/them-dich-vu/".$positioncontact_id;?>">Lưu và tiếp tục</a>
        </div>
        <div class="box-form">
            <div class="row">
                <div class="col-md-6">
                    <form id="frm_action" name="frm_action" method="post" action=""  enctype="multipart/form-data">
                        <input name="txt_positioncontact_id" type="hidden" id="txt_positioncontact_id" value="<?php echo $positioncontact_id;?>"/>
                        <input name="txt_position_id" type="hidden" id="txt_position_id" value="<?php echo $row['position_id'];?>"/>
                        <input name="txt_location_id" type="hidden" id="txt_location_id" value="<?php echo $row['location_id'];?>"/>
                        <input name="txt_position_code" type="hidden" id="txt_position_code" value="<?php echo $position_code;?>"/>
                        <div class='form-group'>
                            <label class="control-label"><strong>Tên thực đơn</strong></label>
                            <input name="txt_name" type="text" id="txt_name" size="45" class='form-control' value="" placeholder='' />
                        </div>
                        <div class='form-group col-md-6'>
                            <label class="control-label"><strong>Thumb ảnh</strong></label>
                            <input name="fileImg" type="file" id="file-thumb" size="45" class='form-control' value="" placeholder='' />
                            <div id="show-img">
                                <img class="img-display" src="<?php echo ROOTHOST.THUMB_DEFAULT;?>">
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <label><strong>Nội dung mô tả</strong></label>
                            <textarea name="txt_content" id="txt_content" size="45"></textarea>
                        </div>
                        <!--<input class="btn btn-success" type="submit" name="submitsave" value="Addnew"/>-->
                        <a class="save btn-default btn-primary"  href="#" onclick="dosubmitAction('frm_action','save');" title="Save">Save</a>
                        <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;">
                    </form>
                </div>
                <div class="col-md-6">
                    <div class="box-respon list-result">
                        <h4>Danh sách thực đơn</h4>
                        <div class="box-scroll">
                            <table class="table">
                                <tr>
                                    <th>#</th>
                                    <th>Hình ảnh</th>
                                    <th>Name</th>
                                    <th>Sửa</th>
                                    <th>Xóa</th>
                                </tr>
                                <tbody id="respon-food">
                                <?php
                                $str="WHERE `tbl_foodmenu`.`positioncontact_id`=$positioncontact_id";
                                $obj->listAjax($str);
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



<script language="javascript">
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
        /* if($("#txt_name").val()==""){
         alert('Name is require!');
         $("#txt_name").focus();
         return false;
         }
         if($("#txt_content").val()==""){
         alert('Content is require!');
         $("#txt_content").focus();
         return false;
         }*/
        return true;
    }


    $(document).ready(function() {
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
            $.post('<?php echo ROOTHOST;?>ajaxs/food/comAction.php',data,function(response_data){
                //$("#tr-"+ data['val']).html(response_data);

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
