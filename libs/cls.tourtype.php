<?php
class CLS_TOURTYPE{
    private $objmysql=NULL;
    public function CLS_TOURTYPE(){
        $this->objmysql=new CLS_MYSQL;
    }

    public function Num_rows(){
        return $this->objmysql->Num_rows();
    }
    public function Fetch_Assoc(){
        return $this->objmysql->Fetch_Assoc();
    }
    public function getList($where='', $limit=''){
        $sql="SELECT `tbl_tour_type`.`id`, `tbl_tour_type`.`code`, `tbl_tour_type`.`name` FROM `tbl_tour_type` ".$where.' ORDER BY `tbl_tour_type`.`name` '.$limit;
        return $this->objmysql->Query($sql);
    }

    /* get ID by Code */
    public function getIdAndNameByCode($id){
        $sql="SELECT `tbl_tour_type`.`id`,`tbl_tour_type`.`name` FROM `tbl_tour_type` WHERE `tbl_tour_type`.`code` ='$id'";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        $row=$objdata->Fetch_Assoc();
        return $row;
    }

    /* combo box*/
    function getListCbTourtype($getId='', $swhere=''){
        $sql="SELECT id, name FROM tbl_tour_type WHERE ".$swhere." `isactive`='1' ORDER BY `name` ASC";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        if($objdata->Num_rows()<=0) return;
        while($rows=$objdata->Fetch_Assoc()){
            $id=$rows['id'];
            $name=$rows['name'];
            ?>
            <option value='<?php echo $id;?>' <?php if(isset($getId) && $id==$getId) echo "selected";?>><?php echo $name;?></option>
            <?php
        }
    }

    public function getNameById($cat_id){
        $objdata=new CLS_MYSQL;
        $sql="SELECT `Name` FROM `tbl_tour_type` WHERE `isactive`=0 AND `ID` = '$cat_id'";
        $objdata->Query($sql);
        $row=$objdata->Fetch_Assoc();
        return $row['name'];
    }
}
?>