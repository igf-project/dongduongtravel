<?php
class CLS_TOURPROGRAM{
    private $pro=array(
        'ID'=>'-1',
		'TourId'=>'',
		'NumDay'=>'',
		'Title'=>'',
		'Content'=>''
       
    );
    private $objmysql=NULL;
    public function CLS_TOURPROGRAM(){
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
        $sql="SELECT * FROM `tbl_tour_program` ".$where.' ORDER BY `tbl_tour_program`.`title` '.$limit;
		//var_dump($sql);
		return $this->objmysql->Query($sql);
    }
	
	public function listTable($strwhere="", $limit='', $ajax=''){
        global $rowcount;
        $sql="SELECT * FROM `tbl_tour_program` ".$strwhere." ORDER BY `tbl_tour_program`.`id` DESC ".$limit."";
        //var_dump($sql);
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        while($rows=$objdata->Fetch_Assoc()){   $rowcount++;
            $id=$rows['id'];
            $name=Substring($rows['title'],0,10);
			 $content=Substring($rows['content'],0,15);
            echo "<tr name='trow'>";
            echo "<td width='40px' align='center'>$rowcount</td>";
			if(!$ajax):
				echo "<td width=\"30\" align=\"center\"><label>";
				echo "<input type=\"checkbox\" name=\"chk\" id=\"chk\"   onclick=\"docheckonce('chk');\" value=\"$id\" />";
				echo "</label></td>";
			endif;
            echo "<td>".$rows['num_day']."</td>";
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
	
	// lấy danh sách chương trình theo tour
	public function getListItem($strwhere="", $limit=''){
        $sql="SELECT `tbl_tour_program`.`id`, `tbl_tour_program`.`num_day`, `tbl_tour_program`.`title`
           FROM `tbl_tour_program`
           ".$strwhere." ".$limit."";
        //var_dump($sql);
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        while($rows=$objdata->Fetch_Assoc()){
			$title=Substring($rows['title'], 0 , 10);
			?>
			<span class="list"><?php echo $rows['num_day'];?>: <?php echo $title;?></span>
		<?php
		}
	}
	public function listAjax($strwhere="", $limit=''){
        global $rowcount;
        $sql="SELECT *
           FROM `tbl_tour_program`
           ".$strwhere." ORDER BY `tbl_tour_program`.`id` DESC ".$limit."";
        //var_dump($sql);
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        while($rows=$objdata->Fetch_Assoc()){   $rowcount++;
            $id=$rows['id'];
            $name=Substring($rows['title'],0,10);
			 $content=Substring($rows['content'],0,15);
             echo "<tr name='trow' id='tr-".$id."'>";
            echo "<td width='40px' align='center'>$rowcount</td>";
			
            echo "<td>".$rows['num_day']."</td>";
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
        $sql=" INSERT INTO `tbl_tour_program`(`tour_id`, `num_day`, `title`, `content`) VALUES";
        $sql.="('".$this->TourId."', '".$this->NumDay."', '".$this->Title."', '".$this->Content."')";
        return $this->objmysql->Query($sql);
    }
    public function Update(){
        $sql = "UPDATE tbl_tour_program SET `num_day`='".$this->NumDay."', `title`='".$this->Title."', `content`='".$this->Content."' WHERE id='".$this->ID."'";
		return $this->objmysql->Query($sql);
    }
    public function Delete($id){
        $sql="DELETE FROM `tbl_tour_program` WHERE `id` in ('$id')";
        return $this->objmysql->Query($sql);
    }
  
	 /* public function Delete($id){
        //$sql="DELETE FROM `tbl_position` WHERE `id` in ('$id')";
        $sql="DELETE `tbl_tour_program`, `tbl_tour_program_content`
                FROM `tbl_tour_program`
                LEFT JOIN `tbl_tour_program_content`
                ON `tbl_tour_program`.`id` = `tbl_tour_program_content`.`location_id`
                WHERE `tbl_tour_program`.`id` in ('$id')";
         //var_dump($sql); die();
        return $this->objmysql->Exec($sql);
    } */
   

    public function getNameById($cat_id){
        $objdata=new CLS_MYSQL;
        $sql="SELECT `title` FROM `tbl_tour_program` WHERE `isactive`=0 AND `ID` = '$cat_id'";
        $objdata->Query($sql);
        $row=$objdata->Fetch_Assoc();
        return $row['name'];
    }
}
?>