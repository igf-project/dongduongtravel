<?php
ob_start();
session_start();
header("Expires:".gmdate("D, d M Y H:i:s", time()+15360000)."GMT");
header("Cache-Control: max-age=315360000");
// include config
define('incl_path','includes/');
define('libs_path','libs/');

require_once(incl_path.'simple_html_dom.php');
require_once(incl_path.'gfconfig.php');
require_once(incl_path.'gfinnit.php');
require_once(incl_path.'gffunction.php');
// include libs
require_once(libs_path.'cls.mysql.php');
require_once(libs_path.'cls.template.php');
require_once(libs_path.'cls.module.php');
require_once(libs_path.'cls.menuitem.php');
include_once(libs_path.'cls.configsite.php');
include_once(LIB_PATH.'cls.category.php');
include_once(LIB_PATH.'cls.content.php');
include_once(LIB_PATH.'cls.member.php');

$tmp=new CLS_TEMPLATE();
$tmp_name='web';
$this_tem_path=TEM_PATH.$tmp_name.'/';
// Define this template path
define('THIS_TEM_PATH',$this_tem_path);
define('ISHOME',true);
$tmp->WapperTem();
?>