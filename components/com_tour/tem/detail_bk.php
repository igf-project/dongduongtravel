<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
if(isset($_GET['code'])){
    $tour_code=addslashes($_GET['code']);
}
else die('PAGE NOT FOUND');
include_once(LIB_PATH.'cls.position.php');
if(!isset($obj_position)) $obj_position = new CLS_POSITION;

$arr=$obj->getIdAndNameByCode($tour_code);
$tour_id=$arr['id'];
$tour_name=$arr['name'];
?>
<?php
$tour_code=addslashes($_GET['code']);
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
else:
    include_once(COM_PATH.'com_slider/tem/list_main.php');
endif;
?>

<!--End slide-->

<div class="box-info-tour bg-white">
    <div class="info-content container">
        <div class="page-content">
            <?php
            $obj->getList('INNER JOIN `tbl_tour_price` ON `tbl_tour`.`id`=`tbl_tour_price`.`tour_id` WHERE `tbl_tour`.`id`='.$tour_id.'');
            $row=$obj->Fetch_Assoc();
            $alt_thumb=$row['name'];
            $thumb=getThumb($row['thumb'],$alt_thumb, 'img-responsive', 320, 240);
            $intro=strip_tags(Substring($row['intro'], 0, 50));
            $fulltext=strip_tags($row['fulltext']);
            $arr_location=$row['arr_location'];
            $content_price=$row['content'];
            $url=ROOTHOST."tour/";

            $date = date("d-m-Y", strtotime($row['cdate']));
            $start_day=date('d/m/Y', strtotime($row['start']));
            $day=''.$row['num_day'].' day';
            $new_date = strtotime ( $day , strtotime ( $start_day) ) ;
            $end_day = date ( 'd/m/Y' , $new_date );
            ?>
            <div class="row">
                <div class="col-md-8 col-sm-7 info-tour">
                    <h2><i class="fa fa-map-marker"></i><span><?php echo $row['name'];?></span></h2>
                    <div class="row">
                        <div class="col-md-5 col-sm-4 info-thumb">
                            <?php echo $thumb;?>
                        </div>
                        <div class="col-md-7 col-sm-8 info-txt">
                            <p class="">
                                <span class="quote1"></span>
                                <?php echo $intro;?>
                                <span class="quote2"></span>
                            </p>
                            <div class="price">Giá tour: <span><?php echo getFomatPrice($row['price']);?></span></div>
                            <ul class="info-detail-tour">
                                <li class="row"><div class="col-md-6"><span class="txt-bold">Phương tiện: </span><?php echo $row['expediency'];?> </div><div class="col-md-6"><span class="txt-bold">Khách sạn: </span><?php echo $row['rank_hotel'];?></div></li>
                                <li class="clearfix"><span class="txt-bold">Khởi hành từ: </span><?php echo $row['start_time']." ngày ".$start_day;?></li>
                            </ul>
                        </div>
                    </div>

                    <div class="row time-price">
                        <div class="col-md-6 col-sm-6 column">
                            <span class="ic ic-price"></span>
                            <span class="title">Giá dành cho trẻ em</span>
                            <ul>
                                <li class="item">Từ 1 - 5 tuổi : <?php if($row['children_1_4']=='0') echo "Miễn phí"; else echo getFomatPrice($row['children_1_4']);?></li>
                                <li class="item">Từ 6 - 13 tuổi : <?php echo getFomatPrice($row['children_5_9']);?></li>
                            </ul>
                        </div>
                        <div class="col-md-6 col-sm-6 column">
                            <span class="ic ic-time"></span>
                            <span class="title">Thời gian</span>
                            <ul>
                                <li class="item"><?php echo $row['num_day'];?> ngày <?php echo $row['num_night'];?> đêm</li>
                                <li class="item">
                                    <?php
                                    echo "Từ ".$start_day." đến ".$end_day;
                                    ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-5 book-tour">
                    <form class="book-frm" id="frm-booktour" action="<?php echo ROOTHOST."ajaxs/tour/booktour.php";?>" method="POST">
                        <input class="form-control" type="hidden" name="txt_tourid" value="<?php echo $tour_id;?>"/>
                        <h3>Đặt tour ngay</h3>
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Họ và tên" name="txt_fullname"/>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="number"  placeholder="Số CMTND" name="txt_cmt" min="0"/>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="number" placeholder="Điện thoại" name="txt_phone" min="0"/>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="email" placeholder="Email" name="txt_email"/>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-7 col-xs-7 item">
                                <input class="form-control" type="number" placeholder="Số người" name="txt_numperson" min="0"/>
                            </div>
                            <div class="col-md-5 col-xs-5 item">
                                <button type="submit" id="book-tour" class="btn btn-default btn-frm btn-login">Đặt tour</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="box-program">
    <div class="container">
        <div class="page-content">
            <h3 class="title">Lịch trình</h3>
            <div class="date-program" id="box-tabs">
                <ul class="list-inline text-center">
                    <div class="label-day">Ngày</div>
                    <?php
                    $num_day=$row['num_day'];
                    $i='1';
                    for($i==1; $i<=$num_day; $i++):?>
                        <li class="<?php echo $num_day < 6 ? 'lage':'small'?> <?php if($i==1) echo 'active';?>" href="tab<?php echo $i;?>">
                            <span class="date">Ngày</span>
                            <span class="number"><?php echo $i < 10 ? '0':''?><?php echo $i;?></span>
                        </li>
                    <?php endfor;?>
                </ul>
            </div>
            <div class="content-tab">
                <?php
                $num_day=$row['num_day'];
                $i='1';
                for($i==1; $i<=$num_day; $i++):
                ?>
                    <div id="tab<?php echo $i;?>" class="box-content">
                        <div class="g-program" id="tabs-action">
                            <ul>
                                <li href="act-tab<?php echo $i;?>1" class="active"><span class="ic ic-1">Đi đâu</span></li>
                                <li href="act-tab<?php echo $i;?>2"><span class="ic ic-3">Ăn gì</span></li>
                                <li href="act-tab<?php echo $i;?>3"><span class="ic ic-5">Ngủ nghỉ</span></li>
                                <li href="act-tab<?php echo $i;?>4"><span class="ic ic-5">Quà tặng</span></li>
                            </ul>
                        </div>
                        <div class="content content-1" id="act-tab<?php echo $i;?>1">
                            <span class="sub-drop"></span>
                            <?php
                            include_once(LIB_PATH.'cls.tourprogramwhere.php');
                            $objTourProWhere=new CLS_TOURPROGRAMWHERE();
                            $strWhere="WHERE `tour_id`=$tour_id AND `day_id`=$i";
                            $activeTab='-tab'.$i.'1';
                            $objTourProWhere->getListItemStyle($strWhere, false, $activeTab);
                            // 
                            $obj_position->getListGallerySlider($tour_code);
                            ?>
                        </div>

                        <div class="content content-2" id="act-tab<?php echo $i;?>2">

                            <span class="sub-drop"></span>
                            <?php
                            include_once(LIB_PATH.'cls.tourprogramfood.php');
                            $objTourProFood=new CLS_TOURPROGRAMFOOD();
                            $strWhere="WHERE `tour_id`=$tour_id AND `day_id`=$i";
                            $activeTab='-tab'.$i.'2';
                            $objTourProFood->getListItemStyle($strWhere, false, $activeTab);
                            ?>
                        </div>

                        <div class="content content-3" id="act-tab<?php echo $i;?>3">
                            <span class="sub-drop"></span>
                            <?php
                            include_once(LIB_PATH.'cls.tourprogramsleep.php');
                            $objTourProSleep=new CLS_TOURPROGRAMSLEEP();
                            $strWhere="WHERE `tour_id`=$tour_id AND `day_id`=$i";
                            $activeTab='-tab3'.$i;
                            $objTourProSleep->getListItemStyle($strWhere);
                            ?>
                        </div>

                        <div class="content content-4" id="act-tab<?php echo $i;?>4">
                            <span class="sub-drop"></span>
                            <div class="list-product ">
                                <div class="row">
                                    <?php
                                    include_once(LIB_PATH.'cls.products.php');
                                    $objTourProWhere->getList(" WHERE `tbl_tour_programwhere`.tour_id in($tour_id) ","");
                                    $row_TPW = $objTourProWhere->Fetch_Assoc();

                                    $objProduct=new CLS_PRODUCTS();
                                    $strWhere =" AND `tbl_product`.`position_id` in(SELECT `tbl_tour_programwhere`.position_id FROM `tbl_tour_programwhere` WHERE `tbl_tour_programwhere`.tour_id in($tour_id) ) ";
                                    $objProduct->getListItemStyle($strWhere,"");
                                    ?>
                                </div>


                            <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                <?php endfor;?>
            </div>
            <?php
            include_once(LIB_PATH.'cls.tourprogram.php');
            $objPro=new CLS_TOURPROGRAM();
            $objPro->getList('WHERE `tbl_tour_program`.`id`='.$tour_id.'');
            $index='';
            while($rws=$objPro->Fetch_Assoc()){
                $info=strip_tags($rws['content']);
                $index++;?>
                <h3><?php echo $row['num_day'];?></h3>
                <h3><i class="fa fa-map-marker"></i><span><?php echo $row['title'];?></span></h3>
                <div class="item item-<?php echo $index;?>">
                    <?php echo $info;?>
                </div>
            <?php }?>
        </div>
    </div>
    <div class="box-footer"></div>
