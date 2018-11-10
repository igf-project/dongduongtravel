<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
include_once(LIB_PATH.'cls.positionvideo.php');
$objPoVi=new CLS_POSITIONVIDEO();
if(isset($_GET['positioncontact_id']) and (int)$_GET['positioncontact_id']){
    $positioncontact_id=$_GET['positioncontact_id'];
    $position_code=$_GET['code'];
}
else die('PAGE NOT FOUND');

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
        <h3 class="head"><span class="color-1"><?php echo $position_name;?></span> > Cập nhật thư viện video</h3>
        <!--step form-->
        <div class="box-step column-4">
            <ul>
                <li class="">
                    <span class="number num1">01</span>
                    <a href="<?php echo ROOTHOST.'member/dia-diem/edit/'.$position_id.'';?>" class="name">Thông tin địa điểm</a>
                </li>
                <li>
                    <span class="number num3">02</span>
                    <a href="<?php echo ROOTHOST.'member/'.$position_code.'/co-so/cap-nhat-thu-vien-anh/'.$positioncontact_id.'';?>" class="name">Thư viện ảnh</a>
                </li>
                <li class="active">
                    <span class="number num4">03</span>
                    <a href="<?php echo ROOTHOST.'member/'.$position_code.'/co-so/cap-nhat-thu-vien-video/'.$positioncontact_id.'';?>" class="name">Thư viện video</a>
                </li>
                <li class="">
                    <span class="number num5">04</span>
                    <a href="<?php echo ROOTHOST.'member/'.$position_code.'/co-so/cap-nhat-bai-viet-lien-quan/'.$positioncontact_id.'';?>" class="name">Tin liên quan</a>
                </li>
            </ul>
        </div>
        <div class="box-form">
            <form id="frm_action" class="box-sub" name="frm_action" method="post" action="" enctype="multipart/form-data" >
                <input name="position_id" type="hidden" id="position_id" value="<?php echo $positioncontact_id;?>"/>
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
                <a href="<?php echo ROOTHOST;?>member/<?php echo $position_code;?>/co-so/cap-nhat-bai-viet-lien-quan/<?php echo $positioncontact_id;?>" class="save-continues btn-default btn-primary">Save And Continues</a>
            </div>
            <h3 class="title">Thư viện video của bạn</h3>
            <div id="respon-video">
                <?php  $objPoVi->getListInfoVideo("WHERE `positioncontact_id`=".$positioncontact_id.""); ?>
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
        var position_id=$('#position_id').val();
        var formatStrUrlYoutube = url.toLowerCase().indexOf("youtube");
        if (url!="" && formatStrUrlYoutube >= 0){
            var videoId = url.substring(url.indexOf("?v=") + 3);
            $.post('<?php echo ROOTHOST;?>ajaxs/action_upload_video/addVideo.php',{videoId, url, position_id},function(response_data){
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
            var position_id=$('#position_id').val();
            $.post('<?php echo ROOTHOST;?>ajaxs/action_upload_video/delVideo.php',{videoId, position_id},function(response_data){
                $('#respon-video').html(response_data);
            });
            var parent= $(this).parent();
            parent.remove();
        }
        else return false;
    });

    /*search content relate*/
    $('#search-content').click(function(){
        var txt_keyword = $('#txt_search').val();
        var position_id = $('#position_id').val();
        var txt_arr_added = $('#txt_arr_added').val();
        $.post('<?php echo ROOTHOST;?>ajaxs/action_content_relate/searchContent.php',{txt_keyword, position_id, txt_arr_added},function(response_data){
            $('#myModal').modal('show');
            $('#data-frm').html(response_data);
        });
    });
    /* add content relate*/
    $(document).on('click','#btn-add-content',function(e) {
        var form = $('#frm-relate');
        var postData = form.serializeArray();
        var url=form.attr('action');
        $.post(url, postData, function(response_data){
            $('#respon-list').append(response_data);
        });
        $('#myModal').modal('hide');
        return false;
    });
    /*del content relate*/
    $('.btn-del-relate').click(function(){
        var txt_id=$(this).attr('value');
        var txt_position_id=$(this).attr('txt_position_id');
        $.post('<?php echo ROOTHOST;?>ajaxs/action_content_relate/delContent.php', {txt_id, txt_position_id}, function(response_data){
            $('#respon-arr-added').html(response_data);
        });
        var parent= $(this).parent().parent();
        parent.remove();
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