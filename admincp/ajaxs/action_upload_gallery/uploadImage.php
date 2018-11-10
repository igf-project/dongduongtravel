<?php
if(isset($_FILES['fileImg']) && $_FILES['fileImg']['name'][0]!=NULL){
    include_once('../../../includes/gfinnit.php');
    include_once('../../includes/gfconfig.php');
    include_once('../../libs/cls.mysql.php');
    include_once('../../libs/cls.gallery.php');
    include_once('../../extensions/cls.upload.php');


    $name=$_FILES['fileImg']['name'][0];
    $tmp_name=$_FILES['fileImg']['tmp_name'][0];
    $size=$_FILES['fileImg']['size'][0];
    $fileType=$_FILES['fileImg']['type'][0];
    $path="../../../".PATH_GALLERY;

    $obj=new CLS_MYSQL();
    $objUpload=new CLS_UPLOAD();

	//set type par upload, positioncontact, tour, food..
    if(isset($_POST['position_id'])){
        $par_id=(int)$_POST['position_id'];
        $type='1';
    }
    elseif(isset($_POST['par_id'])){
        $par_id=(int)$_POST['par_id'];
        $type='2';
    }
    elseif(isset($_POST['food_id'])){
        $par_id=(int)$_POST['food_id'];
        $type='3';
    }
    else{
        $par_id='';
        $type='';
    }


    if($objUpload->UploadFiles('fileImg', $path)){
        $objGa=new CLS_GALLERY();
        $sql="SELECT * FROM `tbl_gallery` WHERE `par_id`=$par_id AND `type`=".$type;
        $obj->Query($sql);
        $obj->Num_rows();
        $row=$obj->Fetch_Assoc();

        $objGa->ID = $row['id'];
        $objGa->parId = $par_id;
        $objGa->Type = $type;
        
        /* set nếu đã có thư viện ảnh thì update (cộng dồn lại vào array đường dẫn link ) thôi*/
        if($obj->Num_rows() > 0){
            $objGa->arrPath="'".$row['arr_path'].", ".$name."'";
            $objGa->Update();
        }else{
            $objGa->arrPath=$name;
            $objGa->Add_new();
        }
        ?>
        <div class="info-item">
            <img src="<?php echo ROOTHOST.PATH_GALLERY.$name;?>" class="thumb"/>
            <span class="del-item" data-id='<?php echo $row['id'] ?>' value="<?php echo $name;?>" onclick="del_itemGallery(this)"></span>
        </div>
        <?php
    }else{
        echo "Có lỗi xảy ra, vui lòng thử lại!";
    }
}
unset($obj);
unset($objGa);
?>


