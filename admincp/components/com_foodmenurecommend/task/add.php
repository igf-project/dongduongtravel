<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
define('TASK_NAME', 'Thêm nhóm ẩm thực');
write_path();

if(isset($_POST["cmdsave"])){        
    $post_name = addslashes($_POST['txt_name']);
    $post_code = un_unicode($post_name);
    $post_intro = strip_tags($_POST['txt_intro']);
    $sql="INSERT INTO tbl_foodmenu_recommend (`name`,`code`,`intro`,`isactive`) VALUES ('$post_name','$post_code','$post_intro',1)";
    $objdata->Query($sql);
    echo "<script language=\"javascript\">window.location='index.php?com=".COMS."'</script>";
}

?>
<h1 align='center'>Thêm nhóm đối tượng </h1><hr/>
<div id="action">
    <div class="box-tabs">
        <form id="frm_action" name="frm_action" method="post" action="" enctype="multipart/form-data">
            <div class="tab-content">
                <div class="tab-pane fade active in" id="info">
                    <div class="row">
                    <div class='form-group col-md-6'>
                            <label class="control-label">Tên <font color="red"> *</font></label>
                            <input name="txt_name" type="text" id="txt_name" size="45" class='form-control' value="" placeholder='Tên nhóm'/>
                            <span id="err-name"></span>
                        </div>
                    </div>
                    <label class="control-label">Mô tả</label>
                    <textarea id="txt_intro" class="form-control" name="txt_intro" rows="3" placeholder="Mô tả "></textarea>
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
        $("input#file-thumb").change(function(e) {
            for (var i = 0; i < e.originalEvent.srcElement.files.length; i++) {
                var file = e.originalEvent.srcElement.files[i];
                var img = document.createElement("img");
                var reader = new FileReader();
                reader.onloadend = function() {
                    img.src = reader.result;
                }
                reader.readAsDataURL(file);
                $('#show-img').addClass('show-img');
                $('#show-img').html(img);
            }
        });
    });
</script>