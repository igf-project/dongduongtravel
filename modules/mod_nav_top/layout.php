<div class="nav-top">
<div class="container"><div class="row">
	<div class="pull-right">
		<ul class="navi-left pull-left">
			<li class="current"><a href="<?php echo ROOTHOST;?>">Trang Chủ</a></li>
			<li><a href="<?php echo ROOTHOST."tour";?>">Tour</a></li>
			<li><a href="<?php echo ROOTHOST."qua-tang";?>">Quà tặng</a></li>
		</ul>
		<form action ="" method="POST" class="frm-select pull-right">
			<i class="fa fa-map-marker"></i>
			<select name="cbocountry" id="frm-location">
			<?php
			$url_city_cache='cache/city.html';
			if(is_file($url_city_cache)) include($url_city_cache);
			else{
				$json_city_data='json/city.json';
				$json_city=is_file($json_city_data)?json_decode(file_get_contents($json_city_data),true):array();
				$str='';
				foreach($json_city as $key=>$val){
					$str.="<option value='$key'>{$val['name']}</option>";
				}
				echo $str;
				file_put_contents($url_city_cache,$str);
			}
			?>
			</select>
		</form>
	</div>
</div></div>
</div>