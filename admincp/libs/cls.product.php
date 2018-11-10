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
}
?>