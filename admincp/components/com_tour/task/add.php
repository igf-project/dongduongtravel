<link rel="stylesheet" href="<?php echo ROOTHOST.TEM_PATH;?>web/css/searchableOptionList.css">
<script src="<?php echo ROOTHOST.TEM_PATH;?>web/scripts/searchableOptionList.js"></script>
<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
define('TASK_NAME', 'Thêm mới đặt tour');
write_path();
if(isset($_POST['cmdsave'])){
    $arr=implode(',',$_POST['arrLocation']);/* lấy về mảng arrLocation Id từ select box postion */
    if($_POST['txt_code']==''){
        $obj->Code=un_unicode($_POST['txt_name']);
    }
    else{
        $obj->Code=un_unicode($_POST['txt_code']);
    }
    $obj->Name=addslashes($_POST['txt_name']);
    $obj->TourTypeId=(int)($_POST['cbo_category']);
    $obj->AccountId='';
    $obj->NumDay=addslashes($_POST['txt_num_date']);
    $obj->NumNight=addslashes($_POST['txt_num_night']);

    $start_date=date('Y-m-d', strtotime($_POST['txt_start']));
    $obj->Start=$start_date;
    $obj->StartTime=addslashes($_POST['cbo_start_time']);
    $obj->Expediency=addslashes($_POST['cbo_expediency']);
    $obj->RankHotel=addslashes($_POST['txt_rank_hotel']);
    $obj->Intro=addslashes($_POST['txt_intro']);
    $obj->Fulltext=addslashes($_POST['txt_fulltext']);
    $obj->Version=addslashes($_POST['txt_version']);
    $obj->ArrLocation=$arr;
    $obj->Price=addslashes($_POST['txt_price']);
    $obj->PriceChild14=addslashes($_POST['txt_price14']);
    $obj->PriceChild59=addslashes($_POST['txt_price59']);
    $obj->Content=addslashes($_POST['txt_content']);
    $obj->IsActive='1';


    $obj->Thumb=addslashes($_POST['txt_name']);
    /*upload Thumb*/
    if(isset($_FILES['fileImg']) AND $_FILES['fileImg']['name']!=''){
        $objUpload = new CLS_UPLOAD();
        $path = PATH_AVATAR;
        $obj->Thumb = str_replace('../', '', $objUpload->UploadFile('fileImg', $path));
    }
    else $obj->Thumb='';
    $obj->Add_new();
    echo "<script language=\"javascript\">window.location.href='index.php?com=".COMS."'</script>";
}
?>
<h1 align='center'>Đặt tour </h1><hr/>
<div id="action">
    <div class="box-tabs">
        <form id="frm_action" name="frm_action" method="post" action="" enctype="multipart/form-data">
            <div class="box-control">
                <a href="?com=tour" class="btn btn-default pull-left">Quay lại</a>
                <input type="submit" name="cmdsave" id="cmdsave"  class="btn btn-primary pull-right" value="Lưu thông tin">
            </div>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="active">
                    <a href="#info" role="tab" data-toggle="tab">
                        <icon class="fa fa-sms"></icon>Thông tin tour
                    </a>
                </li>
                <li>
                    <a href="#price" role="tab" data-toggle="tab">
                        <i class="fa fa-contact"></i> Giá tour
                    </a>
                </li>
            </ul><br>

            <div class="tab-content">
                <div class="tab-pane fade active in" id="info">
                    <div class="row">
                        <div class='form-group col-md-6'>
                            <label class="control-label">Name </label>
                            <input name="txt_name" type="text" id="txt_name" class='form-control'/>
                        </div>
                        <div class='form-group col-md-6'>
                            <label class="control-label">Mã </label>
                            <input name="txt_code" type="text" id="txt_code" class='form-control'/>
                        </div>
                    </div>
                    <div class="row">
                        <div class='form-group col-md-6'>
                            <label class="control-label">Kiểu tour</label>
                            <select name="cbo_category" id="cbo_category" class='form-control'>
                                <option value=''>-- Chọn nhóm tour --</option>
                                <?php
                                $number = count($AR_TOUR_TYPE);
                                for ($i=0; $i < $number; $i++) { 
                                    $id = $AR_TOUR_TYPE[$i]['id'];
                                    $name = $AR_TOUR_TYPE[$i]['name'];
                                    echo '<option value="'.$id.'">'.$name.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class='form-group col-md-6'>
                            <div class="row">
                                <div class='col-md-6'>
                                    <label class="control-label">Thời gian khởi hành</label>
                                    <select class="form-control" name="cbo_start_time">
                                        <option value="Sáng">Sáng</option>
                                        <option value="Chiều">Chiều</option>
                                        <option value="Tối">Tối</option>
                                    </select>
                                </div>
                                <div class='col-md-6'>
                                    <label class="control-label">Ngày khởi hành</label>
                                    <input type="date" id="datepicker" name="txt_start" class='form-control'>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class='form-group col-md-6'>
                            <div class="row box-cate">
                                <div class='col-md-6'>
                                    <label class="control-label">Số ngày </label>
                                    <input name="txt_num_date" type="text" id="txt_num_date" class='form-control'/>
                                </div>

                                <div class='col-md-6'>
                                    <label class="control-label">Số đêm</label>
                                    <input name="txt_num_night" type="text" id="txt_num_night" class='form-control'/>
                                </div>
                            </div>
                        </div>
                        <div class='form-group col-md-6'>
                            <div class="row">
                                <div class='col-md-6'>
                                    <label class="control-label">Phương tiện</label>
                                    <select class="form-control" name="cbo_expediency">
                                        <?php
                                        $number = count($AR_EXPEDIENCY);
                                        for ($i=0; $i < $number; $i++) { 
                                            $code = $AR_EXPEDIENCY[$i]['code'];
                                            $name = $AR_EXPEDIENCY[$i]['name'];
                                            echo '<option value="'.$code.'">'.$name.'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class='col-md-6'>
                                    <label class="control-label">Hạng khách sạn</label>
                                    <select id="txt_rank_hotel" name="txt_rank_hotel" class="form-control">
                                        <option value="6">Tiêu chuẩn</option>
                                        <option value="1">1 Sao</option>
                                        <option value="2">2 Sao</option>
                                        <option value="3">3 Sao</option>
                                        <option value="4">4 Sao</option>
                                        <option value="5">5 Sao</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class='form-group col-md-6'>
                            <label class="control-label">Version tour</label>
                            <input name="txt_version" type="text" id="txt_version" class='form-control'/>
                        </div>
                        <div class='form-group col-md-6'>
                            <label class="control-label">Thumb ảnh</label>
                            <input name="fileImg" type="file" id="file-thumb" class='form-control'/>
                            <div id="show-img">
                                <img class="img-display" src="<?php echo ROOTHOST.THUMB_DEFAULT;?>">
                            </div>
                        </div>
                    </div>
                    <div class="box-select" style="margin-bottom: 12px">
                        <label class="control-label">Add các địa danh Tour thăm quan</label>
                        <div class="clearfix"></div>
                        <select id="cbo_location" class="cbo_location" name="arrLocation[]" multiple="multiple">
                            <?php 
                            $sql="SELECT id, name, code FROM tbl_location WHERE ".$swhere." `isactive`='1' ORDER BY `name` ASC";
                            $objdata->Query($sql);
                            while($row_Lo=$objdata->Fetch_Assoc()){
                                $id=$row_Lo['id'];
                                $name=$row_Lo['name'];
                                echo '<option value="'.$id.'">'.$name.'</option>';
                            }
                            ?>
                        </select>
                        <script>
                            $('#cbo_location').searchableOptionList();
                        </script>
                    </div>



                    <div class="form-group">
                        <label>Mô tả về Tour</label>
                        <textarea id="txt_intro" name="txt_intro" placeholder='Nội dung bài viết' ></textarea>
                    </div>
                    <div class="form-group">
                        <label>Nội dung chi tiết bảng giá, dịch vụ</label>
                        <textarea id="txt_fulltext" name="txt_fulltext" placeholder='Nội dung bài viết' ></textarea>
                    </div>

                </div>
                <div class="tab-pane fade" id="price">
                    <div class="row">
                        <div class='form-group col-md-6'>
                            <label class="control-label">Đơn giá</label>
                            <input name="txt_price" type="text" id="txt_price" class='form-control'/>
                        </div>
                    </div>
                    <div class="row">
                        <div class='form-group col-md-6'>
                            <label class="control-label">Giá cho trẻ em 1-4 tuổi</label>
                            <input name="txt_price14" type="text" id="txt_price14" class='form-control'/>
                        </div>
                        <div class='form-group col-md-6'>
                            <label class="control-label">Giá cho trẻ em 5-9 tuổi</label>
                            <input name="txt_price59" type="text" id="txt_price59" class='form-control'/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Nội dung chi tiết bảng giá, dịch vụ</label>
                        <textarea id="txt_content" name="txt_content" placeholder='Nội dung bài viết' ></textarea>
                    </div>
                </div>
                <div class="text-center">
                    <br/>
                    <a href="?com=tour" class="btn btn-default">Quay lại</a>
                    <input type="submit" name="cmdsave" id="cmdsave"  class="btn btn-primary" value="Lưu thông tin">
                </div>
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
        if($("#cbo_category").val()==""){
            alert('Category is require!');
            $("#cbo_category").focus();
            return false;
        }
        if($("#datepicker").val()==""){
            alert('Start date is require!');
            $("#datepicker").focus();
            return false;
        }
        if($("#txt_num_date").val()==""){
            alert('Number date is require!');
            $("#txt_num_date").focus();
            return false;
        }
        if($("#txt_num_night").val()==""){
            alert('Number night is require!');
            $("#txt_num_night").focus();
            return false;
        }
        if($("#file-thumb").val()==""){
            alert('Thumb Image is require!');
            $("#file-thumb").focus();
            return false;
        }

        if($("#txt_version").val()==""){
            alert('Version tour is require!');
            $("#txt_version").focus();
            return false;
        }
        if($("#cbo_location").val()==""){
            alert('Location is require!');
            $("#cbo_location").focus();
            return false;
        }
        if($("#txt_rank_hotel").val()==""){
            alert('Rank Hotel is require!');
            $("#txt_rank_hotel").focus();
            return false;
        }

        if($("#txt_price").val()==""){

            alert('Price is require!');
            $('.nav-tabs a[href="#price"]').tab('show');
            $("#txt_price").focus();
            return false;
        }
        if($("#txt_price14").val()==""){
            alert('Price for children 1-4 is require!');
            $('.nav-tabs a[href="#price"]').tab('show');
            $("#txt_price14").focus();
            return false;
        }
        if($("#txt_price59").val()==""){
            alert('Price for children 5-9 is require!');
            $('.nav-tabs a[href="#price"]').tab('show');
            $("#txt_price59").focus();
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
            $('#txt_fulltext').summernote({height: 250});
            $('#txt_content').summernote({height: 250});
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