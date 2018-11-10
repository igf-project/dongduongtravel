<?php
class CLS_BANNER{
	private $pro=array( 'ID'=>1,
						'Title'=>'',
						'Thumb'=>'',
						'Link'=>'',
						'isActive'=>1);
	private $objmysql=NULL;
	public function CLS_BANNER(){
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
		$sql="SELECT * FROM `tbl_banner` ".$where;
		return $this->objmysql->Query($sql);
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	function listTable($strwhere=""){
		$sql="SELECT * FROM tbl_banner WHERE 1=1 ".$strwhere ;
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		$rowcount=0;
		while($rows=$objdata->Fetch_Assoc()){	
			$rowcount++;
			$id=$rows['id'];
			$name=Substring($rows['title'],0,10);
			$Link=$rows['link'];
			echo "<tr name='trow'>";
			echo "<td width='30' align='center'>$rowcount</td>";
			echo "<td width='30' align='center'><label>";
			echo "<input type='checkbox' name='chk' id='chk' onclick='docheckonce(\"chk\");' value='$id' />";
			echo "</label></td>";
			echo "<td nowrap='nowrap' title='$name'>$name</td>";
			echo "<td nowrap='nowrap' title='$name'>$Link</td>";
			echo "<td width='30' align='center'>";
				echo "<a href='index.php?com=".COMS."&amp;task=active&amp;id=$id'>";
				showIconFun('publish',$rows["isactive"]);
				echo "</a>";
			echo "</td>";
			echo "<td width='30' align='center'>";
				echo "<a href='index.php?com=".COMS."&amp;task=edit&amp;id=$id'>";
				showIconFun('edit','');
				echo "</a>";
			echo "</td>";
			echo "<td width='30' align='center'>";
				echo "<a href='javascript:detele_field(\"index.php?com=".COMS."&amp;task=delete&amp;id=$id\")'>";
				showIconFun('delete','');
				echo "</a>";
			echo "</td>";
		  	echo "</tr>";
		}
	}
	public function getNameById($id){
		$objdata=new CLS_MYSQL;
		$sql="SELECT `title` FROM `tbl_banner`  WHERE isactive=1 AND `id` = '$id'"; 
		$objdata->Query($sql);
		$row=$objdata->Fetch_Assoc();
		return $row['name'];
	}
	function Add_new(){
		$sql=" INSERT INTO `tbl_banner`(`title`,`thumb`,`link`,`isactive`) VALUES";
		$sql.="('".$this->Title."','".$this->Thumb."','".$this->Link."','".$this->isActive."')";
		// echo $sql;die();
		return $this->objmysql->Exec($sql);
	}
	function Update(){
		$sql = "UPDATE `tbl_banner` SET `title`='".$this->Title."',`thumb`=N'".$this->Thumb."',`link`=N'".$this->Link."',`isactive`='".$this->pro["isActive"]."' WHERE `id`='".$this->ID."'";
		return $this->objmysql->Exec($sql);
	}
	function setActive($ids,$status=''){
		$sql="UPDATE `tbl_banner` SET `isactive`='$status' WHERE `id` in ('$ids')";
		if($status=='')
			$sql="UPDATE `tbl_banner` SET `isactive`=if(`isactive`=1,0,1) WHERE `id` in ('$ids')";
		return $this->objmysql->Exec($sql);
	}
	function Delete($id){
		$sql="DELETE FROM `tbl_banner` WHERE `id` in ('$id')";
		return $this->objmysql->Exec($sql);
	}
}
?>