<?php
function paging($total_rows,$max_rows,$cur_page,$url=''){
    $max_pages=ceil($total_rows/$max_rows);
    $start=$cur_page-5; if($start<1)$start=1;
    $end=$cur_page+5;	if($end>$max_pages)$end=$max_pages;

    $paging='<p align="center" class="paging">';
    $paging.="<strong>Total:</strong> $total_rows <strong>on</strong> $max_pages <strong>page</strong><br>";
    $paging.='<ul class="pagination">';
    if($cur_page >1){
        $pre=($cur_page-1)<1?1:$cur_page-1;
        $Nurl=str_replace('{page}', $pre, $url);
        $paging.='<li><a href="'.$Nurl.'"> << </a></li>';
    }
    if($max_pages>1){
        for($i=$start;$i<=$end;$i++){
            $Nurl=str_replace('{page}', $i, $url);
            if($i!=$cur_page)
                $paging.="<li><a href='$Nurl'> $i </a></li>";
            else
                $paging.="<li class='active'><a href='#' class='cur_page'> $i </a></li>";
        }
    }
    if($cur_page <$max_pages){
        $nex=($cur_page+1)>$max_pages?$max_pages:$cur_page+1;
        $Nurl=str_replace('{page}',$nex, $url);
        $paging.='<li><a href="'.$Nurl.'"> >> </a></li>';
    }
    $paging.='</ul></p></form>';
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
                $paging.="<a href='javascript:gotopage($i)'> $i </a>";
            else
                $paging.="<a href='#' class='cur_page' > $i </a>";
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
                $paging.="<a rel='noindex, nofollow' href='#' class='active'>$i</a>";
            else
                $paging.="<a rel='noindex, nofollow' href='#'>$i</a>";
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
    echo $obj.".cmdAssetManager = 'modalDialogShow('/GFCMS/extensions/editor/innovar/assetmanager/assetmanager.php',640,465)'; ";
    echo ''.$obj.'.REPLACE("'.$txtname.'");';
    echo '</script>';
}
function encodeHTML($sHTML){
    $sHTML=str_replace('"',"'",$sHTML);
    return $sHTML;
}
function uncodeHTML($sHTML){
    $sHTML=str_replace("'",'"',$sHTML);
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

function Cutstring($str,$start,$len){
    return substr($str, $start, $len).". ..";
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
            $title='Delete';
            $filename="delete.png";
            break;
        case "edit":
            $title='Edit';
            $filename="icon_edit.png";
            break;
        case "publish":
            if($value==1){
                $title='Public';
                $filename="publish.png";
            }
            else{
                $title='UnPublic';
                $filename="unpublish.png";
            }
            break;
        case "show":
            if($value==1){
                $title='Show';
                $filename="publish.png";
            }
            else{
                $title='Hidden';
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
    echo "<img border=0 height='15' src='".ROOTHOST.IMG_PATH."$filename' title='$title'/>";
}
function MENUS_ASSIGN(){
    $objdata=new CLS_MYSQL();
    if(!isset($objmenuitem))
        $objmenuitem=new CLS_MENUITEM();

    $sql="SELECT * FROM `view_menu` WHERE `isactive`='1'";
    $objdata->Query($sql);
    while($row_menu=$objdata->Fetch_Assoc()){
        echo "<option onclick='getIDs();' value='' class='menutype'>".$row_menu["name"]."</option>";
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
            echo "<option value='".$opt->nodeValue."'>".$opt->nodeValue."</option>";
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
            echo "<option value='".$file."'>".$file."</option>";
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
            echo "<option value='".$dir."'>".$dir."</option>";
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
function getThumb($urlThumb, $alt='', $class='', $width='', $height=''){
    if($urlThumb !='' AND file_exists($urlThumb)==true){
        /*if($urlThumb !=''){*/
        return '<img src="'.ROOTHOST.$urlThumb.'" width="'.$width.'" height="'.$height.'" class="'.$class.'" alt="'.$alt.'">';
    }
    else{
        return '<img src="'.ROOTHOST.THUMB_DEFAULT.'" width="'.$width.'" height="'.$height.'" class="'.$class.'">';
    }
}
/*function get thumb for Ajax*/
function getThumbAjax($urlThumb, $alt='', $class='', $width='', $height=''){
    if($urlThumb !=''){
        return '<img src="'.ROOTHOST.$urlThumb.'" width="'.$width.'" height="'.$height.'" class="'.$class.'" alt="'.$alt.'">';
    }
    else{
        return '<img src="'.ROOTHOST.THUMB_DEFAULT.'" width="'.$width.'" height="'.$height.'" class="'.$class.'">';
    }
}


/* function redrect */
function redrect($url=''){
    echo '<script>window.location="".$url.""</script>';
}
/* function redrect 404*/
function redrect404(){
    echo '<script>window.location="".ROOTHOST."404.shtml"</script>';
}
/* function get fomat price */
function getFomatPrice($price){
    if((int)$price){
        if($price!='0') return number_format($price,0,'','.')." đ";
        else return "Giá: Liên hệ";
    }
    echo $price;

}
/*function del img*/
function unLinkImage($urlThumb){
    var_dump($urlThumb);
    if($urlThumb !='' AND file_exists($urlThumb)==true){
        unlink(''.$urlThumb.'');
    }
}

/*function get avatar*/
function getAvatar($urlThumb, $class='', $width='300px', $height='200px'){
    if($urlThumb !='' AND file_exists($urlThumb)==true){
        /*if($urlThumb !=''){*/
        return "<img src=".ROOTHOST.$urlThumb." width='".$width."' height='".$height."' class=".$class.">";
    }
    else{
        return "<img src=".ROOTHOST.THUMB_DEFAULT." width='".$width."' height='".$height."' class=".$class.">";
    }
}
 function checkLevel($level, $access_level){
        if(in_array($level,$access_level)) return true;
        else die('You not Access in Page here');
    }

// Phân trang bằng get + filter
function getParameter($full_link){
    $tem = explode('?',$full_link);
    $par=array();
    if(count($tem)==2 && !empty($tem[1])){
        $str_par=explode("&",$tem[1]);
        for($i=0;$i<count($str_par);$i++){
            $item=explode('=',$str_par[$i]);
            $par[$item[0]]=$item[1];
        }
    }
    return $par;
}
function __link($page,$link_full){
    return str_replace('{page}', $page,$link_full);
}
function conver_to_par($par){
    $str="?";
    $key=array_keys($par);
    for($i=0;$i<count($par);$i++){
        $str=$str.$key[$i].'='.$par[$key[$i]]."&";
    }
    $str=substr($str,0,strlen($str)-1);
    return $str;
}
function paging0($total_rows,$max_rows,$cur_page,$link_full){
    $max_pages=ceil($total_rows/$max_rows);
    $start=$cur_page-5; if($start<1)$start=1;
    $end=$cur_page+5;   if($end>$max_pages)$end=$max_pages;
    $paging='<div class="paging">
    <nav>
        <ul class="pager">
            <input type="hidden" name="txtCurnpage" id="txtCurnpage" value="'.$cur_page.'" />';
            $paging.="";
            if($cur_page == 1 && $max_pages==1){
                $paging.='<li><span aria-hidden="true" style="background: #f5f5f5;">&laquo; Trang trước</span></li>';
                $paging.='<li><span aria-hidden="true" style="background: #f5f5f5;">Trang sau &raquo;</span></li>';
            }elseif($cur_page <=1){
                $paging.='<li><span aria-hidden="true" style="background: #f5f5f5;">&laquo; Trang trước</span></li>';
                $paging.='<li><a href="'.__link($cur_page+1,$link_full).'" aria-label="Next"><span aria-hidden="true">Trang sau &raquo;</span></a></li>';
            }elseif($cur_page >=$max_pages){
                $paging.='<li><a href="'.__link($cur_page-1,$link_full).'" class="cur_page" aria-label="Preview"> <span aria-hidden="true">&laquo; Trang trước</span></a></li>';
                $paging.='<li><span aria-hidden="true" style="background: #f5f5f5;">Trang sau &raquo;</span></li>';
            }else{
                $paging.='<li><a href="'.__link($cur_page-1,$link_full).'" class="cur_page" aria-label="Preview"> <span aria-hidden="true">&laquo; Trang trước</span></a></li>';
                $paging.='<li><a href="'.__link($cur_page+1,$link_full).'" aria-label="Next"><span aria-hidden="true">Trang sau &raquo;</span></a></li>';
            }
            $paging.='</ul>
        </nav>
    </div>';
    echo $paging;
}
function paging1($total_rows,$max_rows,$cur_page,$link_full){
    $max_pages=ceil($total_rows/$max_rows);
    $start=$cur_page-5; if($start<1)$start=1;
    $end=$cur_page+5;   if($end>$max_pages)$end=$max_pages;
    $paging='<div class="paging">
    <nav>
        <ul class="pagination">
            <input type="hidden" name="txtCurnpage" id="txtCurnpage" value="'.$cur_page.'" />';
            $paging.="";
            if($cur_page>1)
                $paging.='<li><a href="'.__link($cur_page-1,$link_full).'" aria-label="Next"><span aria-hidden="true">Pre</span></a></li>';
            if($max_pages>1){
                for($i=$start;$i<=$end;$i++){
                    if($i!=$cur_page)
                        $paging.='<li><a href="'.__link($i,$link_full).'" aria-label="Next"><span aria-hidden="true">'.$i.'</span></a></li>';
                    else
                        $paging.='<li class="active"><a href="'.__link($cur_page,$link_full).'" aria-label="Next"><span aria-hidden="true">'.$cur_page.'</span></a></li>';
                }
            }
            if($cur_page <$max_pages)
                $paging.='<li><a href="'.__link($cur_page+1,$link_full).'" aria-label="Next"><span aria-hidden="true">Next</span></a></li>';
            $paging.='</ul>
        </nav>
    </div>';
    echo $paging;
}

?>