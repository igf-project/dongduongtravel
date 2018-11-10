<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
if(isset($_GET['positioncontact_id']) and (int)$_GET['positioncontact_id']){
    $positioncontact_id=$_GET['positioncontact_id'];
    $position_code=$_GET['code'];
}
else die('PAGE NOT FOUND');
include_once(LIB_PATH.'cls.gallery.php');
$objGa=new CLS_GALLERY();

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
    <div class="frm-control">
        <div class="link-header">
            <h3><span class="color-1"><?php echo $position_name;?></span> > Thêm thư viện ảnh</h3>
        </div>
        <div class="box-step column-4">
            <ul>
                <li class="">
                    <span class="number num1">01</span>
                    <span class="name">Thông tin cơ sở</span>
                </li>
                <li class="active">
                    <span class="number num3">02</span>
                    <span class="name">Thư viện ảnh</span>
                </li>
                <li>
                    <span class="number num4">03</span>
                    <span class="name">Thư viện video</span>
                </li>
                <li>
                    <span class="number num5">04</span>
                    <span class="name">Tin liên quan</span>
                </li>
            </ul>
        </div>
        <div class="box-form">

            <form id="frm-upload-img" class="box-sub" enctype="multipart/form-data">
                <input name="position_id" type="hidden" id="position_id" value="<?php echo $positioncontact_id;?>"/>
                <div class="row">
                    <div class='form-group col-md-6 col-action'>
                        <h3 class="title">Upload thư viện ảnh (Định dạng: JPEG,PNG,JPG. Dung lượng < 2M)</h3>
                        <input name="fileImg[]" type="file" id="file-img"/>
                    </div>
                    <div class='form-group col-md-6'>
                        <input class="btn btn-gallery btn-success" type="submit" value="Upload">
                    </div>
                </div>
            </form>
            <div class="box-btn-act top20">
                <a href="<?php echo ROOTHOST;?>member/<?php echo $position_code;?>/co-so/them-thu-vien-video/<?php echo $positioncontact_id;?>" class="save-continues btn-default btn-primary">Lưu và tiếp tục</a>
            </div>
            <div id="respon-img">
                <?php $objGa->getListGallery("WHERE `par_id`=".$positioncontact_id." AND `type`='1' AND `arr_path` IS NOT NULL", PATH_GALLERY); ?>
            </div>

            </div>
        </div>

    </div>
</div>



<link rel="stylesheet" type="text/css" href="<?php echo ROOTHOST;?>global/plugins/bootstrap-summernote/summernote.css">
<script src="<?php echo ROOTHOST;?>global/plugins/select2/select2.min.js"></script>
<script src="<?php echo ROOTHOST;?>global/plugins/bootstrap-summernote/summernote.min.js" type="text/javascript"></script>
<script language="javascript">

    /* add gallery */
    $("#frm-upload-img").submit(function(event){
        if($('#file-img').val()!= ''){
            var position_id=$('#position_id').val();
            event.preventDefault();
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: '<?php echo ROOTHOST;?>ajaxs/action_upload_gallery/uploadImage.php',
                type: 'POST',
                data: formData , position_id,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                success: function (returndata) {
                    $('#respon-img').append(returndata);
                    //alert(returndata);
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
    $('#respon-img .del-item').click(function(){
        if(confirm("Bạn có muốn chắc xóa ảnh này")){
            var imgId=$(this).attr('value');
            var position_id=$('#position_id').val();
            $.post('<?php echo ROOTHOST;?>ajaxs/action_upload_gallery/delImage.php',{imgId, position_id},function(response_data){
               //$('#respon-img').append(response_data);
            });
            var parent= $(this).parent();
            parent.remove();
        }
        else return false;
    });
</script>
<?php unset($objGa); unset($objPo);?>