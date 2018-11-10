<?php
include_once(LIB_PATH.'cls.location.php');
include_once(LIB_PATH.'cls.position.php');
include_once(LIB_PATH.'cls.positioncontact.php');
$objLo=new CLS_LOCATION();
$objPo=new CLS_POSITION();
$objPo_Con=new CLS_POSITIONCONTACT();


$thisurl= 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
if(isset($_GET['position_code'])){
	$position_code=addslashes($_GET['position_code']);
	$location_code=addslashes($_GET['location_code']);
}
else die("PAGE NOT FOUND");
$strWhere=" AND `tbl_position`.`code`='".$position_code."' ";

$info_Position = $objPo->getInfo($strWhere);
$ids = $info_Position['id'];
$name = $info_Position['name'];
$code = stripcslashes($info_Position['code']);

$info_Location = $objLo->getInfo(" AND code='".$location_code."'");
$linkLocation = ROOTHOST.$info_Location['code'];



$strWhere="WHERE `tbl_foodmenu`.`location_id`='".$info_Location['id']."' AND `tbl_foodmenu`.`position_id`='".$ids."'";
$total_rows = $obj->getCout($strWhere);
if($total_rows > 0){
	$max_rows= MAX_ROWS;
	$max_page=ceil($total_rows/$max_rows);
	$cur_page=isset($_GET['page'])? $_GET['page']: '1';
	if(isset($_GET['page'])){$cur_page=$_GET['page'];}
	if($cur_page>$max_page) $cur_page=$max_page;
	$start=($cur_page-1)*$max_rows;
	?>
	<div class="box-main box-scroll1">
		<div class="container">
			<div class="page-content">
				<div class="page-content">
					<div class="box-path">
						<ul class="list-inline">
							<li class="home"><a href="<?php echo ROOTHOST;?>">Trang chủ</a></li>
							> <li><a href="<?php echo $linkLocation;?>"><?php echo $info_Location['name'] ?></a></li>
							> <li><a class="active" href="#"><?php echo $name;?></a></li>
						</ul>
					</div>
					<h1 class="title24">Ẩm thực <?php echo '<span class="color">&nbsp'.$name.'</span>';?></h1>
					<div class="list-foodmenu list-item">
						<div class="row">
							<?php
							$obj->getListJoin($strWhere, " LIMIT $start,".$max_rows);
							while($row=$obj->Fetch_Assoc()){
								$position_code=$row['position_code'];
								$url=ROOTHOST.$location_code."/".$position_code."/am-thuc/".$row['code'].".html";?>
								<div class="col-md-3 col-sm-3 col-xs-6 column">
									<a href="<?php echo $url;?>" title=""><?php echo getThumb($row['thumb'],$row['name'],'img-responsive img-full');?></a>
									<div class="item">
										<h3 class="ellipsis"><a  href="<?php echo $url;?>" title="<?php echo $row['name'];?>"><?php echo $row['name'];?></a></h3>
										<h3 class="ellipsis" ><a  href="<?php echo $url;?>" title="<?php echo $row['contact_name'];?>" style="color: #21a117"><?php echo $row['contact_name'];?></a></h3>
										<div class="box-score"><span class="score">9.5</span><a href="">320 Đánh giá</a></div>
										<div class="clearfix"></div>
									</div>
								</div>
								<?php 
							}?>
							<div class="clearfix"></div>
							<div class="text-center">
								<?php 
								$par=getParameter($thisurl);
								$par['page']="{page}";
								$link_full=conver_to_par($par);
								paging1($total_rows,$max_rows,$cur_page,$link_full);
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php 
}
unset($objPoCon);
unset($objGa);
unset($objLo);
?>