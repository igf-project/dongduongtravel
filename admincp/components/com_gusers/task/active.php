<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
$id="";
if(isset($_GET["id"]))
	$id=(int)$_GET["id"];
if(!isset($obj))
	$obj=new CLS_GUSER();
$obj->setActive($id);
echo "<script language=\"javascript\">window.location='index.php?com=".COMS."'</script>";
?>