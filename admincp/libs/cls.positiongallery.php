<?php
class CLS_POSITIONGALLERY{
    private $pro=array(
        'ID'=>'-1',
        'positionContactId'=>'',
        'arrPath'=>'',
        'isActive'=>1,
        'Order'=>1
    );
    private $objmysql=NULL;
    public function CLS_POSITIONGALLERY(){
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
        $sql="SELECT * FROM `tbl_position_gallery` where 1=1 ".$where.' ORDER BY `name` '.$limit;
        return $this->objmysql->Query($sql);
    }
    public function Num_rows(){
        return $this->objmysql->Num_rows();
    }
    public function Fetch_Assoc(){
        return $this->objmysql->Fetch_Assoc();
    }

    public function getThumbAvatarBypositionContactId($positioncontact_id){
        $objdata=new CLS_MYSQL;
        $sql="SELECT `arr_path` FROM `tbl_position_gallery`  WHERE `positioncontact_id` = '$positioncontact_id' AND `arr_path` IS NOT NULL";
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


    public function listTable($strwhere="",$page=1){
        global $rowcount;
        $star=($page-1)*MAX_ROWS;
        $leng=MAX_ROWS;
        $sql="SELECT `tbl_position_gallery`.*, `tbl_position`.`name` FROM tbl_position_gallery LEFT JOIN tbl_position ON `tbl_position_gallery`.`positioncontact_id` = tbl_position.`id` WHERE 1=1 $strwhere ORDER BY `name` ASC LIMIT $star,$leng";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);  $i=0;
        while($rows=$objdata->Fetch_Assoc()){
            $i++;
            $ids=$rows['id'];
            $title=Substring(stripslashes($rows['name']),0,10);
            echo "<tr name=\"trow\">";
            echo "<td width=\"30\" align=\"center\">$i</td>";
            echo "<td width=\"30\" align=\"center\"><label>";
            echo "<input type=\"checkbox\" name=\"chk\" id=\"chk\" onclick=\"docheckonce('chk');\" value=\"$ids\" />";
            echo "</label></td>";
            echo "<td title=''>$title</td>";

            echo "<td align=\"center\">";

            echo "<a href=\"index.php?com=".COMS."&amp;task=active&amp;id=$ids\">";
            showIconFun('publish',$rows['isactive']);
            echo "</a>";

            echo "</td>";
            echo "<td align=\"center\">";

            echo "<a href=\"index.php?com=".COMS."&amp;task=edit&amp;id=$ids\">";
            showIconFun('edit','');
            echo "</a>";

            echo "</td>";
            echo "<td align=\"center\">";

            echo "<a href=\"javascript:detele_field('index.php?com=".COMS."&amp;task=delete&amp;id=$ids')\" >";
            showIconFun('delete','');
            echo "</a>";

            echo "</td>";
            echo "</tr>";
        }
    }

    public function Add_new(){
        $sql=" INSERT INTO `tbl_position_gallery`(`positioncontact_id`, `arr_path`, `isactive`, `order`) VALUES";
        $sql.="('".$this->positionContactId."', '".$this->arrPath."', '".$this->isActive."', '".$this->Order."')";
        return $this->objmysql->Exec($sql);
    }
    public function Update(){
        $sql = "UPDATE tbl_position_gallery SET `arr_path`=".$this->arrPath." WHERE positioncontact_id='".$this->positionContactId."'";
//        /var_dump($sql);
        return $this->objmysql->Exec($sql);
    }
    public function Delete($id){
        $sql="DELETE FROM `tbl_position_gallery` WHERE `positioncontact_id` in ('$id')";
        return $this->objmysql->Exec($sql);
    }
    public function setActive($ids,$status=''){
        $sql="UPDATE `tbl_position_gallery` SET `isactive`='$status' WHERE `id` in ('$ids')";
        if($status=='')
            $sql="UPDATE `tbl_position_gallery` SET `isactive`=if(`isactive`=0,1,0) WHERE `id` in ('$ids')";
        return $this->objmysql->Exec($sql);
    }
    public function Order($arr_id,$arr_quan){
        $n=count($arr_id);
        for($i=0;$i<$n;$i++){
            $sql="UPDATE `tbl_position_gallery` SET `order`='".$arr_quan[$i]."' WHERE `id` = '".$arr_id[$i]."' ";
            $this->objmysql->Exec($sql);
        }
    }

    /* get list combo box addnew*/
    function getListCbPositionType($parid=0, $getId=0){
        $sql="SELECT id, name FROM `tbl_position_gallery` WHERE `isactive`='1' ";
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

    public function getListGallery($strwhere="", $path=""){
        $sql="SELECT * FROM `tbl_position_gallery` ".$strwhere."";
        //var_dump($sql);
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        while($rows=$objdata->Fetch_Assoc()){
            $arr=explode(', ', $rows['arr_path']);
            foreach($arr as $list):?>
                <div class="info-item">
                    <img src="<?php echo ROOTHOST.$path.$list;?>" width="150px">
                    <span class="del-item" value="<?php echo $list;?>"></span>
                </div>
           <?php endforeach;
        }
    }
}
?>