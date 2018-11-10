<?php
global $AR_COUNTRY;
global $AR_POSITION_GROUP;
$objdata=new CLS_MYSQL();
define('TASK_NAME', 'Thêm địa điểm');
write_path();
defined("ISHOME") or die("Can't acess this page, please come back!");

if(isset($_POST['cmdsave'])){
    if($_POST['txt_code']=='')
        $obj->Code=un_unicode($_POST['txt_name']);
    else 
        $obj->Code=un_unicode($_POST['txt_code']);
    /*position*/
    $positiontype_id =(int)$_POST['cbo_position_type'];
    $obj->positiontypeId=(int)$_POST['cbo_position_type'];
    $obj->positiongrouptypeId=(int)$_POST['cbo_position_group_type'];
    $obj->Name=addslashes($_POST['txt_name']);
    $obj->Intro=addslashes($_POST['txt_intro']);
    $obj->Fulltext=addslashes($_POST['txt_fulltext']);
    $obj->H1=addslashes($_POST['txt_h1']);
    $obj->metaTitle=addslashes($_POST['txt_meta_title']);
    $obj->metaKey=addslashes($_POST['txt_meta_key']);
    $obj->metaDesc=addslashes($_POST['txt_meta_desc']);
    $obj->isActive='1';
    $obj->Order=0;

    $obj->CountryID=(int)$_POST['cbo_countries'];
    $obj->LocationID=(int)$_POST['cbo_location'];
    $obj->Phone=addslashes($_POST['txt_phone']);
    $obj->Address=addslashes($_POST['txt_address']);
    $obj->Email=addslashes($_POST['txt_email']);
    $obj->Website=addslashes($_POST['txt_website']);
    $obj->Latlng='';
    $path = '../'.PATH_AVATAR;
    /*upload avatar*/
    if(isset($_FILES['fileImg']) AND $_FILES['fileImg']['name']!=''){
        $objUpload=new CLS_UPLOAD();
        $obj->Avatar = str_replace('../', '', $objUpload->UploadFile('fileImg', $path));
    }
    else $obj->Avatar='';
    $obj->Add_new();
    echo "<script language=\"javascript\">window.location.href='index.php?com=".COMS."'</script>";
}
?>
<h1 align='center'>Thêm địa điểm </h1><hr/>
<div id="action">
    <div class="box-tabs">

        <form id="frm_action" name="frm_action" method="post" action="" enctype="multipart/form-data">
            <div class="box-control">
                <a href="?com=position" class="btn btn-default pull-left">Quay lại</a>
                <input type="submit" name="cmdsave" id="cmdsave"  class="btn btn-primary pull-right" value="Lưu thông tin">
            </div>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="active">
                    <a href="#home" role="tab" data-toggle="tab">
                        <i class="fa fa-home"></i> Thông tin chung
                    </a>
                </li>
                <li>
                    <a href="#profile" role="tab" data-toggle="tab">
                        <i class="fa fa-user"></i> Thông tin liên hệ
                    </a>
                </li>
                <li>
                    <a href="#seo" role="tab" data-toggle="tab">
                        <i class="fa fa-contact"></i> Từ khóa seo
                    </a>
                </li>
            </ul><br>
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane fade active in" id="home">
                    <div class="row">
                        <div class='form-group col-md-6'>
                            <label class="control-label">Nhóm đối tượng </label>
                            <select name="cbo_position_group_type" id="cbo_position_group_type" class='form-control'>
                                <option value="">--- Chọn nhóm đối tượng ---</option>
                                <?php
                                $number = count($AR_POSITION_GROUP);
                                for ($i=0; $i < $number; $i++) { 
                                    $id = $AR_POSITION_GROUP[$i]['id'];
                                    $name = $AR_POSITION_GROUP[$i]['name'];
                                    echo '<option value="'.$id.'">'.$name.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class='form-group col-md-6'>
                            <label class="control-label">Kiểu đối tượng </label>
                            <select name="cbo_position_type" id="cbo_position_type" class='form-control'>
                                <option value="">--- Chọn kiểu đối tượng ---</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class='form-group col-md-6'>
                            <label class="control-label">Tên địa điểm</label>
                            <input name="txt_name" type="text" id="txt_name" size="45" class='form-control' value="" placeholder='' />
                        </div>
                        <div class='form-group col-md-6'>
                            <label class="control-label">Mã</label>
                            <input name="txt_code" type="text" id="txt_code" size="45" class='form-control' value="" placeholder='' />
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Mô tả</label>
                        <textarea id="txt_intro" name="txt_intro" placeholder='Mô tả bài viết' ></textarea>
                    </div>
                    <div class="form-group">
                        <label>Nội dung chi tiết</label>
                        <textarea id="txt_fulltext" name="txt_fulltext" placeholder='Nội dung bài viết' ></textarea>
                    </div>
                </div>
                <div class="tab-pane fade" id="profile">
                    <div id="list">
                        <input name="txt_contact_name" type="hidden" id="txt_contact_name" size="45" class='form-control' value="Cơ sở chính" placeholder='' />
                        <div class="row">
                            <div class='form-group col-md-6'>
                                <label class="control-label">Thuộc quốc gia</label>
                                <select name="cbo_countries" id="cbo_countries" style="width: 100%;">
                                    <?php
                                    $number = count($AR_COUNTRY);
                                    for ($i=0; $i < $number; $i++) { 
                                        $id = $AR_COUNTRY[$i]['id'];
                                        $name = $AR_COUNTRY[$i]['name'];
                                        echo '<option value="'.$id.'">'.$name.'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class='form-group col-md-6'>
                                <label class="control-label">Thuộc tỉnh thành</label>
                                <select name="cbo_location" id="cbo_location" style="width: 100%;">
                                    <option value="">--- Chọn tỉnh/ thành phố ---</option>
                                    <?php
                                    $sql="SELECT id, name, code FROM tbl_location WHERE `isactive`='1' ORDER BY `name` ASC";
                                    $objdata->Query($sql);
                                    while($rows=$objdata->Fetch_Assoc()){
                                        $id=$rows['id'];
                                        $name=$rows['name'];
                                        echo '<option value="'.$id.'">'.$name.'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class='form-group col-md-6'>
                                <label class="control-label">Địa chỉ</label>
                                <input name="txt_address" type="text" id="txt_address" size="45" class='form-control' value="" placeholder='' />
                            </div>
                            <div class='form-group col-md-6'>
                                <label class="control-label">Email</label>
                                <input name="txt_email" type="text" id="txt_email" size="45" class='form-control' value="" placeholder='' />
                            </div>

                        </div>

                        <div class="row">

                            <div class='form-group col-md-6'>
                                <label class="control-label">Phone</label>
                                <input name="txt_phone" type="text" id="txt_phone" size="45" class='form-control' value="" placeholder='' />
                            </div>
                            <div class='form-group col-md-6'>
                                <label class="control-label">Website</label>
                                <input name="txt_website" type="text" id="txt_website" size="45" class='form-control' value="" placeholder='' />
                            </div>
                        </div>
                        <div class="row">
                            <div class='form-group col-md-6'>
                                <label class="control-label">Ảnh đại diện</label>
                                <input name="fileImg" type="file" id="file-thumb" size="45" class='form-control' value="" placeholder='' />
                                <div id="show-img">
                                    <img class="img-display" src="<?php echo ROOTHOST.THUMB_DEFAULT;?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="seo">

                    <div class="row">
                        <div class='form-group col-md-6'>
                            <label class="control-label">Mô tả tiêu đề</label>
                            <input name="txt_meta_title" type="text" id="txt_meta_title" size="45" class='form-control' value="" placeholder='' />
                        </div>
                        <div class='form-group col-md-6'>
                            <label class="control-label">Từ khóa H1</label>
                            <input name="txt_h1" type="text" id="txt_h1" size="45" class='form-control' value="" placeholder='' />
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Danh sách từ khóa</label>
                            <input name="txt_meta_key" type="text" id="txt_meta_key" size="45" class='form-control' value="" placeholder='' />
                            <span class="note">Mỗi từ khóa cách nhau bởi dấu ,</span>
                        </div>

                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="txt_meta_desc" id="txt_meta_desc" size="45"></textarea>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <br/>
                <a href="?com=position" class="btn btn-default">Quay lại</a>
                <input type="submit" name="cmdsave" id="cmdsave"  class="btn btn-primary" value="Lưu thông tin">
            </div>
        </form>
    </div>
</div>


<script language="javascript">
    function checkinput(){
        if($("#txt_name").val()==""){
            alert('Name is require!');
            $("#txt_name").focus();
            return false;
        }
        if($("#cbo_position_group_type").val()==""){
            alert('Position group type is require!');
            $("#cbo_position_group_type").focus();
            return false;
        }
        if($("#cbo_position_type").val()==""){
            alert('Position type is require!');
            $("#cbo_position_type").focus();
            return false;
        }

        if($("#txt_contact_name").val()==""){
            alert('Name is require!');
            $('.nav-tabs a[href="#profile"]').tab('show');
            $("#txt_contact_name").focus();
            return false;
        }
        if($("#cbo_countries").val()==""){
            alert('Countries is require!');
            $('.nav-tabs a[href="#profile"]').tab('show');
            $("#cbo_countries").focus();
            return false;
        }
        if($("#cbo_location").val()==""){
            alert('Location is require!');
            $('.nav-tabs a[href="#profile"]').tab('show');
            $("#cbo_location").focus();
            return false;
        }
        if($("#txt_address").val()==""){
            alert('Address is require!');
            $('.nav-tabs a[href="#profile"]').tab('show');
            $("#txt_address").focus();
            return false;
        }
        // check validate email
        if($("#txt_email").val() !=""){
            var value=$("#txt_email").val();
            var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
            if(!value.match(re)){
                alert('Email is not validate!');
                $("#txt_email").focus();
                return false;
            }
        }
        else{
            alert('Email is require!');
            $("#txt_email").focus();
            return false;
        }

        //Check is number phone
        if($("#txt_phone").val() !=""){
            var valueP=$("#txt_phone").val();
            var phoneno =/^[\d\.\-]+$/;;
            if(!valueP.match(phoneno)){
                alert('Phone is not validate number!');
                $("#txt_phone").focus();
                return false;
            }
        }
        else{
            alert('Number Phone is require!');
            $("#txt_phone").focus();
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
            $('#txt_intro').summernote({height: 80});
            $('#txt_fulltext').summernote({height: 350});
            $('#txt_meta_desc').summernote({height: 150});
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
        $('#frm_action').submit(function(){
            return checkinput();
        })
        $("#cbo_countries").select2();
        $("#cbo_location").select2();

        ComponentsEditors.init();
        $('#cbo_position_group_type').change(function(){
            var valOption=this.value;
            $.get('<?php echo ROOTHOST_ADMIN;?>ajaxs/getPositionType.php',{valOption},function(response_data){
                $('#cbo_position_type').html(response_data);
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