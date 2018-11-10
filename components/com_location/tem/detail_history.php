<?php
$content_code=''; 
$location_code=isset($_GET['location_code']) ? addslashes(strip_tags($_GET['location_code'])) : '';
if(isset($_GET['code'])){
    $content_code=addslashes($_GET['code']);
}
else die("PAGE NOT FOUND");

$sql="SELECT `id`,`code`,`name` FROM tbl_location WHERE isactive=1 AND `code`='$location_code' ";
$objdata->Query($sql);
$row_loc = $objdata->Fetch_Assoc();
?>

<div class="detail-content">
    <div class="container">
        <div class="page-content">
            <?php
            $strWhere="WHERE `code`='$content_code' AND isactive=1 AND location_id=".$row_loc['id'];
            $sql="SELECT * FROM `tbl_location_content_history` ".$strWhere;
            $objdata->Query($sql);
            $row=$objdata->Fetch_Assoc();
            $location_id=(int)$row['location_id'];
            $position_id=(int)$row['position_id'];
            $intro=strip_tags(Substring($row['intro'], 0, 100));
            $fulltext=html_entity_decode($row['fulltext']);
            ?>
            <div class="box-path">
                <ul class="list-inline">
                    <li class="home"><a href="<?php echo ROOTHOST.'trang-chu/'?>">Trang chủ</a></li>
                    > <li><a href="<?php echo ROOTHOST.$row_loc['code'];?>"><?php echo $row_loc['name'] ?></a></li>
                    > <li><a href="<?php echo ROOTHOST.$row_loc['code'];?>/lich-su">Lịch sử</a></li>
                    > <li><a class="active" href="#"><?php echo $row['name'];?></a></li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <h3 class="title">
                        <?php echo $row['name'];?>
                    </h3>
                    <p class="intro">
                        <?php echo $intro;?>
                    </p>
                    <div class="fulltext">
                        <?php echo $fulltext;?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mod-tour">
                        <div  class="mod-title" class="active">
                            <div class="sub-accord1-div1"><b>Tour du lịch trong nước</b></div>
                            <div class="selected"></div>
                        </div>
                        <ul class="list">
                            <?php
                            $strWhere='';
                            include_once(LIB_PATH.'cls.tour.php');
                            $objTour=new CLS_TOUR();
                            $objTour->getListModItem('','LIMIT 0,5');?>
                        </ul>
                    </div>

                    <img src="<?php echo ROOTHOST.TEM_PATH;?>web/images/dalat.jpg" class="img-full" alt=""/>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
unset($objPoCon);
?>