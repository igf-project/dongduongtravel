
<?php
	define('COMS', 'tourprogram');
    $com=isset($_GET['com'])? $_GET['com']:'';
    $viewtype=isset($_GET['viewtype'])? addslashes($_GET['viewtype']):'list';
	$arr=array('list', 'block', 'add', 'edit', 'delete', 'active', 'list_member');
	if($com!=COMS OR in_array($viewtype, $arr)==false OR !is_file(COM_PATH.'com_'.$com.'/tem/'.$viewtype.'.php')){ //Check
        die('PAGE NOT FOUND!');
    }
    include_once(LIB_PATH.'cls.tourprogram.php');
    $obj=new CLS_TOURPROGRAM();
    include_once('tem/'.$viewtype.'.php');
    if(isset($_POST['cmdsave'])){
		if($_POST['txt_code']==''){
            $obj->Code=un_unicode($_POST['txt_name']);
        }
        else{
            $obj->Code=un_unicode($_POST['txt_code']);
        }
        $obj->Name=addslashes($_POST['txt_name']);
		$obj->TourTypeId=(int)($_POST['cbo_category']);
		$obj->AccountId='';
		$obj->NumDay=addslashes($_POST['txt_num_date']);
		$obj->NumNight=addslashes($_POST['txt_num_night']);
		$obj->Start=addslashes($_POST['txt_start']);
		
		$obj->Intro=addslashes($_POST['txt_intro']);
		$obj->Fulltext=addslashes($_POST['txt_fulltext']);
		$obj->Version=addslashes($_POST['txt_version']);
		$obj->Price=addslashes($_POST['txt_price']);
		$obj->PriceChild14=addslashes($_POST['txt_price14']);
		$obj->PriceChild59=addslashes($_POST['txt_price59']);
		$obj->Content=addslashes($_POST['txt_content']);
		//$obj->CDate=addslashes($_POST['txt_name']);
		$obj->IsActive='1';
            
			
		$obj->Thumb=addslashes($_POST['txt_name']);
		if(isset($_POST['txtid'])){
			$obj->ID=(int)$_POST['txtid'];
			$obj->Update();
			echo "<script language=\"javascript\">window.location.href='".ROOTHOST."member/tour/danh-sach'</script>";   
		}else{
			$obj->Add_new();
			echo "<script language=\"javascript\">window.location.href='".ROOTHOST."member/tour/".$obj->Code."/them-lich-trinh/".$obj->ID.".html'</script>";   
		}
	}
    unset($viewtype); unset($com); unset($arr);unset($obj);
?>

