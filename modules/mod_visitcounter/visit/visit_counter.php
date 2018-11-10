<style>
div.visit span{
	width: 20px;
	height:26px;
	background-image:url(tem01.png);
	display:inline-block;
}
div.visit span.num0{
	background-position:0px 0px;
}
div.visit span.num1{
	background-position:-20px 0px;
}
div.visit span.num2{
	background-position:-40px 0px;
}
div.visit span.num3{
	background-position:-60px 0px;
}
div.visit span.num4{
	background-position:-80px 0px;
}
div.visit span.num5{
	background-position:-100px 0px;
}
div.visit span.num6{
	background-position:-120px 0px;
}
div.visit span.num7{
	background-position:-140px 0px;
}
div.visit span.num8{
	background-position:-160px 0px;
}
div.visit span.num9{
	background-position:-180px 0px;
}
</style>
<?php
$total='13214354';
$ar=array();
$count=0;
for($i=0;$i<strlen($total);$i++){
	$ar[$count]=$n=substr($total,$i,1);
	$count++;
}
?>
<div class='visit'>
<?php
	for($i=0;$i<count($ar);$i++){
		echo "<span class='num".$ar[$i]."'></span>";
	}
?>
</div>