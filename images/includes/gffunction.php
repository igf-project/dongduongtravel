<?php
function paging($total_rows,$max_rows,$cur_page){
	$max_pages=ceil($total_rows/$max_rows);
	$start=$cur_page-5; if($start<1)$start=1;
	$end=$cur_page+5;	if($end>$max_pages)$end=$max_pages;
	$paging='
	<form action="" method="post" name="frmpaging" id="frmpaging">
	<input type="hidden" name="txtCurnpage" id="txtCurnpage" value="1" />';
	$paging.='<p align="center" class="paging">';
	$paging.="<strong>Total:</strong> $total_rows <strong>on</strong> $max_pages <strong>page</strong><br>";
	if($cur_page >1)
	$paging.='<a href="javascript:gotopage('.($cur_page-1).')"> << </a>';
	if($max_pages>1){
		for($i=$start;$i<=$end;$i++)
		{
			if($i!=$cur_page)
			$paging.="<a href=\"javascript:gotopage($i)\"> $i </a>";
			else
			$paging.="<a href=\"#\" class=\"cur_page\"> $i </a>";
		}
	}
	if($cur_page <$max_pages)
	$paging.='<a href="javascript:gotopage('.($cur_page+1).')"> >> </a>';
	$paging.='</p></form>';
	echo $paging;
}
function paging_index($total_rows,$max_rows,$cur_page){
	$max_pages=ceil($total_rows/$max_rows);
	$start=$cur_page-5; if($start<1)$start=1;
	$end=$cur_page+5;	if($end>$max_pages)$end=$max_pages;
	$paging='<p class="paging">';
	if($total_rows > $max_rows)
		$paging='
	<form action="" method="post" name="frmpaging" id="frmpaging">
	<input type="hidden" name="txtCurnpage" id="txtCurnpage" value="'.$cur_page.'" />';
	if($cur_page >1)
		$paging.='<a href="javascript:gotopage('.($cur_page-1).')" class="cur_page"> < </a>';
	if($max_pages>1){
		for($i=$start;$i<=$end;$i++)
		{
			if($i!=$cur_page)
			$paging.="<a href=\"javascript:gotopage($i)\"> $i </a>";
			else
		      $paging.="<a href=\"#\" class=\"cur_page\" > $i </a>";
		}
	}
	if($cur_page <$max_pages)
		$paging.='<a href="javascript:gotopage('.($cur_page+1).')"> > </a>';
	$paging.='</p></form>';
	echo $paging;
}
function product_paging($total_rows,$max_rows,$cur_page){
	$max_pages=ceil($total_rows/$max_rows);
	if($max_pages<=1) return;
	$start=$cur_page-5; if($start<1)$start=1;
	$end=$cur_page+5;	if($end>$max_pages)$end=$max_pages;
	$paging="<div class='paging'>";
	if($cur_page >1)
		$paging.='<a href="javascript:gotopage('.($cur_page-1).')" class="cur_page"> PRE </a>';
	if($max_pages>1){
		for($i=$start;$i<=$end;$i++){
			if($i==$cur_page)
				$paging.="<a rel=\"noindex, nofollow\" href='#' class='active'>$i</a>";
			else
				$paging.="<a rel=\"noindex, nofollow\" href='#'>$i</a>";
		}
	}
	if($cur_page <$max_pages)
		$paging.='<a href="javascript:gotopage('.($cur_page+1).')"> NEXT </a>';
	$paging.='</div>';
	echo $paging;
}
// Make a textarea with name is $name
function Create_textare($txtname,$obj){
	echo '<textarea name="'.$txtname.'" id="'.$txtname.'" rows=4 cols=30>&nbsp;</textarea>';
	echo '<script>';
	echo 'var '.$obj.' = new InnovaEditor("'.$obj.'");';
	echo ''.$obj.'.width="100%";';
	echo ''.$obj.'.height="300";';
	echo $obj.".cmdAssetManager = \"modalDialogShow('/GFCMS/extensions/editor/innovar/assetmanager/assetmanager.php',640,465)\"; ";
	echo ''.$obj.'.REPLACE("'.$txtname.'");';
	echo '</script>';
}
function encodeHTML($sHTML){
	$sHTML=str_replace('"','\"',$sHTML);
	return $sHTML;
}
function uncodeHTML($sHTML){
	$sHTML=str_replace('\"','"',$sHTML);
	return $sHTML;
}
function Substring($str,$start,$len){
	$str=str_replace("  "," ",$str);
	$arr=explode(" ",$str);
	if($start>count($arr))	$start=count($arr);
	$end=$start+$len;
	if($end>count($arr))	$end=count($arr);
	$newstr="";
	for($i=$start;$i<$end;$i++)
	{
		if($arr[$i]!="")
		$newstr.=$arr[$i]." ";
	}
	if($len<count($arr)) $newstr.="...";
	return $newstr;
}
function showIconFun($fun,$value){
	$filename="noimage.gif";
	$title="no image";
	switch($fun){
		case "menuitem": 
			$title="Menu Item";
			$filename="menuitem.png"; 
			break;
		case "delete": 
			$title=CDELETE;
			$filename="delete.png"; 
			break;
		case "edit": 
			$title=CEDIT;
			$filename="icon_edit.png"; 
			break;
		case "publish": 
			if($value==1){
				$title=CPUBLIC;
				$filename="publish.png";
			}
			else{
				$title=CUNPUBLIC;
				$filename="unpublish.png";
			}
			break;
		case "show": 
			if($value==1){
				$title="Show";
				$filename="publish.png";
			}
			else{
				$title="Hidden";
				$filename="icon_nodefault.png";
			}
			break;
		case "isfronpage":
			if($value==1) {
				$title="Front page";
				$filename="icon_isfront.png"; 
			}else{ 
				$title="Admin";
				$filename="icon_nofront.png";
			}
			break;
		case "isdefault":
			if($value==1) {
				$title="Default";
				$filename="icon_default.png"; 
			}
			else {
				$title="Not default";
				$filename="icon_nodefault.png";
			}
			break;
	}
	echo "<img border=0 height=\"15\" src=\"".IMG_PATH."$filename\" title=\"$title\"/>";
}
function MENUS_ASSIGN(){
	$objdata=new CLS_MYSQL();
	if(!isset($objmenuitem))
	$objmenuitem=new CLS_MENUITEM();
	
	$sql="SELECT * FROM `view_menu` WHERE `isactive`=\"1\"";
	$objdata->Query($sql);
	while($row_menu=$objdata->Fetch_Assoc()){
		echo "<option onclick=\"getIDs();\" value=\"\" class=\"menutype\">".$row_menu["name"]."</option>";
		echo $objmenuitem->getListMenuItem($row_menu["mnu_id"],0,1);
	}
}
function LoadPosition(){
  $doc = new DOMDocument();
  $doc->load(THIS_TEM_ADMIN_PATH.'template.xml');
  $options = $doc->getElementsByTagName("position");
  
  foreach( $options as $option )
  { 
  	  $opts = $option->getElementsByTagName("option");
	  foreach($opts as $opt)
	  {
		  echo "<option value=\"".$opt->nodeValue."\">".$opt->nodeValue."</option>";
	  }
  }
}
function LoadModBrow($mod_name){
	$path="../".MOD_PATH.$mod_name."/brow";
	//echo $path;
	if(!is_dir($path))
		return;
	$objdir=dir($path);
	while($file=$objdir->read()){
		if(is_file($path."/".$file) && $file!="." && $file!=".." ){
			$file=substr($file,0,strlen($file)-4);
			echo "<option value=\"".$file."\">".$file."</option>";
		}
	}
	return ;
}
function LoadModType(){
	$path="../modules";
	if(!is_dir($path))
		return;
	$objdir=dir($path);
	while($dir=$objdir->read()){
		if(is_dir($path."/".$dir) && $dir!="." && $dir!=".." )
			echo "<option value=\"".$dir."\">".$dir."</option>";
	}
	return ;
}
function un_unicode($str){
	$marTViet=array(
	'à','á','ạ','ả','ã','â','ầ','ấ','ậ','ẩ','ẫ','ă',
	'ằ','ắ','ặ','ẳ','ẵ','è','é','ẹ','ẻ','ẽ','ê','ề'
	,'ế','ệ','ể','ễ',
	'ì','í','ị','ỉ','ĩ',
	'ò','ó','ọ','ỏ','õ','ô','ồ','ố','ộ','ổ','ỗ','ơ'
	,'ờ','ớ','ợ','ở','ỡ',
	'ù','ú','ụ','ủ','ũ','ư','ừ','ứ','ự','ử','ữ',
	'ỳ','ý','ỵ','ỷ','ỹ',
	'đ',
	'A','B','C','D','E','F','J','G','H','I','K','L','M',
	'N','O','P','Q','R','S','T','U','V','W','X','Y','Z',
	'À','Á','Ạ','Ả','Ã','Â','Ầ','Ấ','Ậ','Ẩ','Ẫ','Ă'
	,'Ằ','Ắ','Ặ','Ẳ','Ẵ',
	'È','É','Ẹ','Ẻ','Ẽ','Ê','Ề','Ế','Ệ','Ể','Ễ',
	'Ì','Í','Ị','Ỉ','Ĩ',
	'Ò','Ó','Ọ','Ỏ','Õ','Ô','Ồ','Ố','Ộ','Ổ','Ỗ','Ơ'
	,'Ờ','Ớ','Ợ','Ở','Ỡ',
	'Ù','Ú','Ụ','Ủ','Ũ','Ư','Ừ','Ứ','Ự','Ử','Ữ',
	'Ỳ','Ý','Ỵ','Ỷ','Ỹ',
	'Đ',"`","~","!","@","#","$","%","^","&","*","(",")","'",'"','&','/','   ','  ',' ');

	$marKoDau=array('a','a','a','a','a','a','a','a','a','a','a',
	'a','a','a','a','a','a',
	'e','e','e','e','e','e','e','e','e','e','e',
	'i','i','i','i','i',
	'o','o','o','o','o','o','o','o','o','o','o','o'
	,'o','o','o','o','o',
	'u','u','u','u','u','u','u','u','u','u','u',
	'y','y','y','y','y',
	'd',
	'a','b','c','d','e','f','j','g','h','i','k','l','m',
	'n','o','p','q','r','s','t','u','v','w','x','y','z',
	'a','a','a','a','a','a','a','a','a','a','a','a'
	,'a','a','a','a','a',
	'e','e','e','e','e','e','e','e','e','e','e',
	'i','i','i','i','i',
	'o','o','o','o','o','o','o','o','o','o','o','o'
	,'o','o','o','o','o',
	'u','u','u','u','u','u','u','u','u','u','u',
	'y','y','y','y','y',
	'd',"","","","","","","","","","",'','','','','','',' ',' ','-');

	$str = str_replace($marTViet, $marKoDau, $str);
	return $str;
}
function show_catalog($par,$type){
	$objdata=ConnectServer($type);
	$sql="SELECT cat_id,`alias`,`name` FROM `tbl_catalog`  WHERE isactive=1 AND par_id='$par' ";
	$objdata->Query($sql);
	if($objdata->Num_rows()>0){
		echo '<ul>';
		while($row=$objdata->Fetch_Assoc()){
			$class='';
			if($_SESSION['CUR_CAT']==$row['alias'])
				$class='class="active"';
			echo "<li $class id='item-".$row['alias']."'><a href='".ROOTHOST.trans_type($type).'/'.$row['alias']."' title='".$row['name']."'><span>".$row['name']."</span></a>";
			show_catalog($row['cat_id'],$type);
			echo "</li>";
		}
		echo '</ul>';
	}
}

/*function get thumb*/
function getThumb($urlThumb, $width='', $height=''){
	if($urlThumb !='' AND file_exists(PATH_THUMB.$urlThumb)==true){
		return PATH_THUMB.$urlThumb;
	}
	else{
        return THUMB_DEFAULT;
	}
}

?>