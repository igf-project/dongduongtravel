<?php
	//define('COMS', 'slider');
    include_once(LIB_PATH.'cls.location.php');
    $com=isset($_GET['com'])? $_GET['com']:'';
	$viewtype=isset($_GET['viewtype'])? $_GET['viewtype']:'';
	/* $arrObjSlider=array('position', 'positioncontact', 'location');
	if(in_array($com, $arrObjSlider)==true){ */
	if($com=='position1' AND $viewtype=='detail'){
		include_once(LIB_PATH.'cls.position.php');
		$objPo=new CLS_POSITION();
		$position_code=addslashes($_GET['position_code']);
		$imgGa=$objPo->getListGallery($position_code);
		if($imgGa!=''):
		?>
		<div id="slide-main">
			<div id="slider-main" class="swiper-container ">
				<div class="swiper-wrapper">
					<?php 
					$arr=explode(', ', $imgGa['arr_path']);
					foreach($arr as $vl):?>
					<div class="swiper-slide">
						<img src="<?php echo ROOTHOST.PATH_GALLERY.$vl;?>"/>
						
					</div>
					<?php
					endforeach;
					?>
				</div>
				
				 <div id="content-login">
						<div class="container">
							<div class="box-name col-md-8">
								<h2 class="name"><?php echo $name;?></h2>
							</div>
							<form class="book-frm col-md-4 pull-right">
								<h3>Đặt phòng khách sạn</h3>
								<div class="form-group">
									<input class="form-control"  placeholder="Thời gian đặt"/>
								</div>
								<div class="form-group">
									<input class="form-control"  placeholder="Thời gian trả"/>
								</div>
								<div class="form-group row">
									<div class="col-md-7 col-xs-7 item">
										<select class="form-control">
											<option value="">2 Người</option>
											<option value="">2 Người</option>
											<option value="">2 Người</option>
											<option value="">2 Người</option>
											<option value="">2 Người</option>
										</select>
									</div>
									<div class="col-md-5 col-xs-5 item">
										<button type="submit" class="btn btn-default btn-frm btn-login">Đặt phòng</button>
									</div>
								</div>
								<div class="checkbox">
									<label>
										<input type="checkbox"> Xác nhận
									</label>
									<a href="" class="link">Check đơn giá</a>
								</div>
								<a href="" class="btn-social btn-facebook"></a>
								<a href="" class="btn-social btn-twitter"></a>
							</form>
						</div>
					</div>
					
					
				<!-- Add Pagination -->
				<div class="swiper-pagination"></div>
				<!-- Add Arrows -->
				<div class="swiper-button-next btn-next"></div>
				<div class="swiper-button-prev btn-prev"></div>
			</div>
		</div>
		<script type="text/javascript">
			$(document).ready(function(){
				slider_main();
			});
		</script>
	<?php
		endif;
	}
	else{
		//include_once(COM_PATH.'com_slider/tem/list_main.php');
	} 
    unset($viewtype); unset($com); unset($arr);unset($obj);
?>