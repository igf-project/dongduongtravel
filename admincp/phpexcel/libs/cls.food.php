<?php
ini_set('display_errors', 1);
class CLS_FOOD{
	private $pro=array(
			'ID'=>'-1',
			'Cata_ID'=>'0',
			'Name'=>'',
			'Code'=>'',
			'Intro'=>'',
			'Fulltext'=>'',
			'Thumb'=>'',
			'Price'=>'',
			'PriceBig'=>'',
			'View'=>'',
			'Cdate'=>'',
			'Mdate'=>'',
			'MTitle'=>'',
			'MKey'=>'',
			'MDesc'=>'',
			'isHot'=>'0',
			'isActive'=>'1');
	private $objmysql;
	public function CLS_FOOD(){
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
		$sql=" SELECT * FROM tbl_food $strwhere";
		return $this->objmysql->Query($sql);
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	public function getCatName($catid) {
		$sql="SELECT name FROM tbl_catalog WHERE id=$catid";
		$objdata=new CLS_MYSQL;
		$objdata->Query($sql);
		if($objdata->Num_rows()>0) {
			$r=$objdata->Fetch_Assoc();
			return $r['name'];
		}
	}
    public function getMenuFoodName($ids) {
        $sql="SELECT name FROM tbl_food_menu WHERE FIND_IN_SET($ids, `food_id`)";
        $objdata=new CLS_MYSQL;
        $objdata->Query($sql);
        $count=$objdata->Num_rows();
            $arr='';$i=0;
            while($r=$objdata->Fetch_Assoc()){

                $arr.=$r['name'];
                $i++;
            }
            return $arr;
    }
	public function listTable($strwhere="",$page){
		$star=($page-1)*MAX_ROWS;
		$leng=MAX_ROWS;
		$sql="	SELECT tbl_food.* FROM tbl_food $strwhere ORDER BY `cdate` DESC, cata_id LIMIT $star,$leng";
		//echo $sql;
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);	$i=0;
		while($rows=$objdata->Fetch_Assoc())
		{	$i++;
			$ids=$rows['id'];
			$cata_id=$rows['cata_id'];
			$title=Substring(stripslashes($rows['name']),0,10);
			$intro = Substring(stripslashes($rows['intro']),0,10);
			$price = number_format($rows['price']);
			$pricebig = number_format($rows['price_big']);
			$category = $this->getCatName($cata_id);
			$menu = $this->getMenuFoodName($ids);
			//$category = $this->getCatName($rows['id']);
			$visited=$rows['view'];
			echo "<tr name=\"trow\">";
			echo "<td width=\"30\" align=\"center\">$i</td>";
			echo "<td width=\"30\" align=\"center\"><label>";
			echo "<input type=\"checkbox\" name=\"chk\" id=\"chk\" 	 onclick=\"docheckonce('chk');\" value=\"$ids\" />";
			echo "</label></td>";
			echo "<td title='$intro'>$title</td>";
			echo "<td>$category</td>";
			echo "<td>$menu</td>";
			echo "<td nowrap='nowrap' align=\"center\"><span style='color:red;'>$price</span><b> đ</b></td>";
			echo "<td nowrap='nowrap' align=\"center\"><span style='color:red;'>$pricebig</span><b> đ</b></td>";
			echo "<td nowrap='nowrap' align='center'>$visited</td>";
			echo "<td align=\"center\">";
			echo "<a href=\"index.php?com=".COMS."&amp;task=hot&amp;id=$ids\">";
			showIconFun('publish',$rows['ishot']);
			echo "</a>";
		
			echo "</td>";
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
		$sql="INSERT INTO `tbl_food` (`cata_id`, `code`, `name`, `intro`, `fulltext`, `thumb`, `price`,`price_big`, `cdate`, `mdate`, `meta_title`, `meta_key`, `meta_desc`, `isactive`) VALUES ";
		$sql.="('".$this->Cata_ID."','".$this->Code."','".$this->Name."','".$this->Intro."','".$this->Fulltext."','".$this->Thumb."','";
		$sql.=$this->Price."','";
		$sql.=$this->PriceBig."','";
		$sql.=$this->Cdate."','".$this->Mdate."','";
		$sql.=$this->MTitle."','".$this->MKey."','".$this->MDesc."','".$this->isActive."')";
		return $this->objmysql->Exec($sql);
	}
	public function Update(){
		$sql="UPDATE `tbl_food` SET  
				`cata_id`='".$this->Cata_ID."',
				`code`='".$this->Code."',
				`name`='".$this->Name."',
				`intro`='".$this->Intro."',
				`fulltext`='".$this->Fulltext."',
				`thumb`='".$this->Thumb."',										
				`price`='".$this->Price."',
				`price_big`='".$this->PriceBig."',
				`mdate`='".$this->Mdate."',
				`meta_title`='".($this->MTitle)."',
				`meta_key`='".($this->MKey)."',
				`meta_desc`='".($this->MDesc)."',
				`ishot`='".$this->isHot."'
		WHERE `id`='".$this->ID."'";
		return $this->objmysql->Exec($sql);
	}
	public function Delete($ids){
		$sql="DELETE FROM `tbl_food` WHERE `id` in ('$ids')";
		return $this->objmysql->Exec($sql);
	}
	public function setHot($ids){
		$sql="UPDATE `tbl_food` SET `ishot`=if(`ishot`=1,0,1) WHERE `id` in ('$ids')";
		return $this->objmysql->Exec($sql);
	}
	public function setActive($ids,$status=''){
		$sql="UPDATE `tbl_food` SET `isactive`='$status' WHERE `id` in ('$ids')";
		if($status=='')
			$sql="UPDATE `tbl_food` SET `isactive`=if(`isactive`=1,0,1) WHERE `id` in ('$ids')";
		return $this->objmysql->Exec($sql);
	}
	public function Order($ids,$order){
		$sql="UPDATE tbl_food SET `order`='".$order."' WHERE `id`='".$ids."'";	
		return $this->objmysql->Exec($sql);
	}
	public function Orders($arids,$arods){
		for($i=0;$i<count($arids);$i++){
			$this->Order($arids[$i],$arods[$i]);
		}
	}
    /* combo box*/
    function getListCbItem($getId='', $swhere='', $arrId=''){
        $sql="SELECT id, name, code FROM tbl_food WHERE ".$swhere." `isactive`='1' ORDER BY `name` ASC";

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
            ?>


        <?php
        }
    }


}
?>