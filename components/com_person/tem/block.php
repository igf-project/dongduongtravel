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
    include_once(LIB_PATH."cls.location.php");
    $objLo=new CLS_LOCATION();
    $arr=$objLo->getIdAndNameByCode($location_code);
    $location_id=$arr['id'];
    $name=$arr['name'];
    $strWhere="AND find_in_set($location_id, `tbl_tour`.`arr_location`) > 0";
    $url_form=ROOTHOST."tour/".$location_code."/danh-sach";
}

/*Block theo kiểu tour*/
if(isset($_GET['tourtype_code'])){
    $tourtype_code=isset($_GET['tourtype_code']) ? addslashes($_GET['tourtype_code']) : '';
    include_once(LIB_PATH."cls.tourtype.php");
    $objLo=new CLS_TOURTYPE();
    $arr=$objLo->getIdAndNameByCode($tourtype_code);
    $tourtype_id=$arr['id'];
    $name=$arr['name'];
    $strWhere="AND `tbl_tour`.`tour_type_id`=$tourtype_id";
    $url_form=ROOTHOST."tour/nhom-tour/".$tourtype_code;
}

if(!isset($_SESSION['PAGE_PRICE'])) $_SESSION['PAGE_PRICE']='';
if(isset($_POST['finder'])){
    $_SESSION['PAGE_PRICE']=(int)$_POST['cbo_price'];
    $price_rank = $_SESSION['PAGE_PRICE'];
    //echo $price_rank;
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
<div class="container box-list-tour block-tour">
    <div class="page-content">
        <div class="box-title">
            <h3 class="title">Tour du lịch <span class="color-1"><?php echo $name;?></span></h3>
            <div class="box-find pull-right">
                <form class="form-inline" action="<?php echo $url_form;?>" method="post">
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
                if($total_rows<MAX_ROWS){
                    $start=($cur_page-1)*MAX_ROWS;
                }
                else{
                    $start=($cur_page-1)*MAX_ROWS + 1;
                }
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