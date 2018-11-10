<?php
class CLS_CATE{
	private $objmysql=null;
	public function CLS_CATE(){
		$this->objmysql=new CLS_MYSQL;
	}
	public function getList($where='',$lag_id=0){
		$sql="SELECT * FROM `tbl_category` INNER JOIN `tbl_category_text` ON `tbl_category`.`cat_id`= `tbl_category_text`.`cat_id` ".$where; 
		echo $sql;
		return $this->objmysql->Query($sql);
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	function getCatIDChild($where='',$parid,$lag_id=0){
		$sql="SELECT * FROM `view_cate` WHERE `lag_id`='$lag_id' AND isactive=1 AND par_id='$parid' ".$where;
		$objdata=new CLS_MYSQL();
		$this->result=$objdata->Query($sql);
		$str='';
		if($objdata->Num_rows()>0) {
			while ($rows=$objdata->Fetch_Assoc()) {
				$str.=$rows['cat_id']."','";
				$str.=$this->getCatIDChild('',$rows['cat_id']);
			}
		}
		return $str;
	}
	public function getNameById($cat_id){
		$objdata=new CLS_MYSQL;
		$sql="SELECT `name` FROM `view_cate`  WHERE isactive=1 AND `cat_id` = '$cat_id'"; 
		$objdata->Query($sql);
		$row=$objdata->Fetch_Assoc();
		return $row['name'];
	}
	/* combo box*/
    function getListCbCategory($getId='', $swhere=''){
        $sql="SELECT cat_id, name FROM tbl_category_text WHERE ".$swhere." `isactive`='1' ORDER BY `name` ASC";
        
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
		//var_dump($getId); die;
        if($objdata->Num_rows()<=0) return;
        while($rows=$objdata->Fetch_Assoc()){
            $id=$rows['cat_id'];
            $name=$rows['name'];
            ?>
			
            <option value='<?php echo $rows['cat_id'];?>' <?php if(isset($getId) && $id==$getId) echo "selected";?>><?php echo $name;?></option>
        <?php
        }
    }
	/* get ID by Code */
	 public function getIdAndNameByCode($id){
        $sql="SELECT `tbl_category`.`cat_id`,`tbl_category_text`.`name` FROM `tbl_category` INNER JOIN `tbl_category_text` ON `tbl_category`.`cat_id`=`tbl_category_text`.`cat_id` WHERE `tbl_category`.`code` ='$id'";
		 $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        $row=$objdata->Fetch_Assoc();
		return $row;
    }
	
}
?>