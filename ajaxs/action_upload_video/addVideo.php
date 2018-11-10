<?php
include_once('../../includes/gfinnit.php');
include_once('../../includes/gfconfig.php');
include_once('../../libs/cls.mysql.php');
include_once('../../libs/cls.positionvideo.php');
$objdata=new CLS_MYSQL();
$objPoVi=new CLS_POSITIONVIDEO();
$id=isset($_POST['videoId'])? $_POST['videoId']: '';
$urlLink=isset($_POST['url'])? $_POST['url']: '';
$position_Id=isset($_POST['position_id'])? $_POST['position_id']: '';
?>
<?php
$isActive='1';
$sql="SELECT * FROM `tbl_position_video` WHERE `position_id`=".$position_Id."";
$objdata->Query($sql);
$objdata->Num_rows();
$row = $objdata->Fetch_Assoc();
/* set nếu đã có thư viện video thì update (cộng dồn lại vào array đường dẫn link ) thôi*/
if($objdata->Num_rows() > 0){
    $arrVideoId="'".$row['arr_videoid'].", ".$id."'";
    $sql="UPDATE tbl_position_video SET `arr_videoid`=".$arrVideoId." WHERE `position_id`='".$position_Id."'";
    $objdata->Query($sql);
}
else{
    $sql=" INSERT INTO `tbl_position_video`(`position_id`, `arr_videoid`, `isactive`) VALUES ('".$position_Id."', '".$id."', '1')";
    $objdata->Query($sql);
}

?>
<div class="info-item">
    <img src="<?php echo $objPoVi->youtube_image($id);?>" width="150px">
    <span><?php echo $objPoVi->getTitle($id);?></span>
    <span class="del-item" onclick="del_itemvideo(this)" value="<?php echo $id;?>"></span>
</div>
<?php
unset($obj);
unset($objPoVi);
?>