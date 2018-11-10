
<?php
	defined('ISHOME') or die('Can not acess this page, please come back!');
    define('OBJ_PAGE','CONTENTS');
    $keyword='';
	if(isset($_POST['txtkeyword'])){
		$keyword=trim($_POST['txtkeyword']);
		$_SESSION['KEY_'.OBJ_PAGE]=$keyword;
	}
    $strwhere='Where 1=1';
    if(isset($_POST['cbo_active']))
        $_SESSION['ACT'.OBJ_PAGE]=addslashes($_POST['cbo_active']);
    if(isset($_SESSION['KEY_'.OBJ_PAGE]) && $keyword!='')
        $keyword=$_SESSION['KEY_'.OBJ_PAGE];
    else
        $keyword='';
    $action=isset($_SESSION['ACT'.OBJ_PAGE]) ? $_SESSION['ACT'.OBJ_PAGE]:'';
    if($keyword!='')
        $strwhere.=" AND(`tbl_contents`.`title` like '%$keyword%' OR `tbl_contents`.`intro` like '%$keyword%')";

    if($action!='' && $action!='all' ){
        $strwhere.=" AND `isactive` = '$action'";
    }


    $obj->getList($strwhere);
    $total_rows=$obj->Num_rows();
    $cur_page=isset($_POST['txtCurnpage'])? (int)$_POST['txtCurnpage']:'1';
?>
<div id="list">
<script language="javascript">
  function checkinput()
  {
	  var strids=document.getElementById("txtids");
	  if(strids.value=="")
	  {
		  alert('You are select once record to action');
		  return false;
	  }
	  return true;
  }
</script>
  <form id="frm_list" name="frm_list" method="post" action="">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="Header_list">
      <tr>
        <td><strong><?php echo SEARCH;?>:</strong>
            <input type="text" name="txtkeyword" id="txtkeyword" onfocus="onsearch(this,1);" onblur="onsearch(this,0)" placeholder="Keyword" value="<?php echo $keyword;?>"/>&nbsp;
			<input type="submit" name="button" id="button" value="<?php echo SEARCH;?>" class="button" size='30'/>
		</td>
        <td align="right">
        <label>
        </label>&nbsp; &nbsp;
        <select name="cbo_active" id="cbo_active" onchange="document.frm_list.submit();">
          <option value="all"><?php echo MALL;?></option>
          <option value="1"><?php echo MPUBLISH;?></option>
          <option value="0"><?php echo MUNPUBLISH;?></option>
          <script language="javascript">
			cbo_Selected('cbo_active','<?php echo $action;?>');
            </script>
        </select></td>
      </tr>
    </table>
	<div style="clear:both;height:10px;"></div>
      <table width="100%" border="0" cellspacing="0" cellpadding="3" class="table table-bordered">
      <tr class="header">
        <th width="30" align="center">#</th>
        <th width="30" align="center"><input type="checkbox" name="chkall" id="chkall" value="" onclick="docheckall('chk',this.checked);" /></th>
        <th align="center">Tiêu đề</th>
        <th width="180" align="center">Nhóm tin</th>
        <th align="center" width="100">Tác giả</th>
        <th align="center" width="90"><?php echo CVISITED;?></th>
		<th width="30" align="center">isHot</th>
          <th width="70" align="center"><?php echo CACTIVE;?></th>
        <th width="30" align="center"><?php echo CEDIT;?></th>
        <th width="30" align="center"><?php echo CDELETE;?></th>
      </tr>
      <?php 
	  $obj->listTable($strwhere,$cur_page);
	  ?>
    </table>
</form>
  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="Footer_list">
      <tr>
        <td align="center">
        <?php 
            paging($total_rows,MAX_ROWS,$cur_page);
        ?>
        </td>
      </tr>
  </table>
</div>
<?php //----------------------------------------------?>
