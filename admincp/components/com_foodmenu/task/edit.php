<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
define('TASK_NAME', 'Sửa món ăn');
write_path();
if(isset($_GET['id'])){
    $ID = (int)$_GET['id'];
}else die('Page not found !');


if(isset($_POST['cmdsave'])){
    $obj->Name=addslashes($_POST['txt_name']);
    $obj->LocationId=(int)$_POST['cbo_location'];
    $obj->PositionId=(int)$_POST['cbo_position'];
    $obj->CateId=(int)$_POST['cbo_foodcate'];
    $obj->RecomId=(int)$_POST['cbo_foodrecommend'];
    $obj->Intro=addslashes($_POST['txt_intro']);
    $obj->Fulltext=addslashes($_POST['txt_fulltext']);
    $obj->isActive='1';
    $path = '../'.PATH_THUMB;
    $obj->Code=un_unicode($_POST['txt_name']);

    /*upload thumb*/
    if(isset($_FILES['fileImg']) AND $_FILES['fileImg']['name']!=''){
        $objUpload=new CLS_UPLOAD();
        $obj->Thumb = str_replace('../', '', $objUpload->UploadFile('fileImg', $path));
    }
    else $obj->Thumb='';
    $id=(int)$_POST['txtid'];
    $obj->ID=$id;
    $obj->Update();
    echo "<script>window.location.href='index.php?com=".COMS."&mess=U01'</script>";
}

