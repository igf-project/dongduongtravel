<?php
$strWhere=''; $strWherLo='';
$location_id=''; $price_rank='';
if(!isset($_SESSION['PAGE_LOCATION'])) $_SESSION['PAGE_LOCATION']='';
if(!isset($_SESSION['PAGE_PRICE'])) $_SESSION['PAGE_PRICE']='';

if(isset($_POST['finder'])){
    $_SESSION['PAGE_LOCATION']=(int)($_POST['cbo_location']);
    $_SESSION['PAGE_PRICE']=(int)$_POST['cbo_price'];
    $location_id = $_SESSION['PAGE_LOCATION'];
    $price_rank = $_SESSION['PAGE_PRICE'];
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
                <div class="col-md-7 info-tour info-location">
                    <h2>Du lịch cùng Đông Dương Travel</h2>
                    <p>Tận hưởng niềm vui, nâng tầm cuộc sống! Hãy cùng chúng tôi tới những điểm du lịch hàng đầu để tận hưởng, khám phá những điều kỳ thú nhất, sự trải nghiệm thú vị nhất</p>
                </div>
                <div class="col-md-5">
                    <div class="findter-location">
                        <ul class="list">
                            <li class="item active" value="0"><span>Tất cả</span></li>
                            <?php
                            include_once(LIB_PATH.'cls.location.php');
                            $objLo=new CLS_LOCATION();
                            $objLo->getList();
                            while($rows=$objLo->Fetch_Assoc()):?>
                                <!--<li class="item" value="<?php /*echo $rows['id'];*/?>"  title="<?php /*echo $rows['name'];*/?>"><span class="item-location"><?php /*echo $rows['name'];*/?></span></li>-->
                                <li class="item" value="<?php echo $rows['id'];?>"  title="<?php echo $rows['name'];?>"><a href="<?php echo ROOTHOST."tour/".$rows['code']."/danh-sach";?>" class="item-location"><?php echo $rows['name'];?></a></li>
                            <?php endwhile;?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="box-list-tour">
    <?php if(isset($_SESSION['PAGE_LOCATION_ACT'])){echo $_SESSION['PAGE_LOCATION_ACT'];}?>
    <?php include_once(LIB_PATH."cls.tourtype.php");
    $objTourType=new CLS_TOURTYPE();
    $objTourType->getList();
    $stt='';
    While($rw=$objTourType->Fetch_Assoc()){
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


<script>
    /*call ajax*/
    /*$('.findter-location .item').click(function(){
     *//*$('body').addClass('div-relati');*//*
     var name=$(this).attr('title');
     var val=$(this).attr('value');
     $('.findter-location .item').removeClass('active');
     $(this).addClass('active');
     $.get('<?php echo ROOTHOST;?>ajaxs/tour/getListTour.php',{val, name},function(response_data){
     $('#data-respon').html(response_data);
     *//*$('body').removeClass('div-relati');*//*
     })
     })*/
</script>