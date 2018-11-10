<link rel="stylesheet" href="<?php echo ROOTHOST.TEM_PATH;?>web/css/searchableOptionList.css">
<script src="<?php echo ROOTHOST.TEM_PATH;?>web/scripts/searchableOptionList.js"></script>

<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
$id=isset($_GET["id"])?(int)$_GET["id"]:"";
$obj->getListAll('WHERE `tbl_tour`.`id`='.$id.'');
$row=$obj->Fetch_Assoc();
include_once(LIB_PATH.'cls.tourtype.php');
include_once(LIB_PATH.'cls.location.php');
?>
<div class="container">
    <div class="frm-control">
        <h3 class="h3-header"><?php echo $row['name']?> > Thông tin tour</h3>
        <div class="box-step column-3">
            <ul>
                <li class="active">
                    <span class="number num1">01</span>
                    <span class="name">Thông tin Tour</span>
                </li>

                <li class="">
                    <span class="number num2">02</span>
                    <span class="name">Các lịch trình Tour</span>
                </li>
                <li class="">
                    <span class="number num3">03</span>
                    <span class="name">Thư viện ảnh</span>
                </li>
            </ul>
        </div>
		<div class="box-form">


           <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="active">
                    <a href="#info" role="tab" data-toggle="tab">
                        <icon class="fa fa-sms"></icon>Thông tin tour
                    </a>
                </li>
                <li><a href="#price" role="tab" data-toggle="tab">
                        <i class="fa fa-contact"></i> Giá tour
                    </a>
                </li>
                
            </ul>
            <div class="box-btn-act">
                <a href="<?php echo ROOTHOST;?>member/tour/danh-sach" class="btn-close">Close</a>
                <a class="save-continues btn-default btn-primary"  href="#" onclick="dosubmitAction('frm_action','save');" title="Save">Lưu và tiếp tục</a>
            </div>
            <form id="frm_action" name="frm_action" method="post" action=""  enctype="multipart/form-data">
			<input name="txtid" type="hidden" id="txtid" value="<?php echo $row['id']?>"/>
			<div class="tab-content">
				<div class="tab-pane fade active in" id="info">
					<div class="row">
						<div class='form-group col-md-6'>
							<label class="control-label"><strong>Name </strong></label>
							<input name="txt_name" type="text" id="txt_name" size="45" class='form-control' value="<?php echo $row['name']?>" placeholder='' />
						</div>
						<div class='form-group col-md-6'>
							<label class="control-label"><strong>Mã </strong></label>
							<input name="txt_code" type="text" id="txt_code" size="45" class='form-control' value="<?php echo $row['code']?>" placeholder='' />
						</div>
                    </div>








                    <div class="row">
                        <div class='form-group col-md-6'>
                            <label class="control-label"><strong>Kiểu tour</strong></label>
                            <select name="cbo_category" id="cbo_category" class='form-control'>
                                <option value=''>-- Chọn nhóm tour --</option>
                                <?php
                                if(!isset($objCate)) $objCate=new CLS_TOURTYPE();
                                echo $objCate->getListCbTourtype($row['tour_type_id']);
                                ?>
                            </select>
                        </div>
                        <div class='form-group col-md-6'>
                            <div class="row">
                                <div class='col-md-6'>
                                    <label class="control-label"><strong>Thời gian khởi hành</strong></label>
                                    <select class="select" name="cbo_start_time">
                                        <option value="Sáng" <?php echo $row['start_time']=='Sáng'? 'selected':'';?>>Sáng</option>
                                        <option value="Chiều" <?php echo $row['start_time']=='Chiều'? 'selected':'';?>>Chiều</option>
                                        <option value="Tối" <?php echo $row['start_time']=='Tối'? 'selected':'';?>>Tối</option>
                                    </select>
                                </div>
                                <div class='col-md-6'>
                                    <label class="control-label"><strong>Ngày khởi hành</strong></label>
                                    <?php $date=date('d-m-Y', strtotime($row['start'])); ?>
                                    <input name="txt_start" type="text" id="datepicker" size="45" class='form-control' value="<?php echo $date?>" placeholder='' />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class='form-group col-md-6'>
                            <div class="row box-cate">
                                <div class='form-group col-md-6'>
                                    <label class="control-label"><strong>Số ngày </strong></label>
                                    <input name="txt_num_date" type="text" id="txt_num_date" size="45" class='form-control' value="<?php echo $row['num_day']?>" placeholder='' />
                                </div>

                                <div class='form-group col-md-6'>
                                    <label class="control-label"><strong>Số đêm</strong></label>
                                    <input name="txt_num_night" type="text" id="txt_num_night" size="45" class='form-control' value="<?php echo $row['num_night']?>" placeholder='' />
                                </div>
                            </div>
                        </div>
                        <div class='form-group col-md-6'>
                            <div class="row">
                                <div class='col-md-6'>
                                    <label class="control-label"><strong>Phương tiện</strong></label>
                                    <select class="select" name="cbo_expediency">
                                        <option value="Ô tô" <?php echo $row['expediency']=='Ô tô'? 'selected':'';?>>Ô tô</option>
                                        <option value="Máy bay" <?php echo $row['expediency']=='Máy bay'? 'selected':'';?>>Máy bay</option>
                                        <option value="Tàu hỏa" <?php echo $row['expediency']=='Tàu hỏa'? 'selected':'';?>>Tàu hỏa</option>
                                        <option value="Ô tô con" <?php echo $row['expediency']=='Ô tô con'? 'selected':'';?>>Ô tô con</option>
                                        <option value="Tàu thủy" <?php echo $row['expediency']=='Tàu thủy'? 'selected':'';?>>Tàu thủy</option>
                                    </select>
                                </div>
                                <div class='col-md-6'>
                                    <label class="control-label"><strong>Hạng khách sạn</strong></label>
                                    <input name="txt_rank_hotel" type="text" id="txt_rank_hotel" size="45" class='form-control'  value="<?php echo $row['rank_hotel']?>"  placeholder='' />
                                </div>
                            </div>

                        </div>
                        <div class='form-group col-md-6'>
                            <label class="control-label"><strong>Version tour</strong></label>
                            <input name="txt_version" type="text" id="txt_version" size="45" class='form-control' value="<?php echo $row['version']?>" placeholder='' />
                        </div>
                        <div class='form-group col-md-6'>
                            <label class="control-label"><strong>Thumb ảnh</strong></label>
                            <input name="fileImg" type="file" id="file-thumb" size="45" class='form-control' value="" placeholder='' />
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
                        <script>
                            $('#cbo_location').searchableOptionList();
                        </script>
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
							 <input name="txt_price" type="text" id="txt_price" size="45" class='form-control' value="<?php echo $row['price']?>" placeholder='' />
						 </div>
						
					 </div>
					 <div class="row">
						  <div class='form-group col-md-6'>
							 <label class="control-label"><strong>Giá cho trẻ em 1-4 tuổi</strong></label>
							 <input name="txt_price14" type="text" id="txt_price14" size="45" class='form-control' value="<?php echo $row['children_1_4']?>" placeholder='' />
						 </div>
						  <div class='form-group col-md-6'>
							 <label class="control-label"><strong>Giá cho trẻ em 5-9 tuổi</strong></label>
							 <input name="txt_price59" type="text" id="txt_price59" size="45" class='form-control' value="<?php echo $row['children_5_9']?>" placeholder='' />
						 </div>

					 </div>
					 <div class="form-group">
						 <label><strong>Nội dung chi tiết bảng giá, dịch vụ</strong></label>
                         <textarea id="txt_content" name="txt_content" placeholder='Nội dung bài viết' ><?php echo $row['content']?></textarea>
					 </div>
				</div>
                <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;">
			</form>
		</div>
    </div>
    </div>
</div>

<?php
unset($objCate);
?>
<link rel="stylesheet" type="text/css" href="<?php echo ROOTHOST;?>global/plugins/bootstrap-summernote/summernote.css">
<script src="<?php echo ROOTHOST;?>global/plugins/select2/select2.min.js"></script>
<script src="<?php echo ROOTHOST;?>global/plugins/bootstrap-summernote/summernote.min.js" type="text/javascript"></script>

<link rel="stylesheet" href="<?php echo ROOTHOST.EXT_PATH;?>/date_picker_coder/css/jquery.ui.all.css">
<script src="<?php echo ROOTHOST.EXT_PATH;?>/date_picker_coder/js/jquery-ui.min.js"></script>
<link rel="stylesheet" href="<?php echo ROOTHOST.EXT_PATH;?>date_picker_coder/css/demos.css">

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

    $(document).ready(function() {
	$("#datepicker").datepicker({ dateFormat: 'dd-mm-yy' });
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