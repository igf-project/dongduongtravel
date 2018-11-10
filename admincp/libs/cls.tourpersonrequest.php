<?php
class CLS_TOURPERSONREQUEST{
	private $pro=array(
		'ID'=>'1',
		'TourId'=>'',
		'PersonTypeId'=>'',
		'Fullname'=>'',
		'Cmt'=>'',
		'Email'=>'',
		'Phone'=>'',
		'Address'=>'',
		'NumberPerson'=>'',
		'NumberChild14'=>'',
		'NumberChild59'=>'',
		'TimeStart'=>'',
		'NumDay'=>'',
		'NumNight'=>'',
		'WhereStart'=>'',
		'Position'=>'',
		'RankHotel'=>'',
		'Other'=>'',
		'Date'=>'');
	private $objmysql;
	public function CLS_TOURPERSONREQUEST(){
		$this->objmysql=new CLS_MYSQL;
	}
	// property set value
	public function __set($proname,$value){
		if(!isset($this->pro[$proname])){
			echo ($proname.' is not member of CLS_CONTENTS Class' );
			return;
		}
		$this->pro[$proname]=$value;
	}
	public function __get($proname){
		if(!isset($this->pro[$proname])){
			echo ($proname.' is not member of CLS_CONTENTS Class' );
			return '';
		}
		return $this->pro[$proname];
	}
	public function getList($strwhere=""){
		$sql="SELECT * FROM `tbl_tour_person_request`".$strwhere."";
        //var_dump($sql);
		return $this->objmysql->Query($sql);
	}

	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	

	
	
	public function listTable($strwhere="", $limit){
		$sql="SELECT *
		FROM `tbl_tour_person_request`
		$strwhere ORDER BY `tbl_tour_person_request`.`id` ASC $limit";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		$i=0;
		while($rows=$objdata->Fetch_Assoc())
			{	$i++;
				$ids=$rows['id'];
				$phone=stripslashes($rows['phone']);
				$time_start=$rows['time_start'];
				$time_day=$rows['num_day']." ngày ".$rows['num_night']." đêm";
				$position=Substring(stripslashes($rows['position']),0,10);
				$fullname=Substring(stripslashes($rows['fullname']),0,10);
				echo "<tr name=\"trow\">";
				echo "<td width=\"30\" align=\"center\">$i</td>";
				echo "<td width=\"30\" align=\"center\"><label>";
				echo "<input type=\"checkbox\" name=\"chk\" id=\"chk\" 	 onclick=\"docheckonce('chk');\" value=\"$ids\" />";
				echo "</label></td>";
				echo "<td>$fullname</td>";
				echo "<td>$position</td>";
				echo "<td>$time_start</td>";
				echo "<td>$time_day</td>";
				echo "<td>$phone</td>";
			/*echo "<td align=\"center\">";
			echo "<a href='".ROOTHOST."member/tour/active/$ids'>";
			showIconFun('publish',$rows['isactive']);
			echo "</a>";
			echo "</td>";*/

			/*echo "<td align=\"center\">";
			echo "<a href='".ROOTHOST."member/tour/cap-nhat/$ids'>";
			showIconFun('edit','');
			echo "</a>";
			echo "</td>";*/
			echo "<td align=\"center\">";
			echo "<span class='show-detail' value='".$ids."'>Chi tiết</span>";
			echo "</td>";
			echo "<td align=\"center\">";
			echo "<a class='delete-item' href='".ROOTHOST."member/khach-hang-dat-tour-theo-yeu-cau/delete/$ids'>";
			showIconFun('delete','');
			echo "</a>";
			
			echo "</td>";
			echo "</tr>";
		}
	}

	public function Add_new(){
		$sql="INSERT INTO tbl_tour_person_request (`tour_id`, `person_type_id`, `fullname`, `cmt`,`email`, `phone`,`address`, `number_person`, `number_child14`, `number_child59`, `time_start`, `num_day`, `num_night`, `where_start`, `position`, `rank_hotel`,`other`, `date`) VALUES ";
		$sql.="('".$this->TourId."', '".$this->PersonTypeId."', '".$this->Fullname."', '".$this->Cmt."', '".$this->Email."', '".$this->Phone."', '".$this->Address."', '".$this->NumberPerson."', '".$this->NumberChild14."', '".$this->NumberChild59."', '".$this->TimeStart."', '".$this->NumDay."', '".$this->NumNight."', '".$this->WhereStart."', '".$this->Position."', '".$this->RankHotel."', '".$this->Other."', '".time()."')";
		var_dump($sql);
		// return $this->objmysql->Query($sql);
	}
	public function Update(){
		$sql = "UPDATE tbl_tour_person_request SET `tour_id`='".$this->TourId."', 
		`person_type_id`='".$this->PersonTypeId."', 
		`fullname`='".$this->Fullname."',
		`cmt`='".$this->Cmt."',
		`email`='".$this->Email."',
		`phone`='".$this->Phone."',
		`address`='".$this->Address."'
		WHERE id='".$this->ID."'";
		var_dump($sql); die();
		// return $this->objmysql->Query($sql);
	}
	public function Delete($id){
		$sql="DELETE FROM `tbl_tour_person_request` WHERE `id` in ('$id')";
		return $this->objmysql->Query($sql);
	}

	public function getLastId(){
		return $this->objmysql->LastInsertID();
	}
	// lấy danh sách liên hệ theo tour
	public function getListItem($strwhere="", $limit=''){
		$sql="SELECT `tbl_tour_person_request`.`id`, `tbl_tour_person_request`.`fullname`, `tbl_tour_person_request`.`phone`, `tbl_tour_person_request`.`email`
		FROM `tbl_tour_person_request`
		".$strwhere." ".$limit."";
        //var_dump($sql);
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		while($rows=$objdata->Fetch_Assoc()){
			?>
			<span class="list-per">
				<span class="lb-title">Họ và tên: </span><?php echo $rows['fullname'];?> - 
				<span class="lb-title">Phone: </span><?php echo $rows['phone'];?> - 
				<span class="lb-title">Email: </span><?php echo $rows['email'];?>
			</span>
			<?php
		}
	}

	
}
?>
