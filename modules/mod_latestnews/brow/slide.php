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
$objcon->getList(" AND cat_id IN ('$catid') ",' ORDER BY modifydate DESC ',' LIMIT 0,5');
}else{
$objcon->getList("",' ORDER BY modifydate DESC ',' LIMIT 0,5');
}
echo "<div id='wrapper-slides'>";
echo "<div id='slide'>";
$tt=0;
while($item_r = $objcon->Fetch_Assoc()) {
	$imgs=stripslashes($item_r["thumb_img"]);
	$tt++;
	$title = Substring(stripslashes($item_r["title"]),0,10);
	$intro = Substring(stripslashes($item_r["intro"]),0,20);
	$link = ROOTHOST.stripslashes($item_r["code"]).'.html';
	echo '<a class="slideitem" href="'.$link.'" id="item'.$tt.'" title="'.$title.'" data="'.$intro.'"><img src="'.$imgs.'" alt="'.$title.'" title="'.$title.'" width="557" height="340"/></a>';
}
echo "</div>";
echo "<div class='intro'><div class='inner'>
	<h2>Title</h2><p>Introduction</p>
</div></div>";
echo "<div id='thumbs'>";
$objcon->Seek(0);
$tt=0;
while($item_r = $objcon->Fetch_Assoc()) {
	$imgs=stripslashes($item_r["thumb_img"]);
	$tt++;
	$title = Substring(stripslashes($item_r["title"]),0,10);
	$intro = Substring(stripslashes($item_r["intro"]),0,20);
	echo '<a class="thumbitem" title="'.$title.'" name="'.$tt.'" data="'.$intro.'"><img src="'.$imgs.'" alt="'.$title.'" title="'.$title.'" width="516" height="340"/><div class="overlay"></div></a>';
}
echo "</div>";
echo "</div>";
unset($objcon);
unset($objmodule);
unset($clsimage);
?>
<script type='text/javascript'>
var tt=0; var _timmer;
$('#thumbs a').click(function(){
	tt=$(this).attr('name')-1;
	clearTimeout(_timmer);
	nex_item();
})
function nex_item(){
	tt++; if(tt>5) tt=1;
	$('#thumbs a.active').removeClass('active');
	thisactive=$('#thumbs a[name="'+tt+'"]');
	$(thisactive).addClass('active');
	
	$('#slide a:visible').fadeOut('slow').appendTo('#slide');
	$('#slide a#item'+tt).fadeIn('slow');
	
	$str="<h2>"+$('#thumbs a.active').attr('title')+"</h2><p>"+$('#thumbs a.active').attr('data')+"</p>";
	$('#wrapper-slides .intro').html($str);
	
	_timmer=setTimeout(function(){nex_item();},5000);
}
nex_item();
</script>