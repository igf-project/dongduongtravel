<?php
session_start();
include_once('../includes/gfinnit.php');
include_once('../libs/cls.mysql.php');
include_once('../libs/cls.member.php');
$obj=new CLS_MEMBER;
$obj->Logout();
?>