<div class="wrap-detail">
    <?php
    $location_code='';
    if(isset($_GET['code'])){
        $product_code=addslashes($_GET['code']);
    }
    else die("PAGE NOT FOUND");


    $strWhere="WHERE `tbl_product`.`pro_code`='".$product_code."'";
    $obj->getList($strWhere);
    $row=$obj->Fetch_Assoc();
    $name=$row['name'];

    $thumb=getThumb($row['thumb'],$name, 'img-responsive', 320, 240);
    $intro=strip_tags(Substring($row['intro'], 0, 50));
    $fulltext=strip_tags($row['fulltext']);
    $location_id=(int)$row['location_id'];
    $position_id=(int)$row['position_id'];
    ?>
    <div class="box-info-pro bg-white">
        <div class="container">
            <div class="page-content">
                <div class="row box-bg">
                    <div class=" col-md-5 col-sm-6 col-xs-12 slide-pro-detail">
                        <?php echo $thumb;?>
                    </div>
                    <div class=" col-md-7 col-sm-6 col-xs-12 info-txt">
                        <h3><?php echo $name;?></h3>
                        <div class="price-box">
                            <p class="special-price">
                                <span class="price-label">Đơn giá</span>
                                <span class="price"><?php echo getFomatPrice($row['cur_price']);?></span>
                            </p>
                        </div>
                        <div class="short-description">
                            <div class="std"><p><strong>Đặc điểm:</strong></p>
                                <p><?php echo $intro;?></p>
                            </div>
                        </div>
                        <button class="text-center btn btn-default btn-buy">Mua hàng</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="detail-pro ">
        <div class="container">
            <div class="page-content">

                <div class="info-content">
                    <div class="date-program" id="box-tabs">
                        <ul class="list-inline text-center">
                            <div class="label-day">Ngày</div>
                            <li class="lage active" href="tab1">
                                <span class="date">Thông tin chi tiết</span>
                            </li>
                            <li class="lage" href="tab2">
                                <span class="date">Bình luận</span>
                            </li>
                        </ul>
                    </div>
                    <div class="content-tab">
                        <div id="tab1" class="box-content">
                            <?php echo $fulltext!=''? $fulltext: 'Nội dung đang được cập nhật!';?>
                        </div>
                        <div id="tab2" class="box-content">
                            <form class="col-md-8 frm-comment">
                                <div class="form-group">
                                    <label>Nội dung đánh giá</label>
                                    <textarea class="textarea"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="captcha">Mã bảo mật</label>
                                    <input type="text" class="captcha" id="captcha" placeholder="Nhập mã captcha">
                                    <img src="<?php echo ROOTHOST ?>extensions/captcha/CaptchaSecurityImages.php?width=90&height=32" class="img-captcha"/>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-default">Gửi đánh giá</button>
                                </div>
                            </form>
                            <div class="clearfix"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <?php if($location_id!=''){
        $strWhere="AND `tbl_product`.`location_id`=$location_id AND `tbl_product`.`pro_code` NOT IN ('$product_code')";
        $obj->getListAllActive($strWhere);
        if($obj->Num_rows()>0){
            ?>
            <div class="box-main">
                <div class="container">
                    <div class="page-content">
                        <div class="list-product list-item">
                            <h3 class="title">Sản phẩm theo vùng miền</h3>
                            <div class="row">
                                <?php
                                while($rows=$obj->Fetch_Assoc()){
                                    $alt_thumb=$rows['name'];
                                    $thumb=getThumb($rows['thumb'],$alt_thumb, 'img-responsive', 320, 240);
                                    $url=ROOTHOST."qua-tang/chi-tiet/".$rows['pro_code'].".html";
                                    $date = date("d-m-Y", strtotime($rows['cdate']));
                                    ?>
                                    <div class="col-md-3 col-sm-3 col-xs-6 tour">
                                        <a href="<?php echo $url;?>" title="<?php echo $rows['name'];?>"><?php echo $thumb;?></a>
                                        <div class="tour-content">
                                            <h3><span><?php echo $rows['name'];?></span></h3>
                                            <div class="price"><?php echo getFomatPrice($rows['cur_price']);?></div>
                                            <div class="box"><a href="<?php echo $url;?>" class="link detail">Chi tiết <span></span></a></div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <?php 
                                }?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
        }
    }?>

    <?php if($position_id!=''){
        $strWhere="AND `tbl_product`.`position_id`=$position_id AND `tbl_product`.`pro_code` NOT IN ('$product_code')";
        $obj->getListAllActive($strWhere);
        if($obj->Num_rows()>0){
            ?>
            <div class="box-main <?php echo $location_id!=''? 'bg-white':'';?>">
                <div class="container">
                    <div class="page-content">
                        <div class="list-product list-item">
                            <h3 class="title">Sản phẩm cùng địa điểm</h3>
                            <div class="row">
                                <?php
                                while($rows=$obj->Fetch_Assoc()){
                                    $alt_thumb=$rows['name'];
                                    $thumb=getThumb($rows['thumb'],$alt_thumb, 'img-responsive', 320, 240);
                                    $url=ROOTHOST."qua-tang/chi-tiet/".$rows['pro_code'].".html";
                                    $date = date("d-m-Y", strtotime($rows['cdate']));
                                    ?>
                                    <div class="col-md-3 col-sm-3 col-xs-6 tour">
                                        <a href="<?php echo $url;?>" title="<?php echo $rows['name'];?>"><?php echo $thumb;?></a>
                                        <div class="tour-content">
                                            <h3><span><?php echo $rows['name'];?></span></h3>
                                            <div class="price"><?php echo getFomatPrice($rows['cur_price']);?></div>
                                            <div class="box"><a href="<?php echo $url;?>" class="link detail">Chi tiết <span></span></a></div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <?php 
                                }?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
        }
    }?>

    <?php
    $strWhere="WHERE `tbl_location`.`id`='$location_id'";
    $objLo->getList($strWhere);
    while($rows=$objLo->Fetch_Assoc()){
        $location_name=$rows['name'];
        $location_intro=strip_tags(Substring($rows['intro'],0, 70));
        ?>
        <div class="box-discovery">
            <div class="container discovery">
                <h2 class="title text-center"><span>Khám phá <?php echo $location_name;?></span></h2>
                <div class="row row-centered">
                    <div class="col-md-9 col-centered intro">
                        <p class="intro"><?php echo $location_intro;?></p>
                    </div>
                </div>

            </div>
        </div>
        <?php 
    } ?>

    <?php
    $strWhere="WHERE `tbl_content`.`location_id`=$location_id OR `tbl_content`.`position_id`=$position_id LIMIT 0,6";
    $objCon->getList($strWhere);
    if($objCon->Num_rows()>0){
        ?>
        <div class="box-main">
            <div class="container">
                <div class="page-content list-news">
                    <h3 class="title">Bài viết liên quan</h3>
                    <div class="row news-style">
                        <?php
                        while($rows=$objCon->Fetch_Assoc()){
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
                            <?php 
                        }?>
                    </div>
                </div>

            </div>
        </div>
        <?php 
    } ?>
</div>

<script>
    $('.content-tab .box-content').hide();
    $('.content-tab .box-content:first').addClass('active-tab');
    $('#box-tabs li').click(function(){
        $('#box-tabs li').removeClass('active');
        $(this).addClass('active');
        var tabActive=$(this).attr('href');
        $('.content-tab .box-content').removeClass('active-tab');
        $('#'+tabActive).addClass('active-tab');
        $('.g-program li').removeClass('active');
    });
</script>