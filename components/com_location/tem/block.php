<?php
$location_code=isset($_GET['location_code']) ? addslashes($_GET['location_code']):'';
$category_code=isset($_GET['category_code']) ? addslashes($_GET['category_code']):'';


/*lay ra id,name location tu code*/
$arr=$obj->getIdAndNameByCode($location_code);
$location_id=$arr['id'];
$location_name=$arr['name'];
/*lay ra id,name location tu code*/
foreach ($AR_CATE_CONTENT as $key => $val) {
	if($val['code']==$category_code)
		$arr2 = $val;
}
$category_id=$arr2['id'];
$category_name=$arr2['name'];
?>

<div class="page-content">
	<div class="box-item news-style">
		<div class="container">
			<div class="box-path">
				<ul class="list-inline">
					<li class="home"><a href="<?php echo ROOTHOST.'trang-chu/'?>">Trang chủ</a></li>
					> <li><a href="<?php echo ROOTHOST.$location_code;?>"><?php echo $location_name;?></a></li>
					> <li><a href="#" class="active"><?php echo $category_name;?></a></li>
				</ul>
			</div>
			<?php
			$limit='';
			$strWhere="WHERE `tbl_contents`.`location_id`='".$location_id."' AND `tbl_contents`.`cate_id`='".$category_id."'";
			
			$total_rows = $objCon->getCount($strWhere);
			$cur_page=isset($_GET['page'])?(int)$_GET['page']:1;
			$max_rows = MAX_ROWS;
			$start=($cur_page-1)*$max_rows;

			if($total_rows>0){
				echo ' <div class="row">';
				$objCon->getListItem($strWhere, $limit=" LIMIT $start,$max_rows ", $category_code);
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