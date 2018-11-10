<?php
include_once('../../includes/gfinnit.php');
include_once('../../includes/function.php');
include_once('../../includes/gfconfig.php');
include_once('../../libs/cls.mysql.php');
include_once('../../libs/cls.content.php');
include_once('../../libs/cls.positioncontentrelate.php');
include_once('../../libs/cls.content.php');
$con_id=isset($_POST['chk'])? $_POST['chk']: '';
$arrConId=implode(', ', $con_id);
$obj=new CLS_MYSQL();
$objPoConRe=new CLS_POSITIONCONTENTRELATE();
$objCon=new CLS_CONTENTS();
$positionContactId=isset($_POST['positionId'])? $_POST['positionId']: '';
$objPoConRe->positionContactId=$positionContactId;
$sql="SELECT * FROM `tbl_position_contentrelate` WHERE `positioncontact_id`=".$positionContactId."";
$obj->Query($sql);
$obj->Num_rows();
$row=$obj->Fetch_Assoc();
/* set nếu đã có bài viết liên thì update (cộng dồn lại vào array đường dẫn link ) thôi*/
if($obj->Num_rows() > 0){
    $objPoConRe->arrPath="'".$row['arr_path'].", ".$arrConId."'";
    $objPoConRe->Update();
}
else{
    $objPoConRe->arrPath=$arrConId;
    $objPoConRe->Add_new();
}

$strWhere="`con_id`IN ($arrConId)";
$objCon->getListAddRelate($strWhere, $del="true", $positionContactId);
?>
<script>
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

</script>
<?php
unset($objCon);
unset($obj);
unset($objPoConRe);
?>
