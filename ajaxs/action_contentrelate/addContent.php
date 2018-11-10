<?php
include_once('../../includes/gfinnit.php');
include_once('../../includes/function.php');
include_once('../../includes/gfconfig.php');
include_once('../../libs/cls.mysql.php');
include_once('../../libs/cls.content.php');
include_once('../../libs/cls.foodcontentrelate.php');
include_once('../../libs/cls.content.php');
$con_id=isset($_POST['chk'])? $_POST['chk']: '';
$arrConId=implode(', ', $con_id);
$obj=new CLS_MYSQL();
$objConRe=new CLS_FOODCONTENTRELATE();
$objCon=new CLS_CONTENTS();
$par_id=isset($_POST['txt_parid'])? $_POST['txt_parid']: '';
$objConRe->parId=$par_id;
$sql="SELECT * FROM `tbl_food_contentrelate` WHERE `par_id`=".$par_id."";
$obj->Query($sql);
$obj->Num_rows();
$row=$obj->Fetch_Assoc();
/* set nếu đã có bài viết liên thì update (cộng dồn lại vào array đường dẫn link ) thôi*/
if($obj->Num_rows() > 0){
    $objConRe->arrPath="'".$row['arr_path'].", ".$arrConId."'";
    $objConRe->Update();
}
else{
    $objConRe->arrPath=$arrConId;
    $objConRe->Add_new();
}

$strWhere="`con_id`IN ($arrConId)";
$objCon->listTableContentRelate($strWhere, $del="true", $par_id);
?>
<script>

    /*del content relate*/
    $('.btn-del-relate').click(function(){
        if(confirm("Bạn có muốn chắc xóa bản ghi này")){
            var txt_id=$(this).attr('value');
            var txt_parid = $('#txt_parid').val();
            $.post('<?php echo ROOTHOST;?>ajaxs/action_contentrelate/delContent.php', {txt_id, txt_parid}, function(response_data){
                $('#respon-arr-added').html(response_data);
            });
            var parent= $(this).parent().parent();
            parent.remove();
        }else return false;
    });
</script>
<?php
unset($objCon);
unset($obj);
unset($objConRe);
?>
