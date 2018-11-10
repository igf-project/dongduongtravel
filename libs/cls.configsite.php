<?php
class CLS_CONFIG{
	private $pro=array(
		'Title'=>'',
		'Meta_key'=>'',
		'Meta_desc'=>'',
		'Logo'=>'http://igf.com.vn/images/logo-igf.png',
		'Img'=>'http://igf.com.vn/images/logo-igf.png',
		'Email'=>'',
		'Phone'=>'',
		'Contact'=>'',
		'Footer'=>'',
		'Nich_yahoo'=>'',
		'Name_yahoo'=>''
	);
	private $objmysql=null;
	public function CLS_CONFIG(){
		$this->objmysql=new CLS_MYSQL;
		$this->objmysql->Query("SELECT * FROM tbl_configsite");
		$row=$this->objmysql->Fetch_Assoc();
		$this->Title=($row['title']!="")?$row['title']:SITE_TITLE;
		$this->Meta_desc=($row['meta_descript']!="")?$row['meta_descript']:SITE_DESC;
		$this->Meta_key=($row['meta_keyword']!="")?$row['meta_keyword']:SITE_KEY;
		$this->Contact=($row['contact']!="")?$row['contact']:COM_CONTACT;
		$this->Footer=$row['footer'];
		$this->Email=$row['email'];
		$this->Phone=$row['phone'];
		$this->Nich_yahoo=$row['nick_yahoo'];
		$this->Name_yahoo=$row['name_yahoo'];
		$this->Logo=$row['logo'];
	}
	// property set value
	function __set($proname,$value){
		if(!isset($this->pro[$proname])){
			echo "Error set: $proname không phải là thành viên của class configsite"; return;
		}
		$this->pro[$proname]=$value;
	}
	function __get($proname){
		if(!isset($this->pro[$proname])){
			echo ("Error get:$proname không phải là thành viên của class configsite" ); return;
		}
		return $this->pro[$proname];
	}
	function load_config(){
		$com=	isset($_GET['com'])?addslashes($_GET['com']):'';
		$viewtype=	isset($_GET['viewtype'])?addslashes($_GET['viewtype']):'';
		$code=		isset($_GET['code'])?addslashes($_GET['code']):'';
		$objcon=new CLS_CONTENTS;
		$objcat=new CLS_CATE;
		if($com=='contents'):
			if($viewtype=='block'){
				$objcat->getList(" AND `alias`='$code'");
				$r_cat=$objcat->Fetch_Assoc();
				if($r_cat['meta_title']!='')
					$this->Title=$r_cat['meta_title'];
				else
					$this->Title=$r_cat['name'];
				$this->Meta_key=$r_cat['meta_key'];
				$this->Meta_desc=$r_cat['meta_desc'];
			}
			elseif($viewtype=='article'){
				$objcon->getList(" AND `code`='$code'");
				$r_con=$objcon->Fetch_Assoc();
				
				if($r_con['meta_title']!='')
				$this->Title=stripslashes($r_con['meta_title']);
				else
				$this->Title=stripslashes($r_con['title']);
				$this->Meta_key=stripslashes($r_con['meta_key']);
				$this->Meta_desc=stripslashes($r_con['meta_desc']);
			}elseif($viewtype=='search'){
				$key='';
				if(isset($_GET['keyword']))
				$key=$_GET['keyword'];
				$this->Title="Tìm kiếm sản phẩm với từ khóa \"$key\"";
				$this->Meta_desc="";
			}else{}	
		endif;
	}
}
?>