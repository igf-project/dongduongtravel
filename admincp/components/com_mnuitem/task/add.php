<?php
defined("ISHOME") or die("Can't acess this page, please come back!")
?>
<div id="action">
	<script language="javascript">
		function checkinput(){	
			if($("#cbo_viewtype").val()=="block" || $("#cbo_viewtype").val()=="list"){
				if($("#cbo_cate").val()=="0") {
					$("#category_err").fadeTo(200,0.1,function()
					{ 
						$(this).html('Vui lòng chọn một nhóm tin').fadeTo(900,1);
					});
					$("#cbo_cate").focus();
					return false;
				}
			}
			else if($("#cbo_viewtype").val()=="catalog"){
				if($("#cbo_cata").val()=="0") {
					$("#catalog_err").fadeTo(200,0.1,function(){ 
						$(this).html('Vui lòng chọn một nhóm sản phẩm').fadeTo(900,1);
					});
					$("#cbo_cata").focus();
					return false;
				}			
			}
			else if($("#cbo_viewtype").val()=="article"){
				if($("#cbo_article").val()=="0") {
					$("#article_err").fadeTo(200,0.1,function()
					{ 
						$(this).html('Vui lòng chọn một bài viết').fadeTo(900,1);
					});
					$("#cbo_article").focus();
					return false;
				}
			}
			else if($("#cbo_viewtype").val()=="link"){
				if($("#txtlink").val()=="" || $("#txtlink").val()=="http://" ) {
					$("#link_err").fadeTo(200,0.1,function()
					{ 
						$(this).html('Vui lòng nhập đường dẫn đến bài viết').fadeTo(900,1);
					});
					$("#txtlink").focus();
					return false;
				}
			}

			if($("#txtname").val()==""){
				$("#txtname_err").fadeTo(200,0.1,function()
				{ 
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
					$("#txtname_err").fadeTo(200,0.1,function()
					{ 
						$(this).html('').fadeTo(900,1);
					});
				}
			})
		})

		function select_type(){
			var txt_viewtype=document.getElementById("txt_viewtype");
			var cbo_viewtype=document.getElementById("cbo_viewtype");
			for(i=0;i<cbo_viewtype.length;i++){
				if(cbo_viewtype[i].selected==true)
					txt_viewtype.value=cbo_viewtype[i].value;
			}
			document.frm_type.submit();
		}
	</script>
	<?php
	$viewtype="block";
	if(isset($_POST["txt_viewtype"]))
		$viewtype=$_POST["txt_viewtype"];
	?>
	<form id="frm_type" name="frm_type" method="post" action="" style="display:none;">
		<input type="text" name="txt_viewtype" id="txt_viewtype" />
	</form>
	<form id="frm_action" name="frm_action" method="post" action="">
		Những mục đánh dấu <font color="red">*</font> là yêu cầu bắt buộc.
		<fieldset>
			<legend><strong>Kiểu hiển thị :</strong></legend>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="" class="col-sm-3 form-control-label">Kiểu hiển thị*</label>
						<div class="col-sm-9">
							<select name="cbo_viewtype" id="cbo_viewtype" class="form-control" onchange="select_type();">
								<option value="link" selected="selected">Links</option>
								<option value="block">Block</option>
								<option value="article">Article</option>
								<option value="catalog">Catalog</option>
								<script language="javascript">
									cbo_Selected('cbo_viewtype','<?php echo $viewtype;?>');
								</script>
							</select>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="clearfix"></div>
				<?php if($viewtype=="block"){?>
				<div class="col-md-6">
					<div class="form-group">
						<label for="" class="col-sm-3 form-control-label">Nhóm tin*</label>
						<div class="col-sm-9">
							<select name="cbo_cate" id="cbo_cate" class="form-control">
								<option value="0" title="Top">Chọn một nhóm tin</option>
								<?php $obj_cate->getListCate(0,0); ?>
							</select>
							<script type="text/javascript">
								$(document).ready(function() {
									$("#cbo_cate").select2();
								});
							</script>
							<div id="category_err" class="check_error"></div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<?php } else if($viewtype=="catalog"){?>
				<div class="col-md-6">
					<div class="form-group">
						<label for="" class="col-sm-3 form-control-label">Nhóm SP*</label>
						<div class="col-sm-9">
							<select name="cbo_cata" id="cbo_cata">
								<option value="0" title="Top">Chọn một nhóm SP</option>
								<?php $obj_cata->getListCate(0,0); ?>
							</select> 
							<div id="catalog_err" class="check_error"></div>
							<script type="text/javascript">
								$(document).ready(function() {
									$("#cbo_cata").select2();
								});
							</script>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<?php } else if($viewtype=="article"){?>
				<div class="col-md-6">
					<div class="form-group">
						<label for="" class="col-sm-3 form-control-label">Bài viết*</label>
						<div class="col-sm-9">
							<select name="cbo_article" id="cbo_article" class="form-control">
								<option value="0" title="N/A">Chọn một bài viết</option>
								<?php $obj_con->LoadConten(); ?>
								<script language="javascript">
									cbo_Selected('cbo_article','0');
								</script>
							</select>
							<div id="article_err" class="check_error"></div>
							<script type="text/javascript">
								$(document).ready(function() {
									$("#cbo_article").select2();
								});
							</script>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<?php } else { ?>
				<div class="col-md-6">
					<div class="form-group">
						<label for="" class="col-sm-3 form-control-label">Link*</label>
						<div class="col-sm-9">
							<input name="txtlink" type="text" id="txtlink" class="form-control" value="" placeholder="http://"/>
							<div id="link_err" class="check_error"></div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<?php }?>
			</div>
		</div>
	</fieldset>
	<fieldset>
		<legend><strong>Chi tiết:</strong></legend>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="" class="col-sm-3 form-control-label">Tên*</label>
					<div class="col-sm-9">
						<input name="txtname" type="text" id="txtname" class="form-control">
						<div id="txtname_err" class="check_error"></div>
						<input name="txttask" type="hidden" id="txttask" value="1" />
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="" class="col-sm-3 form-control-label">Danh mục cha</label>
					<div class="col-sm-9">
						<select name="cbo_parid" id="cbo_parid" class="form-control">
							<option value="0">Top</option>
							<?php echo $obj->getListMenuItem($mnuid,0,0); ?>
						</select>
						<script type="text/javascript">
							$(document).ready(function() {
								$("#cbo_parid").select2();
							});
						</script>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="" class="col-sm-3 form-control-label">Class</label>
					<div class="col-sm-9">
						<input type="text" name="txtclass" id="txtclass" class="form-control"/>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="" class="col-sm-3 form-control-label">Hiển thị</label>
					<div class="col-sm-9">
						<label class="radio-inline"><input type="radio" value="1" name="optactive" checked>Có</label>
						<label class="radio-inline"><input type="radio" value="0" name="optactive">Không</label>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</fieldset>
	<fieldset>
		<legend><strong>Mô tả:</strong></legend>
		<textarea name="txtdesc" id="txtdesc" cols="45" rows="5"></textarea>
		<script language="javascript">
			var oEdit1=new InnovaEditor("oEdit1");
			oEdit1.width="100%";
			oEdit1.height="300";
			oEdit1.cmdAssetManager ="modalDialogShow('<?php echo ROOTHOST_ADMIN;?>extensions/editor/innovar/assetmanager/assetmanager.php',640,465)";
			oEdit1.REPLACE("txtdesc");
		</script>
	</fieldset>
	<input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;">
</form>
</div>