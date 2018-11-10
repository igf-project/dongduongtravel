<?php
	define('COMS', 'member');
    include_once(LIB_PATH.'cls.location.php');
	include_once(LIB_PATH.'cls.locationcontent.php');
    include_once(EXT_PATH.'cls.upload.php');
    $com=isset($_GET['com'])? $_GET['com']:'';
    $viewtype=isset($_GET['viewtype'])? addslashes($_GET['viewtype']):'list';
	$arr=array('list', 'block', 'seach', 'detail', 'add', 'edit', 'list_member', 'active', 'delete', 'article');
	if($com!=COMS OR in_array($viewtype, $arr)==false OR !is_file(COM_PATH.'com_'.$com.'/tem/'.$viewtype.'.php')){ //Check
		die('PAGE NOT FOUND!');
	}
	else{
        $obj=new CLS_MEMBER();
        include_once('tem/'.$viewtype.'.php');

        if(isset($_POST['cmdsave'])){
            $obj->parId='';
            $obj->Name=addslashes($_POST['txt_name']);
            $obj->Intro=addslashes($_POST['txt_intro']);
            $obj->isActive='1';

			if(isset($_POST['txtid'])){
				$obj->ID=(int)$_POST['txtid'];
				$obj->Update();
			}
			else{
				$obj->Add_new();
				$lastId=$obj->getLastId();
			}
			echo "<script language=\"javascript\">window.location.href='".ROOTHOST."member/dia-danh/danh-sach'</script>";
        }
    }
    unset($viewtype); unset($com); unset($arr);unset($obj);
?>