<?php
include_once('../../includes/gfinnit.php');
include_once('../../includes/gfconfig.php');
include_once('../../libs/cls.mysql.php');
include_once('../../libs/cls.positionvideo.php');
$objdata=new CLS_MYSQL();
$objPoVi=new CLS_POSITIONVIDEO();
$videoId=isset($_POST['videoId'])? $_POST['videoId']: '';
$positionId=isset($_POST['position_id'])? $_POST['position_id']: '';
?>
<?php
$sql="SELECT * FROM `tbl_position_video` WHERE `position_id`=".$positionId;
$objdata->Query($sql);
$objdata->Num_rows();
$row=$objdata->Fetch_Assoc();
$arrVideo=explode(", ", $row['arr_videoid']);
if(($key = array_search($videoId, $arrVideo)) !== false) {
    unset($arrVideo[$key]);
}
if(count($arrVideo) > 0){
    $arrVideoUpdate=implode(', ', $arrVideo);
    /*update lại sau khi xóa phần tử trong mảng*/
    $arrVideoId="'".$arrVideoUpdate."'";
    $sql = "UPDATE tbl_position_video SET `arr_videoid`=".$arrVideoId." WHERE `position_id`='".$positionId."'";
    $objdata->Query($sql);
}
else{   // xóa cả toàn bộ ảnh của position
    $sql="DELETE FROM `tbl_position_video` WHERE `position_id` in ('$positionId')";
    $objdata->Query($sql);
}
$objPoVi->getListInfoVideo("WHERE `position_id`=".$positionId."");
unset($objdata);
unset($objPoVi);
?>
