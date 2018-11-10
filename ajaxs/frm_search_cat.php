<?php
session_start();
require_once('../includes/gfconfig.php');
require_once('../includes/gfinnit.php');
require_once('../libs/cls.mysql.php');
$sql="SELECT * FROM tbl_service WHERE isactive=1";
$obj=new CLS_MYSQL;
$obj->Query($sql);
echo "<h4>Loại dịch vụ</h4>";
echo "<div class='row'>";
while($r=$obj->Fetch_Assoc()){
	echo "<label class='col-md-6'>";
	echo "<input type='checkbox' value='{$r['cat_id']}' name='chk' class='chk'/> {$r['name']}";
	echo "<span class='pull-right result'>".count_pos($r['cat_id'])."</span>";
	echo "</label>";
}
echo "</div>";
function count_pos($cat){
	$sql="SELECT count(*) as num FROM `tbl_position` WHERE cat_id='$cat'";
	$obj=new CLS_MYSQL;
	$obj->Query($sql);
	$r=$obj->Fetch_Assoc();
	return $r['num'];
}
?>