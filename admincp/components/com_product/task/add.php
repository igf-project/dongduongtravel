<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
define('TASK_NAME', 'Thêm quà tặng');
write_path();

$cur_date=date('Y-m-d');
$sql="SELECT count(*) as total FROM `tbl_product` where `cdate` LIKE'".$cur_date."%'";
$obj_sql=new CLS_MYSQL;
$obj_sql->Query($sql);
$r=$obj_sql->Fetch_Assoc();
$count=$r['total'];
$count++;
if(0<$count && $count<10)           
    $count='0'.$count;
$pro_code=SHOP_CODE.date('dmy').'-'.$count;

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
    $post_Author= $_SESSION[MD5($_SERVER['HTTP_HOST']).'_USERLOGIN'];
    $post_Intro=addslashes($_POST['txt_intro']);
    $post_Cur_price=addslashes($_POST['txt_price']);
    $post_Quantity=addslashes($_POST['txt_quantity']);
    $post_Fulltext=addslashes($_POST['txt_fulltext']);
    $post_MTitle=addslashes($_POST['txt_meta_title']);
    $post_MKey=addslashes($_POST['txt_meta_key']);
    $post_MDesc=addslashes($_POST['txt_meta_desc']);
    $date = time('Y-m-d');
    
    if(isset($_FILES['fileImg']) AND $_FILES['fileImg']['name']!=''){
        $objUpload=new CLS_UPLOAD();
        $path='../'.PATH_AVATAR;
        $post_Thumb = str_replace('../', '', $objUpload->UploadFile('fileImg', $path));
    }
    else $post_Thumb='';
    $sql="INSERT INTO `tbl_product` (`pro_code`,`cata_id`,`position_id`,`location_id`, `name`,`intro`,`fulltext`,`thumb`,`cur_price`, `quantity`,`author`,`cdate`,`meta_title`,`meta_key`,`meta_desc`) VALUES('".$post_Code."','".$post_CataId."','".$post_PositionId."','".$post_LocationId."','".$post_Name."','".$post_Intro."','".$post_Fulltext."','".$post_Thumb."','".$post_Cur_price."','".$post_Quantity."','".$post_Author."','".$date."','".$post_MTitle."','".$post_MKey."','".$post_MDesc."')";
    $objdata->Query($sql);
    echo "<script>window.location.href='index.php?com=".COMS."'</script>";
}
?>

<h1 align='center'>Thêm quà tặng </h1><hr/>
<div id="action">
    <div class="box-tabs">
        <div id="action">
            <form id="frm_action" name="frm_action" method="post" action=""  enctype="multipart/form-data">
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
                                <input name="txt_name" type="text" id="txt_name" class='form-control' required/>
                                <font id="err-name" color="red"></font>
                            </div>
                            <div class='form-group col-md-6'>
                                <label class="control-label">Mã quà tặng <font color="red"> *</font></label>
                                <input name="txt_code" type="text" id="txt_code" class='form-control' value="<?php echo $pro_code ?>" required />
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
                                <input name="txt_author" type="text" id="txt_author" class='form-control' value="<?php echo $_SESSION[MD5($_SERVER['HTTP_HOST']).'_USERLOGIN'] ?>" readonly />
                            </div>
                            <div class='form-group col-md-6'>
                                <label class="control-label">Đơn giá <font color="red"> *</font></label>
                                <input name="txt_price" type="text" id="txt_price" class='form-control' required />
                                <font id="err-price" color="red"></font>
                            </div>
                            <div class='form-group col-md-6'>
                                <label class="control-label">Số lượng</label>
                                <input name="txt_quantity" type="text" id="txt_quantity" class='form-control'/>
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
                                <div id="show-img">
                                    <img class="img-display" src="<?php echo ROOTHOST.THUMB_DEFAULT;?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label> Mô tả ngắn</label>
                            <textarea class="form-control" name="txt_intro" id="txt_intro" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label> Nội dung</label>
                            <textarea class="form-control" name="txt_fulltext" id="txt_fulltext" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="seo">
                        <div class='form-group col-md-12'>
                            <label>Mô tả tiêu đề</label>
                            <input name="txt_meta_title" type="text" id="txt_meta_title" class='form-control'/>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Danh sách từ khóa </label><small class="note"> (Mỗi từ khóa cách nhau bởi dấu ,)</small>
                            <input name="txt_meta_key" type="text" id="txt_meta_key" class='form-control'/>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Description</label>
                            <textarea class='form-control' name="txt_meta_desc" id="txt_meta_desc" rows="3"></textarea>
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