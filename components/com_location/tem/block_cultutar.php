<?php
$location_code=isset($_GET['location_code']) ? addslashes($_GET['location_code']):'';
$category_code=isset($_GET['category_code']) ? addslashes($_GET['category_code']):'';


/*lay ra id,name location tu code*/
$arr=$obj->getIdAndNameByCode($location_code);
$location_id=$arr['id'];
$location_name=$arr['name'];
?>

<div class="page-content">
	<div class="box-item news-style">
		<div class="container">
			<div class="box-path">
				<ul class="list-inline">
					<li class="home"><a href="<?php echo ROOTHOST.'trang-chu/'?>">Trang chủ</a></li>
					> <li><a href="<?php echo ROOTHOST.$location_code;?>"><?php echo $location_name;?></a></li>
					> <li><a href="#" class="active">Văn hóa</a></li>
				</ul>
			</div>
			<?php
			$strWhere="WHERE `tbl_location_content_cultural`.`location_id`='".$location_id."'";
			$sql="SELECT count(*) AS 'num' FROM tbl_location_content_cultural $strWhere AND isactive=1";
			$objdata->Query($sql);
			$row = $objdata->Fetch_Assoc();
			$total_rows = $row['num'];

			$cur_page=isset($_GET['page'])?(int)$_GET['page']:1;
			$max_rows = MAX_ROWS;
			$start=($cur_page-1)*$max_rows;

			if($total_rows>0){
				echo ' <div class="row">';
				$sql="SELECT `id`, `code`, `thumb`, `cdate`,`name`, `intro`, `author` FROM `tbl_location_content_cultural` ".$strWhere." ORDER BY `cdate` DESC LIMIT $start,$max_rows ";
				$objdata->Query($sql);
				while($rows=$objdata->Fetch_Assoc()){
					$intro=strip_tags(Substring($rows['intro'], 0, 20));
					$url=ROOTHOST.$location_code."/van-hoa/".$rows['code'].".html";
					$date = date("d-m-Y", $rows['cdate']);
					$title=Substring($rows['name'], 0, 20);
					?>
					<div class="col-md-6 col-sm-6 item">
						<div class="col-item">
							<?php echo getThumb($rows['thumb'],$title, 'thumb', '200px', '160px');?>
							<h4 class="name"><a href="<?php echo $url;?>" title="<?php echo $rows['title'];?>"><?php echo $title;?></a></h4>
							<span class="author">By: <?php echo $rows['author'];?></span>
							<p class="intro"><?php echo $intro;?></p>
							<span class="date">
								<?php echo $date;?>
							</span>
							<a class="btn-readmore" href="<?php echo $url;?>">Chi tiết</a>
						</div>
					</div>
					<?php 
				}
				echo ' </div>';
				echo '<div class="text-center">';
				paging($total_rows, $max_rows, $cur_page,'?page={page}');
				echo '</div>';
			}
			else 
				echo '<p class="notic-mes">Dữ liệu đang được cập nhật. Vui lòng quay lại sau!</p>';
			?>

		</div>
	</div>
</div>