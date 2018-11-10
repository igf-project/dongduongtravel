<?php
class CLS_ORDER{
	private $pro=array(	'Id'=>'0',
						'Cdate'=>'',
						'Cname'=>'',
						'Cphone'=>'',
						'Cemail'=>'',
						'ShipType'=>'',
						'Add'=>'',
						'Payment'=>'',
						'TotalMoney'=>'0',
						'SalerCode'=>'0',
						'Status'=>'0',
						'Cart'=>null
					);
	private $objmysql=null;
	public function CLS_ORDER(){
		$this->objmysql=new CLS_MYSQL;
	}
	public function __set($proname,$value){
		if(!isset($this->pro[$proname])){
			echo $proname. ' can not found in set method of class';
			return;
		}
		$this->pro[$proname]=$value;
	}
	public function __get($proname){
		if(!isset($this->pro[$proname])){
			echo $proname. ' can not found in get method of class';
			return;
		}
		return $this->pro[$proname];
	}
	public function getList($where=' ',$order=' ORDER BY cdate DESC ',$limit=' '){
		$sql="SELECT * FROM `tbl_order` ".$where.$order.$limit;
		return $this->objmysql->Query($sql);
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	public function Num_Buy($pro_id){
		$sql="SELECT SUM(`quantity`) as numbuy FROM `tbl_order_detail` WHERE `pro_id`=$pro_id";
		$objdata=new CLS_MYSQL;
		$objdata->Query($sql);
		$row=$objdata->Fetch_Assoc();
		return $row['numbuy']+0;
	}
	public function Num_Person_Buy($pro_id){
		$sql="SELECT * FROM `tbl_order` WHERE `id` in (SELECT `order_id` FROM `tbl_order_detail` WHERE `pro_id`=$pro_id)";
		return $this->objmysql->Query($sql);
	}
	public function Add_new(){
		$color=array();
		$obj_mysql=Connectserver('order');
		$sql="INSERT INTO `tbl_order`(`cdate`,`cname`,`cphone`,`cemail`,`shiptype`,`add`,`payment`,`totalmoney`,`salercode`,`status`) VALUES (
		'".$this->Cdate."','".$this->Cname."','".$this->Cphone."','".$this->Cemail."','".$this->ShipType."','".$this->Add."','".$this->Payment."','".$this->TotalMoney."','".$this->SalerCode."','".$this->Status."')";
		$obj_mysql->Exec('BEGIN');
		echo $sql;
		$result=$obj_mysql->Exec($sql);
		$order_id=$obj_mysql->LastInsertID();
		$sql="INSERT INTO `tbl_order_detail`(`order_id`,`pro_id`,`quantity`,`price`,`color`,`size`) VALUES ";
		$n=count($_SESSION['CART']);
		$objpro=new CLS_PRODUCTS;
		for($i=0;$i<$n;$i++){
			$code=$_SESSION['CART'][$i]['code'];
			$char=substr($code,0,2);
			$type='fashion';
			if($char=='TT') $type='fashion';
			if($char=='GD') $type='education';
			if($char=='MP') $type='makeup';
			if($char=='TH') $type='grocery';
			if($char=='QT') $type='gift';
			$obj_data=Connectserver($type);
			$sql1="SELECT `cur_price`,`thumb` FROM tbl_product WHERE `pro_code`='$code'";			
			$obj_data->Query($sql1);	
			$rs=$obj_data->Fetch_Assoc();
			if($_SESSION['CART'][$i]['color']=='') $color=explode(',',$rs['thumb']);
			else $color[0]=$_SESSION['CART'][$i]['color'];
			$sql.=" ('".$order_id."','".$_SESSION['CART'][$i]['code']."','".$_SESSION['CART'][$i]['quan']."','".$rs['cur_price']."','".$color[0]."','".$_SESSION['CART'][$i]['size']."')";
			if($i<$n-1) $sql.=" , ";
		}
		echo $sql;
		$result1=$obj_mysql->Exec($sql);
		
		if($result && $result1 ){
			$obj_mysql->Exec('COMMIT');
			return true;
		}else {
			$obj_mysql->Exec('ROLLBACK');
			return false;
		}
		unset($_SESSION['CART']);
	}
}
?>