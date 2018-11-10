<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
?>
<div class="container">
    <div class="frm-control">
        <h3 class="h3-header">Thêm mới Tour type</h3>
		<form id="frm_action" name="frm_action" method="post" action=""  enctype="multipart/form-data">
			<div class="row">
				<div class='form-group col-md-6'>
					<label class="control-label"><strong>Name</strong></label>
					<input name="txt_name" type="text" id="txt_name" size="45" class='form-control' value="" placeholder='' />
				</div>
			</div>
			<a class="save btn-default btn-primary"  href="#" onclick="dosubmitAction('frm_action','save');" title="Save">Save</a>
			<input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;">
		</form>
    </div>
</div>

<script language="javascript">
    function checkinput(){
        if($("#txt_name").val()==""){
            alert('Title is require!');
            $("#txt_name").focus();
            return false;
        }
        return true;
    }
</script>