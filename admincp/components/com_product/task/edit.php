<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
define('TASK_NAME', 'Sửa quà tặng');
write_path();

$ID = isset($_GET['id']) ? (int)$_GET['id'] : '';
$sql="SELECT * FROM tbl_product WHERE id=$ID ";
$objdata->Query($sql);
$row = $objdata->Fetch_Assoc();

if(isset($_POST['cmdsave'])){
    if($_POST['txt_code']==''){
        $post_Code=un_unicode($_POST['txt_name']);
    }
    else{
        $post_Code=un_unicode($_POST['txt_code']);
    }
    $post_CataId=(int)$_POST['cbo_catalog'];
    $post_LocationId=(int)$_POST['cbo_location'];
    $post_PositionId=(int)$_POST['cbo_position'];
    $post_Name=addslashes($_POST['txt_name']);
    $post_Author=addslashes($_POST['txt_author']);
    $post_Intro=addslashes($_POST['txt_intro']);
    $post_Cur_price=addslashes($_POST['txt_price']);
    $post_Quantity=addslashes($_POST['txt_quantity']);
    $post_Fulltext=addslashes($_POST['txt_fulltext']);
    $post_MTitle=addslashes($_POST['txt_meta_title']);
    $post_MKey=addslashes($_POST['txt_meta_key']);
    $post_MDesc=addslashes($_POST['txt_meta_desc']);
    $date = time('Y-m-d');
    $post_ID = (int)$_POST['txtid'];
    
    if(isset($_FILES['fileImg']) AND $_FILES['fileImg']['name']!=''){
        $objUpload=new CLS_UPLOAD();
        $path='../'.PATH_AVATAR;
        $post_Thumb = str_replace('../', '', $objUpload->UploadFile('fileImg', $path));
    }
    else $post_Thumb= addslashes($_POST['url_image']);
    $sql="UPDATE `tbl_product` SET
    `cata_id`='".$post_CataId."',
    `pro_code`='".$post_Code."',
    `location_id`='".$post_LocationId."',
    `position_id`='".$post_PositionId."',
    `name`='".$post_Name."',
    `intro`='".$post_Intro."',
    `fulltext`='".$post_Fulltext."',
    `thumb`='".$post_Thumb."',
    `cur_price`='".$post_Cur_price."',
    `quantity`='".$post_Quantity."',
    `mdate`='".$date."',
    `author`='".$_SESSION[MD5($_SERVER['HTTP_HOST']).'_USERLOGIN']."',
    `meta_title`='".$post_MTitle."',
    `meta_key`='".$post_MKey."',
    `meta_desc`='".$post_MDesc."'
    WHERE `ID`='".$post_ID."'";
    $objdata->Query($sql);
    echo "<script>window.location.href='index.php?com=".COMS."'</script>";
}
?>

