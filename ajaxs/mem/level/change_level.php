<style>
#frm-level .box .item{
	float: left;
	border: 1px solid #eee;
	padding : 2px 8px;
	border-radius: 3px;
	margin-right: 6px;
	margin-bottom: 5px;
}

#frm-level .table-label{
	background-color: #fafafa;
	font-weight: bold;
	width: 100%;
	margin-top: 8px;
}
#frm-level .table-label td{
	
	padding-top: 6px;
	padding-bottom: 6px;
}
#frm-level .table td{
	padding-bottom: 6px;
	padding-top: 6px;
}
.table .tr-item{
	cursor: poiter !important;
	
}
.table .tr-item:hover{
	background-color:#ccc !important;
}

</style>
<?php
include_once('../../../includes/gfinnit.php');
include_once('../../../includes/gffunction.php');
include_once('../../../includes/gfconfig.php');
include_once('../../../libs/cls.mysql.php');
include_once('../../../libs/cls.gmem.php');
include_once('../../../libs/cls.member.php');
$obj=new CLS_MEMBER();
$objGmem=new CLS_GMEM();
if(isset($_GET["val"])):
    $user=addslashes($_GET["val"]);
else:
    echo "Not acset Program";
endif;
echo '<h5>Tài khoản: '.$user.'</h5>';

?>
 <form id="frm-level" name="frm-level" method="post" action="<?php echo ROOTHOST;?>ajaxs/mem/level/action.php">
 <input name="txt_username" id="" type="hidden" value="<?php echo $user;?>"/>
	<div class="box">
			<?php
			$objGmem->getListGmem("WHERE `tbl_account_gmem`.`username`='".$user."'");
			if($objGmem->Num_rows()>=1){
				echo '<span class="pull-left">Quyền:</span>';
				$rw=$objGmem->Fetch_Assoc();
				$arr_gmemid=explode(',',$rw['gmem_id']);
				$objGmem->getList("WHERE `tbl_gmem`.`gmem_id` IN (".$rw['gmem_id'].")");
				While($rows=$objGmem->Fetch_Assoc()){?>
				<div class="item it<?php echo $rows['gmem_id'];?>">
					<?php echo $rows['name'];?>
					<input name="arrGmemId[]" type="hidden" value="<?php echo $rows['gmem_id'];?>"/>
				</div>
			<?php } 

			}
			
			?>
			
		<div id="show-data"></div>
		</div>
		<div class="data">
			<table class="table-label">
				<tr>
					<td width='40px'>#</td>
					<td width='40px'>#</td>
					<td>Quyền</td>
				</tr>
			</table>
			<div style="height: 180px; overflow: auto">
				<table class="table">
					<?php
					$rowcount='';
					$objGmem->getList();
					 while($rows=$objGmem->Fetch_Assoc()){   $rowcount++;
						$id=$rows['gmem_id'];
						$name=Substring($rows['name'],0,10);
						?>
						<tr name='trow' class="tr-item<?php if(in_array($id, $arr_gmemid)) echo " active";?>" val_name="<?php echo $rows["name"];?>" val_id="<?php echo $rows["gmem_id"];?>">
						<?php
						 echo "<td width='40px' align='center'>$rowcount</td>";
						echo "<td width=\"40\" align=\"center\"><label>";
						echo "</label></td>";
						 echo "<td class='content' '>".$rows["name"]."</td>";
						echo '</tr>';
					 }
					?>
				</table>
			</div>
		</div>
    <div class="clearfix"></div>
</form>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary" onclick="submitUpdate()">Save changes</button>
</div>
<script>
function checkinputPopup(){
	  if($("#arr_in").val()==''){
		  alert('Member phải có ít nhất 1 quyền!');
		  return false;
	  }
	  return true;
}
function submitUpdate(){
    if(checkinputPopup() == true){
        var form = $('#frm-level');
        var postData = form.serializeArray();
        var url =form.attr('action');
        $.post(url, postData, function(response_data){
         console.log(response_data);
            $('#myModal').modal('hide');
        });

    }
};
$(".tr-item").on("click", function(){
	var val_name=$(this).attr('val_name');
	var val_id=$(this).attr('val_id');
	if(!$(this).hasClass('active')){
		var str='<div class="item it'+ val_name +'">'
					+ val_name +
					'<input name="arrGmemId[]" id="arr_in" type="hidden" value="'+ val_id +'"/></div>';
					console.log(str);
		$('#show-data').append(str);
		$(this).addClass('active');
	}
	else{
		$('.it'+val_id).remove();
		$(this).removeClass('active');
	}
});

</script>


