<?php
if(isset($_GET['position_code'])){
    $position_code=addslashes($_GET['position_code']);
    $location_code=addslashes($_GET['location_code']);
    $food_code=addslashes($_GET['food_code']);
}
else die("PAGE NOT FOUND");
$strWhere="WHERE `tbl_foodmenu`.`code`='".$food_code."' AND `tbl_foodmenu`.`isactive`='1'";
$obj->getList($strWhere);
$row=$obj->Fetch_Assoc();
$location_id=$row['location_id'];
$position_id=$row['position_id'];

$name=strip_tags($row['name']);
$intro=strip_tags($row['intro']);
$fulltext=strip_tags($row['fulltext']);

$info_Location = $objLo->getInfo(" AND id=".$location_id);
$position_name = $objPo->getNameById($position_id);
$linkLocation = ROOTHOST.$info_Location['code'];

?>
<div class="info-position">
    <div class="box-item info">
        <div class="info-content container">
            <div class="box-path">
                <ul class="list-inline">
                    <li class="home"><a href="<?php echo ROOTHOST;?>">Trang chủ</a></li>
                    > <li><a href="<?php echo $linkLocation;?>"><?php echo $info_Location['name'] ?></a></li>
                    > <li><a class="active" href="#"><?php echo $row['name'];?></a></li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <h1 class="title"><?php echo $row['name'];?></h1>
                    <p class="intro">
                        <?php echo $intro;?>
                    </p>
                    <div class="fulltext">
                        <?php echo $fulltext;?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mod-tour">
                        <div  class="mod-title" class="active">
                            <div class="sub-accord1-div1"><b>Tour du lịch trong nước</b></div>
                            <div class="selected"></div>
                        </div>
                        <ul class="list">
                            <?php
                            $strWhere='';
                            include_once(LIB_PATH.'cls.tour.php');
                            $objTour=new CLS_TOUR();
                            $objTour->getListModItem('','LIMIT 0,5');?>
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

    
    <?php
    $strWhere="WHERE `tbl_foodmenu`.`location_id`='".$location_id."' AND `tbl_foodmenu`.`position_id`='".$position_id."'";
    $obj->getListJoin($strWhere, $limit='Limit 0,8');
    if($obj->Num_rows() > 0){
        ?>
        <div class="box-main box-scroll1">
            <div class="container">
                <div class="page-content">
                    <div class="list-foodmenu list-item">
                        <h3 class="title">Ẩm thực <?php echo '<span class="color">&nbsp'.$position_name.'</span>';?></h3>
                        <div class="row">
                            <?php
                            while($row=$obj->Fetch_Assoc()){
                                $position_code=$row['position_code'];
                                $url=ROOTHOST.$location_code."/".$position_code."/am-thuc/".$row['code'].".html";
                                $url_position = ROOTHOST.$location_code."/".$position_code."/am-thuc/";
                                ?>
                                <div class="col-md-3 col-sm-3 col-xs-6 column">
                                    <a href="<?php echo $url;?>" title=""><?php echo getThumb($row['thumb'],$row['name'],'img-responsive img-full');?></a>
                                    <div class="item">
                                        <h3 class="ellipsis"><a  href="<?php echo $url;?>" title="<?php echo $row['name'];?>"><?php echo $row['name'];?></a></h3>
                                        <h3 class="ellipsis" ><a  href="<?php echo $url_position;?>" title="<?php echo $row['position_name'];?>" style="color: #21a117"><?php echo $row['position_name'];?></a></h3>
                                        <div class="box-score"><span class="score">9.5</span><a href="">320 Đánh giá</a></div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <?php 
                            }?>
                        </div>
                    </div>
                    <div class="box-btn text-center">
                        <a class="readmore link detail" href="<?php echo ROOTHOST.$location_code;?>/an-gi">Xem tất cả</a>
                    </div>
                </div>
            </div>
        </div>
        <?php 
    }?>

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