<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
$id="";
if(isset($_GET["id"]))
	$id=(int)$_GET["id"];
$obj->getList(" WHERE `gmem_id`='$id' ",' LIMIT 0,1');
$row=$obj->Fetch_Assoc();
?>
<div id="action">
<script language="javascript">
function checkinput(){
	if($("#txtname").val()==""){
	 	$("#txtname_err").fadeTo(200,0.1,function(){ 
		  $(this).html('Vui lòng nhập tên').fadeTo(900,1);
		});
	 	$("#txtname").focus();
	 	return false;
	}
	return true;
}
$(document).ready(function(){
	$("#txtname").blur(function() {
		if( $(this).val()=='') {
			$("#txtname_err").fadeTo(200,0.1,function(){ 
			  $(this).html('Vui lòng nhập tên').fadeTo(900,1);
			});
		}
		else {
			$("#txtname_err").fadeTo(200,0.1,function(){ 
			  $(this).html('').fadeTo(900,1);
			});
		}
	})
})
</script>
    <form id="frm_action" name="frm_action" method="post" action="">
        <input type="hidden" name="txtid" id="txtid" value="<?php echo $row['gmem_id'];?>">
        <div class="col-md-6">
            <div class="form-group">
                <label for="" class="col-sm-3 form-control-label">Tiêu đề*</label>
                <div class="col-sm-9">
                    <input type="text" name="txtname" class="form-control" id="txtname" value="<?php echo $row['name'];?>" size="30">
                    <div id="txt_name_err" class="mes-error"></div>
                </div>
                <div class="clearfix"></div>

            </div>
            <div class="form-group">
                <label for="" class="col-sm-3 form-control-label">Nhóm người dùng</label>
                <div class="col-sm-9">

                    <select name="cbo_parid" id="cbo_parid" class="form-control">
                        <option value="0" selected="selected" style="font-weight:bold"><?php echo "Root";?></option>
                        <?php
                        if(!isset($obju)) $obju = new CLS_GUSER();
                        $obju->getListGmem(0,1);
                        unset($obju);
                        ?>
                    </select>
                </div>
                <div class="clearfix"></div>

            </div>
            <div class="form-group">
                <label for="" class="col-sm-3 form-control-label">Nổi bật</label>
                <div class="col-sm-9">
                    <div class="col-sm-6">
                        <input type="radio" value="1" name="optactive" <?php if($row['isactive']==1) echo "checked";?>>Có
                    </div>
                    <div class="col-sm-6">
                        <input type="radio" value="0" name="optactive" <?php if($row['isactive']==0) echo "checked";?>>Không
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
            <div class="form-group">
                <label for="" class="form-control-label">Mô tả</label>
                <textarea name="txtdesc" id="txtdesc" style="min-height: 80px" class="form-control"><?php echo $row['intro'];?></textarea>
            </div>
        </div>
        <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;">
    </form>
</div>
<?php unset($obj); unset($row); ?>