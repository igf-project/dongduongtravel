<?php
class CLS_BUY{
	var $pro=array(
		"ID"=>"",
		"UserName"=>"",
		"Code"=>"",
		"VP"=>"",
		"CDate"=>"",
		"Note"=>"",
	);
	private $objmysql=NULL;
	public function CLS_BUY(){
		$this->objmysql=new CLS_MYSQL;
	}
	// property set value
	public function __set($proname,$value){
		if(!isset($this->pro[$proname])){
			echo "Error: $proname";
			return;
		}
		$this->pro[$proname]=$value;
	}
	public function __get($proname){
		if(!isset($this->pro[$proname])){
			echo ("$proname is not a member" );
			return;
		}
		return $this->pro[$proname];
	}
	public function getList($where=""){
		$sql="SELECT * FROM `tbl_buy_histories` ".$where;
		return $this->objmysql->Query($sql);
	}
	public function getListUser ($name,$selected='') {
		$sql = "SELECT username,cmt FROM tbl_member_level WHERE isactive=1";
		$this->objmysql->Query($sql);
		$str = '<input list="list_'.$name.'" name="'.$name.'" id="'.$name.'" value="'.$selected.'"><datalist id="list_'.$name.'">';
		while($row = $this->Fetch_Assoc()) {
			$str.='<option value="'.$row['username'].'">'.'(CMT:'.$row['cmt'].'</option>';
		}
		$str.='</datalist>';
		return $str;
	}
	public function getListCode ($name,$user='',$selected='') {
		$sql = "SELECT code,name FROM tbl_accounts WHERE username='".$user."'";
		$this->objmysql->Query($sql);
		$str = '<input list="list_'.$name.'" name="'.$name.'" id="'.$name.'" value="'.$selected.'"><datalist id="list_'.$name.'">';
		while($row = $this->Fetch_Assoc()) {
			$str.='<option value="'.$row['name'].'-'.$row['code'].'">';
		}
		$str.='</datalist>';
		return $str;
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	public function Add_new(){
		$sql="INSERT INTO `tbl_buy_histories`(`username`,`code`,`vp`,`cdate`,`note`) VALUES ";
		$sql.=" ('".$this->UserName."','".$this->Code."','".$this->VP."','".$this->CDate."','".$this->Note."') ";
		return $this->objmysql->Query($sql);
	}
	public function Update(){
		$sql="UPDATE `tbl_buy_histories` SET `username`='".$this->UserName."',`code`='".$this->Code."',`vp`='".$this->VP."',`cdate`='".$this->CDate."',`note`='".$this->Note."' ";
		$sql.=" WHERE `id`='".$this->ID."'";
		return $this->objmysql->Query($sql);
	}
	public function Update_trietkhau(){
		
	}
	public function Delete($id){
		$sql="DELETE FROM `tbl_buy_histories` WHERE `id` in ('$id')";
		return $this->objmysql->Exec($sql);
	}
}
?>