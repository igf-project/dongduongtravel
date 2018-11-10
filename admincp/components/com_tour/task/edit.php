<link rel="stylesheet" href="<?php echo ROOTHOST.TEM_PATH;?>web/css/searchableOptionList.css">
<script src="<?php echo ROOTHOST.TEM_PATH;?>web/scripts/searchableOptionList.js"></script>

<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
define('TASK_NAME', 'Sửa thông tin đặt tour');
write_path();
$id=isset($_GET["id"])?(int)$_GET["id"]:"";


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
    else $obj->Thumb=$_POST['url_image'];

    $obj->ID=(int)$_POST['txtid'];
    $obj->Update();
    echo "<script language=\"javascript\">window.location.href='index.php?com=".COMS."'</script>";
}



$obj->getListAll('WHERE `tbl_tour`.`id`='.$id.'');
$row=$obj->Fetch_Assoc();
?>
<h1 align='center'>Sửa thông tin đặt tour</h1><hr/>
<div id="action">
    <div class="box-tabs">
        <form id="frm_action" name="frm_action" method="post" action=""  enctype="multipart/form-data">
            <input name="txtid" type="hidden" id="txtid" value="<?php echo $row['id']?>"/>
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
                            <label class="control-label"><strong>Name </strong></label>
                            <input name="txt_name" type="text" id="txt_name" class='form-control' value="<?php echo $row['name']?>" placeholder='' />
                        </div>
                        <div class='form-group col-md-6'>
                            <label class="control-label"><strong>Mã </strong></label>
                            <input name="txt_code" type="text" id="txt_code" class='form-control' value="<?php echo $row['code']?>" placeholder='' />
                        </div>
                    </div>
                    <div class="row">
                        <div class='form-group col-md-6'>
                            <label class="control-label"><strong>Kiểu tour</strong></label>
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
                                    <label class="control-label"><strong>Thời gian khởi hành</strong></label>
                                    <select class="form-control" name="cbo_start_time">
                                        <option value="Sáng" <?php echo $row['start_time']=='Sáng'? 'selected':'';?>>Sáng</option>
                                        <option value="Chiều" <?php echo $row['start_time']=='Chiều'? 'selected':'';?>>Chiều</option>
                                        <option value="Tối" <?php echo $row['start_time']=='Tối'? 'selected':'';?>>Tối</option>
                                    </select>
                                </div>
                                <div class='col-md-6'>
                                    <label class="control-label"><strong>Ngày khởi hành</strong></label>
                                    <?php $date=date('Y-m-d', strtotime($row['start'])); ?>
                                    <input name="txt_start" type="date" id="datepicker" class='form-control' value="<?php echo $date?>" placeholder='' />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class='form-group col-md-6'>
                            <div class="row box-cate">
                                <div class='form-group col-md-6'>
                                    <label class="control-label"><strong>Số ngày </strong></label>
                                    <input name="txt_num_date" type="text" id="txt_num_date" class='form-control' value="<?php echo $row['num_day']?>" placeholder='' />
                                </div>

                                <div class='form-group col-md-6'>
                                    <label class="control-label"><strong>Số đêm</strong></label>
                                    <input name="txt_num_night" type="text" id="txt_num_night" class='form-control' value="<?php echo $row['num_night']?>" placeholder='' />
                                </div>
                            </div>
                        </div>
                        <div class='form-group col-md-6'>
                            <div class="row">
                                <div class='col-md-6'>
                                    <label class="control-label"><strong>Phương tiện</strong></label>
                                    <select class="form-control" id="cbo_expediency" name="cbo_expediency">
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
                                    <label class="control-label"><strong>Hạng khách sạn</strong></label>
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
                            <label class="control-label"><strong>Version tour</strong></label>
                            <input name="txt_version" type="text" id="txt_version" class='form-control' value="<?php echo $row['version']?>" placeholder='' />
                        </div>
                        <div class='form-group col-md-6'>
                            <label class="control-label"><strong>Thumb ảnh</strong></label>
                            <input name="fileImg" type="file" id="file-thumb" class='form-control' value="" placeholder='' />
                            <input name="url_image" type="hidden" value="<?php echo $row['thumb'];?>"/>
                            <div id="show-img">
                                <img class="img-display" src="<?php echo $row['thumb']==''? ROOTHOST.THUMB_DEFAULT:ROOTHOST.$row['thumb'];?>">
                            </div>
                        </div>
                    </div>


                    <div class="box-select">
                        <label class="control-label"><strong>Add các địa danh liên quan</strong></label>
                        <?php
                        $arrLocation='';
                        if(count($row['arr_location'])> 0){
                            $arrLocation= explode(',', $row['arr_location']);
                        }

                        ?>
                        <div class="clearfix"></div>
                        <select id="cbo_location" class="cbo_location" name="arrLocation[]" multiple="multiple">
                            <?php
                            if(!isset($objLo)) $objLo=new CLS_LOCATION();
                            echo $objLo->getListCbLocation($strWhere, '', $arrLocation);
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label><strong>Mô tả Tour</strong></label>
                        <textarea id="txt_intro" name="txt_intro" placeholder='Nội dung bài viết' ><?php echo $row['intro']?></textarea>
                    </div>
                    <div class="form-group">
                        <label><strong>Nội dung chi tiết</strong></label>
                        <textarea id="txt_fulltext" name="txt_fulltext" placeholder='Nội dung bài viết' ><?php echo $row['fulltext']?></textarea>
                    </div>

                </div>
                <div class="tab-pane fade" id="price">
                    <div class="row">
                        <div class='form-group col-md-6'>
                            <label class="control-label"><strong>Đơn giá</strong></label>
                            <input name="txt_price" type="text" id="txt_price" class='form-control' value="<?php echo $row['price']?>" placeholder='' />
                        </div>

                    </div>
                    <div class="row">
                        <div class='form-group col-md-6'>
                            <label class="control-label"><strong>Giá cho trẻ em 1-4 tuổi</strong></label>
                            <input name="txt_price14" type="text" id="txt_price14" class='form-control' value="<?php echo $row['children_1_4']?>" placeholder='' />
                        </div>
                        <div class='form-group col-md-6'>
                            <label class="control-label"><strong>Giá cho trẻ em 5-9 tuổi</strong></label>
                            <input name="txt_price59" type="text" id="txt_price59" class='form-control' value="<?php echo $row['children_5_9']?>" placeholder='' />
                        </div>

                    </div>
                    <div class="form-group">
                        <label><strong>Nội dung chi tiết bảng giá, dịch vụ</strong></label>
                        <textarea id="txt_content" name="txt_content" placeholder='Nội dung bài viết' ><?php echo $row['content']?></textarea>
                    </div>
                </div>
                <div class="text-center">
                    <br/>
                    <a href="?com=tour" class="btn btn-default">Quay lại</a>
                    <input type="submit" name="cmdsave" id="cmdsave"  class="btn btn-primary" value="Lưu thông tin">
                </div>
            </form>
        </div>
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
        if($("#txt_rank_hotel").val()==""){
            alert('Rank Hotel is require!');
            $("#txt_rank_hotel").focus();
            return false;
        }


        if($("#txt_version").val()==""){
            alert('Version tour is require!');
            $("#txt_version").focus();
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


    $('#cbo_location').searchableOptionList();
    cbo_Selected('cbo_category','<?php echo $row['tour_type_id'];?>');
    cbo_Selected('cbo_expediency','<?php echo $row['expediency'];?>');
    cbo_Selected('txt_rank_hotel','<?php echo $row['rank_hotel'];?>');


    $(document).ready(function() {
        ComponentsEditors.init();
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