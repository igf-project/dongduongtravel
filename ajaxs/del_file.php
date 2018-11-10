<?php
session_start();

if(isset($_POST['name'])) {
	$file = stripslashes($_POST['name']);
	$path = $_POST['path']; 
	$id   = (int)$_POST['id']; 
	if(is_file($path.$file) && file_exists($path.$file)) {
		// Xoa file 
		@unlink($path.$file);
		// Xoa session co ten file nay
		$new_arr=array();
		for($i=0;$i<count($_SESSION["file$id"]);$i++){
			if($file!=$_SESSION["file$id"][$i])
				$new_arr[count($new_arr)]=$_SESSION["file$id"][$i];
		}
		unset($_SESSION["file$id"]);
		$_SESSION["file$id"] = $new_arr;
		$_SESSION["file_del"] = $file;
		echo "OK";
	}
	else  echo ("not file");
}
else echo 'not value';
?>