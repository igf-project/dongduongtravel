<?php
class CLS_FOODMENU{
    private $pro=array(
        'ID'=>'-1',
        'LocationId'=>'',
        'PositionId'=>'',
        'CateId'=>'',
        'RecomId'=>'',
        'PositionContactId'=>'',
        'Name'=>'',
        'Code'=>'',
        'Thumb'=>'',
        'Score'=>'',
        'Intro'=>'',
        'Fulltext'=>'',
        'isActive'=>1
        );
    private $objmysql=NULL;
    public function CLS_FOODMENU(){
        $this->objmysql=new CLS_MYSQL;
    }
    // property set value
    public function __set($proname,$value){
        if(!isset($this->pro[$proname])){
            echo ('Can not found $proname member');
            return;
        }
        $this->pro[$proname]=$value;
    }
    public function __get($proname){
        if(!isset($this->pro[$proname])){
            echo ("Can not found $proname member");
            return;
        }
        return $this->pro[$proname];
    }
    public function getList($where='',$limit=''){
        $sql="SELECT * FROM `tbl_foodmenu` ".$where.' ORDER BY `tbl_foodmenu`.`name` DESC '.$limit;
       //var_dump($sql);
        return $this->objmysql->Query($sql);
    }
    public function getListJoin($where='',$limit=''){
        $sql="SELECT `tbl_foodmenu`.`name`, `tbl_foodmenu`.`thumb`, `tbl_foodmenu`.`code`, `tbl_position_contact`.`contact_name`, `tbl_position`.`code` AS `position_code`
        FROM `tbl_foodmenu`
        LEFT JOIN `tbl_position`
        ON `tbl_foodmenu`.`position_id` =`tbl_position`.`id`
        $where
        ORDER BY `tbl_foodmenu`.`name` DESC $limit";
        return $this->objmysql->Query($sql);
    }


    public function Num_rows(){
        return $this->objmysql->Num_rows();
    }

    public function Fetch_Assoc(){
        return $this->objmysql->Fetch_Assoc();
    }
    public function getLastId(){
        return $this->objmysql->LastInsertID();
    }



    public function Add_new(){
        $sql=" INSERT INTO `tbl_foodmenu`(`location_id`, `position_id`, `cate_id`, `recom_id`, `name`, `code`,`thumb`,`intro`, `fulltext`, `isactive`) VALUES";
        $sql.="('".$this->LocationId."', '".$this->PositionId."', '".$this->CateId."', '".$this->RecomId."', '".$this->Name."', '".$this->Code."','".$this->Thumb."', '".$this->Intro."', '".$this->Fulltext."', '".$this->isActive."')";
        return $this->objmysql->Exec($sql);
    }

    public function Update(){
        $sql = "UPDATE `tbl_foodmenu` SET 
        `name`='".$this->Name."', 
        `code`='".$this->Code."', 
        `location_id`='".$this->LocationId."', 
        `position_id`='".$this->PositionId."', 
        `cate_id`='".$this->CateId."', 
        `recom_id`='".$this->RecomId."', 
        `thumb`='".$this->Thumb."', 
        `intro`='".$this->Intro."', 
        `fulltext`='".$this->Fulltext."'
        WHERE id='".$this->ID."'";
        // var_dump($sql);
        return $this->objmysql->Exec($sql);
    }
    public function Delete($id){
        $sql="DELETE `tbl_foodmenu`
        FROM `tbl_foodmenu`
        WHERE `tbl_foodmenu`.`id` in ('$id')";
        //var_dump($sql); die();
        return $this->objmysql->Exec($sql);
    }

    public function setActive($ids,$status=''){
        $sql="UPDATE `tbl_foodmenu` SET `isactive`='$status' WHERE `id` in ('$ids')";
        if($status=='')
            $sql="UPDATE `tbl_foodmenu` SET `isactive`=if(`isactive`=0,1,0) WHERE `id` in ('$ids')";
        return $this->objmysql->Exec($sql);
    }


    /* get list combo box addnew*/
    function getListCbFoodMenu($getId=0){
        $sql="SELECT id, name FROM `tbl_foodmenu` WHERE `isactive`='1' ";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        if($objdata->Num_rows()<=0) return;
        while($rows=$objdata->Fetch_Assoc()){
            $id=$rows['id'];
            $name=$rows['name'];
            ?>
            <option value='<?php echo $id;?>' <?php if($getId && $id==$getId) echo "selected";?>><?php echo $name;?></option>
            <?php
        }
    }
    /* get list combo box addnew*/
    function getListCbFoodCategory($getId=''){
        $sql="SELECT id, name FROM `tbl_foodmenu_category` WHERE `isactive`='1' ";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        if($objdata->Num_rows()<=0) return;
        while($rows=$objdata->Fetch_Assoc()){
            $id=$rows['id'];
            $name=$rows['name'];
            ?>
            <option value='<?php echo $id;?>' <?php if($getId && $id==$getId) echo "selected";?>><?php echo $name;?></option>
            <?php
        }
    }
    /* get list combo box addnew*/
    function getListCbFoodRecommend($getId=''){
        $sql="SELECT id, name FROM `tbl_foodmenu_recommend` WHERE `isactive`='1' ";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        if($objdata->Num_rows()<=0) return;
        while($rows=$objdata->Fetch_Assoc()){
            $id=$rows['id'];
            $name=$rows['name'];
            ?>
            <option value='<?php echo $id;?>' <?php if($getId && $id==$getId) echo "selected";?>><?php echo $name;?></option>
            <?php
        }
    }


    /* get ID and by Code */
    public function getIdAndNameByCode($code){
        $sql="SELECT `tbl_foodmenu`.`id`,`tbl_foodmenu`.`name` FROM `tbl_foodmenu` WHERE `tbl_foodmenu`.`code` ='$code'";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        $row=$objdata->Fetch_Assoc();
        return $row;
    }
    /* get ID by Code */
    public function getNameAndCodeById($id){
        $sql="SELECT `tbl_foodmenu`.`code`,`tbl_foodmenu`.`name` FROM `tbl_foodmenu` WHERE `tbl_foodmenu`.`id` ='$id'";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        $row=$objdata->Fetch_Assoc();
        return $row;
    }

    public function getCodeById($id){
        $sql="SELECT `tbl_foodmenu`.`code` FROM `tbl_foodmenu` WHERE `tbl_foodmenu`.`id` ='$id'";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        $row=$objdata->Fetch_Assoc();
        return $row['code'];
    }

    public function getNameById($id){
        $objdata=new CLS_MYSQL;
        $sql="SELECT `name` FROM `tbl_foodmenu` WHERE `id` = '$id'";
        $objdata->Query($sql);
        $row=$objdata->Fetch_Assoc();
        return $row['name'];
    }

    public function getCout($strwhere){
        $objdata=new CLS_MYSQL;
        $sql="SELECT COUNT(`tbl_foodmenu`.`id`) AS `number` FROM `tbl_foodmenu` $strwhere";
        $objdata->Query($sql);
        $row=$objdata->Fetch_Assoc();
        return $row['number'];
    }
}
?>