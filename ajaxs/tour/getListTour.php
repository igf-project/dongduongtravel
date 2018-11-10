
<?php
include_once('../../includes/gfinnit.php');
include_once('../../includes/gfconfig.php');
include_once('../../includes/gffunction.php');
include_once('../../libs/cls.mysql.php');
include_once('../../libs/cls.tour.php');
$value=isset($_GET['val'])? $_GET['val']: '';
$name=isset($_GET['name'])? $_GET['name']: '';
if($value=='0')
    $strWhere='';
else
    $strWhere="AND find_in_set($value, `tbl_tour`.`arr_location`) > 0";

$obj=new CLS_TOUR();
$obj->getListItem($strWhere);
?>
<h3 class="title title-solut">Tour khám phá <span class="color-1"><?php echo $name;?></span></h3>
