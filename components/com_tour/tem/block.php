<?php
$cbo_location=''; $price_rank='';
$location_id='';
$location_code='';
$strWhere='';
$url_form='';
if(!isset($_GET['location_code']) AND !isset($_GET['tourtype_code'])) DIE('PAGE NOT FOUND');

/*Block theo location*/
if(isset($_GET['location_code'])){
    $location_code=isset($_GET['location_code']) ? addslashes($_GET['location_code']) : '';
    $arr=$objLo->getIdAndNameByCode($location_code);
    $location_id=$arr['id'];
    $name=$arr['name'];
    $strWhere="AND find_in_set($location_id, `tbl_tour`.`arr_location`) > 0";
    $url_form=ROOTHOST."tour/".$location_code."/danh-sach";
}

/*Block theo kiểu tour*/
if(isset($_GET['tourtype_code'])){
    $tourtype_code=isset($_GET['tourtype_code']) ? addslashes($_GET['tourtype_code']) : '';
    $arr=$obj_TourType->getIdAndNameByCode($tourtype_code);
    $tourtype_id=$arr['id'];
    $name=$arr['name'];
    $strWhere=" AND `tbl_tour`.`tour_type_id`=$tourtype_id";
    $url_form=ROOTHOST."tour/nhom-tour/".$tourtype_code;
}


if(isset($_GET['cbo_price'])){
    $price_rank = (int)$_GET['cbo_price'];
    if($price_rank!='0'){
        switch($price_rank){
            case "1" : $strWhere="$strWhere AND `tbl_tour_price`.`price` < '1000000'";
            break;
            case "2" : $strWhere="$strWhere AND `tbl_tour_price`.`price` BETWEEN '1000000' AND '3000000'";
            break;
            case "3" : $strWhere="$strWhere AND `tbl_tour_price`.`price` BETWEEN '3000000' AND '5000000'";
            break;
            case "4" : $strWhere="$strWhere AND `tbl_tour_price`.`price` BETWEEN '5000000' AND '7000000'";
            break;
            case "5" : $strWhere="$strWhere AND `tbl_tour_price`.`price` BETWEEN '7000000' AND '10000000'";
            break;
            case "5" : $strWhere="$strWhere AND `tbl_tour_price`.`price` BETWEEN >10000000";
            break;
            default: $strWhere='';
        }
    }
}
?>
<div class="findter-tour">
    <div class="loading-notic" id="loading-notic"></div>
    <div class="container">
        <div class="page-content">
            <div class="row" style="padding-bottom: 10px; padding-top: 10px">
                <div class="col-md-7 col-sm-7 info-tour info-location">
                    <h2>Du lịch cùng Hà Giang Travel</h2>
                    <p>Tận hưởng niềm vui, nâng tầm cuộc sống! Hãy cùng chúng tôi tới những điểm du lịch hàng đầu để tận hưởng, khám phá những điều kỳ thú nhất, sự trải nghiệm thú vị nhất</p>
                </div>
                <div class="col-md-5 col-sm-5">
                    <div class="findter-location">
                        <ul class="list">
                            <li class="item" value="0"><a href="<?php echo ROOTHOST."tour/";?>" class="item-location">Tất cả</a></li>
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
<div class="container box-list-tour block-tour">
    <div class="page-content">
        <div class="box-title">
            <h3 class="title">Tour du lịch <span class="color-1"><?php echo $name;?></span></h3>
            <div class="box-find pull-right">
                <form class="form-inline" action="<?php echo $url_form;?>" method="get">
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
                    <button type="submit" class="btn btn-default btn-border btn-finder">Tìm kiếm</button>
                </form>
            </div>
        </div>
        <div class="content row list-item" id="data-respon">

            <?php
            $limit='';
            $cur_page=isset($_GET['page'])?(int)$_GET['page']:1;
            $max_rows = MAX_ROWS;
            $start=($cur_page-1)*$max_rows;
            $total_rows = $obj->getCount($strWhere);
            $limit='LIMIT '.$start.','.$max_rows;
            if($total_rows>0){
                $obj->getListItem($strWhere, $limit);
                echo '<div class="text-center">';
                paging($total_rows, $max_rows, $cur_page,'?page={page}');
                echo '</div>';
            }else{
                echo '<div class="text-center">Dữ liệu trống.</div>';
            }
            ?>
        </div>
    </div>
</div>
