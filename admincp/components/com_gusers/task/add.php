<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
define('TASK_NAME', 'Thêm nhóm user');
write_path();

if(isset($_POST['cmdsave'])){
    $post_ParID=(int)$_POST['cbo_parid'];
    $post_Name=addslashes($_POST['txtname']);
    $post_Intro=addslashes($_POST['txtdesc']);
    $post_isActive=(int)$_POST['optactive'];
    $sql="INSERT INTO `tbl_guser`(`par_id`,`name`,`intro`,`isactive`) VALUES ";
    $sql.="('".$post_ParID."','".$post_Name."','".$post_Intro."','".$post_isActive."')";
    $objdata->Query($sql);
    echo "<script language='javascript'>window.location='index.php?com=".COMS."'</script>";
}
?>
<div id="action">
    <h1 align='center'>Thêm nhóm user</h1><hr/>
    <form id="frm_action" name="frm_action" method="post" action="">
        <div class="row">
            <div class="col-md-6 form-group">
                <label>Tiêu đề</label><font color="red">*</font>
                <input type="text" name="txtname" class="form-control" id="txtname">
                <font id="err-name" color="red"></font>
                <div class="clearfix"></div>
            </div>
            <div class="col-md-6 form-group">
                <label>Nhóm người dùng</label>
                <select name="cbo_parid" id="cbo_parid" class="form-control">
                    <option value="0" selected="selected">Root</option>
                    <?php $obj->getListGmem(0,0); ?>
                </select>
                <script type="text/javascript">
                    $(document).ready(function() {
                        $("#cbo_parid").select2();
                    });
                </script>
                <div class="clearfix"></div>
            </div>
            <div class="col-md-6 form-group">
                <label>Nổi bật</label>
                <label class="radio-inline"><input type="radio" value="1" name="optactive" checked >Có</label>
                <label class="radio-inline"><input type="radio" value="0" name="optactive">Không</label>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="form-group">
        <label class="form-control-label">Mô tả</label>
        <textarea name="txtdesc" id="txtdesc" rows="5" class="form-control"></textarea>
    </div>
    <div class="text-center">
        <br/>
        <a href="?com=gusers" class="btn btn-default">Quay lại</a>
        <input type="submit" name="cmdsave" id="cmdsave"  class="btn btn-primary" value="Lưu thông tin">
    </div>
</form>
</div>
<script>
    function checkinput(){
        if($("#txtname").val()==""){
            $("#err-name").text('Không được để trống');
            return false;
        }
        return true;
    }

    var ComponentsEditors = function () {
        var handleWysihtml5 = function () {
            if (!jQuery().wysihtml5) {
                return;
            }
            if ($('.wysihtml5').size() > 0) {
                $('.wysihtml5').wysihtml5({
                    "stylesheets": ["global/plugins/bootstrap-wysihtml5/wysiwyg-color.css"]
                });
            }
        }
        var handleSummernote = function () {
            $('#txtdesc').summernote({height: 150});
        }
        return {
            init: function () {
                handleWysihtml5();
                handleSummernote();
            }
        }
    }();

    $(document).ready(function() {
        ComponentsEditors.init();
        $('#frm_action').submit(function(){
            return checkinput();
        })
    });
</script>