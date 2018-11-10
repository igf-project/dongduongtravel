<?php
class CLS_LOCATIONCONTENT{
    private $objmysql=NULL;
    public function CLS_LOCATIONCONTENT(){
        $this->objmysql=new CLS_MYSQL;
    }
    public function getList($where='',$limit=''){
        $sql="SELECT * FROM `tbl_location_content` ".$where.' ORDER BY `tbl_location_content`.`name` DESC '.$limit;
        echo $sql;
        return $this->objmysql->Query($sql);
    }

    public function Num_rows(){
        return $this->objmysql->Num_rows();
    }

    public function Fetch_Assoc(){
        return $this->objmysql->Fetch_Assoc();
    }
}
?>