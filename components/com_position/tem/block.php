<?php
$limit=''; $strWhere=''; 
$location_code = isset($_GET['location_code']) ? addslashes($_GET['location_code']):'';
if($location_code=='') die('PAGE NOT FOUND !');
$sql="SELECT `id`,`name`,`code` FROM tbl_location WHERE `code` = '$location_code'";
$objdata->Query($sql);
$row_loc = $objdata->Fetch_Assoc();
if($objdata->Num_rows()>0){
    ?>
    <div class="box-main page">
        <div class="container">
            <div class="page-content">
                <h1 class="title">Địa điểm ở <span class="color"><?php echo $row_loc['name'] ?></span></h1>
                <div class="list-location list-item">
                    <div class="row">
                        <?php
                        $obj->getList($strWhere,'');
                        $total_rows=$obj->Num_rows();
                        $cur_page=isset($_GET['page'])?(int)$_GET['page']:1;
                        $max_rows = MAX_ROWS;
                        $start=($cur_page-1)*$max_rows;

                        $obj->getList($strWhere, " LIMIT $start,$max_rows");
                        while($row = $obj->Fetch_Assoc()){
                            $url = $location_code."/".$row['code']."/";
                            ?>
                            <div class="col-md-3 col-sm-3 col-xs-6 column">
                                <a href="<?php echo $url;?>" title=""><?php echo getAvatar($row['avatar'], 'img-responsive');?></a>
                                <div class="item">
                                    <h3><?php echo $row['name'];?></h3>
                                    <div class="box-score"><span class="score">9.5</span><a href="">320 Đánh giá</a></div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <?php 
                        }?>
                    </div>
                </div>
                <div class="text-center">
                    <?php paging($total_rows, $max_rows, $cur_page,'?page={page}'); ?>
                </div>
            </div>
        </div>
    </div>

    <?php
}
?>