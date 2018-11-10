<?php
defined('ISHOME') or die('Can not acess this page, please come back!');
?>
<div id="menus" class="toolbars">
  <form id="frm_menu" name="frm_menu" method="post" action="">
    <div class='pull-right'>
		<input type="hidden" name="txtorders" id="txtorders" />
		<input type="hidden" name="txtids" id="txtids" />
		<input type="hidden" name="txtaction" id="txtaction" />
		<?php 
            if(!isset($_GET["task"])){
        ?>
		<a class="edit" href="index.php?com=<?php echo COMS;?>" title="Danh sách">List</a>
		<a class="publish" href="#" onclick="dosubmitAction('frm_menu','public');" title="Hiện">Hiện</a>
		<a class="unpublish" href="#" onclick="dosubmitAction('frm_menu','unpublic');" title="Ẩn">Ẩn</a>
		<a class="addnew" href="index.php?com=<?php echo COMS;?>&task=add" title="Add New">Add New</a>
		<a class="delete" href="#" onclick="javascript:if(confirm('Bạn có chắc chắn muốn xóa thông tin này không?')){dosubmitAction('frm_menu','delete'); }" title="Delete">Delete</a></li>
		<?php }else{?>
		<a class="save"  href="#" onclick="dosubmitAction('frm_action','save');" title="Save">Save</a>
		<a class="clos"  href="index.php?com=<?php echo COMS;?>" title="Close">Close</a></li>
		<a class="help"  href="index.php?com=<?php echo COMS;?>&task=help" title="Help">Help</a>
        <?php } ?>
    </div>
  </form>
</div>