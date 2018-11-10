<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
if(isset($_GET['food_id'])){
    $positioncontact_id=(int)$_GET['positioncontact_id'];
    $position_id=(int)$_GET['position_id'];
    $food_id=(int)$_GET['food_id'];
}
else die('PAGE NOT FOUND');
include_once(LIB_PATH.'cls.gallery.php');
$objGa=new CLS_GALLERY();

/*lấy ra positiontype_id*/
include_once(LIB_PATH.'cls.position.php');
$objPo=new CLS_POSITION();

$positiontype_id=$objPo->getPositionTypeById($position_id);
$arr_type_position=explode(',', ARR_TYPEPOSITION);
$position_name=$objPo->getNameById($position_id);
$arr=$obj->getNameAndCodeById($food_id);
$food_code=$arr['code'];
$food_name=$arr['name'];
?>
<div class="container">
    <div class="frm-control">
        <div class="link-header">
            <h3><span class="color-1"><?php echo $position_name;?></span> > <?php echo $food_name;?> > Thêm thư viện ảnh</h3>
        </div>
        <div class="box-step column-4">
            <ul>
                <li class="">
                    <span class="number num1">01</span>
                    <a href="<?php echo ROOTHOST.'member/thuc-don/cap-nhat/'.$position_id.'/'.$positioncontact_id.'/'.$food_id;?>" class="name">Thông tin thực đơn</a>
                </li>
                <li class="active">
                    <span class="number num2">02</span>
                    <a href="<?php echo ROOTHOST.'member/thuc-don/'.$food_code.'/cap-nhat-thu-vien-anh/'.$position_id.'/'.$positioncontact_id.'/'.$food_id;?>" class="name">Thư viện ảnh</a>
                </li>
                <li class="">
                    <span class="number num3">03</span>
                    <a href="<?php echo ROOTHOST.'member/thuc-don/'.$food_code.'/cap-nhat-thu-vien-video/'.$position_id.'/'.$positioncontact_id.'/'.$food_id;?>" class="name">Thư viện video</a>
                </li>
                <li>
                    <span class="number num4">04</span>
                    <a href="<?php echo ROOTHOST.'member/thuc-don/'.$food_code.'/cap-nhat-bai-viet-lien-quan/'.$position_id.'/'.$positioncontact_id.'/'.$food_id;?>" class="name">Tin liên quan</a>
                </li>
            </ul>
        </div>
        <div class="box-form">
            <form id="frm-upload-img" class="box-sub" enctype="multipart/form-data">
                <input name="food_id" type="hidden" id="position_id" value="<?php echo $food_id;?>"/>
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
                <a href="<?php echo ROOTHOST."member/thuc-don/".$food_code."/cap-nhat-thu-vien-video/".$position_id."/".$positioncontact_id."/".$food_id;?>" class="save-continues btn-default btn-primary">Lưu và tiếp tục</a>
            </div>
            <div id="respon-img">
                <?php $objGa->getListGallery("WHERE `par_id`=".$food_id." AND `type`='3' AND `arr_path` IS NOT NULL", PATH_GALLERY); ?>
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