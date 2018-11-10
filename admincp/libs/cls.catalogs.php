<?php
class CLS_CATALOGS{
	private $pro=array( 'ID'=>'-1',
		'Par_id'=>'',
		'Name'=>'',
		'Code'=>'',
		'Thumb'=>'',
		'Intro'=>'',
		'Order'=>'',
		'isActive'=>1);
	private $objmysql=NULL;
	public function CLS_CATALOGS(){
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
	public function getList($where='',$limit=''){
		$sql="SELECT * FROM `tbl_catalog` ".$where.' ORDER BY `name` '.$limit;
		return $this->objmysql->Query($sql);
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	public function getListCate($parid=0,$level=0){
		$sql="SELECT cat_id,par_id,name FROM tbl_catalog WHERE `par_id`='$parid' AND `isactive`='1' ";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		$char="";
		if($level!=0){
            for($i=0;$i<$level;$i++)
                $char.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; 
            $char.="|---";
        }
		if($objdata->Num_rows()<=0) return;
		while($rows=$objdata->Fetch_Assoc()){
			$id=$rows['cat_id'];
			$parid=$rows['par_id'];
			$name=$rows['name'];
			echo "<option value='$id'>$char $name</option>";
			$nextlevel=$level+1;
			$this->getListCate($id,$nextlevel);
		}
	}
	
	public function getNameById($id){
		$objdata=new CLS_MYSQL;
		$sql="SELECT `name` FROM `tbl_catalog`  WHERE isactive=1 AND `cat_id` = '$id'"; 
		$objdata->Query($sql);
		$row=$objdata->Fetch_Assoc();
		return $row['name'];
	}
	public function Add_new(){
        $sql=" INSERT INTO `tbl_catalog`(`par_id`,`code`, `name`, `intro`, `isactive`) VALUES";
        $sql.="('".$this->Par_id."', '".$this->Code."', '".$this->Name."','".$this->Intro."','".$this->isActive."')";
        return $this->objmysql->Exec($sql);
    }
    public function Update(){
        $sql = "UPDATE tbl_catalog SET 
        par_id='".$this->Par_id."', 
        intro='".$this->Intro."',
        `name`='".$this->Name."', 
        `code`='".$this->Code."' 
        WHERE cat_id='".$this->ID."'";
        return $this->objmysql->Exec($sql);
    }
	public function Delete($id){
		$sql="DELETE FROM `tbl_catalog` WHERE `cat_id` in ('$id')";
		return $this->objmysql->Exec($sql);
	}
	public function setActive($ids,$status=''){
		$sql="UPDATE `tbl_catalog` SET `isactive`='$status' WHERE `cat_id` in ('$ids')";
		if($status=='')
			$sql="UPDATE `tbl_catalog` SET `isactive`=if(`isactive`=1,0,1) WHERE `cat_id` in ('$ids')";
		return $this->objmysql->Exec($sql);
	}
	public function Order($arr_id,$arr_quan){
		$n=count($arr_id);
		for($i=0;$i<$n;$i++){
			$sql="UPDATE `tbl_catalog` SET `order`='".$arr_quan[$i]."' WHERE `cat_id` = '".$arr_id[$i]."' ";
			$this->objmysql->Exec($sql);
		}
	}
	/* combo box*/
	function getListCbItem($getId='', $swhere='', $arrId=''){
		$sql="SELECT cat_id, name, code FROM tbl_catalog  WHERE 1=1 ".$swhere." AND `isactive`='1' ORDER BY `name` ASC";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		if($objdata->Num_rows()<=0){
			echo '<option value="">-- Chọn nhóm sản phẩm --</option>';
			return;
		}
		while($rows=$objdata->Fetch_Assoc()){
			$id=$rows['cat_id'];
			$name=$rows['name'];
			if(!$arrId){
				?>
				<option value='<?php echo $rows['cat_id'];?>' <?php if(isset($getId) && $id==$getId) echo "selected";?>><?php echo $name;?></option>
				<?php
			}else{?>
			<option value='<?php echo $id;?>' <?php if(isset($arrId) and in_array($id, $arrId)) echo "selected";?>><?php echo $name;?></option>
			<?php
		}
		?>
		<?php
	}
}
}
?>