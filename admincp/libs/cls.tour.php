<?php
class CLS_TOUR{
    private $pro=array(
        'ID'=>'1',
        'TourTypeId'=>'',
        'AccountId'=>'',
        'Code'=>'',
        'Name'=>'',
        'NumDay'=>'',
        'NumNight'=>'',
        'StartTime'=>'',
        'Start'=>'',
        'Expediency'=>'',
        'RankHotel'=>'',
        'Thumb'=>'',
        'Intro'=>'',
        'Fulltext'=>'',
        'Version'=>'',
        'ArrLocation'=>'',
        'Price'=>'',
        'PriceChild14'=>'',
        'PriceChild59'=>'',
        'Content'=>'',
        'CDate'=>'',
        'IsActive'=>'1');
    private $objmysql;
    public function CLS_TOUR(){
        $this->objmysql=new CLS_MYSQL;
    }
    // property set value
    public function __set($proname,$value){
        if(!isset($this->pro[$proname])){
            echo ($proname.' is not member of CLS_CONTENTS Class' );
            return;
        }
        $this->pro[$proname]=$value;
    }
    public function __get($proname){
        if(!isset($this->pro[$proname])){
            echo ($proname.' is not member of CLS_CONTENTS Class' );
            return '';
        }
        return $this->pro[$proname];
    }
    public function getList($strwhere=""){
        $sql="SELECT * FROM `tbl_tour`".$strwhere."";
        //var_dump($sql);
        return $this->objmysql->Query($sql);
    }

    public function getListAllActive($strwhere='', $limit=''){
        $sql="SELECT * FROM `tbl_tour` INNER JOIN `tbl_tour_price` ON `tbl_tour`.`id`=`tbl_tour_price`.`tour_id` WHERE `tbl_tour`.`isactive`='1' $strwhere ORDER BY `tbl_tour`.`name` $limit";

        return $this->objmysql->Query($sql);
    }

    public function Num_rows(){
        return $this->objmysql->Num_rows();
    }
    public function Fetch_Assoc(){
        return $this->objmysql->Fetch_Assoc();
    }

    public function getListAll($strwhere=""){
        $sql="SELECT * FROM `tbl_tour` INNER JOIN `tbl_tour_price` ON `tbl_tour`.`id`=`tbl_tour_price`.`tour_id` ".$strwhere."";
        //var_dump($sql);
        return $this->objmysql->Query($sql);
    }
    public function getCatName($catid) {
        $sql="SELECT name from view_cate where cat_id='$catid'";
        $objdata=new CLS_MYSQL;
        $objdata->Query($sql);
        if($objdata->Num_rows()>0) {
            $r=$objdata->Fetch_Assoc();
            return $r['name'];
        }
    }




    public  function Add_new(){
        $objdata=new CLS_MYSQL;
        $objdata->Query("BEGIN");
        $sql="INSERT INTO tbl_tour (`tour_type_id`, `account_id`, `code`, `name`,`num_day`, `num_night`, `start_time`, `start`, `expediency`, `rank_hotel`, `thumb`, `intro`, `fulltext`,`version`,`arr_location`, `cdate`, `isactive`) VALUES ";
        $sql.="('".$this->TourTypeId."', '".$this->AccountId."', '".$this->Code."', '".$this->Name."', '".$this->NumDay."', '".$this->NumNight."', '".$this->StartTime."', '".$this->Start."', '".$this->Expediency."', '".$this->RankHotel."', '".$this->Thumb."', '".$this->Intro."', '".$this->Fulltext."', '".$this->Version."', '".$this->ArrLocation."', NOW(), '".$this->IsActive."')";
        $result=$objdata->Exec($sql);


        $ids=$objdata->LastInsertID();
        $sql="INSERT INTO tbl_tour_price (`tour_id`,`price`,`children_1_4`,`children_5_9`,`content`) VALUES";
        $sql.="('$ids','".$this->Price."','".$this->PriceChild14."', '".$this->PriceChild59."', '".$this->Content."')";
        $result1=$objdata->Query($sql);


        if($result && $result1){
            $objdata->Query('COMMIT');
            return $result;
        }
        else
            $objdata->Query('ROLLBACK');
    }

