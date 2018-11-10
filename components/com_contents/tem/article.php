<?php
$content_code='';
if(isset($_GET['code'])){
    $content_code=addslashes($_GET['code']);
}
else die("PAGE NOT FOUND");
?>

<div class="detail-content">
    <div class="container">
        <div class="page-content">
            <?php
            $strWhere='WHERE `tbl_contents`.`code`="'.$content_code.'"';
            $obj->getList($strWhere);
            $row=$obj->Fetch_Assoc();
            $location_id=(int)$row['location_id'];
            $position_id=(int)$row['position_id'];
            $intro=strip_tags(Substring($row['intro'], 0, 100));
            $fulltext=html_entity_decode($row['fulltext']);
            ?>
            <div class="box-path">
                <ul class="list-inline">
                    <li class="home"><a href="<?php echo ROOTHOST.'trang-chu/'?>">Trang chủ</a></li>
                    > <li><a href="<?php echo ROOTHOST."tin-tuc/";?>">Tin tức</a></li>
                    > <li><a class="active" href="#"><?php echo $row['title'];?></a></li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <h3 class="title">
                        <?php echo $row['title'];?>
                    </h3>
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
</div>
<?php
unset($objPoCon);
?>