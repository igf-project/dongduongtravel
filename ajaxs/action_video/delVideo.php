<?php
include_once('../../includes/gfinnit.php');
//include_once('../../includes/function.php');
include_once('../../includes/gfconfig.php');
include_once('../../libs/cls.mysql.php');
include_once('../../libs/cls.video.php');
$obj=new CLS_MYSQL();
$objVi=new CLS_VIDEO();
$videoId=isset($_POST['videoId'])? $_POST['videoId']: '';
$id=isset($_POST['id'])? $_POST['id']: '';
$type=$objVi->getTypeById($id);
?>
<?php
$objVi->ID=$id;
$sql="SELECT * FROM `tbl_video` WHERE `id`=".$id."";
$obj->Query($sql);
$obj->Num_rows();

$row=$obj->Fetch_Assoc();
$type=$row['type'];
$par_id=$row['par_id'];
$arrVideo=explode(", ", $row['arr_path']);
if(($key = array_search($videoId, $arrVideo)) !== false) {
    unset($arrVideo[$key]);
}
if(count($arrVideo) > 0){
    $arrVideoUpdate=implode(', ', $arrVideo);
    /*update lại sau khi xóa phần tử trong mảng*/
    $objVi->arrPath="'".$arrVideoUpdate."'";
    $objVi->parId=$par_id;
    $objVi->Type=$type;
    $objVi->Update($type);
}
else{   // xóa cả toàn bộ ảnh của position
    $objVi->Delete($id);
}
$objVi->getListInfoVideo("WHERE `id`=".$id."");
unset($obj);
unset($objVi);
?>
<script>
    /*del video*/
    $('.del-item').click(function(){
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
