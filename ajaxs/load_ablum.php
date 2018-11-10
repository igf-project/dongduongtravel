<?php 
if($_POST['dir']){
	include_once("../includes/gfconfig.php");
	include_once("../includes/gffunction.php");
	$dir_img = "../images/position/".$_POST['pos_id'].'/ablum/'.$_POST['dir'];
	$arr_file = read_all_files($dir_img);

	echo '<ul>';
	// Hien thi danh sach anh
	for($i=0;$i<count($arr_file);$i++) {
		$file_path = ROOTHOST.str_replace("../","",$arr_file[$i]);
		$img = '<img src="'.$file_path.'" class="img-responsive"/>';
		echo '<li><div class="inner"><a class="ablum_fancybox" rel="group" href="'.$file_path.'">'.$img.'</a><span></div></li>';
	}
	echo '</ul>';
}
?>