<?php
defined('ISHOME') or die('Can not acess this page, please come back!');
define('TASK_NAME', 'Lịch trình tour');
write_path();
$objdata=new CLS_MYSQL();
$keyword='';$strwhere='';$action='';
$tour_id = isset($_GET['tour'])?(int)$_GET['tour']:'';
if($tour_id=='') die('PAGE NOT FOUND !');

$sql="SELECT `num_day`,`name`,`id` FROM tbl_tour WHERE id=$tour_id";
$objdata->Query($sql);
$row=$objdata->Fetch_Assoc();
?>
<style>
    #box-schedule .item{
        position: relative;
        background: #DDD;
        padding: 10px 15px;
        height: 60px;
        line-height: 40px;
        color: #000;
        margin-bottom: 20px;
    }
    #box-schedule .item span.i-num{
        height: 40px;
        width: 40px;
        display: inline-block;
        float: left;
        line-height: 40px;
        background: #FFF;
        border-radius: 50%;
        text-align: center;
        margin-right: 15px;
        font-size: 18px;
    }
</style>
<div id="list">
    <h1 class="text-center">Lịch trình tour <font color="red"><?php echo $row['name'];?></font></h1><hr/>
    <div style="clear:both;height:10px;"></div>
    <div id="box-schedule">
        <?php
        $num_day = (int)$row['num_day'];
        for ($i=1; $i <= $num_day; $i++) { 
            $link='index.php?com=tour&task=add_schedule&tour='.$tour_id.'&date='.$i;
            echo '<div class="col-sm-4 col-xs-6 item-outline"><a href="'.$link.'"><div class="item"><span class="i-num">'.$i.'</span><div class="title">Lịch trình ngày '.$i.'</div></div></a></div>';
        }
        ?>
    </div>
</div>