</div>

<div class="box-main content-price bg-white">
    <div class="container">
        <div class="page-content">
            <div class="row">
                <div class="col-md-8 col-sm-7">
                    <?php echo $content_price;?>
                </div>
                <div class="col-md-4 col-sm-5">
                    <div class="mod-tour">
                        <div  class="mod-title" class="active">
                            <div class="sub-accord1-div1"><b>Tour du lịch trong nước</b></div>
                            <div class="selected"></div>
                        </div>
                        <ul class="list">
                            <?php $obj->getListModItem('','LIMIT 0,5');?>
                        </ul>
                    </div>

                    <img src="<?php echo ROOTHOST.TEM_PATH;?>web/images/dalat.jpg" class="img-full" alt=""/>
                    <div class="mod mod-news">
                        <div class="mod-title" class="active">
                            <div class="sub-accord1-div1"><b>Cộng đồng du lịch</b></div>
                            <div class="selected"></div>
                        </div>
                        <?php
                        $strWhere='';
                        include_once(LIB_PATH.'cls.content.php');
                        $objCon=new CLS_CONTENTS();
                        $objCon->getListModItem('','LIMIT 0,5');?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<img src="<?php echo ROOTHOST;?>images/banners/festival.png" class="img-responsive img-full"/>


<div class="box-main">
    <div class="container list-item">
        <div class="page-content">
            <h3 class="title">Tour liên quan</h3>
            <div class="row">
                <?php
                /*$strWhere="AND `tbl_tour`.`arr_location` LIKE '%,$arr_location%' OR `tbl_tour`.`arr_location` LIKE '$arr_location,%'";
               $arr_location=explode(',',$arr_location);
                foreach($arr_location as $vl){

                }*/
                //$strWhere="AND find_in_set($arr_location, `tbl_tour`.`arr_location`) > 0";
                $limit='LIMIT 0,8';
                $strWhere='';
                $obj->getListItem($strWhere, $limit);

                ?>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>


