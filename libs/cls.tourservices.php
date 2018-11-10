<?php
class CLS_TOURSERVICES{
    private $pro=array(
        'ID'=>'-1',
        'TourId'=>'',
		'ServiceTypeId'=>'',
		'ServerId'=>'',
		'Name'=>'',
		'Content'=>'',
		'Quantity'=>'',
		'Price'=>'',
		'Type'=>''
    );
    private $objmysql=NULL;
    public function CLS_TOURSERVICES(){
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
        $sql="SELECT * 
           FROM `tbl_tour_services` ".$where.' ORDER BY `tbl_tour_services`.`name` '.$limit;
		//var_dump($sql);
		return $this->objmysql->Query($sql);
    }
	
	public function listTable($strwhere="", $limit='', $ajax=''){
        global $rowcount;
        $sql="SELECT *
           FROM `tbl_tour_services`
           ".$strwhere." ORDER BY `tbl_tour_services`.`id` DESC ".$limit."";
        //var_dump($sql);
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        while($rows=$objdata->Fetch_Assoc()){   $rowcount++;
            $id=$rows['id'];
            $name=Substring($rows['name'],0,10);
			 $content=Substring($rows['content'],0,15);
            echo "<tr name='trow'>";
            echo "<td width='40px' align='center'>$rowcount</td>";
			if(!$ajax):
				echo "<td width=\"30\" align=\"center\"><label>";
				echo "<input type=\"checkbox\" name=\"chk\" id=\"chk\"   onclick=\"docheckonce('chk');\" value=\"$id\" />";
				echo "</label></td>";
			endif;
           
           echo "<td>".$name."</td>";
           
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
	
	// lấy danh sách dịch vụ theo tour
	public function getListItem($strwhere="", $limit=''){
        $sql="SELECT `tbl_tour_services`.`id`, `tbl_tour_services`.`name`
           FROM `tbl_tour_services`
           ".$strwhere." ".$limit."";
        //var_dump($sql);
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        while($rows=$objdata->Fetch_Assoc()){
			$name=Substring($rows['name'], 0 , 10);
			?>
			<span class="list"><?php echo $name;?></span>
		<?php
		}
	}
	
	
	
	public function listAjax($strwhere="", $limit=''){
        global $rowcount;
        $sql="SELECT *
           FROM `tbl_tour_services`
           ".$strwhere." ORDER BY `tbl_tour_services`.`id` DESC ".$limit."";
        //var_dump($sql);
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        while($rows=$objdata->Fetch_Assoc()){   $rowcount++;
            $id=$rows['id'];
            $name=Substring($rows['name'],0,10);
			 $content=Substring($rows['content'],0,15);
             echo "<tr name='trow' id='tr-".$id."'>";
            echo "<td width='40px' align='center'>$rowcount</td>";
			
            echo "<td>".$name."</td>";
          
           
             echo "<td  align='center'>";
			echo "<span class='actEdit' tourId=".$rows['tour_id']." value=".$id.">";
			showIconFun('edit','');
			echo "</span>";
			echo "</td>";
			echo "<td align='center'>";
			echo "<span class='actAjax' tourId=".$rows['tour_id']." act='del'  value=".$id.">";
			showIconFun('delete','');
			echo "</span>";
			echo "</td>";
            echo "</tr>";

        }
    }
	
 
	 public function getLastId(){
        return $this->objmysql->LastInsertID();
    }
	
	public function Add_new(){
        $sql=" INSERT INTO `tbl_tour_services`(`tour_id`, `services_type_id`, `server_id`, `name`, `content`, `price`, `type`) VALUES";
        $sql.="('".$this->TourId."', '".$this->ServiceTypeId."', '".$this->ServerId."', '".$this->Name."', '".$this->Content."', '".$this->Price."', '".$this->Type."')";
       echo $sql;
	   return $this->objmysql->Query($sql);
    }
    public function Update(){
        $sql = "UPDATE tbl_tour_services SET `services_type_id`='".$this->ServiceTypeId."', `server_id`='".$this->ServerId."',`name`='".$this->Name."', `content`='".$this->Content."', `price`='".$this->Price."',`quantity`='".$this->Quantity."' WHERE id='".$this->ID."'";
		return $this->objmysql->Query($sql);
    }
    public function Delete($id){
        $sql="DELETE FROM `tbl_tour_services` WHERE `id` in ('$id')";
        return $this->objmysql->Query($sql);
    }
  
	 /* public function Delete($id){
        //$sql="DELETE FROM `tbl_position` WHERE `id` in ('$id')";
        $sql="DELETE `tbl_tour_services`, `tbl_tour_services_content`
                FROM `tbl_tour_services`
                LEFT JOIN `tbl_tour_services_content`
                ON `tbl_tour_services`.`id` = `tbl_tour_services_content`.`location_id`
                WHERE `tbl_tour_services`.`id` in ('$id')";
         //var_dump($sql); die();
        return $this->objmysql->Exec($sql);
    } */
   
/* get ID by Code */
	 public function getIdAndNameByCode($id){
        $sql="SELECT `tbl_tour_services`.`id`,`tbl_tour_services`.`title` FROM `tbl_tour_services` WHERE `tbl_tour_services`.`code` ='$id'";
		 $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        $row=$objdata->Fetch_Assoc();
		return $row;
    }
	
    /* combo box*/
    function getListCbTourtype($getId='', $swhere=''){
        $sql="SELECT id, name FROM tbl_tour_services WHERE ".$swhere." `isactive`='1' ORDER BY `title` ASC";
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
        $sql="SELECT `title` FROM `tbl_tour_services` WHERE `isactive`=0 AND `ID` = '$cat_id'";
        $objdata->Query($sql);
        $row=$objdata->Fetch_Assoc();
        return $row['name'];
    }
}
?>