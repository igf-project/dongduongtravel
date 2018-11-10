<?php
$location_code='';
if(isset($_GET['code'])){
    $location_code=addslashes($_GET['code']);
}
else die("PAGE NOT FOUND");
$arr=$obj->getIdAndNameByCode($location_code);
$location_id=$arr['id'];
$location_name=$arr['name'];
?>
<div class="box-about" style="padding-top: 20px; padding-bottom: 20px">
    <div class="container">
        <div class="page-content">
            <div class="row">
                <div class="col-md-8 col-sm-7">
                    <div class="info-location">
                        <?php
                        $strWhere=" WHERE `tbl_location`.`code`='".$location_code."'";
                        $obj->getList($strWhere);
                        $row=$obj->Fetch_Assoc();
                        ?>
                        <h2>Why do you come <?php echo $location_name;?>?</h2>
                        <p class="comment more">
                            <?php
                            echo strlen($row['intro'])>12 ? SubString(strip_tags($row['intro']), 0, 500): '<p>Dữ liệu đang được cập nhật!</p>';
                            ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-5">
                    <div class="box-travel">
                        <h3 class="col-md-6">Tìm hiểu về <span class="name-location"><?php echo $location_name;?></span></h3>
                        <ul class="his col-md-6">
                            <?php
                            $number = count($AR_CATE_CONTENT);
                            for ($i=0; $i < $number; $i++) { 
                                $name = $AR_CATE_CONTENT[$i]['name'];
                                $code = $AR_CATE_CONTENT[$i]['code'];
                                $url=ROOTHOST.$location_code."/".$code;
                                echo '<li class="col-xs-4 col-md-10"><a href="'.$url.'" class="ic-'.$i.'">'.$name.'</a></li>';
                            }
                            ?>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container box-tour tour-location">
    <div class="box-title">
        <h3 class="title title-slider">Tour <span class="color"><?php echo $location_name;?></span></h3>
    </div>
    <div class="content row">
        <div id="slider-item1" class="swiper-container slider-item">
            <div class="swiper-wrapper">
                <?php
                $strWhere="AND find_in_set($location_id, `tbl_tour`.`arr_location`) > 0";
                $objTour->getListItemSlider($strWhere, $limit='LIMIT 0, 8');
                ?>
            </div>

            <!-- Add Arrows -->
            <div class="swiper-button-next1 btn-next"></div>
            <div class="swiper-button-prev1 btn-prev"></div>

            <script>
                $(document).ready(function(){
                    slider_item(1);
                });
            </script>
        </div>
    </div>
</div>
<div class="box-discovery">
    <div class="container discovery">
        <h2 class="title text-center"><span>Khám phá <?php echo $location_name;?></span></h2>
        <div class="content row">
            <div class="box">
                <?php
                $number = count($AR_POSITION_GROUP); $j=0;
                for ($i=0; $i < $number; $i++) { 
                    $j++;
                    $name = $AR_POSITION_GROUP[$i]['name'];
                    ?>
                    <div class="col-md-4 col-sm-6 col-xs-6 item">
                        <div id="ic-scroll<?php echo $j;?>" class="icon ic-<?php echo $j;?>">
                            <span></span>
                        </div>
                        <h3><?php echo $name;?></h3>
                    </div>
                    <script>
                        scrollToBox('ic-scroll<?php echo $j;?>', 'box-scroll<?php echo $j;?>');
                    </script>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>


<div class="box-main box-scroll1">
    <div class="container">
        <div class="page-content">
            <div class="list-foodmenu list-item">
                <h3 class="title">Ẩm thực <?php echo $location_name;?></h3>
                <div class="row">
                    <?php
                    $strWhere="WHERE `tbl_foodmenu`.`location_id`='".$location_id."'";
                    $objFood->getListJoin($strWhere, $limit='Limit 0,8');
                    if($objFood->Num_rows() > 0){
                        while($row=$objFood->Fetch_Assoc()){
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
                        }
                    } ?>
                </div>
            </div>
            <div class="box-btn text-center">
                <a class="readmore link detail" href="<?php echo ROOTHOST.$location_code;?>/an-gi">Xem tất cả</a>
            </div>
        </div>

    </div>
</div>

<?php
$index='';
foreach ($AR_POSITION_GROUP as $key => $val) {
    if($val['id']!=63){
        $index++;
        $strWhere=" AND `tbl_position`.`location_id`='".$location_id."' AND `tbl_position`.`positiongrouptype_id`=".$val['id']."";
        $objPo->getListJoin($strWhere, $limit='Limit 0,8');
        if($objPo->Num_rows() > 0){
            $group_id=$val['id'];
            $group_code=$val['code'];
            ?>
            <div class="box-main <?php if ($index % 2 != 0){echo "bg-white";}?> box-scroll<?php echo $index;?>">
                <div class="container">
                    <div class="page-content">
                        <div class="list-location list-item">
                            <h3 class="title"><?php echo $val['name']." ".$location_name;?></h3>
                            <ul class="title-category list-inline pull-right">
                                <?php
                                $strWher="WHERE `group_id`=$group_id";
                                $objPoType->getList($strWher);
                                while($rw=$objPoType->Fetch_Assoc()){?>
                                <li>
                                    <a href="<?php echo ROOTHOST.$location_code."/".$group_code."/".$rw['code']."/danh-sach";?>"><?php echo $rw['name'];?></a>
                                </li>
                                <?php } ?>
                            </ul>
                            <div class="row">
                                <?php
                                while($row=$objPo->Fetch_Assoc()){
                                    $url=ROOTHOST.$location_code."/".$row['code'].".html";
                                    ?>
                                    <div class="col-md-3 col-sm-3 col-xs-6 column">
                                        <a href="<?php echo $url;?>" title=""><?php echo getAvatar($row['avatar'], 'img-responsive');?></a>
                                        <div class="item">
                                            <h3 class="ellipsis"><a  href="<?php echo $url;?>" title=""><?php echo $row['name'];?></a></h3>
                                            <div class="box-score"><span class="score">9.5</span><a href="">320 Đánh giá</a></div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <?php 
                                } ?>
                            </div>
                        </div>
                        <div class="box-btn text-center">
                            <a class="readmore link detail" href="<?php echo ROOTHOST.$location_code;?>/<?php echo $group_code;?>">Xem tất cả</a>
                        </div>
                    </div>

                </div>
            </div>
            <?php 
        }
    }
}?>


<div class="where-go">
    <div class="container">
        <h2>Where do you go?</h2>
        <div class="row row-centered">
            <form class="col-md-5 col-sm-6 col-xs-10 col-centered form-inline">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Địa danh, danh lam thắng cảnh, ..">
                </div>
                <button type="submit" class="btn btn-default">Search</button>
            </form>
        </div>

    </div>
</div>

