<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
define('TASK_NAME', 'Sửa nhóm quà tặng');
write_path();
$id="";
if(isset($_GET["id"]))
    $id=trim($_GET["id"]);
$obj->getList(" WHERE `cat_id`='".$id."'");
$row=$obj->Fetch_Assoc();


if(isset($_POST['cmdsave'])){
    $obj->Name=addslashes($_POST['txt_name']);
    $obj->Code=un_unicode($_POST['txt_name']);
    $obj->Intro=addslashes($_POST['txt_intro']);
    $obj->ID=(int)$_POST['txtid'];
    $obj->Update();
    echo "<script>window.location.href='index.php?com=".COMS."'</script>";
}
?>
<div id="action">
    <script language="javascript">
        function checkinput(){
            if($("#txt_name").val()==""){
                $("#txt_name_err").fadeTo(200,0.1,function(){
                    $(this).html('Vui lòng nhập tên nhóm').fadeTo(900,1);
                });
                $("#txt_name").focus();
                return false;
            }
            return true;
        }
    </script>
    <div class="box-tabs">
        <form id="frm_action" name="frm_action" method="post" action="" enctype="multipart/form-data">
            <input type="hidden" name="txtid" value="<?php echo $row['cat_id'];?>">
            <div class="tab-content">
                <div class="row">
                    <div class='form-group col-md-6'>
                        <label class="control-label"><strong>Tên</strong><font color="red">*</font></label>
                        <input name="txt_name" type="text" id="txt_name" size="45" class='form-control' value="<?php echo $row['name'];?>" placeholder='' />
                    </div>
                </div>
                <div class="form-group">
                    <label><strong>Mô tả</label>
                    <textarea id="txt_intro" name="txt_intro" class="form-control" placeholder='Nội dung mô tả' ><?php echo $row['intro'];?></textarea>
                </div>
            </div>
            <div class="text-center">
                <br/>
                <a href="?com=catalogs" class="btn btn-default">Quay lại</a>
                <input type="submit" name="cmdsave" id="cmdsave"  class="btn btn-primary" value="Lưu thông tin">
            </div>
        </form>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#frm_action').submit(function(){
            return checkinput();
        })
    })
</script>