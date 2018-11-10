  <?php
	$location_code=isset($_GET['location_code']) ? addslashes($_GET['location_code']):'';
	$category_code=isset($_GET['category_code']) ? addslashes($_GET['category_code']):'';
	if($location_code=='' AND $category_code==''){
	   DIE("PAGE NOT FOUND");
	}
	include_once(LIB_PATH.'cls.category.php');
	include_once(LIB_PATH.'cls.content.php');
	$objCat=new CLS_CATE();
	$objCon=new CLS_CONTENTS();
	/*lay ra id,name location tu code*/
	$arr=$obj->getIdAndNameByCode($location_code);
	$location_id=$arr['id'];
	$location_name=$arr['name'];
	/*lay ra id,name location tu code*/
	$arr2=$objCat->getIdAndNameByCode($category_code);
	$category_id=$arr2['cat_id'];
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
				$strWhere="WHERE `tbl_content`.`location_id`='".$location_id."' AND `tbl_content`.`cat_id`='".$category_id."'";
				$cur_page=isset($_POST['txtCurnpage'])? $_POST['txtCurnpage']: '1';
				$objCon->getList($strWhere,'');
				$total_rows=$objCon->Num_rows();
				$total_page=ceil($total_rows/MAX_ROWS);
				if($cur_page >= 1 AND $cur_page <= $total_page){
					if($total_rows<MAX_ROWS){
						$start=($cur_page-1)*MAX_ROWS;
					}
					else  $start=($cur_page-1)*MAX_ROWS + 1;

					$limit='LIMIT '.$start.','.MAX_ROWS;
				}
				if($total_rows>=1){
					echo ' <div class="row">';
					$objCon->getListItem($strWhere, $limit='', $location_code, $category_code);
					echo ' </div>';
				}
				else 
					echo '<p class="notic-mes">Dữ liệu đang được cập nhật. Vui lòng quay lại sau!</p>';
				?>
				
			</div>
           <?php
		   if($total_rows>=1):
				$max_rows=MAX_ROWS;
				paging($total_rows, $max_rows, $cur_page);
			endif;
			?>
        </div>
</div>
<?php unset($objCat);
unset($objCon);
?>