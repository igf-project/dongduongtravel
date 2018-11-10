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
</style>
<?php
include_once('../../includes/gfinnit.php');
include_once('../../includes/gffunction.php');
include_once('../../includes/gfconfig.php');
include_once('../../libs/cls.mysql.php');
include_once('../../libs/cls.gmem.php');
include_once('../../libs/cls.member.php');
$obj=new CLS_MEMBER();
$objGmem=new CLS_GMEM();
if(isset($_GET["val"])):
    $user=addslashes($_GET["val"]);
else:
    echo "Not acset Program";
endif;
echo '<h5>Tài khoản: '.$user.'</h5>';

?>
 <form id="frm-level" name="frm-level" method="post" action="<?php echo ROOTHOST;?>ajaxs/level/action.php">
	<div class="box">
			<?php
			$objGmem->getListGmem("WHERE `tbl_account_gmem`.`username`='".$user."'");
			echo '<span class="pull-left">Quyền:</span>';
			While($rows=$objGmem->Fetch_Assoc()){?>
				<div class="item">
					<?php echo $rows['name'];?>
					<input name="arrGmemId[]" type="hidden" value="<?php echo $rows['gmem_id'];?>"/>
				</div>
			<?php } 
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
						echo "<tr name='trow'>";
						 echo "<td width='40px' align='center'>$rowcount</td>";
						echo "<td width=\"40\" align=\"center\"><label>";
						echo "<input checked='true' type=\"checkbox\" name=\"chk\" value=\"$id\" />";
						echo "</label></td>";
						 echo "<td class='content'><div class='item'>".$rows["name"]."<input  name='arrGmemId[]' type='hidden' value='".$rows['gmem_id']."'/></div></td>";
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
    <button type="button" class="btn btn-primary" onclick="submitUpdate('sleep')">Save changes</button>
</div>
<script>
$(":checkbox").on("click", function(){
	var par=$(this).closest("td").parent();
    if($(this).is(":checked")) {
		var val=$(this).closest("td").siblings("td.content");
		par.addClass('active');
        val.each(function(){
			
          $("#show-data").append(val.html());
        });
    }
    else {
		par.removeClass('active');
     $("#show-data").html("");
	 var exit=$(":checkbox:checked").closest("td").siblings("td.content");
	 var par=$(":checkbox:checked").closest("td").parent();
	 
     exit.each(function(){ 
       $("#show-data").append(exit.html());
     });
    }
})
</script>


