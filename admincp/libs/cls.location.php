<?php
class CLS_LOCATION{
    private $pro=array(
        'ID'=>'-1',
        'parId'=>'',
        'countryId'=>'',
        'Code'=>'',
        'Name'=>'',
        'Thumb'=>'',
        'Intro'=>'',
        'introAbout'=>'',
        'Fulltext'=>'',
        'isActive'=>1,
        'Order'=>1
        );
    private $objmysql=NULL;
    public function CLS_LOCATION(){
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
    public function getList($where='', $limit=''){
        $sql="SELECT * FROM `tbl_location` ".$where.' ORDER BY `name` '.$limit;
        return $this->objmysql->Query($sql);
    }

    public function Num_rows(){
        return $this->objmysql->Num_rows();
    }
    public function Fetch_Assoc(){
        return $this->objmysql->Fetch_Assoc();
    }
    public function getListCate($parid=0,$level=0){
        $sql="SELECT id, name FROM tbl_location WHERE `isactive`='1' ";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        $char="";
        if($level!=0){
            $char.="&nbsp;&nbsp;&nbsp;";
            $char.="|---";
        }
        if($objdata->Num_rows()<=0) return;
        while($rows=$objdata->Fetch_Assoc()){
            $id=$rows['id'];
            $name=$rows['name'];
        }
    }


    public function Add_new(){
        $sql="INSERT INTO `tbl_location`(`par_id`, `country_id`, `code`, `name`, `thumb`, `intro`, `isactive`, `order`) VALUES";
        $sql.="('".$this->parId."', '".$this->countryId."', '".$this->Code."', '".$this->Name."', '".$this->Thumb."', '".$this->Intro."','".$this->isActive."', '".$this->Order."')";
        return $this->objmysql->Exec($sql);
    }
    public function Update(){
        $sql="UPDATE tbl_location SET par_id='".$this->parId."', country_id='".$this->countryId."', `name`='".$this->Name."', `thumb`='".$this->Thumb."', `intro`='".$this->Intro."', `code`='".$this->Code."' WHERE id='".$this->ID."'";
        return $this->objmysql->Exec($sql);
    }
    public function setActive($ids,$status=''){
        $sql="UPDATE `tbl_location` SET `isactive`='$status' WHERE `id` in ('$ids')";
        if($status==''){
            $sql="UPDATE `tbl_location` SET `isactive`=if(`isactive`=0,1,0) WHERE `id` in ('$ids')";
        }
        return $this->objmysql->Exec($sql);
    }

    public function Delete($id){
        $sql="DELETE FROM `tbl_location` WHERE `id` in ('$id')";
        return $this->objmysql->Exec($sql);
    }

    function getListCbLocation($getId='', $swhere='', $arrId=''){
        $sql="SELECT id,name, code FROM tbl_location WHERE ".$swhere." `isactive`='1' ORDER BY `name` ASC";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        if($objdata->Num_rows()<=0) return;
        while($rows=$objdata->Fetch_Assoc()){
            $id=$rows['id'];
            $name=$rows['name'];
            if(!$arrId){
                ?>
                <option value='<?php echo $rows['id'];?>' <?php if(isset($getId) && $id==$getId) echo "selected";?>><?php echo $name;?></option>
            <?php
            }else{?>
                <option value='<?php echo $id;?>' <?php if(isset($arrId) and in_array($id, $arrId)) echo "selected";?>><?php echo $name;?></option>
            <?php
            }
            ?>


        <?php
        }
    }
    public function getNameById($id){
        $objdata=new CLS_MYSQL;
        $sql="SELECT `name` FROM `tbl_location` WHERE `id` = '$id'";
        $objdata->Query($sql);
        $row=$objdata->Fetch_Assoc();
        return $row['name'];
    }
    public function getCodeById($id){
        $objdata=new CLS_MYSQL;
        $sql="SELECT `code` FROM `tbl_location` WHERE `id` = '$id'";
        $objdata->Query($sql);
        $row=$objdata->Fetch_Assoc();
        return $row['code'];
    }

    public function getInfo($strwhere){
        $sql="SELECT `id`, `code`, `name` FROM tbl_location WHERE isactive=1 $strwhere";
        // echo $sql;
        $objdata = new CLS_MYSQL();
        $objdata->Query($sql);
        $row = $objdata->Fetch_Assoc();
        return $row;
    }
}
?>