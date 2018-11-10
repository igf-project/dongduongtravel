<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
$location_id = isset($_GET['loc']) ? (int)$_GET['loc']:'';
$objdata=new CLS_MYSQL();


if(isset($_POST['cmdsave'])){
    $post_location_id = (int)$_POST['txt_location_id'];
    $post_position_id = (int)$_POST['cbo_position'];
    $post_name = stripcslashes($_POST['txt_name']);
    $post_code = un_unicode($_POST['txt_name']);
    $post_intro = strip_tags($_POST['txt_intro']);
    $post_fulltext = stripcslashes($_POST['txt_fulltext']);
    $date = time();
    $post_meta_title= stripcslashes($_POST['txt_meta_title']);
    $post_meta_key= stripcslashes($_POST['txt_meta_key']);
    $post_meta_desc= stripcslashes($_POST['txt_meta_desc']);
    /*upload thumb*/
    $path = '../'.PATH_THUMB;
    if(isset($_FILES['fileImg']) AND $_FILES['fileImg']['name']!=''){
        $objUpload=new CLS_UPLOAD();
        $post_thumb = str_replace('../', '', $objUpload->UploadFile('fileImg', $path));
    }
    else $post_thumb='';

    $sql="INSERT INTO tbl_location_content_history (`location_id`,`position_id`,`name`,`code`,`intro`,`fulltext`,`thumb`,`cdate`,`meta_title`,`meta_key`,`meta_desc`,`isactive`) VALUES ('$post_location_id' , '$post_position_id' , '$post_name' , '$post_code' , '$post_intro' , '$post_fulltext', '$post_thumb', '$date', '$post_meta_title', '$post_meta_key', '$post_meta_desc' , 1)";
    $objdata->Query($sql);

    echo "<script>window.location.href='index.php?com=".COMS."&task=list-lichsu&loc=".$location_id."'</script>";
}

if($location_id!=''){
    $sql="SELECT `name`, `code`, `id` FROM tbl_location WHERE id= $location_id ";
    $objdata->Query($sql);
    $r=$objdata->Fetch_Assoc();

    define('TASK_NAME', 'Thêm mới bài viết lịch sử cho <font color="red">'.$r["name"].'</font>');
    write_path();
    ?>
    <h1 align='center'>Thêm bài viết lịch sử <font color="red"><?php echo $r["name"] ?></font></h1><hr/>
    <div id="action">
        <div class="box-tabs">
            <form id="frm_action" name="frm_action" method="post" action="" enctype="multipart/form-data">
                <input type="hidden" name="txt_location_id" value="<?php echo $location_id; ?>">
                <div class="box-control">
                    <a href="?com=location&task=list-lichsu&loc=<?php echo $location_id ?>" class="btn btn-default pull-left">Quay lại</a>
                    <input type="submit" name="cmdsave" id="cmdsave"  class="btn btn-primary pull-right" value="Lưu thông tin">
                </div>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="active">
                        <a href="#home" role="tab" data-toggle="tab">
                            <icon class="fa fa-sms"></icon>Bài viết
                        </a>
                    </li>

                    <li>
                        <a href="#seo" role="tab" data-toggle="tab">
                            <i class="fa fa-contact"></i> Từ khóa seo
                        </a>
                    </li>
                </ul><br>
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="home">
                        <div class="row">
                            <div class='form-group col-md-6'>
                                <label class="control-label">Tên</label>
                                <input name="txt_name" type="text" id="txt_name" class='form-control' required/>
                            </div>
                            <div class='form-group col-md-6'>
                                <label class="control-label">Địa điểm </label><small> (Không bắt buộc)</small>
                                <select id="cbo_position" name="cbo_position" class="form-control" style="width: 100%;">
                                    <option value="">Địa điểm</option>
                                    <?php
                                    $sql="SELECT `id`,`name` FROM tbl_position WHERE isactive=1 AND location_id=$location_id ";
                                    $objdata->Query($sql);
                                    while ($row_pos=$objdata->Fetch_Assoc()) {
                                        echo '<option value="'.$row_pos['id'].'">'.$row_pos['name'].'</option>';
                                    }
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
                            <label>Giới thiệu ngắn (20 từ)</label>
                            <textarea id="txt_intro" name="txt_intro" class="form-control" rows="3  " placeholder='Nội dung bài viết' ></textarea>
                        </div>

                        <div class="form-group">
                            <label>Nội dung</label>
                            <textarea id="txt_fulltext" name="txt_fulltext" placeholder='Nội dung bài viết' ></textarea>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="seo">
                        <div class="row">
                            <div class='form-group col-md-6'>
                                <label class="control-label"><strong>Mô tả tiêu đề</strong></label>
                                <input name="txt_meta_title" type="text" id="txt_meta_title" size="45" class='form-control' value="" placeholder='' />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label><strong>Danh sách từ khóa</strong></label>
                                <input name="txt_meta_key" type="text" id="txt_meta_key" class='form-control' value="" placeholder='' />
                                <span class="note">Mỗi từ khóa cách nhau bởi dấu ,</span>
                            </div>

                        </div>
                        <div class="form-group">
                            <label><strong>Description</strong></label>
                            <textarea name="txt_meta_desc" id="txt_meta_desc" class="form-control" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="text-center">
                        <br/>
                        <a href="?com=location&task=list-lichsu&loc=<?php echo $location_id ?>" class="btn btn-default">Quay lại</a>
                        <input type="submit" name="cmdsave" id="cmdsave"  class="btn btn-primary" value="Lưu thông tin">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
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
            $("#cbo_position").select2();
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
    <?php
} ?>