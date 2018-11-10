<?php $objdata = new CLS_MYSQL(); ?>
<div class="footer">
    <div class="logo-footer"></div>
    <div class="mn-list">
        <div class="container">
            <div class="foot-content">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="title">Top địa điểm du lịch lý tưởng</h3>
                        <div class="row">
                            <?php
                            $sql="SELECT `tbl_position`.*, `tbl_location`.`code` as `location_code` FROM `tbl_position` INNER JOIN `tbl_location` ON `tbl_position`.`location_id`=`tbl_location`.`id`WHERE `tbl_position`.`isactive`=1 AND `tbl_position`.`positiongrouptype_id`='62' ORDER BY `name` LIMIT 0,16 ";
                            $objdata->Query($sql);
                            while ($rows=$objdata->Fetch_Assoc()) {
                                $url=ROOTHOST.$rows['location_code']."/".$rows['code'].".html";
                                $name=Substring($rows['name'],0,15);
                                ?>
                                <div class="col-md-6 item">
                                    <a class="ellipsis" href="<?php echo $url;?>"><?php echo $name;?></a></li>
                                </div>
                                <?php 
                            }?>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h3 class="title">Thông tin liên hệ</h3>
                        <h4>Công Ty Tnhh Thương Mại Dịch Vụ Và Du Lịch Hà Giang</h4>

                        <p><b>Trụ Sở</b>: Số 73 đường Minh Khai Hà Giang (thành phố) </p>

                        <p><b>Tel</b>: 0219.6511.888   &nbsp;&nbsp;&nbsp;&nbsp;<b>Website</b>: travelhagiang.info </p>
                        <p><b>Email</b>: tsthagiang@travelhagiang.info &nbsp;&nbsp;&nbsp;&nbsp;</p>
                    </div>

                </div>
            </div>

        </div>

    </div>
    <div class="copyright">© 2017 Bản quyền thuộc về Hà Giang Travel</div>

</div>