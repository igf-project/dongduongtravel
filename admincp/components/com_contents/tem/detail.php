<?php
$content_code='';
if(isset($_GET['code'])){
	$content_code=addslashes($_GET['code']);
	$location_code=addslashes($_GET['location_code']);
	include_once(LIB_PATH.'cls.location.php');
	$objLo=new CLS_LOCATION();
	$arr=$objLo->getIdAndNameByCode($location_code);
	$location_id=$arr['id'];
	$location_name=$arr['name'];
}
else die("PAGE NOT FOUND");
?>

<div class="detail-content">
	<div class="container">
		<div class="page-content">
		<?php
		//var_dump($content_code);
		$strWhere='WHERE `tbl_content`.`code`="'.$content_code.'"';
		$obj->getList($strWhere);
		$row=$obj->Fetch_Assoc();
		$intro=strip_tags(Substring($row['intro'], 0, 100));
		$fulltext=html_entity_decode($row['fulltext']);
		?>
		<div class="box-path">
			<ul class="list-inline">
				<li class="home"><a href="<?php echo ROOTHOST.'trang-chu/'?>">Trang chủ</a></li>
				 > <li><a href="<?php echo ROOTHOST."tin-tuc/";?>">Tin tức</a></li>
				> <li><a class="active" href="#"><?php echo $row['title'];?></a></li>
			</ul>
		</div>
		<div class="row">
			<div class="col-md-8">
				<h3 class="title">
				<?php echo $row['title'];?>
				</h3>
				<p class="intro">
					<?php echo $intro;?>
				</p>
				<div class="fulltext">
					<?php echo $fulltext;?>
				</div>
			</div>
			<div class="col-md-4">
				<div class="mod">
					<h3 class="title">
						Khám phá <?php echo $location_name;?>
					</h3>
					<?php 
					$strWhere="WHERE `tbl_content`.`location_id`='".$location_id."'";
					$obj->getListMod($strWhere, 'Limit 0,5');
					?>
				</div>
			</div>
	</div>
</div>
 <?php
 unset($objPoCon);
 ?>