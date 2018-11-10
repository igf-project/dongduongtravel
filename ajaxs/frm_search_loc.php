<?php
session_start();
require_once('../includes/gfconfig.php');
require_once('../includes/gfinnit.php');
require_once('../libs/cls.mysql.php');
require_once('../libs/cls.location.php');
$objloc=new CLS_LOCATION;
$country=isset($_GET['country'])?$_GET['country']:0;
function getCity($loc){
	$sql="SELECT * FROM tbl_location WHERE par_id=$loc";
	$obj=new CLS_MYSQL;
	$obj->Query($sql);
	while($r=$obj->Fetch_Assoc()){
		echo "<h4>{$r['name']}</h4>";
		echo "<div class='row'>";
		getDis($r['id']);
		echo "</div>";
	}
}
function getDis($loc){
	$sql="SELECT * FROM `tbl_location` WHERE par_id=$loc";
	$obj=new CLS_MYSQL;
	$obj->Query($sql);
	while($r=$obj->Fetch_Assoc()){
		echo "<label class='col-md-6'>";
		echo "<input type='checkbox' value='{$r['id']}' name='chk' class='chk'/> {$r['name']}";
		echo "<span class='pull-right result'>".count_pos($r['id'])."</span>";
		echo "</label>";
	}
}
function count_pos($loc){
	$sql="SELECT count(*) as num FROM `tbl_position` WHERE loc_id3='$loc'";
	$obj=new CLS_MYSQL;
	$obj->Query($sql);
	$r=$obj->Fetch_Assoc();
	return $r['num'];
}
getCity($objloc->getIdByAlias($country));
?>