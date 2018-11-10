<?php
	defined("ISHOME") or die("Can't acess this page, please come back!");
	$id="";
	if(isset($_GET["id"]))
		$id=(int)$_GET["id"];
	$obj->getList(' AND `con_id`='.$id);
	$row=$obj->Fetch_Assoc();
?>
<style type='text/css'>
#tabs{clear:both;}
#tabs span{cursor:pointer;font-weight:bold;float:left; background:#ccc; height:30px; line-height:30px; padding:0px 21px; margin:1px 0px -1px 5px;border: #89b8fa 1px solid; border-radius:4px 4px 0px 0px;}
#tabs span.active{background:#fff;border-bottom:#fff 1px solid;}
#tab2{display:none;}
</style>
<div id='tabs'>
<span id='mnu_tb1' class='active'>Chi tiết bài viết</span>
<span id='mnu_tb2'>Meta header</span>
</div>
<div id="action">
<script language="javascript">
function checkinput(){
	if($("#txttitle").val()==""){
		$("#txttitle_err").fadeTo(200,0.1,function(){ 
		  $(this).html('Vui lòng nhập tên bài viết').fadeTo(900,1);
		});
		$("#txttitle").focus();
		return false;
	}
	return true;
}

$(document).ready(function() {
	$("#txttitle").blur(function(){
		if ($("#txttitle").val()=="") {
			$("#txttitle_err").fadeTo(200,0.1,function()
			{ 
			  $(this).html('Vui lòng nhập tên bài viết').fadeTo(900,1);
			});
		}
	});
	$( "#date1" ).datepicker({ dateFormat: 'dd-mm-yy' });
	$( "#date2" ).datepicker({ dateFormat: 'dd-mm-yy' });
	$('#mnu_tb1').click(function(){
		$(this).addClass('active');
		$('#mnu_tb2').removeClass('active');
		$('#tab1').show();
		$('#tab2').hide();
	});
	$('#mnu_tb2').click(function(){
		$(this).addClass('active');
		$('#mnu_tb1').removeClass('active');
		$('#tab1').hide();
		$('#tab2').show();
	});
});
 </script>
	<form id="frm_action" name="frm_action" method="post" action="">
	Những mục đánh dấu <font color="red">*</font> là yêu cầu bắt buộc.
	<div id='tab1'>
	<fieldset>
	<legend><strong><?php echo CDETAIL;?>&nbsp;</strong></legend>
	<table width="100%" border="0" cellspacing="1" cellpadding="3">
	<tr>
	<td width="127" align="right" bgcolor="#EEEEEE"><strong><?php echo CCATEGORY;?><font color="red">*</font></strong></td>
	<td width="308">
	  <select name="cbo_cate" id="cbo_cate">
		<?php 
		  if(!isset($objmenu)) $objmenu=new CLS_CATE();
			echo $objmenu->getListCate("option");
		  ?>
		<script language="javascript">
		  cbo_Selected('cbo_cate',<?php echo $row['cat_id'];?>);
		  </script>
	  </select></td>
	<td width="134" align="right" bgcolor="#EEEEEE"><strong><?php echo CAUTHOR;?>&nbsp;</strong></td>
	<td width="351"><input name="txtauthor" type="text" id="txtauthor" value="<?php echo $row['author'];?>"/></td>
	</tr>
	<tr>
	 <td align="right" bgcolor="#EEEEEE"><strong><?php echo CTITLE;?> <font color="red">*</font></strong></td>
	<td>
	  <input name="txttitle" type="text" id="txttitle" size="45" value="<?php echo $row['title'];?>" />
	  <label id="txttitle_err" class="check_error"></label>
	  <input name="txtid" type="hidden" id="txtid" value="<?php echo $row['con_id'];?>" />
	  </td>
	<td align="right" bgcolor="#EEEEEE"><strong><?php echo CCREATDATE;?>&nbsp;</strong></td>
	<td><input id="date1" type="text" name="txtcreadate" value="<?php echo date('d-m-Y',strtotime($row['creatdate']));?>" readonly='true'/></td>
	</tr>
	<tr>
	<td align="right" bgcolor="#EEEEEE"><strong><?php echo CPUBLIC;?>&nbsp;</strong></td>
	<td><input name="optactive" type="radio" id="radio" value="1" <?php if($row['isactive']==1) echo 'checked';?>/>
	  <?php echo CYES;?>
	  <input name="optactive" type="radio" id="radio2" value="0" <?php if($row['isactive']==0) echo 'checked';?>/>
	  <?php echo CNO;?>
	</td>
	<td align="right" bgcolor="#EEEEEE"><strong><?php echo CMODIFY;?> </strong></td>
	<td><input name="txtmodify" type="text" id="date2" value="<?php echo date("d-m-Y");?>" readonly='true' /></td>
	</tr>
	<tr>
	<td align="right" bgcolor="#EEEEEE"><strong>Ảnh  </strong></td>
	<td><input size="35" name="txtthumb" value="<?php echo $row['thumb_img'];?>" type="text"><a href="#" onclick="OpenPopup('extensions/upload_image.php');">Chọn</a></td>
	<td align="right" bgcolor="#EEEEEE"><strong>&nbsp;<?php echo CMEM;?>&nbsp;</strong></td>
	<td><select name="cbo_groupmem" id="cbo_groupmem">
	  <?php 
		$gmemid = $row['gmem_id'];
		$obj->LoadGmem($gmemid,0,'');?>
	</select></td>
	</tr>
	</table>
	</fieldset>
	<br style="clear:both" />
	<strong><?php echo CINTRO;?></strong>
	<textarea name="txtintro" id="txtintro"  style='width:100%' rows="5"><?php echo stripslashes($row['intro']);?></textarea>
	<script language="javascript">
		var oEdit2=new InnovaEditor("oEdit2");
		oEdit2.width="100%";
		oEdit2.height="100";
		oEdit2.cmdAssetManager ="modalDialogShow('<?php echo ROOTHOST;?>admincp/extensions/editor/innovar/assetmanager/assetmanager.php',640,465)";
		oEdit2.REPLACE("txtintro");
		document.getElementById("idContentoEdit2").style.height="100px";
	</script>
	<br style="clear:both" />
	<strong><?php echo CFULLTEXT;?>&nbsp;</strong>
	<textarea name="txtdesc" id="txtdesc" cols="45" rows="7"><?php echo stripslashes($row['fulltext']);?></textarea>
	<script language="javascript">
		var oEdit1=new InnovaEditor("oEdit1");
		oEdit1.width="100%";
		oEdit1.height="100";
		oEdit1.cmdAssetManager ="modalDialogShow('<?php echo ROOTHOST;?>admincp/extensions/editor/innovar/assetmanager/assetmanager.php',640,465)";
		oEdit1.REPLACE("txtdesc");
		document.getElementById("idContentoEdit1").style.height="450px";
	</script>
	</div>
	<div id='tab2'>
	<strong>Meta title&nbsp;</strong>
	<input style='width:100%;' name="txtmetatitle" type="text" id="txtmetatitle" size="45" value="<?php echo $row['meta_title'];?>" /></label>
	<strong>Meta keyword&nbsp;</strong>
	<textarea style='width:100%;' name="txtmetakey" cols="28" rows="3" id="txtmetakey"><?php echo stripslashes($row['meta_key']);?></textarea>
	<strong>Meta description&nbsp;</strong>
	<textarea style='width:100%;' name="textmetadesc" cols="28" rows="5" id="textmetadesc"><?php echo stripslashes($row['meta_desc']);?></textarea>
	</div>
	<input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;">
	</form>
</div>