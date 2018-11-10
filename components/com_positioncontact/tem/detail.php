<link href="css/style.css" rel="stylesheet" type="text/css" />
<?php
	$id="";
	if(isset($_GET["id"]))
		$id=(int)$_GET["id"];
	$strWhere="WHERE `tbl_position_contact`.`position_id`=".$id;
	$obj->getList($strWhere);
	while($row=$obj->Fetch_Assoc()):?>
		<div>Contact: <?php echo $row['contact_name']?></div>
	<?php endwhile;?>
