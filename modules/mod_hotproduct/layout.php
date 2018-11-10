<?php include("helper.php");?>
<?php 
include_once(libs_path.'cls.products.php');
include_once(libs_path.'cls.simple_image.php');
$clsimage = new SimpleImage();
$obj=new CLS_PRODUCTS();
$objcat=new CLS_CATALOGS;
?>
<div class="module<?php echo " ".$r['class'];?>">
<?php if($r['viewtitle']==1){?>
<h3 class="title" title="<?php echo $r['title'];?>"><?php echo $r['title'];?></h3>
<?php } ?>
<section class="block top20 clearfix">
	<?php include(MOD_PATH."mod_$MOD/brow/".$theme.".php");?>
</section>
</div>
<?php unset($obj); unset($r);?>