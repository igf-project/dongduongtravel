<?php
	defined('ISHOME') or die('Can not acess this page, please come back!');
	$id='';
if(isset($_GET['positioncontact_id']) AND isset($_GET['food_id'])){
    $positioncontact_id=(int)$_GET['positioncontact_id'];
    $position_id=(int)$_GET['position_id'];
    $id=(int)$_GET['food_id'];
    $obj->setActive($id);
    echo "<script language=\"javascript\">window.location='".ROOTHOST."member/thuc-don/danh-sach/".$position_id."/".$positioncontact_id."'</script>";
}
?>