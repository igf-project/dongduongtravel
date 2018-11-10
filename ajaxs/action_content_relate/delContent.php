<?php
include_once('../../includes/gfinnit.php');
include_once('../../includes/gfconfig.php');
include_once('../../libs/cls.mysql.php');
include_once('../../includes/function.php');
include_once('../../libs/cls.positioncontentrelate.php');
include_once('../../libs/cls.content.php');
$obj=new CLS_MYSQL();
$objCon=new CLS_CONTENTS();
$objPoConRe=new CLS_POSITIONCONTENTRELATE();
$id=isset($_POST['txt_id'])? $_POST['txt_id']: '';
$positionId=isset($_POST['txt_position_id'])? $_POST['txt_position_id']: '';
$objPoConRe->positionContactId=$positionId;
$sql="SELECT * FROM `tbl_position_contentrelate` WHERE `positioncontact_id`=".$positionId."";
$obj->Query($sql);
$obj->Num_rows();
$row=$obj->Fetch_Assoc();
$arrId=explode(", ", $row['arr_path']);
if(($key = array_search($id, $arrId)) !== false) {
    unset($arrId[$key]);
}
$arrIdUpdate=implode(', ', $arrId);
if(count($arrId) > 0){
    /*update lại sau khi xóa phần tử trong mảng*/
    $objPoConRe->arrPath="'".$arrIdUpdate."'";
    $objPoConRe->Update();
}
else{   // xóa cả toàn bộ ảnh của position
    $objPoConRe->Delete($positionId);
}
?>
<input name="txt_arr_added" id="txt_arr_added" type="hidden" value="<?php echo $arrIdUpdate;?>">
<?php
unset($obj);
unset($objPoConRe);
unset($objCon);
?>

