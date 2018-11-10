<?php
ini_set('display_errors', 1);
class CLS_SLIDER{
	private $pro=array(
		'ID'=>'-1',
		'Slogan'=>'',
		'Intro'=>'',
		'Link'=>'',
		'Image'=>'',
		'Type'=>'0',
		'Order'=>'0',
		'isActive'=>'1');
	private $objmysql;
	public function CLS_SLIDER(){
		$this->objmysql=new CLS_MYSQL;
	}
	// property set value
	public function __set($proname,$value){
		if(!isset($this->pro[$proname])){
			echo ($proname.' is not member of CLS_PRODUCTS Class' );
			return;
		}
		$this->pro[$proname]=$value;
	}
	public function __get($proname){
		if(!isset($this->pro[$proname])){
			echo ($proname.' is not member of CLS_PRODUCTS Class' );
			return '';
		}
		return $this->pro[$proname];
	}
	public function getList($strwhere=""){
		$sql=" SELECT * FROM tbl_slider $strwhere";
		return $this->objmysql->Query($sql);
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	
	public function Add_new(){
		$sql="INSERT INTO `tbl_slider` ( `slogan`, `intro`, `type`,`link`,`image`, `isactive`) VALUES ";
		$sql.="('".$this->Slogan."','".$this->Intro."','".$this->Type."','".$this->Link."','".$this->Image."','".$this->isActive."')";
		// echo $sql; die();
		return $this->objmysql->Exec($sql);
	}
	public function Update(){
		$sql="UPDATE `tbl_slider` SET  
		`slogan`='".$this->Slogan."',
		`intro`='".$this->Intro."',
		`image`='".$this->Image."',
		`link`='".$this->Link."'
		WHERE `id`='".$this->ID."'";
		// echo $sql; die();
		return $this->objmysql->Exec($sql);
	}
	public function Delete($ids){
		$sql="DELETE FROM `tbl_slider` WHERE `id` in ('$ids')";
		return $this->objmysql->Exec($sql);
	}
	public function setHot($ids){
		$sql="UPDATE `tbl_slider` SET `ishot`=if(`ishot`=1,0,1) WHERE `id` in ('$ids')";
		return $this->objmysql->Exec($sql);
	}
	public function setActive($ids,$status=''){
		$sql="UPDATE `tbl_slider` SET `isactive`='$status' WHERE `id` in ('$ids')";
		if($status=='')
			$sql="UPDATE `tbl_slider` SET `isactive`=if(`isactive`=1,0,1) WHERE `id` in ('$ids')";
		return $this->objmysql->Exec($sql);
	}
	public function Order($ids,$order){
		$sql="UPDATE tbl_slider SET `order`='".$order."' WHERE `id`='".$ids."'";	
		return $this->objmysql->Exec($sql);
	}
	public function Orders($arids,$arods){
		for($i=0;$i<count($arids);$i++){
			$this->Order($arids[$i],$arods[$i]);
		}
	}
	/* combo box*/
	function getListCbItem($getId='', $swhere='', $arrId=''){
		$sql="SELECT id, name, code FROM tbl_slider WHERE ".$swhere." `isactive`='1' ORDER BY `name` ASC";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		if($objdata->Num_rows()<=0) return;
		while($rows=$objdata->Fetch_Assoc()){
			$id=$rows['id'];
			$name=$rows['name'];
			if(!$arrId){
				?>
				<option value='<?php echo $rows['id'];?>' <?php if(isset($getId) && $id==$getId) echo "selected";?>><?php echo $name;?></option>
				<?php
			}else{?>
			<option value='<?php echo $id;?>' <?php if(isset($arrId) and in_array($id, $arrId)) echo "selected";?>><?php echo $name;?></option>
			<?php
		}
	}
}
}
?>