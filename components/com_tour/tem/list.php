<?php
$strWhere=''; $strWherLo='';
$location_id=''; $price_rank='';

if(isset($_GET['cbo_location']) || isset($_GET['cbo_price'])){
    $location_id = (int)($_GET['cbo_location']);
    $price_rank = (int)$_GET['cbo_price'];
    if($location_id!='0'){
        $strWherLo="AND find_in_set($location_id, `tbl_tour`.`arr_location`) > 0";
    }
    //echo $price_rank;
    if($price_rank!='0'){
        switch($price_rank){
            case "1" : $strWhere="$strWherLo AND `tbl_tour_price`.`price` < '1000000'";
                break;
            case "2" : $strWhere="$strWherLo AND `tbl_tour_price`.`price` BETWEEN '1000000' AND '3000000'";
                break;
            case "3" : $strWhere="$strWherLo AND `tbl_tour_price`.`price` BETWEEN '3000000' AND '5000000'";
                break;
            case "4" : $strWhere="$strWherLo AND `tbl_tour_price`.`price` BETWEEN '5000000' AND '7000000'";
                break;
            case "5" : $strWhere="$strWherLo AND `tbl_tour_price`.`price` BETWEEN '7000000' AND '10000000'";
                break;
            case "5" : $strWhere="$strWherLo AND `tbl_tour_price`.`price` BETWEEN >10000000";
                break;
            default: $strWhere='';
        }
    }
    else{
        $strWhere=$strWherLo;
    }
    //echo $strWhere;
}
?>
<div class="findter-tour">
    <div class="loading-notic" id="loading-notic"></div>
    <div class="container">
        <div class="page-content">
            <div class="row">
                <div class="col-md-7 col-sm-7 info-tour info-location">
                    <h2>Du lịch cùng Hà Giang Travel</h2>
                    <p>Tận hưởng niềm vui, nâng tầm cuộc sống! Hãy cùng chúng tôi tới những điểm du lịch hàng đầu để tận hưởng, khám phá những điều kỳ thú nhất, sự trải nghiệm thú vị nhất</p>
                </div>
                <div class="col-md-5 col-sm-5">
                    <div class="findter-location">
                        <ul class="list">
                            <li class="item active" value="0"><span>Tất cả</span></li>
                            <?php
                            $objLo->getListItemWith('', $location_id);
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="box-list-tour">
    <?php 
    $obj_TourType->getList();
    $stt='';
    while($rw=$obj_TourType->Fetch_Assoc()){
        $stt++;
        $tourtype_id=$rw['id'];
        $type_code=$rw['code'];
        $strWhere="AND `tbl_tour`.`tour_type_id`=$tourtype_id";
        $obj->getListAllActive($strWhere);
        $total_rows=$obj->Num_rows();
        if($total_rows >= 1){
            ?>
            <div class="box-main <?php echo $stt%2==0? 'bg-white':'';?>">
                <div class="container list-item">
                    <div class="page-content">
                        <h3 class="title"><?php echo $rw['name'];?></h3>
                        <div class="row">
                            <?php
                            $limit='LIMIT 0,8';
                            $cur_page=isset($_POST['txtCurnpage'])? $_POST['txtCurnpage']: '1';
                            $obj->getListItem($strWhere, $limit);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="box clearfix text-center"><a href="<?php echo ROOTHOST;?>tour/nhom-tour/<?php echo $type_code;?>" class="link detail">Xem tất cả <span></span></a></div>
            </div>
        <?php }?>
    <?php }?>
</div>