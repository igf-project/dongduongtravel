<div id="slide-main">
	<div id="slider-main" class="swiper-container">
		<div class="swiper-wrapper">
			<?php
			$objdata = new CLS_MYSQL();
			$sql="SELECT * FROM tbl_slider WHERE isactive=1 ORDER BY `order` ASC ";
			$objdata->Query($sql);
			while ($row=$objdata->Fetch_Assoc()) {
				echo '<div class="swiper-slide"><img src="'.ROOTHOST.$row["image"].'" title="'.$row['slogan'].'"/></div>';
			}
			?>
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