<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
include_once(LIB_PATH.'cls.gallery.php');
$objGa=new CLS_GALLERY();
if(isset($_GET['code'])){
    $tour_code=addslashes($_GET['code']);
}
else die('PAGE NOT FOUND');
include_once(LIB_PATH.'cls.tour.php');
$objTour=new CLS_TOUR();
$arr=$objTour->getIdAndNameByCode($tour_code);
$tour_id=$arr['id'];
$tour_name=$arr['name'];
?>
<div class="container">
    <div class="frm-control">
        <div class="link-header">
            <h3><span class="color-1"><?php echo $tour_code;?></span> > Thêm thư viện ảnh</h3>
        </div>
       <div class="box-step">
            <ul>
                 <li class="">
                    <span class="number num1">01</span>
                    <span class="name">Thông tin Tour</span>
                </li>
                <li class="">
                    <span class="number num2">02</span>
                    <span class="name">Các lịch trình Tour</span>
                </li>
                <li class="active">
                    <span class="number num3">03</span>
                    <span class="name">Thư viện ảnh</span>
                </li>
               
            </ul>
        </div>
        <div id="action">
            <form id="frm-upload-img" class="box-sub" enctype="multipart/form-data">
                <input name="par_id" type="hidden" id="par_id" value="<?php echo $tour_id;?>"/>
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
            <div id="respon-img">
                <?php $objGa->getListGallery("WHERE `par_id`=".$tour_id." AND `arr_path` IS NOT NULL", PATH_GALLERY); ?>
            </div>
            <!--<span act="saveTabGallery" class="saveTab btn btn-primary">Save</span>-->
            <a href="<?php echo ROOTHOST;?>member/tour/danh-sach" class="btn btn-primary">Finish</a>
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
            var par_id=$('#par_id').val();
            event.preventDefault();
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: '<?php echo ROOTHOST;?>ajaxs/action_upload_gallery/uploadImage.php',
                type: 'POST',
                data: formData, par_id,
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
            var par_id=$('#par_id').val();
            $.post('<?php echo ROOTHOST;?>ajaxs/action_upload_gallery/delImage.php',{imgId, par_id},function(response_data){
               // $('#respon-img').append(response_data);
				//alert(response_data);
            });
            var parent= $(this).parent();
            parent.remove();
        }
        else return false;
    });
    $('#file-img').val("");


</script>