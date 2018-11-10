<?php
$strWhere='';
$location_code= isset($_GET['location_code']) ? addslashes($_GET['location_code']):'';
$position_code= isset($_GET['position_code']) ? addslashes($_GET['position_code']):'';
if($location_code=='' || $position_code==''){
    die("PAGE NOT FOUND");
}

$strWhere.=" WHERE `tbl_position`.`code`='".$position_code."' AND `tbl_position`.`isactive`='1'";
$obj->getList($strWhere);
$row=$obj->Fetch_Assoc();
$position_id=$row['id'];
$name=strip_tags($row['name']);
$intro=strip_tags($row['intro']);
$fulltext=strip_tags($row['fulltext']);
include_once(LIB_PATH.'cls.location.php');
$objLo=new CLS_LOCATION();
$rs=$objLo->getIdAndNameByCode($location_code);
$location_id=$rs['id'];


$imgGa=$obj->getListGallerySlider($position_code);
if($imgGa!=''):
    ?>
<div id="slide-main">
    <div id="slider-main" class="swiper-container ">
        <div class="swiper-wrapper">
            <?php
            $arr=explode(', ', $imgGa['arr_path']);
            foreach($arr as $vl){?>
            <div class="swiper-slide">
                <img src="<?php echo ROOTHOST.PATH_GALLERY.$vl;?>"/>
            </div>
            <?php } ?>
        </div>

        <div id="content-login">
            <div class="container">
                <div class="box-name col-md-8">
                    <h2 class="name"><?php echo $name;?></h2>
                </div>
                <form class="book-frm col-md-4 pull-right">
                    <h3>Đặt phòng khách sạn</h3>
                    <div class="form-group">
                        <input class="form-control"  placeholder="Thời gian đặt"/>
                    </div>
                    <div class="form-group">
                        <input class="form-control"  placeholder="Thời gian trả"/>
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
                            <button type="submit" class="btn btn-default btn-frm btn-login">Đặt phòng</button>
                        </div>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox"> Xác nhận
                        </label>
                        <a href="" class="link">Check đơn giá</a>
                    </div>
                    <a href="" class="btn-social btn-facebook"></a>
                    <a href="" class="btn-social btn-twitter"></a>
                </form>
            </div>
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
else:
    include_once(COM_PATH.'com_slider/tem/list_main.php');
