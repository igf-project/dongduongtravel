<?php
class CLS_GMEM{
    private $pro=array(
        'GmemId'=>'-1',
        'parId'=>'',
		'Name'=>'',
        'Intro'=>'',
        'isActive'=>1
    );
    private $objmysql=NULL;
    public function CLS_GMEM(){
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
        $sql="SELECT `tbl_gmem`.`gmem_id`,
                     `tbl_gmem`.`name`,
                     `tbl_gmem`.`intro`,
                     `tbl_gmem`.`isactive`
           FROM `tbl_gmem` ".$where.' ORDER BY `tbl_gmem`.`name` '.$limit;
		//var_dump($sql);
		return $this->objmysql->Query($sql);
    }
	public function getListGmem($strWhere){
		$sql="SELECT * 
		FROM `tbl_account_gmem` $strWhere";
		return $this->objmysql->Query($sql);
	}
    public function Num_rows(){
        return $this->objmysql->Num_rows();
    }
    public function Fetch_Assoc(){
        return $this->objmysql->Fetch_Assoc();
    }
   
	public function listTable($strwhere="", $limit){
        global $rowcount;
         $sql="SELECT `tbl_gmem`.`gmem_id`,
                     `tbl_gmem`.`name`,
                     `tbl_gmem`.`intro`,
                     `tbl_gmem`.`isactive`
           FROM `tbl_gmem` ".$where.' ORDER BY `tbl_gmem`.`name` '.$limit;
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
            echo "<a href='".ROOTHOST."member/dia-danh/active/$id'>";
            showIconFun('publish',$rows["isactive"]);
            echo "</a>";
            echo "</td>";
            echo "<td  align='center'>";
            echo "<a href='".ROOTHOST."member/dia-danh/cap-nhat/$id'>";
            showIconFun('edit','');
            echo "</a>";
            echo "</td>";
            echo "<td align='center'>";
            echo "<a class='delete-item' href='".ROOTHOST."member/dia-danh/delete/".$id."' class='item-delete'>";
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
		$objdata=new CLS_MYSQL;
		$objdata->Query("BEGIN");
        $sql=" INSERT INTO `tbl_gmem`(`par_id`,`name`, `intro`, `isactive`) VALUES";
        $sql.="('".$this->parId."', '".$this->Name."', '".$this->Intro."','".$this->isActive."')";
		$result=$objdata->Exec($sql);
			$objdata->Query('COMMIT');
    }
    public function Update(){
		$objdata=new CLS_MYSQL;
		$objdata->Query("BEGIN");
        $sql = "UPDATE tbl_gmem SET par_id='".$this->parId."', `name`='".$this->Name."', `intro`='".$this->Intro."' WHERE id='".$this->GmemId."'";
      // var_dump($sql);
		$objdata->Query('COMMIT');
		
    }
  
    /* combo box*/
    function getListCbGmem($swhere='', $getId=''){
        $sql="SELECT gmem_id, name FROM tbl_gmem WHERE ".$swhere." `isactive`='1' ORDER BY `name` ASC";
       
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        if($objdata->Num_rows()<=0) return;
        while($rows=$objdata->Fetch_Assoc()){
            $id=$rows['gmem_id'];
            $name=$rows['name'];
			?>
			<option value='<?php echo $rows['gmem_id'];?>' <?php if(isset($getId) && $id==$getId) echo "selected";?>><?php echo $name;?></option>

        <?php
        }
    }
/* get ID by Code */
	 public function getIdAndNameByCode($id){
        $sql="SELECT `tbl_gmem`.`id`,`tbl_gmem`.`name` FROM `tbl_gmem` WHERE `tbl_gmem`.`code` ='$id'";
		 $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        $row=$objdata->Fetch_Assoc();
		return $row;
    }
	
   
  public function setActive($ids,$status=''){
        $sql="UPDATE `tbl_gmem` SET `isactive`='$status' WHERE `id` in ('$ids')";
        if($status=='')
            $sql="UPDATE `tbl_gmem` SET `isactive`=if(`isactive`=0,1,0) WHERE `id` in ('$ids')";
        return $this->objmysql->Exec($sql);
    }
  public function Delete($id){
        //$sql="DELETE FROM `tbl_position` WHERE `id` in ('$id')";
        $sql="DELETE `tbl_gmem`, `tbl_gmem_content`
                FROM `tbl_gmem`
                LEFT JOIN `tbl_gmem_content`
                ON `tbl_gmem`.`id` = `tbl_gmem_content`.`location_id`
                WHERE `tbl_gmem`.`id` in ('$id')";
         //var_dump($sql); die();
        return $this->objmysql->Exec($sql);
    }

}
?>