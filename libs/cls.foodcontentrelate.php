<?php
class CLS_FOODCONTENTRELATE{
    private $pro=array(
        'ID'=>'-1',
        'parId'=>'',
        'arrPath'=>'',
        'isActive'=>1
    );
    private $objmysql=NULL;
    public function CLS_FOODCONTENTRELATE(){
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
        $sql="SELECT * FROM `tbl_food_contentrelate` where 1=1 ".$where.' ORDER BY `name` '.$limit;
        return $this->objmysql->Query($sql);
    }
    public function Num_rows(){
        return $this->objmysql->Num_rows();
    }
    public function Fetch_Assoc(){
        return $this->objmysql->Fetch_Assoc();
    }
    public function getListCate($parid=0,$level=0){
        $sql="SELECT id, name FROM tbl_food_contentrelate WHERE `isactive`='1' ";
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
        $sql=" INSERT INTO `tbl_food_contentrelate`(`par_id`, `arr_path`, `isactive`) VALUES";
        $sql.="('".$this->parId."', '".$this->arrPath."', '".$this->isActive."')";
        return $this->objmysql->Exec($sql);
    }
    public function Update(){
        $sql = "UPDATE tbl_food_contentrelate SET `arr_path`=".$this->arrPath." WHERE par_id='".$this->parId."'";
        return $this->objmysql->Exec($sql);
    }
    public function Delete($id){
        $sql="DELETE FROM `tbl_food_contentrelate` WHERE `par_id` in ('$id')";
        return $this->objmysql->Exec($sql);
    }
    public function setActive($ids,$status=''){
        $sql="UPDATE `tbl_food_contentrelate` SET `isactive`='$status' WHERE `id` in ('$ids')";
        if($status=='')
            $sql="UPDATE `tbl_food_contentrelate` SET `isactive`=if(`isactive`=0,1,0) WHERE `id` in ('$ids')";
        return $this->objmysql->Exec($sql);
    }


    /* get list combo box addnew*/
    function getListCbPositionType($parid=0, $getId=0){
        $sql="SELECT id, name FROM `tbl_food_contentrelate` WHERE `isactive`='1' ";
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
    public function getArrIdByparId($strwhere=""){
        $sql="SELECT * FROM tbl_food_contentrelate ".$strwhere."";
      //  echo $sql;
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        $rows=$objdata->Fetch_Assoc();
        return $rows['arr_path'];
    }
    public function getListContentRelate($strwhere="", $path=""){
        $sql="SELECT * FROM tbl_food_contentrelate ".$strwhere."";
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