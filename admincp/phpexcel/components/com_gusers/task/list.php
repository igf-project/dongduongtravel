<?php
	defined('ISHOME') or die("Can't acess this page, please come back!");
	$keyword='';
	$action='';
	if(isset($_POST['txtkeyword'])){
		$keyword=addslashes($_POST['txtkeyword']);
		$action=(int)$_POST['cbo_active'];
	}
	$strwhere='';
	if($keyword!='' && $keyword!='Keyword')
		$strwhere.=" ( `name` like '%$keyword%' OR `desc` like '%$keyword%') AND";
	if($action!="" && $action!="all" )
		$strwhere.=" `isactive` = '$action' AND";
	if($strwhere!='')
		$strwhere=" WHERE ".substr($strwhere,0,strlen($strwhere)-4);
	//echo $strwhere;
	if(!isset($_SESSION['CUR_PAGE_GMEM']))
		$_SESSION['CUR_PAGE_GMEM']=1;
	if(isset($_POST['txtCurnpage'])){
		$_SESSION['CUR_PAGE_GMEM']=(int)$_POST['txtCurnpage'];
	}
	$obj->getList($strwhere,'');
	$total_rows=$obj->Num_rows();
	if($_SESSION['CUR_PAGE_GMEM']>ceil($total_rows/MAX_ROWS))
		$_SESSION['CUR_PAGE_GMEM']=ceil($total_rows/MAX_ROWS);
	$cur_page=$_SESSION['CUR_PAGE_GMEM'];
?>
<div id="list">
  <script language="javascript">
  function checkinput(){
	  var strids=document.getElementById("txtids");
	  if(strids.value==""){
		  alert('You are select once record to action');
		  return false;
	  }
	  return true;
  }
  </script>
  <form id="frm_list" name="frm_list" method="post" action="">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="Header_list">
      <tr>
        <td><?php echo SEARCH;?>:
            <input type="text" name="txtkeyword" id="txtkeyword" onfocus="onsearch(this,1);" onblur="onsearch(this,0)" placeholder="Keyword" value="<?php echo $keyword;?>"/>&nbsp;
            <input type="submit" name="button" id="button" value="<?php echo SEARCH;?>" class="button" />
        </td>
        <td align="right">
          <select name="cbo_active" id="cbo_active" onchange="document.frm_list.submit();">
            <option value="all"><?php echo MALL;?></option>
            <option value="1"><?php echo MPUBLISH;?></option>
            <option value="0"><?php echo MUNPUBLISH;?></option>
            <script language="javascript">
			cbo_Selected('cbo_active','<?php echo $action;?>');
            </script>
          </select>
        </td>
      </tr>
    </table>
    <table width="100%" border="0" cellspacing="0" cellpadding="5" class="list">
      <tr class="header">
        <td width="30" align="center"><input type="checkbox" name="chkall" id="chkall" value="" onclick="docheckall('chk',this.checked);" /></td>
        <td width="70" align="center"><?php echo CPAR_ID;?></td>
        <td align="center"><?php echo CNAME;?></td>
        <td align="center"><?php echo CDESC;?></td>
        <td width="80" align="center"><?php echo CACTIVE;?></td>
        <td width="50" align="center"><?php echo CEDIT;?></td>
        <td width="50" align="center"><?php echo CDELETE;?></td>
      </tr>
      <?php 
	  $obj->listTableGmem($strwhere,$cur_page,0,0);
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