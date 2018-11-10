<?php if($imgGa):
?>
	
<div id="slide-main">
	<div id="slider-main" class="swiper-container">
		<div class="swiper-wrapper">
		<?php foreach($imgGa as $vl):?>
		
			<div class="swiper-slide">
			
				<img src="<?php echo ROOTHOST.PATH_GALLERY.$vl;?>"/>
			</div>
		<?php endforeach;?>
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
<?php endif;?>