<?php
include_once('../../includes/gfinnit.php');
include_once('../../includes/function.php');
include_once('../../includes/gfconfig.php');
include_once('../../libs/cls.mysql.php');
include_once('../../libs/cls.content.php');
include_once('../../libs/cls.positioncontentrelate.php');
$obj=new CLS_MYSQL();
$objCon=new CLS_CONTENTS();
$objPoConRe=new CLS_POSITIONCONTENTRELATE();

$keyword=isset($_POST['txt_keyword'])? $_POST['txt_keyword']: '';
$positionId=isset($_POST['position_id'])? $_POST['position_id']: '';
$arrConId=$objPoConRe->getArrIdByPositionContactId("WHERE `positioncontact_id`= $positionId");

if($arrConId==''){
    $strWhere="`title` like '%$keyword%'";
}
else{
    $strWhere="`con_id` NOT IN ($arrConId) AND `title` like '%$keyword%'";
}
$objCon->getList($strWhere);
if($objCon->Num_rows() > 0):
?>
<form id="frm-relate" method="post" action="<?php echo ROOTHOST;?>ajaxs/action_content_relate/addContent.php">
    <input id="positionId" name ='positionId' value="<?php echo $positionId;?>" type="hidden">
    <table class="table" style="width: 100%">
        <tr>
            <th>STT</th>
            <th>#</th>
            <th>Tiêu đề</th>
            <th>Tác giả</th>
        </tr>
        <?php $objCon->getListAddRelate($strWhere,$del=false, $positionId); ?>
    </table>
</form>
<button type="button" class="btn btn-primary" id="btn-add-content">Add Content Relate</button>
<?php
else: echo 'Không có kết quả với từ khóa: <span class="color-1">'.$keyword.'</span>';
endif;
unset($obj);
unset($objCon);
?>
<script>
    /*del image*/
    $('#respon-img .del-item').click(function(){
        var imgId=$(this).attr('value');
        var position_id=$('#position_id').val();
        $.post('ajaxs/action_upload_gallery/delImage.php',{imgId, position_id},function(response_data){
            $('#respon-img').html(response_data);
        });
        var parent= $(this).parent();
        parent.remove();
    });
</script>