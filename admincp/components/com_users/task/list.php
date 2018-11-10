<?php
defined('ISHOME') or die("Can't acess this page, please come back!");
define('OBJ_PAGE','USERS');
define('TASK_NAME', '');
write_path();
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
	$strwhere.=" AND `firstname` like '%$keyword%' OR `lastname` like '%$keyword%' OR username = '$keyword'";
if($action!='' && $action!='all' ){
	$strwhere.=" AND `isactive` = '$action'";
}

// Pagging
$sql="SELECT count(*)  as num FROM `tbl_users` WHERE 1=1 ".$strwhere;
$objdata->Query($sql);
$r=$objdata->Fetch_Assoc();
$total_rows=$r['num'];
$cur_page=isset($_GET['page'])?(int)$_GET['page']:1;
// End pagging
?>
<div id="list">
	<form id="frm_list" name="frm_list" method="post" action="">
		<?php if($obj->isAdmin()==true) { ?>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="Header_list">
			<tr>
				<td>Tìm kiếm:
					<input type="text" name="txtkeyword" id="txtkeyword" placeholder="Keyword" value="<?php echo $keyword;?>"/>
					<input type="submit" name="button" id="button" value="Tìm kiếm" class="button" />
					<select name="cbo_active" id="cbo_active" onchange="document.frm_list.submit();">
						<option value="all">Tất cả</option>
						<option value="1">Hiển thị</option>
						<option value="0">Ẩn</option>
						<script language="javascript">
							cbo_Selected('cbo_active','<?php echo $action;?>');
						</script>
					</select>
				</td>
				<td align="right">
					<a href="?com=users&task=add" class="btn btn-success button"><i class="fa fa-plus" aria-hidden="true"></i> Thêm mới</a>
				</td>
			</tr>
		</table>
		<?php } ?>
		<div style="clear: both;height: 10px;"></div>
		<table class="table table-bordered">
			<tr class="header">
				<th width="30" align="center">#</th>
				<th align="center">Tên đăng nhập</th>
				<th align="center">Tên</th>
				<th align="center">Email</th>
				<?php if($obj->isAdmin()==true) { ?>
				<th align="center">Đổi mật khẩu</th>
				<th align="center">Nhóm quyền</th>
				<th width="50" align="center">Hiển thị</th>
				<th width="50" align="center">Sửa</th>
				<th width="50" align="center">Xóa</th>
				<?php } ?>
			</tr>
			<?php 
			if(!isset($UserLogin)) $UserLogin=new CLS_USERS();
			$max_rows = MAX_ROWS;
			$start=($cur_page-1)*$max_rows;
			$sql="SELECT * FROM `tbl_user` WHERE 1=1 ".$strwhere." LIMIT $start,$max_rows";
			$objdata->Query($sql);
			while($rows=$objdata->Fetch_Assoc()){
				$start++;
				$id=$rows["id"];
				$username=$rows["username"];
				$name=$rows["firstname"]." ".$rows["lastname"];
				$gender=($rows["gender"]==0)?'Nam':'Nữ';
				$gname = $obj_guser->getNameByID($rows["guser_id"]); 
				$email=$rows["email"];
				echo "<tr name='trow'>";
				echo "<td width='30' align='center'>$start</td>";
				echo "<td width='100'>$username</td>";
				echo "<td nowrap='nowrap'><a href='index.php?com=".COMS."&amp;task=edit&amp;id=$id'>$name</a></td>";
				echo "<td nowrap='nowrap'>$email</td>";
				if($UserLogin->isAdmin()==true) {
					echo "<td align='center'><a href='index.php?com=".COMS."&amp;task=changepass&amp;id=$id'>Đổi</a></td>";
					echo "<td nowrap='nowrap'>$gname</td>";

					echo "<td align='center'><a href='index.php?com=".COMS."&amp;task=active&amp;id=$id'>";
					showIconFun('publish',$rows['isactive']);
					echo "</a></td>";

					echo "<td align='center'><a href='index.php?com=".COMS."&amp;task=edit&amp;id=$id'>";
					showIconFun('edit','');
					echo "</a></td>";

					echo "<td align='center'><a href='index.php?com=".COMS."&amp;task=delete&amp;id=$id' onclick=\"return confirm('Bạn có chắc muốn xóa ?')\">";
					showIconFun('delete','');
					echo "</a></td>";

				}
				echo "</tr>";
			}
			?>
		</table>
	</form>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="Footer_list">
		<tr>
			<td align="center">	  
				<?php
				paging($total_rows,$max_rows,$cur_page,'?com=users&page={page}');
				?>
			</td>
		</tr>
	</table>
</div>
