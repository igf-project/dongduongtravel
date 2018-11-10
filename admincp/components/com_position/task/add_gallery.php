<?php
define('TASK_NAME', 'Thêm thư viện ảnh');
write_path();
defined("ISHOME") or die("Can't acess this page, please come back!");
if(isset($_GET['id'])){
    $position_id=$_GET['id'];
}
else die('PAGE NOT FOUND');
include_once(LIB_PATH.'cls.gallery.php');
$objGa=new CLS_GALLERY();


$info_position = $obj->getInfo(" AND id= $position_id");
$position_id = $info_position['id'];
$position_name = $info_position['name'];
?>
<div id="action">
    <h3><span class="color-1"><font color="#00a65a"><?php echo $position_name;?></font></span> > Thêm thư viện ảnh</h3>
    <div class="row">
        <div class="col-md-8">
            <div class="frm-control">
                <div class="box-form">
                    <form id="frm-upload-img" enctype="multipart/form-data">
                        <input name="position_id" type="hidden" id="position_id" value="<?php echo $position_id;?>"/>
                        <div class="row">
                            <div class='form-group col-md-8 col-action'>
                                <h3 class="title" style="font-size: 16px;">Upload thư viện ảnh (Định dạng: JPEG,PNG,JPG. Dung lượng < 2M)</h3>
                                <input name="fileImg[]" type="file" id="file-img"/>
                            </div>
                            <div class='form-group col-md-4'>
                                <input class="btn btn-gallery btn-success" type="submit" style="margin-top:15px;" value="Upload">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="respon-img">
        <?php $objGa->getListGallery("WHERE `par_id`=".$position_id." AND `type`='1' AND `arr_path` IS NOT NULL", PATH_GALLERY); ?>
    </div>
</div>


<script language="javascript">
    /* add gallery */
    $("#frm-upload-img").submit(function(event){
        if($('#file-img').val()!= ''){
            var position_id=$('#position_id').val();
            event.preventDefault();
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: '<?php echo ROOTHOST_ADMIN;?>ajaxs/action_upload_gallery/uploadImage.php',
                type: 'POST',
                data: formData , position_id,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                success: function (returndata) {
                    $('#respon-img').append(returndata);
                }
            });
        }
        else{
            alert('Choose link Images is Require!')
        }
        $('#file-img').val("");
        return false;
    });
    /*del image*/
    function del_itemGallery($this){
        if(confirm("Bạn có muốn chắc xóa ảnh này")){
            var imgId=$($this).attr('value');
            var ID = $($this).attr('data-id');
            $.post('<?php echo ROOTHOST_ADMIN;?>ajaxs/action_upload_gallery/delImage.php',{imgId, ID},function(response_data){
                $('#respon-img').html(response_data);
            });
        }
        else return false;
    }
</script>
<?php unset($objGa); unset($obj);?>