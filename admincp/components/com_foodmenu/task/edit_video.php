<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
include_once(LIB_PATH.'cls.video.php');
$objPoVi=new CLS_VIDEO();
if(isset($_GET['food_id'])){
    $position_id=(int)$_GET['position_id'];
    $positioncontact_id=(int)$_GET['positioncontact_id'];
    $food_id=(int)$_GET['food_id'];
}
else die('PAGE NOT FOUND');
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
            <h3><span class="color-1"><?php echo $position_name;?></span> > <?php echo $food_name;?> > Thêm video</h3>
        </div>
        <div class="box-step column-4">
            <ul>
                <li class="">
                    <span class="number num1">01</span>
                    <a href="<?php echo ROOTHOST.'member/thuc-don/cap-nhat/'.$position_id.'/'.$positioncontact_id.'/'.$food_id;?>" class="name">Thông tin thực đơn</a>
                </li>
                <li class="">
                    <span class="number num2">02</span>
                    <a href="<?php echo ROOTHOST.'member/thuc-don/'.$food_code.'/cap-nhat-thu-vien-anh/'.$position_id.'/'.$positioncontact_id.'/'.$food_id;?>" class="name">Thư viện ảnh</a>
                </li>
                <li class="active">
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
            <form id="frm_action" class="box-sub" name="frm_action" method="post" action="" enctype="multipart/form-data" >
                <input name="par_id" type="hidden" id="par_id" value="<?php echo $food_id;?>"/>
                <div class="row">
                    <div class='form-group col-md-6 col-upload'>
                        <h3 class="title">Upload thư viện video (youtube, ..)</h3>
                        <input name="txt_link" type="text" id="txt_link" size="45" class='form-control' value="" placeholder='' />
                    </div>
                    <div class='form-group col-md-6'>
                        <span id="add-video" class="add-video btn-video btn btn-success">Add Link video</span>
                    </div>
                </div>
            </form>
            <div class="box-btn-act top30">
                <a href="<?php echo ROOTHOST."member/thuc-don/".$food_code."/cap-nhat-bai-viet-lien-quan/".$position_id."/".$positioncontact_id."/".$food_id;?>" class="save-continues btn-default btn-primary">Lưu và tiếp tục</a>
            </div>
            <h3 class="title">Thư viện video của bạn</h3>
            <div id="respon-video">
                <?php  $objPoVi->getListInfoVideo("WHERE `par_id`=".$food_id.""); ?>
            </div>
        </div>

    </div>
</div>


<link rel="stylesheet" type="text/css" href="<?php echo ROOTHOST;?>global/plugins/bootstrap-summernote/summernote.css">
<script src="<?php echo ROOTHOST;?>global/plugins/select2/select2.min.js"></script>
<script src="<?php echo ROOTHOST;?>global/plugins/bootstrap-summernote/summernote.min.js" type="text/javascript"></script>
<script language="javascript">


    /*add video*/
    $('.add-video').click(function(){
        var url=$('#txt_link').val();
        var par_id=$('#par_id').val();
        var formatStrUrlYoutube = url.toLowerCase().indexOf("youtube");
        if (url!="" && formatStrUrlYoutube >= 0){
            var videoId = url.substring(url.indexOf("?v=") + 3);
            $.post('<?php echo ROOTHOST;?>ajaxs/action_video/addVideo.php',{videoId, url, par_id},function(response_data){
                $('#respon-video').append(response_data);
            });
            $('#txt_link').val("");
            $('#txt_link').focus();
        }
        else alert('Url link video from Youtube not avail!')
    });

    /*del video*/
    $('#respon-video .del-item').click(function(){
        if(confirm("Bạn có muốn xóa video này")){
            var videoId=$(this).attr('value');
            var id=$(this).attr('nameid');
            $.post('<?php echo ROOTHOST;?>ajaxs/action_video/delVideo.php',{videoId, id},function(response_data){
                $('#respon-video').html(response_data);
            });
            var parent= $(this).parent();
            parent.remove();
        }
        else return false;
    });


    $(document).ready(function() {
        $('.saveTab').click(function(){
            $('.nav-tabs > .active').next('li').find('a').trigger('click');
        });

        $('.btnPrevious').click(function(){
            $('.nav-tabs > .active').prev('li').find('a').trigger('click');
        });
    });
</script>