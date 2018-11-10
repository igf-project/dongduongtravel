<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
include_once(LIB_PATH.'cls.countries.php');
?>
<div class="container">
    <div class="frm-control">
        <h3 class="h3-header">Thêm mới Slider</h3>		
        <div id="action">
            <form id="frm_action" name="frm_action" method="post" action=""  enctype="multipart/form-data">
    			<div class="tab-content">
    				<div class="tab-pane fade active in" id="home">
    					<div class="row">
    						<div class='form-group'>
    							<label class="control-label"><strong>Tên slide</strong></label>
    							<input name="txt_name" type="text" id="txt_name" size="45" class='form-control' value="" placeholder='Tên slide'/>
    						</div>
    						<div class='form-group'>
    							<label class="control-label"><strong>Link</strong></label>
    							<input name="txt_link" type="text" id="txt_link" size="45" class='form-control' value="" placeholder='Link'/>
    						</div>
    						<div class='form-group'>
    							<label class="control-label"><strong>Image</strong></label>
    							<input name="fileImg" type="file" id="file-thumb" size="45" class='form-control' value="" placeholder='' />
    							<div id="show-img">
    								<img class="img-display" src="<?php echo ROOTHOST.THUMB_DEFAULT;?>">
    							</div>
    						</div>		 
    					</div>				
                        <a class="save btn-default btn-primary"  href="#" onclick="dosubmitAction('frm_action','save');" title="Save">Save</a>               
                        <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;">
                    </div>
                </div>
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
        if($("#txt_link").val()==""){
            alert('Link is require!');
            $("#txt_link").focus();
            return false;
        }
      
        if($("#file-thumb").val()==""){
            alert('Thumb Image is require!');
            $("#file-thumb").focus();
            return false;
        }  
        return true;
    }
    

    $(document).ready(function() {

        // ComponentsEditors.init();
      
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