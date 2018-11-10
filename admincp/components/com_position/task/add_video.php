<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
define('TASK_NAME', 'Thư viện video');
write_path();
$objPoVi=new CLS_POSITIONVIDEO();
if(isset($_GET['id']) and (int)$_GET['id']){
    $position_id=$_GET['id'];
}
else die('PAGE NOT FOUND');
/*lấy ra positiontype_id*/
$sql="SELECT `id`,`name` FROM tbl_position WHERE isactive=1 AND id=$position_id";
$objdata->Query($sql);
$row_Po=$objdata->Fetch_Assoc();
$position_id=$row_Po['id'];
$position_name=$row_Po['name'];

?>
<div id="action">
    <h3><span class="color-1"><font color="#00a65a"><?php echo $position_name;?></font></span> > Thêm thư viện video</h3>
    <div class="frm-control">
        <div class="box-form">
            <form id="frm_action" class="box-sub" name="frm_action" method="post" action="" enctype="multipart/form-data" >
                <input name="position_id" type="hidden" id="position_id" value="<?php echo $position_id;?>"/>
                <div class="row">
                    <div class='form-group col-md-6 col-upload'>
                        <h3 class="title">Upload thư viện video (youtube, ..)</h3>
                        <input name="txt_link" type="text" id="txt_link" size="45" class='form-control' value="" placeholder='' />
                    </div>
                    <div class='form-group col-md-6'>
                        <span id="add-video" class="add-video btn-video btn btn-success" style="margin-top: 55px;">Add Link video</span>
                    </div>
                </div>
            </form>
            <h3 class="title">Thư viện video của bạn</h3>
            <div id="respon-video">
                <?php  $objPoVi->getListInfoVideo("WHERE `position_id`=".$position_id.""); ?>
            </div>
        </div>

    </div>
</div>

<script>
    /*add video*/
    $('.add-video').click(function(){
        var url=$('#txt_link').val();
        var position_id=$('#position_id').val();
        var formatStrUrlYoutube = url.toLowerCase().indexOf("youtube");
        if (url!="" && formatStrUrlYoutube >= 0){
            var videoId = url.substring(url.indexOf("?v=") + 3);
            var url='<?php echo ROOTHOST;?>ajaxs/action_upload_video/addVideo.php';
            $.post(url,{videoId, url, position_id},function(response_data){
                $('#respon-video').append(response_data);
            });
            $('#txt_link').val("");
            $('#txt_link').focus();
        }
        else alert('Url link video from Youtube not avail!')
    });

    /*del video*/
    function del_itemvideo($this){
        if(confirm("Bạn có muốn xóa video này")){
            var videoId=$($this).attr('value');
            var position_id=$('#position_id').val();
            var url = '<?php echo ROOTHOST;?>ajaxs/action_upload_video/delVideo.php';
            $.post(url,{videoId, position_id},function(response_data){
                $('#respon-video').html(response_data);
            });
            var parent= $(this).parent();
            parent.remove();
        }
        else return false;
    }
</script>