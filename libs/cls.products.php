<?php
class CLS_PRODUCTS{
    private $objmysql;
    public function CLS_PRODUCTS(){
        $this->objmysql=new CLS_MYSQL;
    }
    public function getList($strwhere=""){
        $sql=" SELECT * FROM tbl_product $strwhere";
        //echo $sql;
        return $this->objmysql->Query($sql);
    }
    public function getListJoin($strwhere=""){
        $sql=" SELECT `tbl_product`.`name`, `tbl_product`.`pro_code`, `tbl_product`.`location_id`, `tbl_product`.`position_id`, `tbl_product`.`intro`,`tbl_product`.`fulltext`, `tbl_product`.`thumb`, `tbl_product`.`cur_price`, `tbl_location`.`name` as location_name
        FROM `tbl_product` INNER JOIN `tbl_location` ON `tbl_product`.`location_id`=`tbl_location`.`id` $strwhere";
        //echo $sql;
        return $this->objmysql->Query($sql);
    }
    public function getCount($strwhere=""){
        $sql="SELECT count(*) AS 'num' FROM tbl_product WHERE isactive=1 $strwhere";
        $objdata = new CLS_MYSQL();
        $objdata->Query($sql);
        $row = $objdata->Fetch_Assoc();
        return $row['num'];
    }
    public function getListAllActive($strwhere=""){
        $sql=" SELECT * FROM tbl_product WHERE `tbl_product`.`isactive`='1' $strwhere";
        return $this->objmysql->Query($sql);
    }
    public function Num_rows(){
        return $this->objmysql->Num_rows();
    }
    public function Fetch_Assoc(){
        return $this->objmysql->Fetch_Assoc();
    }
    public function getCatName($catid) {
        $sql="SELECT name FROM tbl_catalog WHERE cat_id=$catid";
        $objdata=new CLS_MYSQL;
        $objdata->Query($sql);
        if($objdata->Num_rows()>0) {
            $r=$objdata->Fetch_Assoc();
            return $r['name'];
        }
    }


    public function Add_new(){
        $sql="INSERT INTO `tbl_product` (`pro_code`,`cata_id`,`position_id`,`location_id`, `name`,`intro`,`fulltext`,`thumb`,`cur_price`, `quantity`,`author`,`cdate`,`mdate`,`meta_title`,`meta_key`,`meta_desc`,`ishot`,`isactive`) VALUES ";
        $sql.="('".$this->Code."','".$this->CataId."','".$this->PositionId."','".$this->LocationId."','".$this->Name."','".$this->Intro."','".$this->Fulltext."','".$this->Thumb."','";
        $sql.=$this->Cur_price."','".$this->Quantity."','".$this->Author."','";
        $sql.=$this->Cdate."','".$this->Mdate."','";
        $sql.=$this->MTitle."','".$this->MKey."','".$this->MDesc."','".$this->isHot."','".$this->isActive."')";
        //var_dump($sql); die();
        return $this->objmysql->Exec($sql);
    }
    public function Update(){
        $sql="UPDATE `tbl_product` SET
				`cata_id`='".$this->CataId."',
				`pro_code`='".$this->Code."',
				`location_id`='".$this->LocationId."',
				`position_id`='".$this->PositionId."',
				`name`='".$this->Name."',
				`intro`='".$this->Intro."',
				`fulltext`='".$this->Fulltext."',
				`thumb`='".$this->Thumb."',										
				`cur_price`='".$this->Cur_price."',								
				`quantity`='".$this->Quantity."',
				`cdate`='".$this->Cdate."',
				`mdate`='".$this->Mdate."',
				`author`='".$this->Author."',
				`meta_title`='".($this->MTitle)."',
				`meta_key`='".($this->MKey)."',
				`meta_desc`='".($this->MDesc)."',
				`ishot`='".$this->isHot."',
				`isactive`='".$this->isActive."' 
		WHERE `ID`='".$this->ID."'";
        //var_dump($sql); die();
        return $this->objmysql->Exec($sql);
    }
    public function Delete($ids){
        $sql="DELETE FROM `tbl_product` WHERE `id` in ('$ids')";
        return $this->objmysql->Exec($sql);
    }
    public function setHot($ids){
        $sql="UPDATE `tbl_product` SET `ishot`=if(`ishot`=1,0,1) WHERE `id` in ('$ids')";
        return $this->objmysql->Exec($sql);
    }
    public function setActive($ids,$status=''){
        $sql="UPDATE `tbl_product` SET `isactive`='$status' WHERE `id` in ('$ids')";
        if($status=='')
            $sql="UPDATE `tbl_product` SET `isactive`=if(`isactive`=1,0,1) WHERE `id` in ('$ids')";
        return $this->objmysql->Exec($sql);
    }
    public function Order($ids,$order){
        $sql="UPDATE tbl_product SET `order`='".$order."' WHERE `id`='".$ids."'";
        return $this->objmysql->Exec($sql);
    }
    public function Orders($arids,$arods){
        for($i=0;$i<count($arids);$i++){
            $this->Order($arids[$i],$arods[$i]);
        }
    }


