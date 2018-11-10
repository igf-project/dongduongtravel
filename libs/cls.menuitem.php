<?php
class CLS_MENUITEM{
	private $objmysql=null;
	public function CLS_MENUITEM(){
		$this->objmysql=new CLS_MYSQL;
	}
	public function getList($mnuid=0,$where=""){
		if($where!="")
			$where=" WHERE `mnu_id`='$mnuid' AND ".$where;
		$sql="SELECT * FROM `view_menuitem` ".$where;
		return $this->objmysql->Query($sql);
	}
	function Num_rows() { 
		return $this->objmysql->Num_rows();
	}
	function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	public function ListTopmenu($mnuid=0,$par_id=0,$level=1){
		$sql="SELECT * FROM `view_menuitem` WHERE `par_id`='$par_id' AND `mnu_id`='$mnuid' AND`isactive`='1' ORDER BY `order` ASC, mnuitem_id ASC";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		$total = $objdata->Num_rows();
		if($total<=0)
			return;
		$style="";
		if($level==1)
			$style.='submenu';
		else if($level>1)
			$style.='submenu'.$level;
			
		$str='<ul>';  	
		while($rows=$objdata->Fetch_Assoc()){
		
			$urllink="";
			if($rows['viewtype']=='link'){
				if(trim($rows['link'])!=''){
					$urllink=$rows['link'];
				}else{
					$urllink=ROOTHOST.un_unicode($rows["name"])."-mnu".$rows["mnuitem_id"].".html";
				}
			}
			else if($rows['viewtype']=='article'){
				$objcon=new CLS_CONTENTS;
				$objcon->getList("AND con_id = '".$rows['con_id']."' ");
				$row_con=$objcon->Fetch_Assoc();
				$urllink=ROOTHOST.$row_con['code'].'.html';
			}
			else if($rows['viewtype']=='block' || $rows['viewtype']=='list' ){
				$objcat=new CLS_CATE;
				$objcat->getList("AND cat_id = '".$rows['cat_id']."' ");
				$objcat=$objcon->Fetch_Assoc();
				$urllink=ROOTHOST.$objcat['code'].'/';
			}
			$cls='';
			$curmenu=$_SESSION['CUR_MENU'];
			$cursub=$_SESSION['CUR_SUB_MENU'];
			if(isset($curmenu) && $curmenu!='')
				$cls='';
			if($curmenu==$rows['mnuitem_id'] || $cursub==$rows['mnuitem_id'])
				$cls=' class="active" ';
				
			$cls.='class="'.$rows['class'].'"';
			$str.="<li $cls><a href=\"$urllink\" title='".$rows['name']."'><span>".$rows["name"]."</span></a>";
			$str.=$this->ListTopmenu($mnuid,$rows["mnuitem_id"],$level+1);
			$str.='</li>';	
		}
		$str.='</ul>';  
		return $str;
	}
	public function ListMenuItem($mnuid=0,$par_id=0,$level=1){
		$sql="SELECT * FROM `view_menuitem` WHERE `par_id`='$par_id' AND `mnu_id`='$mnuid' AND`isactive`='1' ORDER BY `order`";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		if($objdata->Num_rows()<=0)
			return;
		$style="";
		if($level==1)
			$style.='submenu';
		else if($level>1)
			$style.='submenu'.$level;
		$str="<ul class=\"$style\">";
		$i=0;
		while($rows=$objdata->Fetch_Assoc()){
			$urllink="";
			if($rows['viewtype']=='link'){
				if(trim($rows['link'])!=''){
					$urllink=$rows['link'];
				}else{
					$urllink=ROOTHOST.un_unicode($rows["name"])."-mnu".$rows["mnuitem_id"].".html";
				}
			}
			else if($rows['viewtype']=='article'){
				$objcon=new CLS_CONTENTS;
				$objcon->getList("AND con_id = '".$rows['con_id']."' ");
				$row_con=$objcon->Fetch_Assoc();
				$urllink=ROOTHOST.$row_con['code'].'.html';
			}
			else if($rows['viewtype']=='block' || $rows['viewtype']=='list' ){
				$objcat=new CLS_CATE;
				$objcat->getList("AND cat_id = '".$rows['cat_id']."' ");
				$row_cat=$objcat->Fetch_Assoc();
				$urllink=ROOTHOST.$row_cat['alias'].'/';
			}
			$cls='';
			if($rows['class']!='')
				$cls=' class="'.$rows['class'].'" ';
			$str.="<li $cls><a href=\"$urllink\" title='".$rows['name']."'><span>".$rows["name"]."</span></a>";
			$str.=$this->ListMenuItem($mnuid,$rows["mnuitem_id"],$level+1);
			$str.='</li>';			
		}
		$str.='</ul>';  
		return $str;
	}
}
?>