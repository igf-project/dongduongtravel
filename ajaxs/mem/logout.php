<?php
session_start();
include_once('../../includes/gfinnit.php');
include_once('../../libs/cls.mysql.php');
include_once('../../libs/cls.member.php');
$objmem=new CLS_MEMBER;
$objmem->Logout();
?>