    /* get ID by Code */
    public function getIdAndNameByCode($id){
        $sql="SELECT `tbl_product`.`id`,`tbl_product`.`name` FROM `tbl_product` WHERE `tbl_product`.`code` ='$id'";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        $row=$objdata->Fetch_Assoc();
        return $row;
    }


    // hàm lấy danh sách product
    public function getListItem($strwhere="", $limit=""){
        $sql="SELECT `tbl_product`.`id`, `tbl_product`.`pro_code`, `tbl_product`.`name`, `tbl_product`.`intro`, `tbl_product`.`fulltext`, `tbl_product`.`thumb`, `tbl_product`.`cdate`, `tbl_product`.`cur_price`
			FROM `tbl_product` 
			WHERE `tbl_product`.`isactive`='1' $strwhere ORDER BY `tbl_product`.`id` DESC $limit";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        $stt='0';
        while($rows=$objdata->Fetch_Assoc()):
            $stt++;
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

        <?php endwhile;
    }

    // hàm lấy danh sách product
    public function getListItemSlider($strwhere="", $limit=""){
        $sql="SELECT `tbl_product`.`id`, `tbl_product`.`pro_code`, `tbl_product`.`name`, `tbl_product`.`intro`, `tbl_product`.`fulltext`, `tbl_product`.`thumb`, `tbl_product`.`cdate`, `tbl_product`.`cur_price`
			FROM `tbl_product`
			WHERE `tbl_product`.`isactive`='1' $strwhere ORDER BY `tbl_product`.`id` DESC $limit";
        // var_dump($sql);
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        $lastRe=$objdata->Num_rows();
        $stt='0';
        while($rows=$objdata->Fetch_Assoc()):
            $stt++;
            $alt_thumb=$rows['name'];
            $thumb=getThumb($rows['thumb'],$alt_thumb, 'img-responsive', 320, 240);
            $url=ROOTHOST."qua-tang/chi-tiet/".$rows['pro_code'].".html";
            ?>
            <?php if ($stt % 4 == 1): ?>
            <div class="swiper-slide">
            <div class="box">
            <?php endif;?>
                <div class="col-md-3 col-sm-3 col-xs-6 tour">
                    <a href="<?php echo $url;?>" title="<?php echo $rows['name'];?>"><?php echo $thumb;?></a>
                    <div class="tour-content">
                        <h3><span><?php echo $rows['name'];?></span></h3>
                        <div class="price"><?php echo getFomatPrice($rows['cur_price']);?></div>
                        <div class="box"><a href="<?php echo $url;?>" class="link detail">Chi tiết <span></span></a></div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            <?php if ($stt % 4 == 0 || $stt == $lastRe): ?>
            </div>
            </div>
        <?php endif;?>
        <?php endwhile;
    }

    // Hàm lấy danh sách quà tặng cho từng tour
    public function getListItemStyle($strwhere="", $limit=''){
      $sql="SELECT `tbl_product`.`id`, `tbl_product`.`pro_code`, `tbl_product`.`name`, `tbl_product`.`intro`, `tbl_product`.`fulltext`, `tbl_product`.`thumb`, `tbl_product`.`cdate`, `tbl_product`.`cur_price`
            FROM `tbl_product` 
            WHERE `tbl_product`.`isactive`='1' $strwhere ORDER BY `tbl_product`.`id` DESC $limit";
       // var_dump($sql);
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        $stt='0';
        while($rows=$objdata->Fetch_Assoc()):
            $stt++;
            $alt_thumb=$rows['name'];
            $thumb=getThumb($rows['thumb'],$alt_thumb, 'img-responsive', 320, 240);
            $url=ROOTHOST."qua-tang/chi-tiet/".$rows['pro_code'].".html";
            $date = date("d-m-Y", strtotime($rows['cdate']));
            ?>
            <div class="col-md-4 col-sm-4 col-xs-6 gift">
                <a href="<?php echo $url;?>" title="<?php echo $rows['name'];?>"><?php echo $thumb;?></a>
                <div class="gift-content">
                    <h3 class="m-ellipsis"><?php echo $rows['name'];?></h3>
                    <div class="price"><?php echo getFomatPrice($rows['cur_price']);?></div>
                    <div class="clearfix"></div>
                </div>
                <span class="item-mask"></span>
            </div>

        <?php endwhile;
    }
}
?>