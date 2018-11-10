<?php
include_once('../../includes/gfinnit.php');
include_once('../../includes/gfconfig.php');
include_once('../../libs/cls.mysql.php');
include_once('../../libs/cls.video.php');
$objdata=new CLS_MYSQL();
$objPoVi=new CLS_VIDEO();
$arr_id=isset($_POST['videoId'])? $_POST['videoId']: '';
$urlLink=isset($_POST['url'])? $_POST['url']: '';
?>
<?php
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

$objPoVi->parId=$par_id;
$objPoVi->Type=$type;
$objPoVi->isActive='1';
$sql="SELECT * FROM `tbl_video` WHERE `par_id`=".$par_id."  AND `type`=".$type."";
$objdata->Query($sql);
$objdata->Num_rows();
$row=$objdata->Fetch_Assoc();
$id=$row['id'];
/* set nếu đã có thư viện video thì update (cộng dồn lại vào array đường dẫn link ) thôi*/
if($objdata->Num_rows() >=1){
    $objPoVi->parId=$par_id;
    $objPoVi->arrPath="'".$row['arr_path'].", ".$arr_id."'";
    $objPoVi->Update($type);
}
else{
    $objPoVi->parId=$par_id;
    $objPoVi->arrPath=$arr_id;
    $objPoVi->Add_new();
}
?>
<div class="info-item">
    <img src="<?php echo $objPoVi->youtube_image($arr_id);?>" width="150px">
    <span><?php echo $objPoVi->getTitle($arr_id);?></span>
    <span class="del-item" value="<?php echo $arr_id;?>" nameid="<?php echo $id;?>"></span>
</div>
<?php
unset($objdata);
unset($objPoVi);

?>
<script>
    /*del video*/
    $('#respon-video .del-item').click(function(){
        if(confirm("Bạn có muốn xóa video này")){
            var videoId=$(this).attr('value');
            var id=$(this).attr('nameid');
            $.post('<?php echo ROOTHOST;?>ajaxs/action_video/delVideo.php',{videoId, id},function(response_data){
                $('#respon-video').html(response_data);
            });
            var parent= $(this).parent();
            parent.remove();
        }
        else return false;
    });

</script>