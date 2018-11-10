<?php
class CLS_PARTNER{	
	private $objmysql=null;
	public function CLS_PARTNER(){
		$this->objmysql=new CLS_MYSQL;
	}
	public function __set($proname,$value){
		if(!isset($this->pro[$proname])){
			echo ("Can not found $proname member");
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
	public function getList($where=' ',$limit=' '){
		$sql="SELECT * FROM `tbl_partners` WHERE `isactive`=1 ".$where.$limit;
		return $this->objmysql->Query($sql);
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	public function getNameById($id){
		$sql="SELECT `company_name` FROM `tbl_partners` WHERE `isactive`=1 AND `partner_id`=$id";
		$objmysql=new CLS_MYSQL;
		$objmysql->Query($sql);
		$row=$objmysql->Fetch_Assoc();
		return $row['company_name'];
	}
}
?>