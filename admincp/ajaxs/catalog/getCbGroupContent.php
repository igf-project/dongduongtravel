<?php
include_once('../../includes/gfinnit.php');
include_once('../../../includes/gffunction.php');
include_once('../../includes/gfconfig.php');
include_once('../../libs/cls.mysql.php');
include_once('../../libs/cls.category.php');
$obj=new CLS_MYSQL();
$val=isset($_GET['valOption'])? addslashes($_GET['valOption']):'';
$objCb=new CLS_CATEGORY();
$swhere=" AND `group_id`='$val'";
$objCb->getListCbItem('', $swhere);?>