$sql="SELECT * FROM tbl_foodmenu WHERE isactive=1 AND id=$ID";
$objdata->Query($sql);
$row = $objdata->Fetch_Assoc();
?>
<h1 align='center'>Sửa món ăn </h1><hr/>
<div id="action">
    <div class="box-tabs">
        <form id="frm_action" name="frm_action" method="post" action="" enctype="multipart/form-data">
            <input type="hidden" name="txtid" value="<?php echo $row['id'] ?>">
            <div class="box-control">
                <a href="?com=foodmenu" class="btn btn-default pull-left">Quay lại</a>
                <input type="submit" name="cmdsave" id="cmdsave"  class="btn btn-primary pull-right" value="Lưu thông tin">
            </div>
            <div class="tab-content">
                <div class="tab-pane fade active in" id="home">
                    <div class="row">
                        <div class='form-group col-md-6'>
                            <label>Tên <font color="red">*</font></label>
                            <input type="text" id="txt_name" name="txt_name" class="form-control" value="<?php echo $row['name'] ?>" placeholder="tên món ăn" required>
                            <span id="err-name"></span>
                        </div>
                        <div class='form-group col-md-6'>
                            <label>Thể loại</label><small> (Không bắt buộc)</small>
                            <select name="cbo_foodcate" id="cbo_foodcate" class='form-control' style="width: 100%;">
                                <option value=""> -- Chọn một thể loại -- </option>
                                <?php
                                $sql="SELECT `id`, `name` FROM tbl_foodmenu_category WHERE isactive=1";
                                $objdata->Query($sql);
                                while ($row_foodcate = $objdata->Fetch_Assoc()) {
                                    echo '<option value="'.$row_foodcate["id"].'">'.$row_foodcate["name"].'</option>';
                                }
                                ?>
                            </select>
                            <span id="err-location"></span>
                        </div>
                        <div class='form-group col-md-6'>
                            <label>Đối tượng</label><small> (Không bắt buộc)</small>
                            <select name="cbo_foodrecommend" id="cbo_foodrecommend" class='form-control' style="width: 100%;">
                                <option value=""> -- Chọn một đối tượng -- </option>
                                <?php
                                $sql="SELECT `id`, `name` FROM tbl_foodmenu_recommend WHERE isactive=1";
                                $objdata->Query($sql);
                                while ($row_foodcate = $objdata->Fetch_Assoc()) {
                                    echo '<option value="'.$row_foodcate["id"].'">'.$row_foodcate["name"].'</option>';
                                }
                                ?>
                            </select>
                            <span id="err-location"></span>
                        </div>
                        <div class='form-group col-md-6'>
                            <label>Tỉnh/ Thành phố <font color="red">*</font></label>
                            <select name="cbo_location" id="cbo_location" class='form-control' style="width: 100%;">
                                <option value=""> -- Chọn một tỉnh/thành phố -- </option>
                                <?php
                                $sql="SELECT `id`, `name` FROM tbl_location WHERE isactive=1";
                                $objdata->Query($sql);
                                while ($row_loc = $objdata->Fetch_Assoc()) {
                                    echo '<option value="'.$row_loc["id"].'">'.$row_loc["name"].'</option>';
                                }
                                ?>
                            </select>
                            <span id="err-location"></span>
                        </div>

                        <div class='form-group col-md-6'>
                            <label>Địa điểm </label>
                            <select name="cbo_position" id="cbo_position" class='form-control' style="width: 100%;">
                                <option value=""> -- Chọn một địa điểm -- </option>
                                <?php
                                $sql="SELECT `id`, `name` FROM tbl_position WHERE isactive=1";
                                $objdata->Query($sql);
                                while ($row_loc = $objdata->Fetch_Assoc()) {
                                    echo '<option value="'.$row_loc["id"].'">'.$row_loc["name"].'</option>';
                                }
                                ?>
                            </select>
                            <span id="err-position"></span>
                        </div>
                        <div class='form-group col-md-6'>
                            <label>Thumb ảnh</label>
                            <input name="fileImg" type="file" id="file-thumb" class='form-control'/>
                            <input name="url_image" type="hidden" value="<?php echo $row['thumb'];?>"/>
                            <div id="show-img">
                                <img class="img-display" src="<?php if($row['thumb']!='') echo ROOTHOST.$row['thumb']; else echo ROOTHOST.THUMB_DEFAULT;?>">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Tóm tắt</label><small> (Không quá 20 từ)</small>
                        <textarea id="txt_intro" class="form-control" name="txt_intro" placeholder='Nội dung bài viết' rows="3"><?php echo $row['intro'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Nội dung chi tiết</label>
                        <textarea id="txt_fulltext" name="txt_fulltext" placeholder='Nội dung bài viết' ><?php echo $row['fulltext'] ?></textarea>
                    </div>
                </div>
                <div class="text-center">
                    <br/>
                    <a href="?com=foodmenu" class="btn btn-default">Quay lại</a>
                    <input type="submit" name="cmdsave" id="cmdsave"  class="btn btn-primary" value="Lưu thông tin">
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    cbo_Selected('cbo_foodcate','<?php echo $row['cate_id'];?>');
    cbo_Selected('cbo_foodrecommend','<?php echo $row['recom_id'];?>');
    cbo_Selected('cbo_location','<?php echo $row['location_id'];?>');
    cbo_Selected('cbo_position','<?php echo $row['position_id'];?>');

    function checkinput(){
        if($("#txt_name").val()==""){
            $('#err-name').text('Không được bỏ trống');
            $("#txt_name").focus();
            return false;
        }else{
            $('#err-name').text('');
        }

        if($("#cbo_location").val()==""){
            $('#err-location').text('Không được bỏ trống');
            return false;
        }else{
            $('#err-location').text('');
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
            $('#txt_fulltext').summernote({height: 350});
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
        $("#cbo_location").select2();
        $("#cbo_position").select2();
        $("#cbo_foodcate").select2();
        $("#cbo_foodrecommend").select2();
        ComponentsEditors.init();
        $('#frm_action').submit(function(){
            return checkinput();
        })

        $('#cbo_location').change(function(){
            var valOption=this.value;
            $.get('<?php echo ROOTHOST_ADMIN;?>ajaxs/getPosition.php',{valOption},function(response_data){
                $('#cbo_position').html(response_data);
            })
        });

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