<ul id='home'>
	<li id='itemhome' <?php if($this->isFrontpage()){ echo "class='active'";}?>> <a href='<?php echo ROOTHOST;?>' title='<?php echo ROOTHOST;?>'></a></li>
</ul>
<?php
include_once(libs_path.'cls.catalogs.php');
include_once(libs_path.'cls.products.php');
$objcat=new CLS_CATALOGS;
$objcat->getAllListCategory();
unset($objcat);
?>