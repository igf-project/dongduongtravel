<?php
class CLS_TOURTYPE{
    private $pro=array(
        'ID'=>'-1',
        'Name'=>'',
		'Code'=>'',
        'isActive'=>1
    );
    private $objmysql=NULL;
    public function CLS_TOURTYPE(){
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
    

    public function Num_rows(){
        return $this->objmysql->Num_rows();
    }
    public function Fetch_Assoc(){
        return $this->objmysql->Fetch_Assoc();
    }
	public function getList($where='', $limit=''){
        $sql="SELECT `tbl_tour_type`.`id`,
                    `tbl_tour_type`.`code`,
                     `tbl_tour_type`.`name`
           FROM `tbl_tour_type` ".$where.' ORDER BY `tbl_tour_type`.`name` '.$limit;
		//var_dump($sql);
		return $this->objmysql->Query($sql);
    }
	
	public function listTable($strwhere="", $limit=''){
        global $rowcount;
        $sql="SELECT
                `tbl_tour_type`.`id`,
                `tbl_tour_type`.`name`,
				`tbl_tour_type`.`isactive`
           FROM `tbl_tour_type`
           ".$strwhere." ORDER BY `tbl_tour_type`.`name`".$limit."";
        //var_dump($sql);
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        while($rows=$objdata->Fetch_Assoc()){   $rowcount++;
            $id=$rows['id'];
            $name=Substring($rows['name'],0,10);
            echo "<tr name='trow'>";
            echo "<td width='40px' align='center'>$rowcount</td>";

            echo "<td width=\"30\" align=\"center\"><label>";
            echo "<input type=\"checkbox\" name=\"chk\" id=\"chk\"   onclick=\"docheckonce('chk');\" value=\"$id\" />";
            echo "</label></td>";
            echo "<td>".$rows["name"]."</td>";
          
            echo "<td  align='center'>";
            echo "<a href='".ROOTHOST."member/tour-type/active/$id'>";
            showIconFun('publish',$rows["isactive"]);
            echo "</a>";
            echo "</td>";
            echo "<td  align='center'>";
            echo "<a href='".ROOTHOST."member/tour-type/cap-nhat/$id'>";
            showIconFun('edit','');
            echo "</a>";
            echo "</td>";
            echo "<td align='center'>";
            echo "<a class='delete-item' href='".ROOTHOST."member/tour-type/delete/".$id."' class='item-delete'>";
            showIconFun('delete','');
            echo "</a>";
            echo "</td>";
            echo "</tr>";

        }
    }
 
	 public function getLastId(){
        return $this->objmysql->LastInsertID();
    }
	
	public function Add_new(){
        $sql=" INSERT INTO `tbl_tour_type`(`name`, `code`, `isactive`) VALUES";
        $sql.="('".$this->Name."', '".$this->Code."', '".$this->isActive."')";
        return $this->objmysql->Exec($sql);
    }
    public function Update(){
        $sql = "UPDATE tbl_tour_type SET `name`='".$this->Name."', `code`='".$this->Code."' WHERE id='".$this->ID."'";
        return $this->objmysql->Exec($sql);
    }
    public function Delete($id){
        $sql="DELETE FROM `tbl_tour_type` WHERE `id` in ('$id')";
        return $this->objmysql->Exec($sql);
    }
    public function setActive($ids,$status=''){
        $sql="UPDATE `tbl_tour_type` SET `isactive`='$status' WHERE `id` in ('$ids')";
        if($status=='')
            $sql="UPDATE `tbl_tour_type` SET `isactive`=if(`isactive`=0,1,0) WHERE `id` in ('$ids')";
        return $this->objmysql->Exec($sql);
    }
	 /* public function Delete($id){
        //$sql="DELETE FROM `tbl_position` WHERE `id` in ('$id')";
        $sql="DELETE `tbl_tour_type`, `tbl_tour_type_content`
                FROM `tbl_tour_type`
                LEFT JOIN `tbl_tour_type_content`
                ON `tbl_tour_type`.`id` = `tbl_tour_type_content`.`location_id`
                WHERE `tbl_tour_type`.`id` in ('$id')";
         //var_dump($sql); die();
        return $this->objmysql->Exec($sql);
    } */
   
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