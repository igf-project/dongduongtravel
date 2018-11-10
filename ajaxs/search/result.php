<?php
include_once('../../includes/gfinnit.php');
include_once('../../includes/gffunction.php');
include_once('../../includes/gfconfig.php');
include_once('../../libs/cls.mysql.php');
include_once('../../libs/cls.tour.php');
include_once('../../libs/cls.position.php');
$objTour=new CLS_TOUR();
$objPo=new CLS_POSITION();
$keyword=isset($_GET['txt'])? $_GET['txt']:'';
if($keyword=='') DIE('NOT ACCESS');
$strWhere1="AND `tbl_tour`.`name` like '%$keyword%'";
$strWhere2=" AND `tbl_position`.`name` like '%$keyword%' OR `tbl_position_contact`.`address` like '%$keyword%'";
$objTour->getListAllActive($strWhere1);
$objPo->getListJoin($strWhere2);
$countTour=$objTour->Num_rows();
$countPo=$objPo->Num_rows();
    if($countPo == 0 AND $countTour==0){
        echo '<span class="notic">Không có kết quả với từ khóa: <span class="text-bold">'.$keyword.'</span>';
    }
    if($countTour >=1){
    ?>
    <div class="box-item">
        <h3 class="title">Tour</h3>
        <?php
        while($rows=$objTour->Fetch_Assoc()):
            $alt_thumb=$rows['name'];
            $thumb=getThumbAjax($rows['thumb'],$alt_thumb, 'img-responsive', 320, 240);
            $intro=strip_tags(Substring($rows['intro'], 0, 15));
            $url=ROOTHOST."tour/chi-tiet/".$rows['code'].".html";
            $date = date("d-m-Y", strtotime($rows['cdate']));
            ?>
            <a class="item" href="<?php echo $url;?>" title="<?php echo $rows['name'];?>">
                <?php echo $thumb;?>
                <div class="tour-content">
                    <h3><?php echo $rows['name'];?></h3>
                    <div class="timer"><?php echo $rows['num_day'].' ngày - '.$rows['num_night'].' đêm';?></div>
                    <div class="price">Giá: <span class="color-1"><?php echo getFomatPrice($rows['price']);?></span> </div>
                    <div class="clearfix"></div>
                </div>
            </a>
        <?php endwhile;?>
        <div class="clearfix"></div>
    </div>
    <?php
    }
    if($countPo >=1){
    ?>
    <div class="box-item item-position">
        <h3 class="title">Địa điểm</h3>
        <?php
        while($rows=$objPo->Fetch_Assoc()):
            $alt_thumb=$rows['name'];
            $url=ROOTHOST."tour/chi-tiet/".$rows['code'].".html";
            $thumb=getThumbAjax($rows['avatar'],$alt_thumb, 'img-responsive', 320, 240);
            ?>
            <a class="item" href="<?php echo $url;?>" title="<?php echo $rows['name'];?>">
                <?php echo $thumb;?>
                <h3 class="ellipsis"><?php echo $rows['name'];?></h3>
                <div class="address"><?php echo $rows['address'];?></div>
                <div class="clearfix"></div>
            </a>
        <?php endwhile;?>
        <div class="clearfix"></div>
    </div>
    <?php }?>



