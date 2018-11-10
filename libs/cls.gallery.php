<?php
class CLS_GALLERY{
    private $pro=array(
        'ID'=>'-1',
        'parId'=>'',
        'arrPath'=>'',
        'Type'=>'',
        'isActive'=>1,
        'Order'=>1
    );
    private $objmysql=NULL;
    public function CLS_GALLERY(){
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
        $sql="SELECT * FROM `tbl_gallery` where 1=1 ".$where.' ORDER BY `name` '.$limit;
        return $this->objmysql->Query($sql);
    }
    public function Num_rows(){
        return $this->objmysql->Num_rows();
    }
    public function Fetch_Assoc(){
        return $this->objmysql->Fetch_Assoc();
    }

    public function getThumbAvatarByPositionId($par_id){
        $objdata=new CLS_MYSQL;
        $sql="SELECT `arr_path` FROM `tbl_gallery`  WHERE `par_id` = '$par_id' AND `arr_path` IS NOT NULL";
        //var_dump($sql);
        $objdata->Query($sql);
        $row=$objdata->Fetch_Assoc();
        $thumb=explode(', ',$row['arr_path']);
        $thumb_img=PATH_THUMB.$thumb[0];
		if($row['arr_path'] != '' AND file_exists($thumb_img)){
            return $thumb_img;
		} 
        else return THUMB_DEFAULT;
    }




    public function Add_new(){
        $sql=" INSERT INTO `tbl_gallery`(`par_id`, `arr_path`, `type`, `isactive`, `order`) VALUES";
        $sql.="('".$this->parId."', '".$this->arrPath."', '".$this->Type."', '".$this->isActive."', '".$this->Order."')";
        // var_dump($sql);
		return $this->objmysql->Exec($sql);
    }
    public function Update(){
        $sql = "UPDATE tbl_gallery SET `arr_path`=".$this->arrPath." WHERE id='".$this->ID."'";
		// var_dump($sql);
        return $this->objmysql->Exec($sql);
    }
    public function Delete($id){
        $sql="DELETE FROM `tbl_gallery` WHERE `id` = $id";
        return $this->objmysql->Exec($sql);
    }
    public function setActive($ids,$status=''){
        $sql="UPDATE `tbl_gallery` SET `isactive`='$status' WHERE `id` in ('$ids')";
        if($status=='')
            $sql="UPDATE `tbl_gallery` SET `isactive`=if(`isactive`=0,1,0) WHERE `id` in ('$ids')";
        return $this->objmysql->Exec($sql);
    }
    public function Order($arr_id,$arr_quan){
        $n=count($arr_id);
        for($i=0;$i<$n;$i++){
            $sql="UPDATE `tbl_gallery` SET `order`='".$arr_quan[$i]."' WHERE `id` = '".$arr_id[$i]."' ";
            $this->objmysql->Exec($sql);
        }
    }

    public function getListGallery($strwhere="", $path=""){
        $sql="SELECT * FROM `tbl_gallery` ".$strwhere."";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        while($rows=$objdata->Fetch_Assoc()){
            $arr=explode(', ', $rows['arr_path']);
            foreach($arr as $list):?>
                <div class="info-item">
                    <img src="<?php echo ROOTHOST.$path.$list;?>" width="150px">
                    <span class="del-item" data-id='<?php echo $rows['id'] ?>' value="<?php echo $list;?>"></span>
                </div>
           <?php endforeach;
        }
    }
}
?>