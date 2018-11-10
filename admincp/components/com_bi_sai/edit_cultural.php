<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
$position_id = isset($_GET['pos']) ? (int)$_GET['pos']:'';
$ID = isset($_GET['id']) ? (int)$_GET['id']:'';
$objdata=new CLS_MYSQL();


if(isset($_POST['cmdsave'])){
    $post_location_id = (int)$_POST['txt_location_id'];
    $post_position_id = (int)$_POST['txt_position_id'];
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

    $sql="UPDATE tbl_location_content_cultural SET 
    `location_id`='$post_location_id',
    `position_id`='$post_position_id',
    `name` = '$post_name',
    `code` = '$post_code',
    `intro` = '$post_intro',
    `fulltext` = '$post_fulltext',
    `thumb` = '$post_thumb',
    `mdate` = '$date',
    `meta_title` = '$post_meta_title',
    `meta_key` = '$post_meta_key',
    `meta_desc` = '$post_meta_desc'
    WHERE id= $ID";
    $objdata->Query($sql);

    echo "<script>window.location.href='index.php?com=".COMS."&task=list-vanhoa&pos=".$position_id."'</script>";
}

if($position_id!=''){
    $sql="SELECT `name`, `code`, `id`, `location_id` FROM tbl_position WHERE id= $position_id ";
    $objdata->Query($sql);
    $r=$objdata->Fetch_Assoc();
    $location_id = $r['location_id'];

    define('TASK_NAME', 'Thêm mới bài viết văn hóa cho <font color="red">'.$r["name"].'</font>');
    write_path();

    $sql="SELECT * FROM tbl_location_content_cultural WHERE id= $ID ";
    $objdata->Query($sql);
    $row=$objdata->Fetch_Assoc();

    ?>
    <h1 align='center'>Thêm bài viết văn hóa <font color="red"><?php echo $r["name"] ?></font></h1><hr/>
    <div id="action">
        <div class="box-tabs">
            <form id="frm_action" name="frm_action" method="post" action="" enctype="multipart/form-data">
                <input type="hidden" name="txt_location_id" value="<?php echo $location_id; ?>">
                <input type="hidden" name="txt_position_id" value="<?php echo $position_id; ?>">
                <div class="box-control">
                    <a href="?com=position&task=list-vanhoa&pos=<?php echo $position_id ?>" class="btn btn-default pull-left">Quay lại</a>
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
                                <input name="txt_name" type="text" id="txt_name" value="<?php echo $row['name'] ?>" class='form-control' required/>
                            </div>

                            <div class='form-group col-md-6'>
                                <label class="control-label"><strong>Thumb ảnh</strong></label>
                                <input name="fileImg" type="file" id="file-thumb" size="45" class='form-control' value="<?php echo $row['thumb'];?>" placeholder='' />
                                <input name="url_image" type="hidden" value="<?php echo $row['thumb'];?>"/>
                                <div id="show-img">
                                    <img class="img-display" src="<?php echo $row['thumb']==''? ROOTHOST.THUMB_DEFAULT:ROOTHOST.$row['thumb'];?>">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Giới thiệu ngắn (20 từ)</label>
                            <textarea id="txt_intro" name="txt_intro" class="form-control" rows="3  " placeholder='Nội dung bài viết' ><?php echo $row['intro'] ?></textarea>
                        </div>

                        <div class="form-group">
                            <label>Nội dung</label>
                            <textarea id="txt_fulltext" name="txt_fulltext" placeholder='Nội dung bài viết' ><?php echo $row['fulltext'] ?></textarea>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="seo">
                        <div class="row">
                            <div class='form-group col-md-6'>
                                <label class="control-label"><strong>Mô tả tiêu đề</strong></label>
                                <input name="txt_meta_title" type="text" id="txt_meta_title" class='form-control' value="<?php echo $row['meta_title'] ?>" placeholder='' />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label><strong>Danh sách từ khóa</strong></label>
                                <input name="txt_meta_key" type="text" id="txt_meta_key" class='form-control' value="<?php echo $row['meta_key'] ?>" placeholder='' />
                                <span class="note">Mỗi từ khóa cách nhau bởi dấu ,</span>
                            </div>

                        </div>
                        <div class="form-group">
                            <label><strong>Description</strong></label>
                            <textarea name="txt_meta_desc" id="txt_meta_desc" class="form-control" rows="5"><?php echo $row['meta_desc'] ?></textarea>
                        </div>
                    </div>
                    <div class="text-center">
                        <br/>
                        <a href="?com=position&task=list-vanhoa&pos=<?php echo $position_id ?>" class="btn btn-default">Quay lại</a>
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