endif;
?>
<div class="info-position">
    <div class="box-item info">
        <div class="info-content container">
            <div class="row">
                <div class="col-md-8 info-hotel">
                    <h2>Wellcome to <span class="color"><?php echo $name;?></span></h2>
                    <p class="">
                        <span class="quote1"></span>
                        <?php echo $intro;?>
                        <span class="quote2"></span>
                    </p>
                    <div class="box-rank">
                        <div class="rank-star">

                        </div>
                        <ul class="info-rank list-inline">
                            <li>
                                <a href="">1.430 Đánh giá</a>
                            </li>
                            <li>
                                <a href="">Đứng thứ 4 trên 340 khách sạn tại MƯờng Thanh</a>
                            </li>
                        </ul>
                        <button class="btn btn-readmore">Đọc thêm</button>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box-contact box-toggle">
                        <h3 class="title">Liên hệ</h3>
                        <?php
                        $strWhere=" WHERE `tbl_position`.`id`='".$position_id."' AND `tbl_position`.`isactive`='1'";
                        $objPo->getList($strWhere);
                        while($rows=$objPo->Fetch_Assoc()){ ?>
                        <div class="item">
                            <span class="title drop-item"><?php echo strip_tags($rows['name']);?></span>
                            <div class="content content-toggle">
                                <ul>
                                    <li>
                                        <a href="" class="address"><?php echo strip_tags($rows['address']);?></a>
                                    </li>
                                    <li>
                                        <a href="" class="phone"><?php echo strip_tags($rows['phone']);?></a>
                                    </li>
                                    <li>
                                        <a href="" class="email"><?php echo strip_tags($rows['email']);?></a>
                                    </li>
                                    <li>
                                        <a href="" class="website"><?php echo $rows['name']!='' ? $rows['name']:'Chưa có';?></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    $strWhere="WHERE `tbl_position_services`.`position_id`=$position_id";
    $sql="SELECT `tbl_position_services`.`code` as `service_code`,
    `tbl_position_services`.`name`,
    `tbl_position_services`.`intro`,
    `tbl_position_services`.`thumb`,
    `tbl_position`.`code` as `position_code`,
    `tbl_location`.`code` as `location_code`
    FROM `tbl_position`
    INNER JOIN `tbl_position_services`
    ON `tbl_position`.`id`=`tbl_position_services`.`position_id`
    LEFT JOIN `tbl_location`
    ON `tbl_position`.`location_id`=`tbl_location`.`id`
    $strWhere";
    $objdata=new CLS_MYSQL();
    $objdata->Query($sql);
    $lastRe=$objdata->Num_rows();
    if($lastRe>0){
        ?>
        <div class="service-hotel">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 box-item">
                        <h3 class="title">Dịch vụ</h3>
                        <div id="slider-item1" class="swiper-container slider-item">
                            <div class="swiper-wrapper">
                                <?php
                                $index='';
                                while($rows=$objdata->Fetch_Assoc()){
                                    $url=ROOTHOST.$rows['location_code']."/".$rows['position_code']."/dich-vu/".$rows['service_code'].".html";
                                    $index++;
                                    ?>
                                    <?php if ($index % 6 == 1){ ?>
                                    <div class="swiper-slide">
                                        <div class="box">
                                            <?php }?>
                                            <div class="col-md-6 col-item">
                                                <div class="ic-<?php echo $index;?> ic"></div>
                                                <h4><a href="<?php echo $url;?>"> <?php echo $rows['name'];?></a></h4>
                                                <p><?php echo Substring($rows['intro'],0, 15);?></p>
                                            </div>
                                            <?php if ($index % 6 == 0 || $index == $lastRe){ ?>
                                        </div>
                                    </div>
                                    <?php }
                                }
                                ?>
                            </div>
                            <!-- Add Arrows -->
                            <div class="swiper-button-next1 btn-next"></div>
                            <div class="swiper-button-prev1 btn-prev"></div>
                        </div>
                        <script>
                            $(document).ready(function(){
                                slider_item(1);
                            });
                        </script>
                    </div>
                    <div class="col-md-4 box-img-service">
                        <img src="<?php echo ROOTHOST;?>images/banners/img-service.png" alt="" class="img-responsive">
                    </div>
                </div>

            </div>

        </div>
        <?php
    }
    ?>


    <div class="box-main news-hotel">
        <div class="container">
            <?php
            $strWhere=" AND `tbl_position`.`location_id`='".$location_id."' AND `tbl_position`.`id` NOT IN ($position_id)";
            $obj->getListJoin($strWhere, $limit='Limit 0,8');
            if($obj->Num_rows() > 0){
                $link_viewall = ROOTHOST.$location_code.'/di-dau';
                ?>
                <div class="list-location list-item">
                    <h3 class="title">Địa điểm gần đây</h3>
                    <div class="row content">
                        <?php
                        while($row=$obj->Fetch_Assoc()){
                            $url=ROOTHOST.$location_code."/".$row['code'].".html";
                            ?>
                            <div class="col-md-3 col-sm-3 col-xs-6 column">
                                <a href="<?php echo $url;?>" title=""><?php echo getAvatar($row['avatar'], 'img-responsive');?></a>
                                <div class="item">
                                    <h3><a href="<?php echo $url;?>" title=""><?php echo $row['name'];?></a></h3>
                                    <div class="box-score"><span class="score">9.5</span><a href="">320 Đánh giá</a></div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <?php 
                        } ?>
                    </div>
                </div>
                <div class="box-btn">
                    <a href="<?php echo $link_viewall ?>" class="link detail">Xem tất cả <span></span></a>
                </div>
                <?php 
            }?>
        </div>
    </div>

    <div class="box-main comment bg-white">
        <div class="container">
            <h3 class="title">Bình luận</h3>
            <div class="row">
                <div class="col-md-8">
                    <div class="box-comment">
                        <div class="box-scoll1">
                            <div class="item item-cm">
                                <div class="content-cm">
                                    <p class="time">5 phút trước</p>
                                    <img class="img-avatar" src="<?php echo ROOTHOST;?>images/avatar.jpg" alt="">
                                    <span class="name">Hùng Đặng</span>
                                    <p class="txt">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout... </p>

                                </div>
                            </div>

                            <div class="item item-cm">
                                <div class="content-cm">
                                    <p class="time">5 phút trước</p>
                                    <img class="img-avatar" src="<?php echo ROOTHOST;?>images/avatar.jpg" alt="">
                                    <span class="name">Hùng Đặng</span>
                                    <p class="txt">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout... </p>
                                </div>
                            </div>

                            <div class="item item-cm">
                                <div class="content-cm">
                                    <p class="time">5 phút trước</p>
                                    <img class="img-avatar" src="<?php echo ROOTHOST;?>images/avatar.jpg" alt="">
                                    <span class="name">Hùng Đặng</span>
                                    <p class="txt">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout... </p>
                                </div>
                            </div>


                            <div class="item item-cm">
                                <div class="content-cm">
                                    <p class="time">5 phút trước</p>
                                    <img class="img-avatar" src="<?php echo ROOTHOST;?>images/avatar.jpg" alt="">
                                    <span class="name">Hùng Đặng</span>
                                    <p class="txt">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout... </p>
                                </div>
                            </div>
                            <div class="item item-cm">
                                <div class="content-cm">
                                    <p class="time">5 phút trước</p>
                                    <img class="img-avatar" src="<?php echo ROOTHOST;?>images/avatar.jpg" alt="">
                                    <span class="name">Hùng Đặng</span>
                                    <p class="txt">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout... </p>
                                </div>
                            </div>
                        </div>
                        <div class="box-btn">
                            <button class="btn btn-viewmore">Xem thêm</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box-mod box-view">
                        <h3><?php echo $name;?> Top review</h3>
                        <div class="content">
                            <ul class="list-inline">
                                <li>
                                    <p><span class="number">+2,300</span> <span>More than view every day.</span></p>
                                </li>
                                <li>
                                    <p><span class="number-book">+140</span> <span>Booking on day.</span></p>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="box-mod person-view">
                        <h3>Top person like</h3>
                        <div class="content">
                            <span class="number num1">01</span>
                            <img class="img-avatar" src="<?php echo ROOTHOST;?>images/avatar.jpg" alt="">
                            <span class="txt">It is a long established fact that a reader will be distracted by ..</span>
                        </div>

                        <div class="content">
                            <span class="number num2">02</span>
                            <img class="img-avatar" src="<?php echo ROOTHOST;?>images/avatar.jpg" alt="">
                            <span class="txt">It is a long established fact that a reader will be distracted by ..</span>
                        </div>

                        <div class="content">
                            <span class="number num3">03</span>
                            <img class="img-avatar" src="<?php echo ROOTHOST;?>images/avatar.jpg" alt="">
                            <span class="txt">It is a long established fact that a reader will be distracted by ..</span>
                        </div>

                        <div class="content">
                            <span class="number num4">04</span>
                            <img class="img-avatar" src="<?php echo ROOTHOST;?>images/avatar.jpg" alt="">
                            <span class="txt">It is a long established fact that a reader will be distracted by ..</span>
                        </div>

                        <div class="content">
                            <span class="number num5">05</span>
                            <img class="img-avatar" src="<?php echo ROOTHOST;?>images/avatar.jpg" alt="">
                            <span class="txt">It is a long established fact that a reader will be distracted by ..</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    $strWhere=" WHERE `position_id`='".$position_id."' AND `isactive`='1'";
    $sql="SELECT `id`, `code`, `thumb`, `cdate`,`title`, `intro`, `author` FROM `tbl_contents` ".$strWhere." ORDER BY `cdate` DESC";
    $objdata->Query($sql);
    if($objdata->Num_rows()>0){
        ?>
        <div class="box-main news-style">
            <div class="container">
                <h3 class="title">Bài viết liên quan</h3>
                <div class="row">
                    <?php
                    while($rows_con=$objdata->Fetch_Assoc()){
                        $intro=strip_tags(Substring($rows_con['intro'], 0, 20));
                        $url=ROOTHOST."tin-tuc/chi-tiet/".$rows_con['code'].".html";
                        $date = date("d-m-Y", strtotime($rows_con['cdate']));
                        $title=Substring($rows_con['title'], 0, 20);
                        ?>
                        <div class="col-md-6 col-sm-6 item">
                            <div class="col-item">
                                <?php echo getThumb($rows_con['thumb'],$rows_con['title'], 'thumb', '200px', '160px');?>
                                <h4 class="name"><a href="<?php echo $url;?>" title="<?php echo $rows_con['title'];?>"><?php echo $title;?></a></h4>
                                <span class="author">By: <?php echo $rows_con['author'];?></span>
                                <p class="intro"><?php echo $intro;?></p>
                                <span class="date">
                                    <?php echo $date;?>
                                </span>
                                <a class="btn-readmore" href="<?php echo $url;?>">Chi tiết</a>
                            </div>
                        </div>
                        <?php 
                    }?>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
</div>


<script>

    $(document).ready(function(){
        $('.box-toggle span.drop-item:first').addClass('active');
        $('.box-toggle .content:first').show().addClass('active');
        $('.box-toggle span.drop-item:last').addClass('last');
        $(".box-toggle span.drop-item").click(function(){
            var parent = $(this).parent();
            if(!$(this).hasClass('active')){
                $('.box-toggle span.drop-item').removeClass('active');
                $(this).addClass('active');
                $('.content-toggle').hide().removeClass('active');
                $('.content-toggle', parent).show().addClass('active');
            } else {
                $(this).removeClass('active');
                $('.content-toggle', parent).hide().removeClass('active');
            }
        });
    });

</script>