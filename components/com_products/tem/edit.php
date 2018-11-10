
<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
include_once(LIB_PATH.'cls.position.php');
include_once(LIB_PATH.'cls.location.php');
include_once(LIB_PATH.'cls.catalog.php');
$id=isset($_GET["id"])?(int)$_GET["id"]:"";
$obj->getList('WHERE `tbl_product`.`id`='.$id.'');
$row=$obj->Fetch_Assoc();
?>
<div class="container">
    <div class="frm-control">
        <h3 class="h3-header">Cập nhật Quà tặng</h3>
           <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="active">
                    <a href="#home" role="tab" data-toggle="tab">
                        <icon class="fa fa-sms"></icon>Thông tin quà tặng
                    </a>
                </li>

                <li><a href="#seo" role="tab" data-toggle="tab">
                        <i class="fa fa-contact"></i> Từ khóa seo
                    </a>
                </li>
            </ul>
            <form id="frm_action" name="frm_action" method="post" action=""  enctype="multipart/form-data">
			<input name="txtid" type="hidden" id="txtid" size="45" value="<?php echo $row['id'];?>"/>
			<div class="tab-content">
				<div class="tab-pane fade active in" id="home">
					<div class="row">
						<div class='form-group col-md-6'>
							<label class="control-label"><strong>Name</strong></label>
							<input name="txt_name" type="text" id="txt_name" size="45" class='form-control' value="<?php echo $row['name'];?>" placeholder='' />
						</div>
						<div class='form-group col-md-6'>
							<label class="control-label"><strong>Mã quà tặng</strong></label>
							<input name="txt_code" type="text" id="txt_code" size="45" class='form-control' value="<?php echo $row['pro_code'];?>" placeholder='' />
						</div>
                    </div>
                    <div class="row">
                        <div class='form-group col-md-6'>
                            <label class="control-label"><strong>Nhóm quà tặng</strong></label>
                            <select name="cbo_catalog" id="cbo_catalog" class='form-control'>
                                <option class="" value="0">--Chọn nhóm quà tặng --</option>
                                <?php
                                if(!isset($objCat)) $objCat=new CLS_CATALOG();
                                echo $objCat->getListCbCatalog('',$row['cata_id']);
                                ?>
                            </select>
                        </div>

						<div class='form-group col-md-6'>
							<label class="control-label"><strong>Tác giả </strong></label>
							<input name="txt_author" type="text" id="txt_author" size="45" class='form-control' value="<?php echo $row['author'];?>" placeholder='' />
						</div>
					</div>
                    <div class="row">
                        <div class='form-group col-md-6'>
                            <label class="control-label"><strong>Đơn giá</strong></label>
                            <input name="txt_price" type="text" id="txt_price" size="45" class='form-control' value="<?php echo $row['cur_price'];?>" placeholder='' />
                        </div>
                        <div class='form-group col-md-6'>
                            <label class="control-label"><strong>Số lượng</strong></label>
                            <input name="txt_quantity" type="text" id="txt_quantity" size="45" class='form-control' value="<?php echo $row['quantity'];?>" placeholder='' />
                        </div>

                    </div>
					<div class="row">

					    <div class='form-group col-md-6'>
                            <label class="control-label"><strong>Thuộc địa danh</strong></label>
                            <select name="cbo_location" id="cbo_location" class='form-control'>
                            <option value=''>-- Tỉnh thành --</option>
                                <?php
                                    if(!isset($objLo)) $objLo=new CLS_LOCATION();
                                    echo $objLo->getListCbLocation($row['location_id']);
                                    ?>
                            </select>
                        </div>
                        <div class='form-group col-md-6'>
                            <label class="control-label"><strong>Thuộc địa điểm</strong></label>
                            <select name="cbo_position" id="cbo_position" class='form-control'>
                            <option value=''>-- Địa điểm --</option>
                                <?php
                                    if(!isset($objPo)) $objPo=new CLS_POSITION();
                                    echo $objPo->getListCbPosition($row['position_id']);
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
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
						<label><strong>Mô tả</strong></label>
						<textarea id="txt_intro" name="txt_intro" placeholder='Mô tả' ><?php echo $row['intro'];?></textarea>
					</div>
					<div class="form-group">
						<label><strong>Nội dung bài viết</strong></label>
						<textarea id="txt_fulltext" name="txt_fulltext" placeholder='Nội dung bài viết' ><?php echo $row['fulltext'];?></textarea>
					</div>

				</div>
				<div class="tab-pane fade" id="seo">
				 <div class="row">
					 <div class='form-group col-md-6'>
						 <label class="control-label"><strong>Mô tả tiêu đề</strong></label>
						 <input name="txt_meta_title" type="text" id="txt_meta_title" size="45" class='form-control' value="<?php echo $row['meta_title'];?>" placeholder='' />
					 </div>
				 </div>
				 <div class="row">
					 <div class="form-group col-md-12">
						 <label><strong>Danh sách từ khóa</strong></label>
						 <input name="txt_meta_key" type="text" id="txt_meta_key" size="45" class='form-control' value="<?php echo $row['meta_key'];?>" placeholder='' />
						  <span class="note">Mỗi từ khóa cách nhau bởi dấu ,</span>
					 </div>

				 </div>
				 <div class="form-group">
					 <label><strong>Description</strong></label>
					 <textarea name="txt_meta_desc" id="txt_meta_desc" size="45"><?php echo $row['meta_desc'];?></textarea>
				 </div>
			</div>
			<input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="" onclick="dosubmitAction('frm_action','save');">
			</form>
		</div>
    </div>
</div>

<?php
unset($objLo);
unset($objPosGrType);
unset($objPosType);
?>


<link rel="stylesheet" type="text/css" href="<?php echo ROOTHOST;?>global/plugins/bootstrap-summernote/summernote.css">
<script src="<?php echo ROOTHOST;?>global/plugins/select2/select2.min.js"></script>
<script src="<?php echo ROOTHOST;?>global/plugins/bootstrap-summernote/summernote.min.js" type="text/javascript"></script>
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


        /* Check is number phone*/
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
            $('#txt_fulltext').summernote({height: 150});
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