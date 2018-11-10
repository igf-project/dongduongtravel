<?php
if(isset($_POST['txt_search'])) $txt_search = $_POST['txt_search'];
	// code phân trang
if(!isset($_SESSION["CUR_PAGE_MNU"]))
	$_SESSION["CUR_PAGE_MNU"]=1;
if(isset($_POST["cur_page"])){
	$_SESSION["CUR_PAGE_MNU"]=(int)$_POST["cur_page"];
}
$cur_page=$_SESSION["CUR_PAGE_MNU"];
if(isset($_POST["txtCurnpage"]))
	$cur_page=$_POST["txtCurnpage"];
	// code phân trang
if(!isset($_SESSION['TXTSEARCH'])) $_SESSION['TXTSEARCH']="";
if(isset($_POST["txtsearch"])) {
	$title= addslashes(trim($_POST["txtsearch"])); 
	$_SESSION['TXTSEARCH'] = $title;
}
else { $title = $_SESSION['TXTSEARCH'];}
$total_rows_tour=0;
		// $total_rows_position=0;
		// $total_rows_food=0;
		// $total_rows_news=0;
$ketqua_tour=false;
$ketqua_positon=false;
$ketqua_food=false;
$ketqua_news=false;
?>
<div class="infomation_search">
	
	<?php
	$obj_tour->getList(" WHERE `name` LIKE '%".$title."%' ");
	$total_rows_tour = $obj_tour->Num_rows();
	if($total_rows_tour>0):
		?>
	<div class="container">
		<div class="content_search">
			<div class="tour_search box-tour">
				<h2 class="title"><span>Danh Sách Tour</span></h2>
				<div class="content row">
					<div class="box">
						<?php
						$start_tour = 0;
						if($cur_page>1) $start_tour = ($cur_page-1)*8;
						if($Num_rows_tour = $obj_tour->Num_rows() >0){
							$ketqua_tour = true;
							$strwhere =" AND `name` LIKE '%".$title."%'";
							$obj_tour->getListItem($strwhere," LIMIT ".$start_tour.","."8");							
						}
						if($ketqua_tour == false){
							echo "<div style='text-align:center'>Không tìm thấy nội dung phù hợp với từ khóa <strong style='color:red'>".$title."</strong></div>";
						}
						?>
					</div>
				</div>
			</div>
		</div>
		<div id="paging_index" class="clearfix">
			<?php 
			paging_index($total_rows_tour,8,$cur_page);
			endif;
			?>

			<div class="position_search box-tour">
				<h2 class="title"><span>Danh Sách Địa Điểm</span></h2>
				<div class="content row">
					<div class="box"></div>
				</div>			
			</div>
			<div class="food_search box-tour">
				<h2 class="title"><span>Ẩm Thực</span></h2>
				<div class="content row">
					<div class="box">
						<?php
						$obj_foodmn->getList(" WHERE `name` LIKE '%".$title."%' ");
						$total_rows_food = $obj_foodmn->Num_rows();
						$start_food = 0;
						if($cur_page>1) $start_food = ($cur_page-1)*8;
						if($Num_rows_food = $obj_foodmn->Num_rows() >0){
							$ketqua_food = true;
							$strwhere =" AND `tbl_foodmenu`.`name` LIKE '%".$title."%'";
							$obj_foodmn->getListItem($strwhere," LIMIT ".$start_food.","."8");							
						}
						if($ketqua_food == false){											
							echo "<div style='text-align:center'>Không tìm thấy nội dung phù hợp với từ khóa <strong style='color:red'>".$title."</strong></div>";
						}							
						?>
					</div>					
				</div>
				<!-- <div id="paging_index" class="clearfix">
				<?php 
					paging_index($total_rows_food,8,$cur_page);
				?>
			</div> -->
		</div>
		<div class="news_search box-tour news-style">
			<h2 class="title"><span>Tin Tức</span></h2>	
			<div class="content row">
				<div class="box">
					<?php
					$obj_news->getList(" WHERE `title` LIKE '%".$title."%' ");
					$total_rows_news = $obj_news->Num_rows();
					$start_news = 0;
					if($cur_page>1) $start_news =($cur_page-1)*8;							
					if($Num_rows_news = $obj_news->Num_rows() >0){
						$ketqua_news =true;
						$strwhere = " AND `title` LIKE '%".$title."%'";
						$obj_news->getListItem($strwhere," LIMIT ".$start_news.",8","","");
					}
					if($ketqua_news==false){
						echo "<div style='text-align:center'>Không tìm thấy nội dung phù hợp với từ khóa <strong style='color:red'>".$title."</strong></div>";
					}
					?>
				</div>
			</div>	
		</div>				
	</div>
</div>
</div>