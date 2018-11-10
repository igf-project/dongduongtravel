<?php
if(!isset($objcon)) $objcon = new CLS_CONTENTS();
if(!isset($objcat)) $objcat = new CLS_CATE();

$id=0;
if(isset($_GET["id"])) 
	$id = (int)$_GET["id"];

$total_rows="0";	
$catid = $id."','".$objcat->getCatIDChild('',$id);
$objcon->getList(" AND cat_id IN ('$catid') ");
$total_rows=$objcon->Num_rows();

if(!isset($_SESSION["CUR_PAGE_MNU"]))
	$_SESSION["CUR_PAGE_MNU"]=1;
if(isset($_POST["txtCurnpage"])){	
	$_SESSION["CUR_PAGE_MNU"]=$_POST["txtCurnpage"];
}
$cur_page=$_SESSION["CUR_PAGE_MNU"];

$start_r=($cur_page-1)*MAX_ITEM;
$objcon->getList(" AND `cat_id` in ('$catid') ",' ORDER BY RAND() '," LIMIT $start_r,".MAX_ITEM);
?>
<article id='product'>
	<?php while($item_r = $objcon->Fetch_Assoc()){	?>
	<div class='item'>
		<div class='content-inner'>
			<a href='index.php?com=contents&viewtype=article&id=<?php echo $item_r['con_id'] ;?>'>
			<img src='<?php echo $item_r['thumb_img'];?>' height='135' title='<?php echo $item_r['title'];?>'/>
			</a>
			<h4 title='<?php echo $item_r['title'];?>'><strong>Mã số:<?php echo $item_r['code'];?></strong></h4>
			<div class='share'>Like(145) | Bình luận(2) | chia sẻ</div>
		</div>
	</div>
	<?php } // endwhile?>
</article>
<?php
unset($objcon); unset($objcat);
?>