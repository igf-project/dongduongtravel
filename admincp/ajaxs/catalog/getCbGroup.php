<?php
include_once('../../includes/gfinnit.php');
include_once('../../../includes/gffunction.php');
include_once('../../includes/gfconfig.php');
include_once('../../libs/cls.mysql.php');
include_once('../../libs/cls.service.php');
$obj=new CLS_MYSQL();
$val=isset($_GET['valOption'])? addslashes($_GET['valOption']):'';
$objCb=new CLS_SERVICE();
$swhere=" AND `group_id`='$val'";
$objCb->getListCbItem('', $swhere);?>
