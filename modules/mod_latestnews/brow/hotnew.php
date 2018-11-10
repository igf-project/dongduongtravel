<?php
if(!isset($objcon)) $objcon = new CLS_CONTENTS();
if(!isset($objcat)) $objcat = new CLS_CATE();

$catid = $r['cat_id']."','".$objcat->getCatIDChild('',$r['cat_id']);
$objcon->getList(" AND cat_id IN ('$catid') ",' ORDER BY con_id ASC ',' LIMIT 0,3');

while($item_r = $objcon->Fetch_Assoc()){	?>
<div class="room">
    <a href="#">
    <?php if($item_r['thumb_img']!='') { ?>
    <img src="<?php echo $item_r['thumb_img'];?>" title='<?php echo $item_r['title'];?>' class="thumb" width="203" height="127"/> 
    <?php }?>
    <h3><?php echo $item_r['title'];?></h3></a>
    <?php echo $item_r['intro'];?>
    <div class="read-more"><a href="http://hoangtucoc.com/rts/<?php echo $item_r['code'].".html"?>">Xem thêm</a></div>
</div>
<?php } // endwhile
unset($objcon); unset($objcat);
?>


