<?php
class CLS_TOURPERSON{
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
		'Type'=>'');
	private $objmysql;
	public function CLS_TOURPERSON(){
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
		$sql="SELECT * FROM `tbl_tour_person`".$strwhere."";
        //var_dump($sql);
		return $this->objmysql->Query($sql);
	}

	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	

	public function Add_new(){
		$sql="INSERT INTO tbl_tour_person (`tour_id`, `person_type_id`, `fullname`, `cmt`,`email`, `phone`,`address`, `number_person`, `number_child14`, `number_child59`,`date`, `type`) VALUES ";
		$sql.="('".$this->TourId."', '".$this->PersonTypeId."', '".$this->Fullname."', '".$this->Cmt."', '".$this->Email."', '".$this->Phone."', '".$this->Address."', '".$this->NumberPerson."', '".$this->NumberChild14."', '".$this->NumberChild59."','".time()."', '".$this->Type."')";
		// var_dump($sql);
		return $this->objmysql->Query($sql);
	}
	public function Update(){
		$sql = "UPDATE tbl_tour_person SET `tour_id`='".$this->TourId."', 
		`person_type_id`='".$this->PersonTypeId."', 
		`fullname`='".$this->Fullname."',
		`cmt`='".$this->Cmt."',
		`email`='".$this->Email."',
		`phone`='".$this->Phone."',
		`address`='".$this->Address."'
		WHERE id='".$this->ID."'";
		// var_dump($sql);
		return $this->objmysql->Query($sql);
	}
	public function Delete($id){
		$sql="DELETE FROM `tbl_tour_person` WHERE `id` in ('$id')";
		return $this->objmysql->Query($sql);
	}
}
?>
