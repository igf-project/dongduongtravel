<?php
class CLS_COUNTRIES{
    private $pro=array(
        'ID'=>'-1',
        'Code'=>'',
        'Name'=>'',
        'Intro'=>'',
        'isActive'=>1,
        'Order'=>1
    );
    private $objmysql=NULL;
    public function CLS_COUNTRIES(){
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
        $sql="SELECT * FROM `tbl_countries` where 1=1 ".$where.' ORDER BY `name` '.$limit;
        return $this->objmysql->Query($sql);
    }
    public function Num_rows(){
        return $this->objmysql->Num_rows();
    }
    public function Fetch_Assoc(){
        return $this->objmysql->Fetch_Assoc();
    }
    public function getListCate($parid=0,$level=0){
        $sql="SELECT id, name FROM tbl_countries WHERE `isactive`='1' ";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        $char="";
        if($level!=0){
            $char.="&nbsp;&nbsp;&nbsp;";
            $char.="|---";
        }
        if($objdata->Num_rows()<=0) return;
        while($rows=$objdata->Fetch_Assoc()){
            $id=$rows['id'];
            $name=$rows['name'];
        }
    }

    public function listTable($strwhere=""){
        //var_dump('fff'); die();
        global $rowcount;
        $sql="SELECT * FROM tbl_countries ".$strwhere." ORDER BY `order`";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        while($rows=$objdata->Fetch_Assoc()){	$rowcount++;
            $id=$rows['id'];
            $name=Substring($rows['name'],0,10);
            echo "<tr name='trow'>";
            echo "<td width='40px' align='center'>$rowcount</td>";

            echo "<td width=\"30\" align=\"center\"><label>";
			echo "<input type=\"checkbox\" name=\"chk\" id=\"chk\" 	 onclick=\"docheckonce('chk');\" value=\"$id\" />";
			echo "</label></td>";
            echo "<td>".$rows["name"]."</td>";
            echo "<td  align='center'>";
            echo "<a href='index.php?com=".COMS."&amp;task=active&amp;id=$id'>";
            showIconFun('publish',$rows["isactive"]);
            echo "</a>";
            echo "</td>";
            echo "<td  align='center'>";
            echo "<a href='index.php?com=".COMS."&amp;task=edit&amp;id=$id'>";
            showIconFun('edit','');
            echo "</a>";
            echo "</td>";
            echo "<td align='center'>";
            echo "<a href='javascript:detele_field(\"index.php?com=".COMS."&amp;task=delete&amp;id=$id\")'>";
            showIconFun('delete','');
            echo "</a>";
            echo "</td>";
            echo "</tr>";

        }
    }
    public function getNameById($cat_id){
        $objdata=new CLS_MYSQL;
        $sql="SELECT `Name` FROM `tbl_countries`  WHERE `isactive`=0 AND `ID` = '$cat_id'";
        $objdata->Query($sql);
        $row=$objdata->Fetch_Assoc();
        return $row['name'];
    }
	
	function getListCountry($getId=''){
		$sql="SELECT id, name FROM tbl_countries WHERE `isactive`='1' ";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		$char="";
		/*if($level!=0){
			$char.="&nbsp;&nbsp;&nbsp;";
				$char.="|---";
		}*/
		if($objdata->Num_rows()<=0) return;
		while($rows=$objdata->Fetch_Assoc()){
			$id=$rows['id'];
			
			$name=$rows['name'];
            ?>
			<option value='<?php echo $id;?>' <?php if(isset($getId) && $id==$getId) echo "selected";?>><?php echo $name;?></option>
            <?php
            /*$nextlevel=$level+1;
			$this->getListCate($id,$nextlevel);*/
		}
	}
   
    public function Add_new(){
        $sql=" INSERT INTO `tbl_countries`(`code`, `name`, `intro`, `isactive`, `order`) VALUES";
        $sql.="('".$this->Code."', '".$this->Name."','".$this->Intro."','".$this->isActive."', '".$this->Order."')";
        return $this->objmysql->Exec($sql);
    }
    public function Update(){
        $sql = "UPDATE tbl_countries SET intro='".$this->Intro."',`name`='".$this->Name."', `code`='".$this->Code."' WHERE id='".$this->ID."'";
        return $this->objmysql->Exec($sql);
    }
    public function Delete($id){
        $sql="DELETE FROM `tbl_countries` WHERE `id` in ('$id')";
		//	var_dump($sql); die();
        return $this->objmysql->Exec($sql);
    }
    public function setActive($ids,$status=''){
        $sql="UPDATE `tbl_countries` SET `isactive`='$status' WHERE `id` in ('$ids')";
        if($status=='')
            $sql="UPDATE `tbl_countries` SET `isactive`=if(`isactive`=0,1,0) WHERE `id` in ('$ids')";
        return $this->objmysql->Exec($sql);
    }
    public function Order($arr_id,$arr_quan){
        $n=count($arr_id);
        for($i=0;$i<$n;$i++){
            $sql="UPDATE `tbl_countries` SET `order`='".$arr_quan[$i]."' WHERE `id` = '".$arr_id[$i]."' ";
            $this->objmysql->Exec($sql);
        }
    }
    /* lấy ra quốc hiển thị menu*/
    function getListMenuCategory($swhere=''){
        $sql="SELECT DISTINCT `tbl_location`.`name`,`tbl_location`.`code`
            FROM tbl_location, tbl_tour, tbl_countries
            WHERE `tbl_countries`.`id`=`tbl_location`.`country_id` find_in_set(tbl_location.id, `tbl_tour`.`arr_location`) > 0 $swhere  ORDER BY `tbl_location`.`name` ASC";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        if($objdata->Num_rows()<=0) return;
        while($rows=$objdata->Fetch_Assoc()){
            $code=$rows['code'];
            $name=$rows['name'];
            ?>
            <li><a href='<?php echo ROOTHOST."tour/".$code."/danh-sach";?>' title="<?php echo $name;?>"><?php echo $name;?></a></li>
        <?php
        }
    }
    /* get list cbo select*/
    function getListCbCountries($getId=''){
        $sql="SELECT `id`, `name` FROM `tbl_countries` WHERE `isactive`='1' ";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        if($objdata->Num_rows()<=0) return;
        while($rows=$objdata->Fetch_Assoc()){
            $id=$rows['id'];
            $name=$rows['name'];
            ?>
            <option value='<?php echo $id;?>' <?php if(isset($getId) && $id==$getId) echo "selected";?>><?php echo $name;?></option>
            <?php
        }
    }
}
?>