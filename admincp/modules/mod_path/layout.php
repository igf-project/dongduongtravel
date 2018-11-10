<?php
defined('ISHOME') or die('Can not acess this page, please come back!');
$com=isset($_GET['com'])?$_GET['com']:'';
function find_comname($com){
	global $_mnu;
	$n=count($_mnu);
	for($i=0;$i<$n;$i++){
		$item=$_mnu[$i];
		if($item['com']==$com){
			return $item['name'];
		}
		if(isset($item['sub_menu']) && is_array($item['sub_menu'])){
			$m=count($item['sub_menu']);
			for($j=0;$j<$m;$j++){
				$sub_item=$item['sub_menu'][$j];
				if($sub_item['com']==$com){
					return $sub_item['name'];
				}
			}
		}
	}
}
?>
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="<?php echo ROOTHOST;?>/admincp">Home</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li><a href="#"><?php echo find_comname($com);?></a></li>
	</ul>
</div>