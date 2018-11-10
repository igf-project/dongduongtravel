<?php

$strWherLo='';
$cbo_location=''; $price_rank='';
$location_id='';
$location_code='';
if(isset($_GET['location_code'])){
    $location_code=addslashes($_GET['location_code']);
    include_once(LIB_PATH."cls.location.php");
    $objLo=new CLS_LOCATION();
    $arr=$objLo->getIdAndNameByCode($location_code);
    $location_id=$arr['id'];
    $location_name=$arr['name'];
    $strWhere="AND find_in_set($location_id, `tbl_tour`.`arr_location`) > 0";
}
else DIE('PAGE NOT FOUND');

if(!isset($_SESSION['PAGE_LOCATION'])) $_SESSION['PAGE_LOCATION']='';
if(!isset($_SESSION['PAGE_PRICE'])) $_SESSION['PAGE_PRICE']='';
if(isset($_POST['finder'])){
    $_SESSION['PAGE_LOCATION']=(int)($_POST['cbo_location']);
    $_SESSION['PAGE_PRICE']=(int)$_POST['cbo_price'];
    $cbo_location= $_SESSION['PAGE_LOCATION'];
    $price_rank = $_SESSION['PAGE_PRICE'];
    if($cbo_location!='0'){
        $strWherLo="AND find_in_set($cbo_location, `tbl_tour`.`arr_location`) > 0";
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
            <div class="row" style="padding-bottom: 30px; padding-top: 30px">
                <div class="col-md-7 info-tour info-location">
                    <h2>Du lịch cùng Đông Dương Travel</h2>
                    <p>Tận hưởng niềm vui, nâng tầm cuộc sống! Hãy cùng chúng tôi tới những điểm du lịch hàng đầu để tận hưởng, khám phá những điều kỳ thú nhất, sự trải nghiệm thú vị nhất</p>
                </div>
                <div class="col-md-5">
                    <div class="findter-location">
                        <ul class="list">
                            <li class="item" value="0"><a href="<?php echo ROOTHOST."tour/";?>" class="item-location">Tất cả</a></li>
                            <?php
                            include_once(LIB_PATH.'cls.location.php');
                            $objLo=new CLS_LOCATION();
                            $objLo->getList();
                            while($rows=$objLo->Fetch_Assoc()):?>
                                <!--<li class="item" value="<?php /*echo $rows['id'];*/?>"  title="<?php /*echo $rows['name'];*/?>"><span class="item-location"><?php /*echo $rows['name'];*/?></span></li>-->
                                <li class="item <?php echo $rows['id']==$location_id ? 'active':'';?>" value="<?php echo $rows['id'];?>"  title="<?php echo $rows['name'];?>"><a href="<?php echo ROOTHOST."tour/".$rows['code']."/danh-sach";?>" class="item-location"><?php echo $rows['name'];?></a></li>
                            <?php endwhile;?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container box-list-tour">

    <?php if(isset($_SESSION['PAGE_LOCATION_ACT'])){echo $_SESSION['PAGE_LOCATION_ACT'];}?>
    <div class="page-content">
        <div class="box-title">
            <div class="box-find pull-right">
                <form class="form-inline" action="<?php echo ROOTHOST."tour";?>" method="post">
                    <div class="form-group">
                        <label>Địa danh</label>
                        <select class="form-control" id="cbo_location" name="cbo_location">
                            <option value="0">-- Tất cả --</option>
                            <?php echo $objLo->getListCbLocation($location_id);?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Đơn giá</label>
                        <select class="form-control" id="cbo_price" name="cbo_price">
                            <option value="0">-- Tất cả --</option>
                            <option class="" <?php echo $price_rank==1? 'selected':'';?> value="1">Dưới 1 triệu</option>
                            <option class="" <?php echo $price_rank==2? 'selected':'';?> value="2">Từ 1 đến 3 triệu</option>
                            <option class="" <?php echo $price_rank==3? 'selected':'';?> value="3">Từ 3 đến 5 triệu</option>
                            <option class="" <?php echo $price_rank==4? 'selected':'';?> value="4">Từ 5 đến 7 triệu</option>
                            <option class="" <?php echo $price_rank==5? 'selected':'';?> value="5">Từ 7 đến 10 triệu</option>
                            <option class="" <?php echo $price_rank==6? 'selected':'';?> value="6">Trên 10 triệu</option>
                        </select>
                    </div>
                    <input type="submit" name="finder" class="btn btn-default btn-border btn-finder" value="Finder"/>
                </form>
            </div>
        </div>
        <div class="content row list-item" id="data-respon">
            <h3 class="title title-solut">Tour khám phá <span class="color-1"><?php echo $location_name;?></span></h3>
            <?php
            $limit='';
            $cur_page=isset($_POST['txtCurnpage'])? $_POST['txtCurnpage']: '1';
            $obj->getListAllActive($strWhere);
            $total_rows=$obj->Num_rows();
            if($total_rows < 1){
                echo EMPTY_DATA;
            }
            $total_page=ceil($total_rows/MAX_ROWS);
            if($cur_page >= 1 AND $cur_page <= $total_page){
                $start=($cur_page-1)*MAX_ROWS + 1;
                $limit='LIMIT '.$start.','.MAX_ROWS;
            }
            $obj->getListItem($strWhere, $limit);
            ?>
        </div>
    </div>
</div>
<?php
$max_rows=MAX_ROWS;
paging($total_rows, $max_rows, $cur_page);
?>
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