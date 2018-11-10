<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
include_once(LIB_PATH.'cls.countries.php');
?>
<div class="container">
    <div class="frm-control">
        <h3 class="h3-header">Thêm mới Địa danh</h3>
		
		  <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="active">
                    <a href="#home" role="tab" data-toggle="tab">
                        <icon class="fa fa-sms"></icon>Thông tin địa danh
                    </a>
                </li>
         
                <li><a href="#about" role="tab" data-toggle="tab">
                        <i class="fa fa-contact"></i> Bài giới thiệu
                    </a>
                </li>
            </ul>
			
        <div id="action">
            <form id="frm_action" name="frm_action" method="post" action=""  enctype="multipart/form-data">
			<div class="tab-content">
				<div class="tab-pane fade active in" id="home">
					<div class="row">
						<div class='form-group col-md-6'>
							<label class="control-label"><strong>Tỉnh/ Thành phố </strong></label>
							<input name="txt_name" type="text" id="txt_name" size="45" class='form-control' value="" placeholder='' />
						</div>

						<div class='form-group col-md-6'>
							<label class="control-label"><strong>Thuộc quốc gia</strong></label>
							<select name="cbo_cate" id="cbo_cate" class='form-control'>
								<?php
								if(!isset($objcountry)) $objcountry=new CLS_COUNTRIES();
								echo $objcountry->getListCountry("option");
								?>
							</select>
						</div>
						 <div class='form-group col-md-6'>
							<label class="control-label"><strong>Thumb ảnh</strong></label>
							<input name="fileImg" type="file" id="file-thumb" size="45" class='form-control' value="" placeholder='' />
							<div id="show-img">
								<img class="img-display" src="<?php echo ROOTHOST.THUMB_DEFAULT;?>">
							</div>
						</div>
		 
					</div>
				
					<div class="form-group">
						<label><strong>Lời giới thiệu</strong> (Tại sao đến đây)</label>
						<textarea id="txt_intro" name="txt_intro" placeholder='Nội dung bài viết' ></textarea>
					</div>
				</div>
				<div class="tab-pane fade" id="about">
					<div class="form-group">
						<label><strong>Tóm tắt</strong></label>
						<textarea id="txt_intro_about" name="txt_intro_about" placeholder='Mô tả bài viết' ></textarea>
					</div>
					<div class="form-group">
						<label><strong>Nội dung chi tiết</strong></label>
						<textarea id="txt_fulltext" name="txt_fulltext" placeholder='Nội dung bài viết' ></textarea>
					</div>
				</div>
                <a class="save btn-default btn-primary"  href="#" onclick="dosubmitAction('frm_action','save');" title="Save">Save</a>
               
                <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;">
            </form>

        </div>

    </div>
</div>

<?php
unset($objcountry);
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
        if($("#cbo_cate").val()==""){
            alert('Country is require!');
            $("#cbo_cate").focus();
            return false;
        }
      
        if($("#file-thumb").val()==""){
            alert('Thumb Image is require!');
            $("#file-thumb").focus();
            return false;
        }
        if($("#txt_intro").val()==""){
            alert('Info come here is require!');
          
            $("#txt_intro").focus();
            return false;
        }
        /* if($("#txt_intro_about").val()==""){
			alert($("#txt_intro_about").value);
            alert('Content intro for About is require!');
            $('.nav-tabs a[href="#about"]').tab('show');
            $("#txt_intro_about").focus();
            return false;
        } 
        if($("#txt_fulltext").val()==""){
           alert('Content for About is require!');
            $('.nav-tabs a[href="#about"]').tab('show');
            $("#txt_fulltext").focus();
            return false;
        }
     */
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
			$('#txt_intro_about').summernote({height: 80});
            $('#txt_fulltext').summernote({height: 180});
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