<?php
	define('COMS', 'slidercontrol');
    include_once(LIB_PATH.'cls.slider.php');	
    include_once(EXT_PATH.'cls.upload.php');
    $com=isset($_GET['com'])? $_GET['com']:'';
    $viewtype=isset($_GET['viewtype'])? addslashes($_GET['viewtype']):'list';
	$arr=array('list', 'add', 'edit', 'active', 'delete');
	if($com!=COMS OR in_array($viewtype, $arr)==false OR !is_file(COM_PATH.'com_'.$com.'/tem/'.$viewtype.'.php')){ //Check
		die('PAGE NOT FOUND!');
	}
	else{
        $obj=new CLS_SILDER();
        include_once('tem/'.$viewtype.'.php');

        if(isset($_POST['cmdsave'])){           
            $obj = new CLS_SILDER();            
            $obj->ID='';
            $obj->Link=$_POST['txt_link'];
            $obj->Name=addslashes($_POST['txt_name']);
            $obj->isActive='1';
			$path=PATH_THUMB;
                    
            if(isset($_POST['txtid'])){
                /*upload thumb*/
                if(isset($_FILES['fileImg']) AND $_FILES['fileImg']['name']!=''){                    
                    $objUpload=new CLS_UPLOAD();
                    $obj->Image=$objUpload->UploadFile('fileImg', $path);
                }
                else $obj->Image=$_POST['url_image'];
                $obj->ID=(int)$_POST['txtid'];
                $obj->Update();
            }
            else{
                /*upload thumb*/
                if(isset($_FILES['fileImg']) AND $_FILES['fileImg']['name']!=''){                   
                    $objUpload=new CLS_UPLOAD();
                    $obj->Image=$objUpload->UploadFile('fileImg', $path);
                }
                else $obj->Image='';

                $obj->Add_new();
            }
			echo "<script language=\"javascript\">window.location.href='".ROOTHOST."member/slider/danh-sach'</script>";
        }
    }
    unset($viewtype); unset($com); unset($arr);unset($obj);
?>