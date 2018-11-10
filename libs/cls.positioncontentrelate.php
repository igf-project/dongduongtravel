<?php
class CLS_POSITIONCONTENTRELATE{
    private $pro=array(
        'ID'=>'-1',
        'positionContactId'=>'',
        'arrPath'=>'',
        'isActive'=>1,
        'Order'=>1
    );
    private $objmysql=NULL;
    public function CLS_POSITIONCONTENTRELATE(){
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
        $sql="SELECT * FROM `tbl_position_contentrelate` where 1=1 ".$where.' ORDER BY `name` '.$limit;
        return $this->objmysql->Query($sql);
    }
    public function Num_rows(){
        return $this->objmysql->Num_rows();
    }
    public function Fetch_Assoc(){
        return $this->objmysql->Fetch_Assoc();
    }
    public function getListCate($parid=0,$level=0){
        $sql="SELECT id, name FROM tbl_position_contentrelate WHERE `isactive`='1' ";
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
        $sql=" INSERT INTO `tbl_position_contentrelate`(`positioncontact_id`, `arr_path`, `isactive`, `order`) VALUES";
        $sql.="('".$this->positionContactId."', '".$this->arrPath."', '".$this->isActive."', '".$this->Order."')";
       
        return $this->objmysql->Exec($sql);
    }
    public function Update(){
        $sql = "UPDATE tbl_position_contentrelate SET `arr_path`=".$this->arrPath." WHERE positioncontact_id='".$this->positionContactId."'";
//        /var_dump($sql);
        return $this->objmysql->Exec($sql);
    }
    public function Delete($id){
        $sql="DELETE FROM `tbl_position_contentrelate` WHERE `positioncontact_id` in ('$id')";
       // var_dump($sql);
        return $this->objmysql->Exec($sql);
    }
    public function setActive($ids,$status=''){
        $sql="UPDATE `tbl_position_contentrelate` SET `isactive`='$status' WHERE `id` in ('$ids')";
        if($status=='')
            $sql="UPDATE `tbl_position_contentrelate` SET `isactive`=if(`isactive`=0,1,0) WHERE `id` in ('$ids')";
        return $this->objmysql->Exec($sql);
    }


    /* get list combo box addnew*/
    function getListCbPositionType($parid=0, $getId=0){
        $sql="SELECT id, name FROM `tbl_position_contentrelate` WHERE `isactive`='1' ";
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
    public function getArrIdByPositionContactId($strwhere=""){
        $sql="SELECT * FROM tbl_position_contentrelate ".$strwhere."";
        //echo $sql;
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        $rows=$objdata->Fetch_Assoc();
        return $rows['arr_path'];
    }

    public function getListContentRelate($strwhere="", $path=""){
        $sql="SELECT * FROM tbl_position_contentrelate ".$strwhere."";
        //var_dump($sql);
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        while($rows=$objdata->Fetch_Assoc()){
            $arr=explode(', ', $rows['arr_path']);
            foreach($arr as $list):?>
                <div class="info-item">
                    <img src="<?php echo $path.$list;?>" width="150px">
                    <span class="del-item" value="<?php echo $list;?>"></span>
                </div>
            <?php endforeach;
        }
    }
}
?>