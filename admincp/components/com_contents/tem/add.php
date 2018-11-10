<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
include_once(LIB_PATH.'cls.position.php');
include_once(LIB_PATH.'cls.location.php');
include_once(LIB_PATH.'cls.category.php');
?>
<div class="container">
	<div class="frm-control">
		<h3 class="h3-header">Thêm mới tin tức</h3>
		<!-- Nav tabs -->
		<ul class="nav nav-tabs" role="tablist">
			<li class="active">
				<a href="#home" role="tab" data-toggle="tab">
					<icon class="fa fa-sms"></icon>Bài viết
				</a>
			</li>
			
			<li><a href="#seo" role="tab" data-toggle="tab">
				<i class="fa fa-contact"></i> Từ khóa seo
			</a>
		</li>
	</ul>
	<form id="frm_action" name="frm_action" method="post" action=""  enctype="multipart/form-data">
		<div class="tab-content">
			<div class="tab-pane fade active in" id="home">
				<div class="row">
					<div class='form-group col-md-6'>
						<label class="control-label">Tiêu đề </label>
						<input name="txt_title" type="text" id="txt_title" size="45" class='form-control' value="" placeholder='' />
					</div>
					<div class='form-group col-md-6'>
						<label class="control-label">Mã </label>
						<input name="txt_code" type="text" id="txt_code" size="45" class='form-control' value="" placeholder='' />
					</div>
					<div class='form-group col-md-6'>
						<label class="control-label">Nhóm tin</label>
						<select name="cbo_category" id="cbo_category" class='form-control'>
							<?php
							if(!isset($objCate)) $objCate=new CLS_CATE();
							echo $objCate->getListCbCategory();
							?>
						</select>
					</div>
					
					<div class='form-group col-md-6'>
						<label class="control-label">Tác giả </label>
						<input name="txt_author" type="text" id="txt_author" size="45" class='form-control' value="" placeholder='' />
					</div>
				</div>
				<div class="row">
					<div class='form-group col-md-6'>
						<div class="row box-cate">
							<div class='col-md-6'>
								<label class="control-label">Thuộc địa danh</label>
								<select name="cbo_location" id="cbo_location" class='form-control'>
									<option value=''>-- Tỉnh thành --</option>
									<?php
									if(!isset($objLo)) $objLo=new CLS_LOCATION();
									echo $objLo->getListCbLocation();
									?>
								</select>
							</div>
							<span class="or">OR</span>
							<div class='col-md-6'>
								<label class="control-label">Thuộc địa điểm</label>
								<select name="cbo_position" id="cbo_position" class='form-control'>
									<option value=''>-- Địa điểm --</option>
									<?php
									if(!isset($objPo)) $objPo=new CLS_POSITION();
									echo $objPo->getListCbPosition();
									?>
								</select>
							</div>
						</div>
					</div>
					
					<div class='form-group col-md-6'>
						<label class="control-label">Thumb ảnh</label>
						<input name="fileImg" type="file" id="file-thumb" size="45" class='form-control' value="" placeholder='' />
						<div id="show-img">
							<img class="img-display" src="<?php echo ROOTHOST.THUMB_DEFAULT;?>">
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label>Mô tả</label>
					<textarea id="txt_intro" name="txt_intro" placeholder='Nội dung bài viết' ></textarea>
				</div>
				<div class="form-group">
					<label>Nội dung bài viết</label>
					<textarea id="txt_fulltext" name="txt_fulltext" placeholder='Nội dung bài viết' ></textarea>
				</div>
				
			</div>
			<div class="tab-pane fade" id="seo">
				<div class="row">
					<div class='form-group col-md-6'>
						<label class="control-label">Mô tả tiêu đề</label>
						<input name="txt_meta_title" type="text" id="txt_meta_title" size="45" class='form-control' value="" placeholder='' />
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
			<a class="save btn-default btn-primary"  href="#" onclick="dosubmitAction('frm_action','save');" title="Save">Save</a>
			<input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;">
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
		if($("#txt_title").val()==""){
			alert('Title is require!');
			$("#txt_title").focus();
			return false;
		}
		if($("#cbo_category").val()==""){
			alert('Category is require!');
			$("#cbo_category").focus();
			return false;
		}
		if($("#txt_author").val()==""){
			alert('Author is require!');
			$("#txt_author").focus();
			return false;
		}

		if($("#cbo_location").val()=="" && $("#cbo_position").val()==""){
			alert('Someonce is require!');
			$("#cbo_location").focus();
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

    /*func add new position contact*/

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