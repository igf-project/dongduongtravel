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
                <div class="col-md-8 info-tour">
                    <h2><i class="fa fa-map-marker"></i><span><?php echo $row['name'];?></span></h2>
                    <div class="row">
                        <div class="col-md-5 info-thumb">
                            <?php echo $thumb;?>
                        </div>
                        <div class="col-md-7 info-txt">
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
                        <div class="col-md-6 column">
                            <span class="ic ic-price"></span>
                            <span class="title">Giá dành cho trẻ em</span>
                            <ul>
                                <li class="item">Từ 1 - 4 tuổi : <?php echo getFomatPrice($row['children_1_4']);?></li>
                                <li class="item">Từ 5 - 9 tuổi : <?php echo getFomatPrice($row['children_5_9']);?></li>
                            </ul>
                        </div>

                        <div class="col-md-6 column">
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

                <div class="col-md-4 book-tour">
                    <form class="book-frm" id="frm-booktour" action="<?php echo ROOTHOST."ajaxs/tour/booktour.php";?>" method="POST">
                        <input class="form-control" type="hidden" name="txt_tourid" value="<?php echo $tour_id;?>"/>
                        <h3>Đặt tour ngay</h3>
                        <div class="form-group">
                            <input class="form-control"  placeholder="Họ và tên" name="txt_fullname"/>
                        </div>
                        <div class="form-group">
                            <input class="form-control"  placeholder="Số CMTND" name="txt_cmt"/>
                        </div>
                        <div class="form-group">
                            <input class="form-control"  placeholder="Điện thoại" name="txt_phone"/>
                        </div>
                        <div class="form-group">
                            <input class="form-control"  placeholder="Email" name="txt_email"/>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-7 col-xs-7 item">
                                <input class="form-control"  placeholder="Số người" name="txt_numperson"/>
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
</div>

<div class="box-main content-price bg-white">
    <div class="container">
        <div class="page-content">
            <?php echo $content_price;?>
        </div>
    </div>
</div>


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


<?php
/*$strWhere="WHERE `tbl_content`.`location_id`=$location_id OR `tbl_content`.`position_id`=$position_id LIMIT 0,6";*/
$strWhere='';
include_once(LIB_PATH.'cls.content.php');
$objCon=new CLS_CONTENTS();
$objCon->getList($strWhere, 'LIMIT 0,6');
if($objCon->Num_rows()>0):
    ?>
    <div class="box-main">
        <div class="container">
            <div class="page-content list-news">
                <h3 class="title">Bài viết liên quan</h3>
                <div class="row news-style">
                    <?php
                    while($rows=$objCon->Fetch_Assoc()):
                        $intro=strip_tags(Substring($rows['intro'], 0, 20));
                        $url=ROOTHOST."tin-tuc/chi-tiet/".$rows['code'].".html";
                        $date = date("d-m-Y", strtotime($rows['cdate']));
                        $title=Substring($rows['title'], 0, 20);
                        ?>
                        <div class="col-md-6 col-sm-6 item">
                            <div class="col-item">
                                <?php echo getThumb($rows['thumb_img'],$rows['title'], 'thumb', '200px', '160px');?>
                                <h4 class="name"><a href="<?php echo $url;?>" title="<?php echo $rows['title'];?>"><?php echo $title;?></a></h4>
                                <span class="author">By: <?php echo $rows['author'];?></span>
                                <p class="intro"><?php echo $intro;?></p>
                            <span class="date">
                                <?php echo $date;?>
                            </span>
                                <a class="btn-readmore" href="<?php echo $url;?>">Chi tiết</a>
                            </div>
                        </div>
                    <?php endwhile;?>
                </div>
            </div>

        </div>
    </div>
<?php endif;?>
</div>
<!-- Modal -->
<div class="book-tour modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Thêm mới</h4>
            </div>
            <div class="modal-body" id="data-frm">
                <!-- show -->


            </div>
        </div>
    </div>
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