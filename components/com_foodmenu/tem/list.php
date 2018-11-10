<link rel="stylesheet" href="<?php echo ROOTHOST.TEM_PATH;?>web/css/searchableOptionList.css">
<script src="<?php echo ROOTHOST.TEM_PATH;?>web/scripts/searchableOptionList.js"></script>

<?php
$strWhere=''; $arr_group=''; $positiongroup_code='';
$positiongroup_code = isset($_GET['group']) ? addslashes($_GET['group']):'';

$arr2='';$flag=false;
foreach($AR_POSITION_GROUP as $key=>$val) { 
	if($val['code']==$positiongroup_code) { 
		$arr2 = $val;
		$flag=true;
	} 
}
if($flag==true){ // Chek xem link truyền vào có trong mảng config hay không
	$positiongrouptype_id=$arr2['id'];
	$positiongrouptype_name=$arr2['name'];
	$positiongrouptype_code=$arr2['code'];
	$strWhere.=" AND `tbl_position`.`positiongrouptype_id`=$positiongrouptype_id";


	/*finter*/
	if(isset($_GET['txt_group']) || isset($_GET['arrLocation']) ){
		if(isset($_GET['txt_group'])){
			$arr_group1 = $_GET['txt_group'];
			$arr_group=implode(',',$arr_group1);
			$strWhere.=" AND `tbl_position`.`positiontype_id` IN ($arr_group)";
		}

		if(isset($_GET['arrLocation'])){
			$arr_location=implode(',',$_GET['arrLocation']);
			$strWhere.=" AND `tbl_position`.`location_id` IN ($arr_location)";
		}
	}
	?>
	<div class="container">
		<div class="page-content">
			<div class="box-path">
				<ul class="list-inline">
					<li><a href="<?php echo ROOTHOST.'trang-chu/'?>">Trang chủ</a></li>>
					<li><a href="<?php echo ROOTHOST.$positiongrouptype_code;?>"><?php echo $positiongrouptype_name;?></a></li>
				</ul>
			</div>

			<div class="box-filter">
				<form id="frm-finter" class="frm-content" action="" method="get">
					<div class="box-content">
						<div class="col-md-6 filter-item">
							<h3>Nhóm đối tượng</h3>
							<ul class="list-group filter-group">
								<li class="item active" value="0" id="item-all">
									<span>Tất cả</span>
								</li>
								<?php
								$str="WHERE `group_id`=$positiongrouptype_id";
								$objPoType->getList($str);
								while($rows=$objPoType->Fetch_Assoc()){?>
								<li class="item" title="<?php echo $rows['name'];?>">
									<label class="radio-inline">
										<input type="checkbox" class="" name="txt_group[]" value="<?php echo $rows['id'];?>"
										<?php
										if(isset($_GET['txt_group']) AND $_GET['txt_group']!=''){
											if( in_array($rows['id'],$_GET['txt_group']) ){
												echo "checked";
											}
										};?>/>
										<span><?php echo $rows['name'];?></span>
									</label>
								</li>
								<?php } ?>
							</ul>
						</div>
						<div class="col-md-6">
							<h3>Địa danh</h3>
							<select id="cbo_location" class="cbo_location" name="arrLocation[]" multiple="multiple">
								<?php
								if(isset($_GET['arrLocation']) AND $_GET['arrLocation']!='')
									echo $objLo->getListCbLocation(false, false, $_GET['arrLocation']);
								else
									echo $objLo->getListCbLocation();
								?>
							</select>
							<script>
								$('#cbo_location').searchableOptionList();
							</script>
						</div>
						<div class="clearfix"></div>
					</div>
					<button type="submit" class="btn btn-color btn-default btn-filter">Tìm kiếm</button>
				</form>
			</div>


			<div class="list-foodmenu list-item">
				<div class="row">
					<?php
					$cur_page=isset($_GET['page'])?(int)$_GET['page']:1;
					$max_rows = MAX_ROWS;
					$start=($cur_page-1)*$max_rows;

					$sql="SELECT count(*) AS 'num' FROM `tbl_foodmenu` LEFT JOIN `tbl_location` ON `tbl_foodmenu`.`location_id` =`tbl_location`.`id` LEFT JOIN `tbl_position` ON `tbl_foodmenu`.`position_id` =`tbl_position`.`id` WHERE tbl_foodmenu.`isactive`=1 $strWhere ";
					$objdata->Query($sql);
					$row_num = $objdata->Fetch_Assoc();
					$total_rows = $row_num['num'];

					if($total_rows > 0){
						$sql="SELECT `tbl_foodmenu`.`name`, `tbl_foodmenu`.`thumb`, `tbl_foodmenu`.`code`, `tbl_location`.`name` AS `location_name`, `tbl_location`.`code` AS `location_code`, `tbl_position`.`name` AS `position_name`, `tbl_position`.`code` AS `position_code` FROM `tbl_foodmenu` LEFT JOIN `tbl_location` ON `tbl_foodmenu`.`location_id` =`tbl_location`.`id` LEFT JOIN `tbl_position` ON `tbl_foodmenu`.`position_id` =`tbl_position`.`id` $strWhere ORDER BY `tbl_foodmenu`.`name` DESC LIMIT $start,$max_rows";
						$objdata->Query($sql);
						while($row=$objdata->Fetch_Assoc()){
							$location_code=$row['location_code'];
							$position_code=$row['position_code'];
							$url=ROOTHOST.$location_code."/".$position_code."/am-thuc/".$row['code'].".html";
							$url_position = ROOTHOST.$location_code."/".$position_code."/am-thuc/";
							?>
							<div class="col-md-3 col-sm-3 col-xs-6 column">
								<a href="<?php echo $url;?>" title=""><?php echo getThumb($row['thumb'],$row['name'],'img-responsive img-full');?></a>
								<div class="item">
									<h3 class="ellipsis"><a  href="<?php echo $url;?>" title="<?php echo $row['name'];?>"><?php echo $row['name'];?></a></h3>
									<h3 class="ellipsis" ><a  href="<?php echo $url_position;?>" title="<?php echo $row['position_name'];?>" style="color: #21a117"><?php echo $row['position_name'];?></a></h3>
									<div class="box-score"><span class="score">9.5</span><a href="">320 Đánh giá</a></div>
									<div class="clearfix"></div>
								</div>
							</div>
							<?php 
						}
					} ?>
				</div>
			</div>


		</div>
	</div>
	<div class="text-center">
		<?php paging($total_rows, $max_rows, $cur_page,'?page={page}'); ?>
	</div>
	<script>
		$("input[type=checkbox][checked]").each(function() {
			$(this).parent().addClass('checked');
		});

		$('.filter-group .item').click(function(){
			var checkbox = $(this).find('input');
			var isChecked = checkbox.checked;
			isChecked = (isChecked)? "checked" : "not checked";
		});

		function checkInputChecked(){
			var act=$('.filter-group .item input[type=checkbox]');
			var flag=false;
			for(i=0;i<act.length;i++){
				if(act[i].checked==true)
				{
					flag=true;
				}
				if(flag==true) $('#item-all').removeClass('active');
				else $('#item-all').addClass('active');
			}
		}
		$('.filter-group .item').click(function(){
			checkInputChecked();
		})
		$('document').ready(function(){
			checkInputChecked();

			$('#frm-finter').submit(function(){
				$(':input[value=""]').attr('disabled', true);
			})
		})

	</script>
	<?php 
} ?>