<?php
include_once('../includes/gfinnit.php');
include_once('../includes/gfconfig.php');
include_once('../libs/cls.mysql.php');
include_once('../libs/cls.positioncontact.php');
$objPoCon=new CLS_POSITIONCONTACT();
$id=isset($_GET['txt_position_id']) ? $_GET['txt_position_id']:'';
$strwhere="";
$strwhere="WHERE `tbl_position_contact`.`position_id`=".$id."";
$objPoCon->getList($strwhere);
$objPoCon->Num_rows();
var_dump($objPoCon->Num_rows());
?>