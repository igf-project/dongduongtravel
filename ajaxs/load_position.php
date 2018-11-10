<?php
session_start();
include_once('../includes/gfconfig.php');
include_once('../includes/gfinnit.php');
include_once('../libs/cls.mysql.php');
include_once('../libs/cls.location.php');
include_once('../libs/cls.position.php');

if(!isset($objloc)) $objloc = new CLS_LOCATION;
if(!isset($obj)) 	$obj = new CLS_POSITION;
if(!isset($objm)) 	$objm = new CLS_MYSQL;

$country=isset($_GET['country'])?addslashes($_GET['country']):'';
$city=isset($_GET['city'])?addslashes($_GET['city']):'';
$dis=isset($_GET['dis'])?addslashes($_GET['dis']):'';
$key=isset($_GET['txt_keyword'])?addslashes($_GET['txt_keyword']):'';
$view_type=isset($_GET['sort_type'])?addslashes($_GET['view_type']):'';
$sort_type=isset($_GET['sort_type'])?(int)$_GET['sort_type']:0;
$page=isset($_GET['page'])?(int)$_GET['page']:1;
$catid=isset($_GET['catid'])?addslashes($_GET['catid']).'0':'';
$disid=isset($_GET['disid'])?addslashes($_GET['disid']).'0':'';

$str_where='';
if($country!='') $str_where.=" AND loc_id1={$objloc->getIdByAlias($country)}";
if($city!='') $str_where.=" AND loc_id2={$objloc->getIdByAlias($city)}";
if($dis!='') $str_where.=" AND loc_id3={$objloc->getIdByAlias($dis)}";
if($key!='') $str_where.=" AND (tbl_position.name like '%$key%' OR tbl_food.name like '%$key%')";
if($catid!='' && $catid!='0') $str_where.=" AND cat_id in($catid)";
if($disid!='' && $disid!='0') $str_where.=" AND loc_id3 in($disid)";

$sort=" ORDER BY mdate DESC, id DESC ";
if($sort_type=='1') $sort=' ORDER BY visited DESC,id DESC ';
if($sort_type=='2') $sort=' ORDER BY mdate DESC, id DESC ';

$star=($page-1)*26;
$limit=" LIMIT $star,26 ";

$vietype='item-bloc  col-md-3';
if($view_type=='list')$vietype='item-list  col-md-12';

$sql="SELECT DISTINCT tbl_position.* FROM tbl_position LEFT JOIN tbl_food ON tbl_position.id=tbl_food.pos_id WHERE tbl_position.isactive=1 ".$str_where.$sort;
$objm->Query($sql);
$total=$objm->Num_rows();
$sql.=$limit;
$objm->Query($sql);
$html='';
while($r = $objm->Fetch_Assoc()){
	$arr_img=explode('|',$r['img']);
	$thum_img=explode(',',$arr_img[0]);
	$img=ROOTHOST.'images/no-image-news.png';
	if($thum_img[0]!='') $img=$thum_img[0];
	$link=ROOTHOST.$objloc->getAlias($r['loc_id2']).'/'.$r['alias'].'.html';
	$html.='<div class="item '.$vietype.'">';
	$html.='<div class="img">';
	$html.="<a href='$link'><img src='$img' title='{$r['name']}' alt='{$r['name']}' height='150'/></a>";
	$html.='</div>';
	$html.="<h3 class='title'><a href='$link'>{$r['name']}</a></h3>";
	$html.="<div class='address'>".$objloc->getName($r['loc_id3']).", <span class='city'>".$objloc->getName($r['loc_id2'])."</span></div>";
	//$html.="<div class='status'><span class='vote'>12</span><span class='comment'>12</span></div>";
	$html.='</div>';
} // end while
echo json_encode(array('total'=>$total,'data'=>$html));
?>