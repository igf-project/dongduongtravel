<?php
	defined('ISHOME') or die('Can not acess this page, please come back!');
	define('COMS','catalogs');
    define('OBJ','Nhóm Thực đơn');
	require_once(libs_path.'cls.catalogs.php');

    $title_manager="Danh sách ".OBJ;
    if(isset($_GET['task']) && $_GET['task']=='add')
        $title_manager = "Thêm mới ".OBJ;
    if(isset($_GET['task']) && $_GET['task']=='edit')
        $title_manager = "Sửa ".OBJ;
	require_once('includes/toolbar.php');
?>
<?php
	$obj=new CLS_CATALOGS();
	if(isset($_POST['cmdsave'])){
		$obj->Name=addslashes($_POST['txt_name']);
		$obj->Code=un_unicode(addslashes($_POST['txt_name']));
		$obj->isActive=1;
		if(isset($_POST['txtid'])){
			$obj->ID=(int)$_POST['txtid'];
			$obj->Update();
		}else{
			$obj->Add_new();
		}
		echo "<script language=\"javascript\">window.location.href='index.php?com=".COMS."&mess=U01'</script>";
	}
	if(isset($_POST["txtaction"]) && $_POST["txtaction"]!=""){
		$ids=trim($_POST["txtids"]);
		if($ids!='')
			$ids = substr($ids,0,strlen($ids)-1);
		$ids=str_replace(",","','",$ids);
		switch ($_POST["txtaction"]){
			case "public": 		$obj->setActive($ids,1); 		break;
			case "unpublic": 	$obj->setActive($ids,0); 		break;
			case "delete": 		$obj->Delete($ids); 			break;
			case 'order':
			$sls=explode(',',$_POST['txtorders']); $ids=explode(',',$_POST['txtids']);
			$obj->Order($ids,$sls); 	break;
		}
		echo "<script language=\"javascript\">window.location='index.php?com=".COMS."'</script>";
	}
	define('THIS_COM_PATH',COM_PATH.'com_'.COMS.'/');
	if(isset($_GET['task']))
		$task=$_GET['task'];

	if(!is_file(THIS_COM_PATH.'task/'.$task.'.php')){
        if(isset($_SESSION['messager_'.COMS])) echo $_SESSION['messager_'.COMS];
		$task='list';
	}
	include_once(THIS_COM_PATH.'task/'.$task.'.php');
	unset($task); unset($ids); unset($obj); unset($objlang);
?>