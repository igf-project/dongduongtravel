<?php
	include_once(LIB_PATH.'cls.location.php');
	$objLo=new CLS_LOCATION();
	$location_id=$_GET['id'];
	?>
<div class="container">
	<div class="page-content">
		<div class="row">
			<div class="col-md-3">
				<div class="box-mod">
					<h3 class="title">Hà Nội</h3>
					<ul>
						<li><a href="" class="ic-1">Đi đâu</a></li>
						<li><a href="" class="ic-2">Làm gì?</a></li>
						<li><a href="" class="ic-3">Ngủ ở đâu?</a></li>
						<li><a href="" class="ic-4">Ăn & uống</a></li>
						<li><a href="" class="ic-5">Tour du lịch</a></li>
					</ul>
				</div>
				
				<div class="box-mod">
					<h3 class="title">Hà Nội</h3>
					<ul>
						<li><a href="" class="ic-1">Đi đâu</a></li>
						<li><a href="" class="ic-2">Làm gì?</a></li>
						<li><a href="" class="ic-3">Ngủ ở đâu?</a></li>
						<li><a href="" class="ic-4">Ăn & uống</a></li>
						<li><a href="" class="ic-5">Tour du lịch</a></li>
					</ul>
				</div>
						
				<div class="box-mod">
					<h3 class="title">Hà Nội</h3>
					<ul>
						<li><a href="" class="ic-1">Đi đâu</a></li>
						<li><a href="" class="ic-2">Làm gì?</a></li>
						<li><a href="" class="ic-3">Ngủ ở đâu?</a></li>
						<li><a href="" class="ic-4">Ăn & uống</a></li>
						<li><a href="" class="ic-5">Tour du lịch</a></li>
					</ul>
				</div>
			</div>
			<div class="col-md-9">
			<div class="row">
				<div class="col-md-8">
					<div class="info-location">
					<?php 
					$strWhere=" WHERE `tbl_location`.`id`=".$location_id."";
					$objLo->getList($strWhere);
					$row=$objLo->Fetch_Assoc();
					//var_dump($row);
					?>
						<p><?php echo SubString($row['intro'], 0, 100);?></p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="box-travel">
						<h3 class="title">Khám phá Hà Nội cùng Đông Dương Travel</h3>
						<ul>
							<li><a href="" class="ic-1">Tìm kiếm tour</a></li>
							<li><a href="" class="ic-2">Đặt phòng</a></li>
							<li><a href="" class="ic-4">Mẹo du lịch Hà Nội</a></li>
						</ul>
					</div>
				</div>
			</div>

		
            
			<?php
			include_once(LIB_PATH.'cls.positiontype.php');
			include_once(LIB_PATH.'cls.position.php');
			include_once(LIB_PATH.'cls.positiongallery.php');
			$objPo=new CLS_POSITION();
			$objPoType=new CLS_POSITIONTYPE();
			$objGa=new CLS_POSITIONGALLERY();
			$objPoType->getList();
				while($row=$objPoType->Fetch_Assoc()):?>
				<?php 
					$strWhere=" WHERE `tbl_position_contact`.`location_id`=".$location_id." AND `tbl_position`.`positiontype_id`=".$row['id']."";
					$objPo->getList($strWhere, $limit='Limit 0,8');
					if($objPo->Num_rows() > 0):
				?>
				<div class="list-location">
					<h3 class="title"><?php echo $row['name'];?></h3>
					 <div class="row">
						<?php
						while($row=$objPo->Fetch_Assoc()):
						$thumb=$objGa->getThumbAvatarByPositionId($row['position_id']);
						$url="index.php?com=".THIS_COM."&type=detail&id=".$row['id'];
						?>
						<div class="col-md-3 col-sm-3 col-xs-6 column">
							<a href="<?php echo $url;?>" title=""><img src="<?php echo $thumb;?>" class="img-responsive"></a>
							<div class="item">
								<h3><?php echo $row['contact_name'];?></h3>
								<div class="box-score"><span class="score">9.5</span><a href="">320 Đánh giá</a></div>
								<div class="clearfix"></div>
							</div>
						</div>
					<?php endwhile;?>
					</div>
				</div>  
				<?php endif;?>
				<?php endwhile;	?>
				       
		</div>
		
		</div>
	</div>
</div>
