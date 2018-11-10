<div class="container box-tour special-tour hot-tour">
    <h2 class="title"><span>Tour nổi bật</span></h2>
    <div class="content row">
        <div id="slider-item1" class="swiper-container slider-item">
            <div class="swiper-wrapper">
                <?php
                include_once(LIB_PATH.'cls.tour.php');
                $objTour=new CLS_TOUR();
                $objTour->getListItemSlider('', $limit='LIMIT 0, 8');
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
    <div class="box clearfix text-center"><a href="<?php echo ROOTHOST;?>tour" class="link detail">Xem tất cả <span></span></a></div>
</div>

<div class="festival">
    <img src="<?php echo ROOTHOST;?>images/banners/festival.png" class="img-responsive img-full"/>
</div>
<div class="container box-tour asean">
    <h2 class="title"><span>Khám phá Asean</span></h2>
    <div class="content row">
        <div id="slider-item2" class="swiper-container slider-item">
            <div class="swiper-wrapper">
                <?php
                include_once(LIB_PATH.'cls.location.php');
                $objLo=new CLS_LOCATION();
                $objLo->getListItemSlider('', $limit='LIMIT 0, 30');
                ?>
            </div>
            <!-- Add Arrows -->
            <div class="swiper-button-next2 btn-next"></div>
            <div class="swiper-button-prev2 btn-prev"></div>
        </div>
        <script>
            $(document).ready(function(){
                slider_item(2);
            });
        </script>
    </div>  
    <div class="box clearfix text-center"><a href="<?php echo ROOTHOST;?>dia-danh" class="link detail">Xem tất cả <span></span></a></div>
</div>
<div class="box-service">
    <div class="preview"></div>
    <div class="container box-tour box-service-tour">
        <div class="content row">

            <div class="col-md-3 col-sm-6 col-xs-6 tour"><a href="#">
                <img src="<?php echo ROOTHOST;?>images/banners/dv-khachsan.png" class="img-responsive"/>Đặt phòng khách sạn</a>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6 tour"><a href="#">
                <img src="<?php echo ROOTHOST;?>images/banners/dv-vemaybay.png" class="img-responsive"/>Đặt vé máy bay, tàu</a>
            </div>

            <div class="m-clear"> </div>

            <div class="col-md-3 col-sm-6 col-xs-6 tour">
                <a href="#"><img src="<?php echo ROOTHOST;?>images/banners/dv-passport.png" class="img-responsive"/>Visa, hộ chiếu</a>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6 tour"><a href="#">
                <img src="<?php echo ROOTHOST;?>images/banners/dv-thuexedulich.png" class="img-responsive"/>Thuê xe du lịch</a>
            </div>
        </div>
    </div>
    <div class="next"></div>
</div>
<div class="container box-tour special-tour gift">
    <h2 class="title"><span>Shop quà tặng</span></h2>
    <div class="content row">
        <div id="slider-item3" class="swiper-container slider-item">
            <div class="swiper-wrapper">
                <?php
                include_once(LIB_PATH.'cls.products.php');
                $objPro=new CLS_PRODUCTS();
                $objPro->getListItemSlider('', $limit='LIMIT 0, 8');
                ?>
            </div>

            <!-- Add Arrows -->
            <div class="swiper-button-next3 btn-next"></div>
            <div class="swiper-button-prev3 btn-prev"></div>
        </div>


        <script>
            $(document).ready(function(){
                slider_item(3);
            });
        </script>
        <div class="box clearfix text-center"><a href="<?php echo ROOTHOST."qua-tang";?>" class="link detail">Xem tất cả <span></span></a></div>
    </div>
</div>
<div class="box-idea">
    <div class="container special-tour">
        <h2 class="title text-center"><span>Gợi ý cho bạn</span></h2>
        <div class="content row">
            <div class="box">
                <div class="col-md-3 col-sm-3 col-xs-6 tour">
                    <a class="item" href="<?php echo ROOTHOST."di-dau.html";?>">
                        <img src="<?php echo ROOTHOST;?>images/banners/didau.jpg" class="img-responsive" alt="Đi du lịch ở đâu"/>
                        <div class="content"><h3 class="box-txt"><span class="txt">Đi đâu?</span></h3></div>
                    </a>
                </div>

                <div class="col-md-3 col-sm-3 col-xs-6 tour">
                    <a class="item" href="<?php echo ROOTHOST."ngu-o-dau.html";?>">
                        <img src="<?php echo ROOTHOST;?>images/banners/nguodau.jpg" class="img-responsive" alt="Đi du lịch ở đâu"/>
                        <div class="content"><h3 class="box-txt"><span class="txt">Ngủ ở đâu?</span></h3></div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-6 tour">
                    <a class="item" href="<?php echo ROOTHOST."an-gi.html";?>">
                        <img src="<?php echo ROOTHOST;?>images/banners/anuong.jpg" class="img-responsive" alt="Đi du lịch ở đâu"/>
                        <div class="content"><h3 class="box-txt"><span class="txt">Ăn uống?</span></h3></div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-6 tour">
                    <a class="item" href="<?php echo ROOTHOST."qua-tang.html";?>">
                        <img src="<?php echo ROOTHOST;?>images/banners/lamgi.jpg" class="img-responsive" alt="Đi du lịch ở đâu"/>
                        <div class="content"><h3 class="box-txt"><span class="txt">Quà tặng?</span></h3></div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container box-tour special-tour community news">
    <h2 class="title"><span>Cộng đồng</span></h2>
    <div class="content row">
        <div id="slider-item4" class="swiper-container slider-item">
            <div class="swiper-wrapper">
                <?php
                include_once(LIB_PATH.'cls.content.php');
                $objCon=new CLS_CONTENTS();
                $objCon->getListItemSlider('', $limit='LIMIT 0, 8');
                ?>
            </div>

            <!-- Add Arrows -->
            <div class="swiper-button-next4 btn-next"></div>
            <div class="swiper-button-prev4 btn-prev"></div>
        </div>
        <script>
            $(document).ready(function(){
                slider_item(4);
            });
        </script>
        <div class="box clearfix text-center"><a href="#" class="link detail">Xem tất cả <span></span></a></div>
    </div>
</div>
<?php
unset($objLo);
?>
