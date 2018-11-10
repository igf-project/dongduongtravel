<?php 
/*include_once("../../includes/gfconfig.php");
include_once("../../includes/gffunction.php");
include_once('../../libs/cls.mysql.php');
include_once('../../libs/cls.location.php');
$obj=new CLS_LOCATION();
$obj->getCodeById();
*/
include_once("../../includes/gffunction.php");
$location_id=isset($_GET['valOption'])? $_GET['valOption']:'';
setcookie('location_id', $location_id);
if(isset($_COOKIE['location_id'])) {
	//echo $_COOKIE['location_id'];
}
?>
