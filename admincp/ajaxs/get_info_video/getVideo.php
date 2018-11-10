<?php
session_start();
include_once('../../includes/gfinnit.php');
include_once('../../includes/gfconfig.php');
include_once('../../libs/cls.mysql.php');
include_once('../../libs/cls.member.php');
include_once('../../libs/cls.content.php');
$obj=new CLS_MYSQL();
$objNews=new CLS_CONTENTS();
if(!isset($objmem))
    $objmem=new CLS_MEMBER();
    $id=isset($_POST['videoId'])? $_POST['videoId']: '';
    $urlImg=$objNews->youtube_image($id);
    ?>
        <img src="<?php echo $urlImg;?>" width="150px">
        <span><?php echo $objNews->getTitle($id);?></span>
        <span class="del-item" value="<?php echo $id;?>"></span>
    <?php
    // tải ảnh về, lưu tên ảnh bằng  pic-id
    $name_img=THUMB_DEFAULT;
        $name_img='pic-'.$id.'jpg';
        $file = file_get_contents($urlImg);
        if($file) file_put_contents('../../'.PATH_VIDEO.$name_img,$file);
?>
<input name="txt_idvideo" id="txt_idvideo" type="hidden" value="<?php echo $id;?>"/>
<input name="txt_imgvideo" id="txt_imgvideo" type="hidden" value="<?php echo PATH_VIDEO_VIEW.$name_img;?>"/>
<?php
unset($obj);
unset($objNew);
?>
