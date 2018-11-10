<?php
class CLS_CATALOG{
    private $pro=array(
        'CatId'=>'',
        'ParId'=>'',
        'Code'=>'',
        'Name'=>'',
        'Intro'=>'',
        'isActive'=>1,
        'Order'=>1
    );
    private $objmysql=NULL;
    public function CLS_CATALOG(){
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
        $sql="SELECT * FROM `tbl_catalog` ".$where." ORDER BY `tbl_catalog`.`name` ".$limit."";
        return $this->objmysql->Query($sql);
    }

    public function Num_rows(){
        return $this->objmysql->Num_rows();
    }
    public function Fetch_Assoc(){
        return $this->objmysql->Fetch_Assoc();
    }
    public function getListCate($parCatId=0,$level=0){
        $sql="SELECT CatId, name FROM tbl_catalog WHERE `isactive`='1' ";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        $char="";
        if($level!=0){
            $char.="&nbsp;&nbsp;&nbsp;";
            $char.="|---";
        }
        if($objdata->Num_rows()<=0) return;
        while($rows=$objdata->Fetch_Assoc()){
            $CatId=$rows['CatId'];
            $name=$rows['name'];
        }
    }

    public function listTable($strwhere=""){
        //var_dump('fff'); die();
        global $rowcount;
        $sql="SELECT * FROM tbl_catalog ".$strwhere." ORDER BY `cat_id`";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        while($rows=$objdata->Fetch_Assoc()){	$rowcount++;
            $ids=$rows['cat_id'];
            $name=Substring($rows['name'],0,10);
            echo "<tr name='trow'>";
            echo "<td width='40px' align='center'>$rowcount</td>";
            echo "<td>".$rows["name"]."</td>";

            echo "<td>";
            echo "<a href='".ROOTHOST."member/nhom-qua-tang/active/".$ids."'>";
            showIconFun('publish',$rows['isactive']);
            echo "</a>";
            echo "</td>";

            echo "<td>";
            echo "<a href='".ROOTHOST."member/nhom-qua-tang/edit/".$ids."'>";
            showIconFun('edit','');
            echo "</a>";
            echo "</td>";

            echo "<td>";
            echo "<a href='".ROOTHOST."member/nhom-qua-tang/delete/".$ids."'>";
            showIconFun('delete','');
            echo "</a>";
            echo "</td>";
            echo "</tr>";

        }
    }
    public function getNameByCatId($cat_CatId){
        $objdata=new CLS_MYSQL;
        $sql="SELECT `Name` FROM `tbl_catalog`  WHERE `isactive`=0 AND `CatId` = '$cat_CatId'";
        $objdata->Query($sql);
        $row=$objdata->Fetch_Assoc();
        return $row['name'];
    }
	
	function getListCountry($parCatId=0, $getCatId=0){
		$sql="SELECT CatId, name FROM tbl_catalog WHERE `isactive`='1' ";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		$char="";
		/*if($level!=0){
			$char.="&nbsp;&nbsp;&nbsp;";
				$char.="|---";
		}*/
		if($objdata->Num_rows()<=0) return;
		while($rows=$objdata->Fetch_Assoc()){
			$CatId=$rows['CatId'];
			
			$name=$rows['name'];
            ?>
			<option value='<?php echo $CatId;?>' <?php if($getCatId && $CatId==$getCatId) echo "selected";?>><?php echo $name;?></option>
            <?php
            /*$nextlevel=$level+1;
			$this->getListCate($CatId,$nextlevel);*/
		}
	}
   
    public function Add_new(){
        $sql=" INSERT INTO `tbl_catalog`(`par_id`,`code`, `name`, `intro`, `isactive`) VALUES";
        $sql.="('".$this->ParId."', '".$this->Code."', '".$this->Name."','".$this->Intro."','".$this->isActive."')";
        //var_dump($sql); die;
        return $this->objmysql->Exec($sql);
    }
    public function Update(){
        $sql = "UPDATE tbl_catalog SET par_id='".$this->ParId."', intro='".$this->Intro."',`name`='".$this->Name."', `code`='".$this->Code."' WHERE cat_id='".$this->CatId."'";
        //var_dump($sql); die;
        return $this->objmysql->Exec($sql);
    }
    public function Delete($CatId){
        $sql="DELETE FROM `tbl_catalog` WHERE `cat_id` in ('$CatId')";
		//	var_dump($sql); die();
        return $this->objmysql->Exec($sql);
    }
    public function setActive($CatIds,$status=''){
        $sql="UPDATE `tbl_catalog` SET `isactive`='$status' WHERE `cat_id` in ('$CatIds')";
        if($status=='')
            $sql="UPDATE `tbl_catalog` SET `isactive`=if(`isactive`=0,1,0) WHERE `cat_id` in ('$CatIds')";
        return $this->objmysql->Exec($sql);
    }
    /* get list combo box addnew*/
    function getListCbCatalog($strWhere='', $getCatId=''){
        $sql="SELECT cat_id, name FROM tbl_catalog ORDER BY `name`";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        if($objdata->Num_rows()<=0) return;
        while($rows=$objdata->Fetch_Assoc()){
            $CatId=$rows['cat_id'];
            $name=$rows['name'];
            ?>
            <option value='<?php echo $CatId;?>' <?php if(isset($getCatId) && $CatId==$getCatId) echo "selected";?>><?php echo $name;?></option>
            <?php
        }
    }

    /* get CatId by Code */
    public function getCatIdAndNameByCode($code){
        $sql="SELECT `tbl_catalog`.`CatId`,`tbl_catalog`.`name` FROM `tbl_catalog` WHERE `tbl_catalog`.`code` ='$code'";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        $row=$objdata->Fetch_Assoc();
        return $row;
    }
}
?>