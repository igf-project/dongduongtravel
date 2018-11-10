<?php
require_once(libs_path."cls.content.php");
require_once(libs_path."cls.category.php");
if(!isset($objcon)) $objcon = new CLS_CONTENTS();
if(!isset($objcat)) $objcat = new CLS_CATE();
$catid='';
if($r['cat_id']!=''){
$catid = $r['cat_id']."','".$objcat->getCatIDChild('',$r['cat_id']);
}
if($catid!=''){
$objcon->getList(" AND cat_id IN ('$catid')  AND ishot=1",' ORDER BY modifydate DESC ',' LIMIT 0,5');
}else{
$objcon->getList(" AND ishot=1 ",' ORDER BY modifydate DESC ',' LIMIT 0,5');
}
echo "<div id='wrapper-slides'>";
echo "<div id='slide'>";
while($item_r = $objcon->Fetch_Assoc()) {
	$imgs=stripslashes($item_r["thumb_img"]);
	$title = Substring(stripslashes($item_r["title"]),0,10);
	$intro = Substring(stripslashes($item_r["intro"]),0,20);
	$link = ROOTHOST.stripslashes($item_r["code"]).'.html';
	echo '<a class="slideitem" href="'.$link.'" title="'.$title.'" data="'.$intro.'"><img src="'.$imgs.'" alt="'.$title.'" title="'.$title.'" width="516" height="340"/></a>';
}
echo "</div>";
echo "<div class='intro'><div class='inner'></div></div>";
echo "<div id='thumbs'>";
$objcon->Seek(0);
while($item_r = $objcon->Fetch_Assoc()) {
	$imgs=stripslashes($item_r["thumb_img"]);
	$title = Substring(stripslashes($item_r["title"]),0,10);
	echo '<a class="thumbitem"><img src="'.$imgs.'" alt="'.$title.'" title="'.$title.'" width="516" height="340"/><div class="overlay"></div></a>';
}
echo "</div>";
echo "</div>";
unset($objcon);
unset($objmodule);
unset($clsimage);
?>