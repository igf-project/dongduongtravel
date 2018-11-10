<link rel="stylesheet" href="<?php echo ROOTHOST.TEM_PATH;?>web/css/searchableOptionList.css">
<script src="<?php echo ROOTHOST.TEM_PATH;?>web/scripts/searchableOptionList.js"></script>
<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
$user=isset($_GET["user"])? addslashes($_GET["user"]):"";
$obj->getListAccountGmem('WHERE `tbl_account_gmem`.`username`='.$user.'');
$row=$obj->Fetch_Assoc();
?>
<div class="container">
    <div class="frm-control">
        <h3 class="h3-header">Cấp quyền Member</h3>
        <div id="action">
            <form id="frm_action" name="frm_action" method="post" action=""  enctype="multipart/form-data">
			 <input name="txtid" type="hidden" id="txtid" value="<?php echo $day_active;?>" />
			 <div class="col-md-6">
				<label class="pull-left" style="margin-top: 15px; margin-right: 20px">Quyền</label>
				<select id="cbo_gmem" class="cbo_gmem" name="arrGmem[]" multiple="multiple">
					<?php
					include_once(LIB_PATH."cls.gmem.php");
					$objGmem=new CLS_GMEM();
					 echo $objGmem->getListCbGmem(false, false, $row['gmem_id']);?>
				</select>
				<script>
					$('#cbo_gmem').searchableOptionList();
				</script>
			</div>
			<div class="clearfix"></div>
			<div class="box-save-db" style="margin-top: 20px">
				<a class="save btn-default btn-primary"  href="#" onclick="dosubmitAction('frm_action','save');" title="Save">Save</a>
				<input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;">
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
        if($("#cbo_cate").val()==""){
            alert('Country is require!');
            $("#cbo_cate").focus();
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