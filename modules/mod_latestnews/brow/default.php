<?php
if(!isset($objcon)) $objcon = new CLS_CONTENTS();
if(!isset($objcat)) $objcat = new CLS_CATE();

$catid = $r['cat_id']."','".$objcat->getCatIDChild('',$r['cat_id']);
$objcon->getList(" AND cat_id IN ('$catid') ",' ORDER BY RAND() ',' LIMIT 0,'.MAX_ITEM);
echo '<ul>';
while($item_r = $objcon->Fetch_Assoc()) {
	$link = ROOTHOST.$item_r["code"].'.html';
	$title = stripslashes($item_r["title"]);
	echo '<li><a href="'.$link.'" title="'.$title.'">'.$title.'</a></li>';			
}
echo '</ul>';
unset($objcat);	unset($objcon);
?>