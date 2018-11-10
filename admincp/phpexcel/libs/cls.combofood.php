<?php
ini_set('display_errors', 1);
class CLS_COMBOFOOD{
	private $pro=array(
			'ID'=>'-1',
			'Food_ID'=>'0',
			'Name'=>'',
			'Code'=>'',
			'Cdate'=>'',
			'isActive'=>'1');
	private $objmysql;
	public function CLS_COMBOFOOD(){
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
		$sql=" SELECT * FROM tbl_food_menu $strwhere";
		return $this->objmysql->Query($sql);
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	public function listTable($strwhere="",$page){
		$star=($page-1)*MAX_ROWS;
		$leng=MAX_ROWS;
		$sql="	SELECT tbl_food_menu.* FROM tbl_food_menu $strwhere ORDER BY `cdate` DESC, id LIMIT $star,$leng";
		//echo $sql;
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);	$i=0;
		while($rows=$objdata->Fetch_Assoc())
		{	$i++;
			$ids=$rows['id'];
			$title=Substring(stripslashes($rows['name']),0,10);
            $count=count(explode(',', $rows['food_id']));
			echo "<tr name=\"trow\">";
			echo "<td width=\"30\" align=\"center\">$i</td>";
			echo "<td width=\"30\" align=\"center\"><label>";
			echo "<input type=\"checkbox\" name=\"chk\" id=\"chk\" 	 onclick=\"docheckonce('chk');\" value=\"$ids\" />";
			echo "</label></td>";
			echo "<td title=''>$title</td>";
			echo "<td title=''>$count</td>";
			echo "<td align=\"center\">";
			echo "<a href=\"index.php?com=".COMS."&amp;task=active&amp;id=$ids\">";
			showIconFun('publish',$rows['isactive']);
			echo "</a>";
		
			echo "</td>";
			echo "<td align=\"center\">";
			echo "<a href=\"index.php?com=".COMS."&amp;task=edit&amp;id=$ids\">";
			showIconFun('edit','');
			echo "</a>";
		
			echo "</td>";
			echo "<td align=\"center\">";
		
			echo "<a href=\"javascript:detele_field('index.php?com=".COMS."&amp;task=delete&amp;id=$ids')\" >";
			showIconFun('delete','');
			echo "</a>";
		
			echo "</td>";
			echo "</tr>";
		}
	}
	public function Add_new(){
		$sql="INSERT INTO `tbl_food_menu` (`food_id`, `code`, `name`,`cdate`, `isactive`) VALUES ";
		$sql.="('".$this->Food_ID."','".$this->Code."','".$this->Name."','".$this->Cdate."','".$this->isActive."')";
		return $this->objmysql->Exec($sql);
	}
	public function Update(){
		$sql="UPDATE `tbl_combo_menu` SET  
				`food_id`='".$this->Food_ID."',
				`code`='".$this->Code."',
				`name`='".$this->Name."',
				`cdate`='".$this->Cdate."'
		WHERE `id`='".$this->ID."'";
		return $this->objmysql->Exec($sql);
	}
	public function Delete($ids){
		$sql="DELETE FROM `tbl_combo_menu` WHERE `id` in ('$ids')";
		return $this->objmysql->Exec($sql);
	}
	public function setActive($ids,$status=''){
		$sql="UPDATE `tbl_combo_menu` SET `isactive`='$status' WHERE `id` in ('$ids')";
		if($status=='')
			$sql="UPDATE `tbl_combo_menu` SET `isactive`=if(`isactive`=1,0,1) WHERE `id` in ('$ids')";
		return $this->objmysql->Exec($sql);
	}
	public function Order($ids,$order){
		$sql="UPDATE tbl_combo_menu SET `order`='".$order."' WHERE `id`='".$ids."'";	
		return $this->objmysql->Exec($sql);
	}
	public function Orders($arids,$arods){
		for($i=0;$i<count($arids);$i++){
			$this->Order($arids[$i],$arods[$i]);
		}
	}
}
?>