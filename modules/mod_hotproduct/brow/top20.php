<?php
if(!isset($objpro)) $objpro = new CLS_PRODUCTS();
if(!isset($objcat)) $objcat = new CLS_CATALOGS();

$catid = $r['cat_id']."','".$objcat->getCatIDChild('',$r['cat_id']);
$objpro->getList(" AND cat_id IN ('$catid') ",' ORDER BY RAND() ',' LIMIT 0,20');
?>
<article id='top-20'>
	<h2 class='title'>Top 20</h2>
	<?php while($item_r = $objpro->Fetch_Assoc()){	
		$img = explode('|',$item_r["thumb"]);
		$imgdefault=explode(',',$img[0]);
		$link_detail=ROOTHOST.un_unicode(trim($item_r['name'])).'-MSP:'.$item_r['pro_code'];
	?>
	<div class='item'>
		<div class='content-inner'>
			<a href='<?php echo $link_detail;?>'>
			<img src='<?php echo $imgdefault[0];?>' height='145' width='200' alt='<?php echo $imgdefault[1];?>' title='<?php echo $imgdefault[2];?>'/>
			</a>
			<h4 title='<?php echo $item_r['name'];?>'><strong>Mã số:<?php echo $item_r['code'];?></strong></h4>
			<div class='share'>Like(145) | Bình luận(2) | chia sẻ</div>
		</div>
	</div>
	<?php } // endwhile?>
</article>
<?php
unset($objpro); unset($objcat);
?>