<script>
    $('document').ready(function(){
        $('.content-tab .box-content').hide();
        $('.content-tab .box-content:first').addClass('active-tab');
        $('#box-tabs li').click(function(){
            $('#box-tabs li').removeClass('active');
            $(this).addClass('active');
            var tabActive=$(this).attr('href');
            $('.content-tab .box-content').removeClass('active-tab');
            $('#'+tabActive).addClass('active-tab');
            $('.g-program li').removeClass('active');
            $('.active-tab .g-program li:first').addClass('active');
            $('.active-tab .content').addClass('hide');
            $('.active-tab .content:first').removeClass('hide');
            $('.active-tab .g-program li').click(function(){
                var tabActiveChild=$(this).attr('href');
                //alert(tabActiveChild);
                $('.g-program li').removeClass('active');
                $(this).addClass('active');

                $('.active-tab .content').addClass('hide');
                $('#'+tabActiveChild).removeClass('hide');
            });

        });


        $('.active-tab .content').addClass('hide');
        $('.active-tab .content:first').removeClass('hide');
        $('.active-tab .g-program li').click(function(){
            var tabActiveChild=$(this).attr('href');
            //alert(tabActiveChild);

            $('.g-program li').removeClass('active');

            $(this).addClass('active');
            $('.active-tab .content').addClass('hide');
            $('#'+tabActiveChild).removeClass('hide');
        });

        $('#frm-booktour').submit(function(){
            var postData = $(this).serializeArray();
            var url=$(this).attr('action');
            $.post(url, postData, function(response_data){
                $('#myModal').modal('show');
                $('#myModalLabel').html('Đặt tour');
                $('#data-frm').html(response_data);
            });
            return false;
        })
    })


</script>