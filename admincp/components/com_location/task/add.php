<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
define('TASK_NAME', 'Thêm mới tỉnh thành');
write_path();
if(isset($_POST['cmdsave'])){
    $obj->parId='';
    $obj->countryId=$_POST['cbo_cate'];
    $obj->Name=addslashes($_POST['txt_name']);
    $obj->Intro=addslashes($_POST['txt_intro']);
    $obj->isActive='1';
    $obj->Order=0;
    $path = '../'.PATH_THUMB;
    $obj->Code=un_unicode($_POST['txt_name']);

    /*upload thumb*/
    if(isset($_FILES['fileImg']) AND $_FILES['fileImg']['name']!=''){
        $objUpload=new CLS_UPLOAD();
        $obj->Thumb = str_replace('../', '', $objUpload->UploadFile('fileImg', $path));
    }
    else $obj->Thumb='';

    $obj->Add_new();
    echo "<script>window.location.href='index.php?com=".COMS."&mess=U01'</script>";
}
?>
<h1 align='center'>Thêm mới tỉnh - thành phố </h1><hr/>
<div id="action">
    <script language="javascript">
        function checkinput(){
            if($("#txt_name").val()==""){
                alert('Name is require!');
                $("#txt_name").focus();
                return false;
            }
            return true;
        }
    </script>
    <div class="box-tabs">
        <form id="frm_action" name="frm_action" method="post" action="" enctype="multipart/form-data">
            <div class="box-control">
                <a href="?com=location" class="btn btn-default pull-left">Quay lại</a>
                <input type="submit" name="cmdsave" id="cmdsave"  class="btn btn-primary pull-right" value="Lưu thông tin">
            </div>
            <div class="tab-content">
                <div class="tab-pane fade active in" id="home">
                    <div class="row">
                        <div class='form-group col-md-6'>
                            <label class="control-label"><strong>Tỉnh/ Thành phố </strong></label>
                            <input name="txt_name" type="text" id="txt_name" size="45" class='form-control' value="" placeholder='' required/>
                        </div>

                        <div class='form-group col-md-6'>
                            <label class="control-label"><strong>Thuộc quốc gia</strong></label>
                            <select name="cbo_cate" id="cbo_cate" class='form-control'>
                                <?php
                                if(!isset($objcountry)) $objcountry=new CLS_COUNTRIES();
                                echo $objcountry->getListCountry("option");
                                ?>
                            </select>
                        </div>
                        <div class='form-group col-md-6'>
                            <label class="control-label"><strong>Thumb ảnh</strong></label>
                            <input name="fileImg" type="file" id="file-thumb" size="45" class='form-control' value="" placeholder='' required/>
                            <div id="show-img">
                                <img class="img-display" src="<?php echo ROOTHOST.THUMB_DEFAULT;?>">
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <label><strong>Lời giới thiệu</strong> (Tại sao đến đây)</label>
                        <textarea id="txt_intro" name="txt_intro" placeholder='Nội dung bài viết' ></textarea>
                    </div>
                </div>
                <div class="tab-pane fade" id="about">
                    <div class="form-group">
                        <label><strong>Tóm tắt</strong></label>
                        <textarea id="txt_intro_about" name="txt_intro_about" placeholder='Mô tả bài viết' ></textarea>
                    </div>
                    <div class="form-group">
                        <label><strong>Nội dung chi tiết</strong></label>
                        <textarea id="txt_fulltext" name="txt_fulltext" placeholder='Nội dung bài viết' ></textarea>
                    </div>
                </div>
                <div class="text-center">
                    <br/>
                    <a href="?com=location" class="btn btn-default">Quay lại</a>
                    <input type="submit" name="cmdsave" id="cmdsave"  class="btn btn-primary" value="Lưu thông tin">
                </div>
            </form>
        </div>
    </div>
</div>

<?php
unset($objcountry);
?>
<script language="javascript">
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
            $('#txt_intro_about').summernote({height: 150});
            $('#txt_fulltext').summernote({height: 350});
            $('#txt_intro').summernote({height: 150});
        }
        return {
            //main function to initiate the module
            init: function () {
                handleWysihtml5();
                handleSummernote();
            }
        }
    }();

    /*func add new position contact*/

    $(document).ready(function() {

        ComponentsEditors.init();
        $('#frm_action').submit(function(){
            return checkinput();
        })
        /* load thumb when select File*/
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