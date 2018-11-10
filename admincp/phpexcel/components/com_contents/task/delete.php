<?php
	defined('ISHOME') or die('Can not acess this page, please come back!');
	$id='';
    $arr=array(1,2);
	if(isset($_GET['id']))
		$id=$_GET['id'];
    if(in_array($id, $arr))
        echo "<script language=\"javascript\">alert('Bài viết trong mục giới thiệu không được xóa!')</script>";
    else
	    $obj->Delete($id);
	echo "<script language=\"javascript\">window.location='index.php?com=".COMS."'</script>";
?>