<?php
	defined('ISHOME') or die('Can not acess this page, please come back!');
	$id='';
	if(isset($_GET['id']))
		$id=(int)$_GET['id'];
    include_once(LIB_PATH."cls.product.php");
    $objPro=new CLS_PRODUCT();
    $count=$objPro->countProByParID("Where `cata_id`='$id'");
    if($count==0)
        $obj->Delete($id);
    else echo "<script language=\"javascript\">alert('Xóa hết sản phẩm thuộc nhóm mới được xóa nhóm')</script>";
	echo "<script language=\"javascript\">window.location='index.php?com=".COMS."'</script>";
?>