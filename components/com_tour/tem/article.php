<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
if(isset($_GET['code'])){
    $tour_code=addslashes($_GET['code']);
}
else die('PAGE NOT FOUND');
$arr=$obj->getIdAndNameByCode($tour_code);
$tour_id=$arr['id'];
$tour_name=$arr['name'];
?>

<?php
$imgGa=$obj->getListGallerySlider($tour_code);
if($imgGa!=''):
?>
<div id="slide-main">
    <div id="slider-main" class="swiper-container ">
        <div class="swiper-wrapper">
            <?php
            $arr=explode(', ', $imgGa['arr_path']);
            foreach($arr as $vl):?>
                <div class="swiper-slide">
                    <img src="<?php echo ROOTHOST.PATH_GALLERY.$vl;?>"/>
                </div>
            <?php
            endforeach;
            ?>
        </div>

        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
        <!-- Add Arrows -->
        <div class="swiper-button-next btn-next"></div>
        <div class="swiper-button-prev btn-prev"></div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        slider_main();
    });
</script>
<?php
endif;
?>

<div class="box-article-tour bg-white">
    <div class="info-content container">
        <div class="page-content">
            <?php
            $obj->getListAll('WHERE `tbl_tour`.`id`='.$tour_id.'');
            $row=$obj->Fetch_Assoc();
            $alt_thumb=$row['name'];
            $thumb=getThumb($row['thumb'],$alt_thumb, 'img-responsive', 320, 240);
            $intro=strip_tags(Substring($row['intro'], 0, 50));
            $url=ROOTHOST."tour/";
            $date = date("d-m-Y", strtotime($row['cdate']));
            ?>
            <div class="row">
                <div class="col-md-8 info-tour article-tour">
                    <h2><i class="fa fa-map-marker"></i><span><?php echo $row['name'];?></span></h2>
                    <div class="price-tour">Giá tour: <span><?php echo getFomatPrice($row['price']);?></span></div>
                    <div class="timer">
                        Thời gian: <?php echo $row['num_day'];?> ngày <?php echo $row['num_night'];?> đêm.
                        <?php
                        $start_day=date('d/m/Y', strtotime($row['start']));
                        $day=''.$row['num_day'].' day';

                        $new_date = strtotime ( $day , strtotime ( $start_day) ) ;
                        $end_day = date ( 'd/m/Y' , $new_date );

                        echo "Từ ".$start_day." đến ".$end_day;
                        ?>
                    </div>
                    <div class="info-txt">
                        <p class="">
                            <?php echo $intro;?>
                        </p>
                    </div>
                    <?php echo $row['fulltext'];?>

                </div>
                    <div class="col-md-4 book-tour">
                        <form class="book-frm">
                            <h3>Book tour now</h3>
                            <div class="form-group">
                                <input class="form-control"  placeholder="Họ và tên"/>
                            </div>
                            <div class="form-group">
                                <input class="form-control"  placeholder="Điện thoại"/>
                            </div>
                            <div class="form-group">
                                <input class="form-control"  placeholder="Email"/>
                            </div>
                            <div class="form-group">
                                <input class="form-control"  placeholder="Địa chỉ"/>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-7 col-xs-7 item">
                                    <select class="form-control">
                                        <option value="">2 Người</option>
                                        <option value="">2 Người</option>
                                        <option value="">2 Người</option>
                                        <option value="">2 Người</option>
                                        <option value="">2 Người</option>
                                    </select>
                                </div>
                                <div class="col-md-5 col-xs-5 item">
                                    <button type="submit" class="btn btn-default btn-frm btn-login">Đặt tour</button>
                                </div>
                            </div>
                        </form>

                    </div>
            </div>
        </div>
    </div>
</div>
