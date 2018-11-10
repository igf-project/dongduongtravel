<?php 
	session_start();
	include_once('../../includes/gfconfig.php');
	include_once('../../includes/gfinnit.php');
	 include_once('../libs/cls.mysql.php');
	include_once('../libs/cls.content.php');
	if (isset($_GET['id_post'])) $id_post=$_GET['id_post'];
	// echo $id_box;
	$objpost=new CLS_CONTENTS;
	$arr=array();
	$objpost->getList(" WHERE `id`=$id_post");
	while ($row=$objpost->Fetch_Assoc()) { 
		$arr[]=array(
			'id_post'=>$row['id'],
			'title_post'=>$row['title'],
			'content_post'=>$row['fulltext']
			);
		// $id_post=$row['id'];
		// $title_post=trim($row['title']);
	 } 
	 echo json_encode($arr);
	 die();
	 ?>
