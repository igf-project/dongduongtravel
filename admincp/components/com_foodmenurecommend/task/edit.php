<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
define('TASK_NAME', 'Sửa nhóm ẩm thực');
write_path();

if(isset($_GET['id'])){
    $ID = (int)$_GET['id'];
}else die('Page not found !');


if(isset($_POST["cmdsave"])){        
    $post_name = addslashes($_POST['txt_name']);
    $post_code = un_unicode($post_name);
    $post_intro = strip_tags($_POST['txt_intro']);
    $sql="UPDATE tbl_foodmenu_recommend SET `name`='$post_name', `code`='$post_code', `intro`='$post_intro' WHERE id=$ID ";
    $objdata->Query($sql);
    echo "<script language=\"javascript\">window.location='index.php?com=".COMS."'</script>";
}

$sql="SELECT * FROM tbl_foodmenu_recommend WHERE isactive=1 AND id=$ID";
$objdata->Query($sql);
$row = $objdata->Fetch_Assoc();
?>
<h1 align='center'>Sửa nhóm đối tượng </h1><hr/>
<div id="action">
    <div class="box-tabs">
        <form id="frm_action" name="frm_action" method="post" action="" enctype="multipart/form-data">
            <div class="tab-content">
                <div class="tab-pane fade active in" id="info">
                    <div class="row">
                    <div class='form-group col-md-6'>
                            <label class="control-label">Tên <font color="red"> *</font></label>
                            <input name="txt_name" type="text" id="txt_name" size="45" class='form-control' value="<?php echo $row['name'] ?>" placeholder='Tên nhóm'/>
                            <span id="err-name"></span>
                        </div>
                    </div>
                    <label class="control-label">Mô tả</label>
                    <textarea id="txt_intro" class="form-control" name="txt_intro" rows="3" placeholder="Mô tả "><?php echo $row['intro'] ?></textarea>
                </div>
            </div>
            <div class="text-center">
                <br/>
                <a href="?com=foodmenurecommend" class="btn btn-default">Quay lại</a>
                <input type="submit" name="cmdsave" id="cmdsave"  class="btn btn-primary" value="Lưu thông tin">
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    function checkinput(){
        if($("#txt_name").val()==""){
            $("#err-name").text('Vui lòng nhập tên.');
            $("#txt_name").focus();
            return false;
        }else{
            $("#err-name").text('');
        }
        return true;
    }
    $(document).ready(function() {
        $('#frm_action').submit(function(){
            return checkinput();
        })
    });
</script>