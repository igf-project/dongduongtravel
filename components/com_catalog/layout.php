
<?php
	define('COMS', 'catalog');
    $com=isset($_GET['com'])? $_GET['com']:'';
    $viewtype=isset($_GET['viewtype'])? addslashes($_GET['viewtype']):'list';
	$arr=array('list', 'block', 'detail', 'add', 'edit', 'delete', 'active', 'list_member');
	if($com!=COMS OR in_array($viewtype, $arr)==false OR !is_file(COM_PATH.'com_'.$com.'/tem/'.$viewtype.'.php')){ //Check
        die('PAGE NOT FOUND!');
    }
    include_once(LIB_PATH.'cls.catalog.php');
    $obj=new CLS_CATALOG();
    include_once('tem/'.$viewtype.'.php');
    if(isset($_POST['cmdsave'])){
        $obj->Name=addslashes($_POST['txt_name']);
        $obj->ParId='';
        $obj->Code=un_unicode($_POST['txt_name']);
        $obj->Intro=addslashes($_POST['txt_intro']);
		if(isset($_POST['txtid'])){
			$obj->CatId=(int)$_POST['txtid'];
			$obj->Update();
		}else{
			$obj->Add_new();
		}
		echo "<script language=\"javascript\">window.location.href='".ROOTHOST."member/nhom-qua-tang/danh-sach'</script>";
	}
    unset($viewtype); unset($com); unset($arr);unset($obj);
?>