    function Update(){
        $objdata=new CLS_MYSQL;
        $objdata->Query("BEGIN");
        $sql="UPDATE `tbl_tour` SET `code`='".$this->Code."',
        `name`='".$this->Name."', 
        `tour_type_id`='".$this->TourTypeId."', 
        `account_id`='".$this->AccountId."', 
        `num_day`='".$this->NumDay."',
        `num_night`='".$this->NumNight."',
        `start_time`='".$this->StartTime."',
        `start`='".$this->Start."',
        `expediency`='".$this->Expediency."',
        `rank_hotel`='".$this->RankHotel."',
        `thumb`='".$this->Thumb."',
        `intro`='".$this->Intro."',
        `fulltext`='".$this->Fulltext."',
        `version`='".$this->Version."',
        `arr_location`='".$this->ArrLocation."',
        `isactive`='".$this->IsActive."'
        WHERE `id`='".$this->ID."'";
        // var_dump($sql); 
        $result = $objdata->Query($sql);
        $sql="UPDATE `tbl_tour_price` SET `price`='".$this->Price."',
        `children_1_4`='".$this->PriceChild14."',
        `children_5_9`='".$this->PriceChild59."',
        `content`='".$this->Content."'
        WHERE `tour_id`='".$this->ID."'";
       // var_dump($sql);die();
        $result1 = $objdata->Query($sql);


        if($result && $result1 ){
            $objdata->Query('COMMIT');
            return $result;
        }
        else
            $objdata->Query('ROLLBACK');
    }

    public function getLastId(){
        return $this->objmysql->LastInsertID();
    }

    public function Delete($ids){
        $objdata=new CLS_MYSQL;
        $objdata->Query("BEGIN");
        $sql="DELETE FROM `tbl_tour` WHERE `id` in ('$ids')";
        $result=$objdata->Query($sql);
        $sql="DELETE FROM `tbl_tour_price` WHERE `tour_id` in ('$ids')";
        $result1=$objdata->Query($sql);
        $sql="DELETE FROM `tbl_tour_programfood` WHERE `tour_id` in ('$ids')";
        $result2=$objdata->Query($sql);
        $sql="DELETE FROM `tbl_tour_programsleep` WHERE `tour_id` in ('$ids')";
        $result3=$objdata->Query($sql);
        $sql="DELETE FROM `tbl_tour_programwhere` WHERE `tour_id` in ('$ids')";
        $result4=$objdata->Query($sql);
        $sql="DELETE FROM `tbl_gallery` WHERE `par_id` in ('$ids') AND `type`='2'";
        $result5=$objdata->Query($sql);
        //var_dump($sql);die();
        if($result && $result1 && $result2 && $result3 && $result4 && $result5){
            $objdata->Query('COMMIT');
            return $result;
        }else
        $objdata->Query('ROLLBACK');
    }

    public function setActive($ids,$status=''){
        $sql="UPDATE `tbl_tour` SET `isactive`='$status' WHERE `id` in ('$ids')";
        if($status=='')
            $sql="UPDATE `tbl_tour` SET `isactive`=if(`isactive`=1,0,1) WHERE `id` in ('$ids')";
        return $this->objmysql->Exec($sql);
    }


    /* get ID by Code */
    public function getIdAndNameByCode($id){
        $sql="SELECT `tbl_tour`.`id`,`tbl_tour`.`name`, `tbl_tour`.`num_day` FROM `tbl_tour` WHERE `tbl_tour`.`code` ='$id'";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        $row=$objdata->Fetch_Assoc();
        return $row;
    }

    public function getInfo($strwhere){
        $sql="SELECT `id`, `code`, `name` FROM tbl_tour WHERE isactive=1 $strwhere";
        // echo $sql;
        $objdata = new CLS_MYSQL();
        $objdata->Query($sql);
        $row = $objdata->Fetch_Assoc();
        return $row;
    }

}
?>
