<?php
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
		if(isset($_POST["txt-where-go"])) {
		   $title= addslashes(trim($_POST["txt-where-go"])); 
		   $_SESSION['TXTSEARCH'] = $title;
		}
		else { $title = $_SESSION['TXTSEARCH'];}
		$total_rows=0;
		$ket_qua =false;
?>
<div class="infomation_search">
	<div class="container">
		<div classs="content_search">
			<div class="box-tour container list-location asean">
				<h2 class="title"><span>Danh Sách Tỉnh Thành</span></h2>
				<div class="content row">
					<div class="box">
						<?php
							$obj_location->getList(" WHERE `tbl_location`.`name` LIKE '%".$title."%' ");
							$total_rows = $obj_location->Num_rows();
							$start = 0;
							if($cur_page>1) $start = ($cur_page-1)*6;
							if($Num_rows_location = $obj_location->Num_rows() >0){
								$ket_qua = true;
								$strwhere =" `tbl_location`.`name` LIKE '%".$title."%' AND ";
								$obj_location->getListItem($strwhere," LIMIT ".$start.","."6");							
							}
							if($ket_qua == false){
								echo "<div style='text-align:center'>Không tìm thấy nội dung phù hợp với từ khóa <strong style='color:red'>".$title."</strong></div>";
							}
						?>
					</div>
				</div>
				<div id="paging_index" class="clearfix">
				<?php 
					paging_index($total_rows,6,$cur_page);
				?>
				</div>				
			</div>							
		</div>
	</div>
</div>