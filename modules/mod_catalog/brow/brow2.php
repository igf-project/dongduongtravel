<?php
include_once(libs_path.'cls.catalogs.php');
include_once(libs_path.'cls.products.php');
$objcat=new CLS_CATALOGS;
if($this->isFrontpage()){
	$objcat=new CLS_CATALOGS;
	$objcat->getAllListCategory();
	unset($objcat);
}
else{
$rootCate=$objcat->FindRootId($_SESSION['CUR_CAT']);
$objcat->getAllListCategory($rootCate);
unset($objcat);}
?>