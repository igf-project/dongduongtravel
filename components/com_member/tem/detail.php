<?php
$location_code='';
if(isset($_GET['code'])){
	$location_code=addslashes($_GET['code']);
}
else die("PAGE NOT FOUND");
$arr=$obj->getIdAndNameByCode($location_code);
$location_id=$arr['id'];
$location_name=$arr['name'];
include_once(LIB_PATH.'cls.positiongrouptype.php');
include_once(LIB_PATH.'cls.category.php');
$objCate= new CLS_CATE();
$objPoGrType=new CLS_POSITIONGROUPTYPE();
?>
<div class="box-about">
	<div class="container">
	<div class="page-content">
		<div class="row">
			<div class="col-md-8 col-sm-7">
				<div class="info-location">
				<?php
				$strWhere=" WHERE `tbl_location`.`code`='".$location_code."'";
				$obj->getList($strWhere);
				$row=$obj->Fetch_Assoc();
				//var_dump($row);
				?>
					<h2>Why do you come <?php echo $location_name;?>?</h2>
					<p class="comment more">
						<?php
							echo strlen($row['intro'])>12 ? SubString(strip_tags($row['intro']), 0, 500): '<p>Dữ liệu đang được cập nhật!</p>';
						 ?>
					 </p>

					 <script type="text/javascript">
					 		readMore('more', 200);
					 </script>

				</div>
			</div>
			<div class="col-md-4 col-sm-5">
				<div class="box-travel">
					<h3 class="col-md-6">Tìm hiểu về <a href="<?php echo ROOTHOST.$location_code."/kham-pha/gioi-thieu.html";?>" class="name-location" title="Giới thiệu về <?php echo $location_name;?>"><?php echo $location_name;?></a></h3>
					<ul class="his col-md-6 col-xs-offset-3">
					<div class="col-xs-3 visible-xs"></div>
					<?php
						$strWhere=" WHERE `tbl_category`.`isactive`='1'";
						$objCate->getList($strWhere);
						$stt='';
						while($rows=$objCate->Fetch_Assoc()): 
						$stt++;
						$url=ROOTHOST.$location_code."/kham-pha/".$rows['code'];
						?>
						
						<li><a href="<?php echo $url;?>" class="ic-<?php echo $stt;?>"><?php echo $rows['name'];?></a></li>
						<?php endwhile;?>
					</ul>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	</div>
</div>
<div class="container box-tour tour-location">
	<div class="box-title">
		<h3 class="title">Tour nổi bật</h3>
	</div>
	<div class="content row">
		<div id="slider-item1" class="swiper-container slider-item">
            <div class="swiper-wrapper">
                <?php
                include_once(LIB_PATH.'cls.tour.php');
                $objTour=new CLS_TOUR();
                //$strWhere="`tbl_tour`.`arr_location` LIKE '%,$location_id%' OR `tbl_tour`.`arr_location` LIKE '$location_id,%'";
                $strWhere="AND find_in_set($location_id, `tbl_tour`.`arr_location`) > 0";
                $objTour->getListItemSlider($strWhere, $limit='LIMIT 0, 8');
                ?>
            </div>

            <!-- Add Arrows -->
            <div class="swiper-button-next2 btn-next"></div>
            <div class="swiper-button-prev2 btn-prev"></div>

            <script>
                $(document).ready(function(){
                    slider_item(1);
                });
            </script>
        </div>
    </div>
</div>
<div class="box-discovery">
	<div class="container discovery">
		<h2 class="title text-center"><span>Khám phá <?php echo $location_name;?></span></h2>
		<div class="content row">
			<div class="box">
                <?php
                $objPoGrType->getList('', 'LIMIT 0,4');
                $index='';
                while($row=$objPoGrType->Fetch_Assoc()): $index++;?>
                    <div class="col-md-4 col-sm-6 col-xs-6 item">
                        <div id="ic-scroll<?php echo $index;?>" class="icon ic-<?php echo $index;?>">
                            <span></span>
                        </div>
                        <h3><?php echo $row['name'];?></h3>
                    </div>
                    <script>
                        scrollToBox('ic-scroll<?php echo $index;?>', 'box-scroll<?php echo $index;?>');
                    </script>
                <?php endwhile;?>
			</div>
		</div>
	</div>

</div>

<?php
include_once(LIB_PATH.'cls.position.php');
include_once(LIB_PATH.'cls.positiongallery.php');
include_once(LIB_PATH.'cls.positiontype.php');
$objPo=new CLS_POSITION();
$objGa=new CLS_POSITIONGALLERY();
$objPoType=new CLS_POSITIONTYPE();
$objPoGrType->getList();
$index='';
while($rows=$objPoGrType->Fetch_Assoc()):?>
    <?php
    $index++;
    $strWhere=" AND `tbl_position_contact`.`location_id`='".$location_id."' AND `tbl_position`.`positiongrouptype_id`=".$rows['id']."";
    $objPo->getListJoin($strWhere, $limit='Limit 0,8');
    if($objPo->Num_rows() > 0):
        $group_id=$rows['id'];
        $group_code=$rows['code'];
        ?>
        <div class="box-main <?php if ($index % 2 == 0){echo "bg-white";}?> box-scroll<?php echo $index;?>">
            <div class="container">
                <div class="page-content">
                    <div class="list-location list-item">
                        <h3 class="title"><?php echo $rows['name']." ".$location_name;?></h3>
                        <ul class="title-category list-inline pull-right">
                            <?php
                            $strWher="WHERE `group_id`=$group_id";
                            $objPoType->getList($strWher);
                             while($rw=$objPoType->Fetch_Assoc()):?>
                            <li>
                                <a href="<?php echo ROOTHOST.$location_code."/".$group_code."/".$rw['code']."/danh-sach";?>"><?php echo $rw['name'];?></a>
                            </li>
                            <?php endwhile;?>
                        </ul>
                        <div class="row">
                            <?php
                            while($row=$objPo->Fetch_Assoc()):
                                $url=ROOTHOST.$location_code."/".$row['code'].".html";
                                ?>
                                <div class="col-md-3 col-sm-3 col-xs-6 column">
                                    <a href="<?php echo $url;?>" title=""><?php echo getAvatar($row['avatar'], 'img-responsive');?></a>
                                    <div class="item">
                                        <h3 class="ellipsis"><a  href="<?php echo $url;?>" title=""><?php echo $row['name'];?></a></h3>
                                        <div class="box-score"><span class="score">9.5</span><a href="">320 Đánh giá</a></div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            <?php endwhile;?>
                        </div>
                    </div>
                    <div class="box-btn text-center">
                        <a class="readmore link detail" href="<?php echo ROOTHOST.$location_code;?>/<?php echo $group_code;?>">Xem tất cả</a>
                    </div>
                </div>

            </div>
        </div>
    <?php endif;?>
<?php endwhile;	?>

    <div class="where-go">
        <div class="container">
            <h2>Where do you go?</h2>
			<div class="row row-centered">
                <form class="col-md-5 col-sm-6 col-xs-10 col-centered form-inline">
                  <div class="form-group">
                    <input type="email" class="form-control" placeholder="Địa danh, danh lam thắng cảnh, ..">
                  </div>
                  <button type="submit" class="btn btn-default">Search</button>
                </form>
            </div>

        </div>
    </div>

 <?php
 unset($objTour);
 unset($objPoCon);
 unset($objGa);
 unset($objPoGrType);
 ?>
