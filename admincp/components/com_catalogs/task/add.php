<?php
define('TASK_NAME', 'Thêm nhóm quà tặng');
write_path();

if(isset($_POST['cmdsave'])){
    $obj->Name=addslashes($_POST['txt_name']);
    $obj->Code=un_unicode($_POST['txt_name']);
    $obj->Intro=addslashes($_POST['txt_intro']);
    $obj->Add_new();
    echo "<script>window.location.href='index.php?com=".COMS."'</script>";
}
?>
<div id="action">
    <script language="javascript">
        function checkinput(){
            if($("#txt_name").val()==""){
                $("#err-name").fadeTo(200,0.1,function(){
                    $(this).html('Vui lòng nhập tên nhóm').fadeTo(900,1);
                });
                $("#txt_name").focus();
                return false;
            }
            return true;
        }
    </script>
    <h1 align='center'>Thêm nhóm quà tặng</h1><hr/>
    <div class="box-tabs">
        <form id="frm_action" name="frm_action" method="post" action=""  enctype="multipart/form-data">
            <div class="tab-content">
                <div class="row">
                    <div class='form-group col-md-6'>
                        <label class="control-label">Tên<font color="red">*</font></label>
                        <input name="txt_name" type="text" id="txt_name" class='form-control' value="" required />
                    </div>
                </div>
                <div class="form-group">
                    <label>Mô tả</label>
                    <textarea id="txt_intro" name="txt_intro" class="form-control" placeholder='Nội dung mô tả'></textarea>
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