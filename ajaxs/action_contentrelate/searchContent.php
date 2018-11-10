<?php
include_once('../../includes/gfinnit.php');
include_once('../../includes/function.php');
include_once('../../includes/gfconfig.php');
include_once('../../libs/cls.mysql.php');
include_once('../../libs/cls.content.php');
include_once('../../libs/cls.foodcontentrelate.php');
$obj=new CLS_MYSQL();
$objCon=new CLS_CONTENTS();
$objConRe=new CLS_FOODCONTENTRELATE();
$keyword=isset($_POST['txt_keyword'])? $_POST['txt_keyword']: '';
$par_id=isset($_POST['txt_parid'])? $_POST['txt_parid']: '';
$arrConId=$objConRe->getArrIdByparId("WHERE `par_id`= $par_id");
if($arrConId==''){
    $strWhere="`tbl_content_text`.`title` like '%$keyword%'";
}
else{
    $strWhere="`tbl_content_text`.`con_id` NOT IN ($arrConId) AND `tbl_content_text`.`title` like '%$keyword%'";
}
$objCon->getList('WHERE '.$strWhere);
if($objCon->Num_rows() > 0):
?>
<form id="frm-relate" method="post" action="<?php echo ROOTHOST;?>ajaxs/action_contentrelate/addContent.php" style="height: 320px; overflow: auto">
    <input id="txt_parid" name ='txt_parid' value="<?php echo $par_id;?>" type="hidden">
    <table class="table" style="width: 100%">
        <tr>
            <th>STT</th>
            <th>#</th>
            <th>Tiêu đề</th>
            <th>Tác giả</th>
        </tr>
        <?php $objCon->listTableContentRelate($strWhere,$del=false); ?>
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