<h1 align='center'>Sửa quà tặng </h1><hr/>
<div id="action">
    <div class="box-tabs">
        <div id="action">
            <form id="frm_action" name="frm_action" method="post" action=""  enctype="multipart/form-data">
                <input type="hidden" name="txtid" value="<?php echo $row['id'] ?>">
                <div class="box-control">
                    <a href="?com=product" class="btn btn-default pull-left">Quay lại</a>
                    <input type="submit" name="cmdsave" id="cmdsave" class="btn btn-primary pull-right" value="Lưu thông tin">
                </div>

                <ul class="nav nav-tabs" role="tablist">
                    <li class="active">
                        <a href="#info" role="tab" data-toggle="tab">
                            <icon class="fa fa-sms"></icon>Thông tin chung
                        </a>
                    </li>
                    <li>
                        <a href="#seo" role="tab" data-toggle="tab">
                            <i class="fa fa-contact"></i> Từ khóa seo
                        </a>
                    </li>
                </ul><br>

                <div class="tab-content">
                    <div class="tab-pane fade active in" id="info">
                        <div class="row">
                            <div class='form-group col-md-6'>
                                <label class="control-label">Tên <font color="red"> *</font></label>
                                <input name="txt_name" type="text" id="txt_name" class='form-control' value="<?php echo $row['name'] ?>" required/>
                                <font id="err-name" color="red"></font>
                            </div>
                            <div class='form-group col-md-6'>
                                <label class="control-label">Mã quà tặng <font color="red"> *</font></label>
                                <input name="txt_code" type="text" id="txt_code" class='form-control' value="<?php echo $row['pro_code'] ?>" required />
                                <font id="err-code" color="red"></font>
                            </div>
                            <div class='form-group col-md-6'>
                                <label class="control-label">Nhóm quà tặng <font color="red"> *</font></label>
                                <select name="cbo_catalog" id="cbo_catalog" class='form-control'>
                                    <option value="0">--Chọn nhóm quà tặng --</option>
                                    <?php
                                    $sql="SELECT * FROM tbl_catalog WHERE isactive=1";
                                    $objdata->Query($sql);
                                    while ($row_cata=$objdata->Fetch_Assoc()) {
                                        echo '<option value="'.$row_cata['cat_id'].'">'.$row_cata['name'].'</option>';
                                    }
                                    ?>
                                </select>
                                <font id="err-catalog" color="red"></font>
                            </div>
                            <div class='form-group col-md-6'>
                                <label class="control-label">Tác giả <font color="red"> *</font></label>
                                <input name="txt_author" type="text" id="txt_author" class='form-control' value="<?php echo $row['author'] ?>" readonly />
                            </div>
                            <div class='form-group col-md-6'>
                                <label class="control-label">Đơn giá <font color="red"> *</font></label>
                                <input name="txt_price" type="text" id="txt_price" class='form-control' value="<?php echo $row['cur_price'] ?>" required />
                                <font id="err-price" color="red"></font>
                            </div>
                            <div class='form-group col-md-6'>
                                <label class="control-label">Số lượng</label>
                                <input name="txt_quantity" type="text" id="txt_quantity" class='form-control' value="<?php echo $row['quantity'] ?>" />
                            </div>
                            <div class='form-group col-md-6'>
                                <label class="control-label">Thuộc địa danh <font color="red"> *</font></label>
                                <select name="cbo_location" id="cbo_location" class='form-control' required>
                                    <option value=''>-- Tỉnh thành --</option>
                                    <?php
                                    $sql="SELECT * FROM tbl_location WHERE isactive=1";
                                    $objdata->Query($sql);
                                    while ($row_cata=$objdata->Fetch_Assoc()) {
                                        echo '<option value="'.$row_cata['id'].'">'.$row_cata['name'].'</option>';
                                    }
                                    ?>
                                </select>
                                <font id="err-location" color="red"></font>
                            </div>
                            <div class='form-group col-md-6'>
                                <label class="control-label">Thuộc địa điểm</label>
                                <select name="cbo_position" id="cbo_position" class='form-control'>
                                    <option value=''>-- Địa điểm --</option>
                                    <?php
                                    $sql="SELECT * FROM tbl_position WHERE isactive=1";
                                    $objdata->Query($sql);
                                    while ($row_cata=$objdata->Fetch_Assoc()) {
                                        echo '<option value="'.$row_cata['id'].'">'.$row_cata['name'].'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class='form-group col-md-6'>
                                <label class="control-label">Thumb ảnh</label>
                                <input name="fileImg" type="file" id="file-thumb" size="45" class='form-control'/>
                                <input name="url_image" type="hidden" value="<?php echo $row['thumb'];?>"/>
                                <div id="show-img">
                                    <img class="img-display" src="<?php echo ROOTHOST.$row['thumb'];?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label> Mô tả ngắn</label>
                            <textarea class="form-control" name="txt_intro" id="txt_intro" rows="5"><?php echo $row['intro'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label> Nội dung</label>
                            <textarea class="form-control" name="txt_fulltext" id="txt_fulltext" rows="5"><?php echo $row['fulltext'] ?></textarea>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="seo">
                        <div class='form-group col-md-12'>
                            <label>Mô tả tiêu đề</label>
                            <input name="txt_meta_title" type="text" id="txt_meta_title" class='form-control' value="<?php echo $row['meta_title'] ?>" />
                        </div>
                        <div class="form-group col-md-12">
                            <label>Danh sách từ khóa </label><small class="note"> (Mỗi từ khóa cách nhau bởi dấu ,)</small>
                            <input name="txt_meta_key" type="text" id="txt_meta_key" class='form-control' <?php echo $row['meta_key'] ?>/>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Description</label>
                            <textarea class='form-control' name="txt_meta_desc" id="txt_meta_desc" rows="3"><?php echo $row['meta_desc'] ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <br/>
                    <a href="?com=product" class="btn btn-default">Quay lại</a>
                    <input type="submit" name="cmdsave" id="cmdsave"  class="btn btn-primary" value="Lưu thông tin">
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    cbo_Selected('cbo_position','<?php echo $row['position_id'];?>');
    cbo_Selected('cbo_location','<?php echo $row['location_id'];?>');
    cbo_Selected('cbo_catalog','<?php echo $row['cata_id'];?>');

    function checkinput(){
        if($("#txt_name").val()==""){
            $("#err-name").text('Vui lòng nhập tên');
            $("#txt_name").focus();
            return false;
        }else{
            $("#err-name").text('');
        }

        if($("#txt_code").val()==""){
            $("#err-code").text('Vui lòng nhập mã');
            $("#txt_code").focus();
            return false;
        }else{
            $("#err-code").text('');
        }

        if($("#cbo_catalog").val()==""){
            $("#err-catalog").text('Vui lòng chọn một đối tượng');
            return false;
        }else{
            $("#err-catalog").text('');
        }

        if($("#txt_price").val()==""){
            $("#err-price").text('Vui lòng nhập giá');
            $("#txt_price").focus();
            return false;
        }else{
            $("#err-price").text('');
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
            $('#txt_intro').summernote({height: 80});
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
    $(document).ready(function() {
        ComponentsEditors.init();
        $("#cbo_position").select2();
        $("#cbo_location").select2();
        $('#frm_action').submit(function(){
            return checkinput();
        })
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
</script>