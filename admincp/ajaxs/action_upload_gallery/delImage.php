<?php
include_once('../../../includes/gfinnit.php');
include_once('../../includes/gfconfig.php');
include_once('../../libs/cls.mysql.php');
include_once('../../libs/cls.gallery.php');
$obj=new CLS_MYSQL();
$objGa=new CLS_GALLERY();
$imgId=isset($_POST['imgId'])? $_POST['imgId']: '';
$ID=''; $par_id=''; $type='';

$ID = isset($_POST['ID']) ? (int)$_POST['ID']:0;


if(isset($_POST['par_id'])){
    $par_id=(int)$_POST['par_id'];
    $type='2';
}
if(isset($_POST['food_id'])){
    $par_id=(int)$_POST['food_id'];
    $type='3';
}
if(isset($_POST['position_id'])){
    $par_id=(int)$_POST['position_id'];
    $type='1';
}



$objGa->ID = $ID;


$sql="SELECT * FROM `tbl_gallery` WHERE id = $ID ";
$obj->Query($sql);
$obj->Num_rows();
$row=$obj->Fetch_Assoc();


$arrImg = explode(", ", $row['arr_path']);
$par_id = $row['par_id'];
$type = $row['type'];

if(($key = array_search($imgId, $arrImg)) !== false) {
    unset($arrImg[$key]);
    $link="'".ROOTHOST.PATH_GALLERY.$imgId."'";
    if(is_file($link)){
        echo $link;
        unlink($link);
    }
}


if(count($arrImg) > 0){
    $arrImgUpdate=implode(', ', $arrImg);
    /*update lại sau khi xóa phần tử trong mảng*/
    $objGa->arrPath="'".$arrImgUpdate."'";
    $objGa->Update();
}
else{   
    // xóa cả toàn bộ ảnh của position or tour
    $strwhere=" AND par_id = $par_id";
    $objGa->Delete($ID,$strwhere);
}
$objGa->getListGallery("WHERE `par_id`=$par_id AND `type`=$type", PATH_GALLERY);
unset($obj);
unset($objGa);
?>

