<?php
if($UserLogin->isAdmin(1) || $UserLogin->isAdmin(2) || $UserLogin->isAdmin(3)):
	$keyword='';
defined('ISHOME') or die('Can not acess this page, please come back!');
define('OBJ_PAGE','CATALOGS');
$keyword='';$strwhere='';$action='';

// Khai báo SESSION
if(isset($_POST['txtkeyword'])){
  $keyword=trim($_POST['txtkeyword']);
  $_SESSION['KEY_'.OBJ_PAGE]=$keyword;
}
if(isset($_POST['cbo_active']))
    $_SESSION['ACT'.OBJ_PAGE]=addslashes($_POST['cbo_active']);
if(isset($_SESSION['KEY_'.OBJ_PAGE]))
    $keyword=$_SESSION['KEY_'.OBJ_PAGE];
else
    $keyword='';
$action=isset($_SESSION['ACT'.OBJ_PAGE]) ? $_SESSION['ACT'.OBJ_PAGE]:'';

// Gán strwhere
if($keyword!='')
    $strwhere.=" AND `username` like '%$keyword%' OR `firstname` like '%$keyword%' OR `lastname` like '%$keyword%' ";
if($action!='' && $action!='all' ){
    $strwhere.=" AND `isactive` = '$action'";
}

// Pagging
if(!isset($_SESSION['CUR_PAGE_'.OBJ_PAGE]))
    $_SESSION['CUR_PAGE_'.OBJ_PAGE]=1;
if(isset($_POST['txtCurnpage'])){
    $_SESSION['CUR_PAGE_'.OBJ_PAGE]=(int)$_POST['txtCurnpage'];
}
$obj->getList($strwhere,'');
$total_rows=$obj->getCount($strwhere,'');
if($_SESSION['CUR_PAGE_'.OBJ_PAGE]>ceil($total_rows/MAX_ROWS))
    $_SESSION['CUR_PAGE_'.OBJ_PAGE]=ceil($total_rows/MAX_ROWS);
$cur_page=(int)$_SESSION['CUR_PAGE_'.OBJ_PAGE]>0 ? $_SESSION['CUR_PAGE_'.OBJ_PAGE]:1;
// End pagging

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
				<td>Tìm kiếm:
					<input type="text" name="txtkeyword" id="txtkeyword" placeholder="Keyword" value="<?php echo $keyword;?>"/>&nbsp;
					<input type="submit" name="button" id="button" value="Tìm kiếm" class="button" />
				</td>
				<td align="right">
					<select name="cbo_active" id="cbo_active" onchange="document.frm_list.submit();">
						<option value="all">Tất cả</option>
                        <option value="1">Hiển thị</option>
                        <option value="0">Ẩn</option>
						<script language="javascript">
							cbo_Selected('cbo_active','<?php echo $action;?>');
						</script>
					</select>
				</td>
			</tr>
		</table>
		<div style="clear:both;height:10px;"></div>
		<table class="table table-bordered">
			<tr class="header">
				<td width="30" align="center">STT</td>
				<th width="30" align="center"><input type="checkbox" name="chkall" id="chkall" value="" onclick="docheckall('chk',this.checked);" /></th>
				<td align="center">Họ tên</td>
				<td align="center">Tên đăng nhập</td>
				<td align="center">Địa chỉ</td>
				<td align="center">Điện thoại</td>
				<td align="center">Email</td>
				<th width="50" align="center">Hiển thị</th>
                <th width="50" align="center">Sửa</th>
                <th width="50" align="center">Xóa</th>
			</tr>
			<?php $obj->listTable($strwhere,$cur_page,0,0,0); ?>
		</table>
	</form>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="Footer_list">
		<tr>
			<td align="center"><?php paging($total_rows,MAX_ROWS,$cur_page);?></td>
		</tr>
	</table>
</div>
<?php endif;//----------------------------------------------?>