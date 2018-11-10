<?php
defined('ISHOME') or die('Can not acess this page, please come back!');
define('OBJ_PAGE','TOURPERSON');
define('TASK_NAME', '');
write_path();
$objdata=new CLS_MYSQL();
$keyword='';$strwhere='';$action='';
// Khai báo SESSION
if(isset($_POST['cbo_active'])){
	$action = strip_tags($_POST['cbo_active']);
    $_SESSION['ACT'.OBJ_PAGE]=$action;
}
if(isset($_POST['txtkeyword'])){
	$keyword=trim($_POST['txtkeyword']);
	$_SESSION['KEY_'.OBJ_PAGE]=$keyword;
}

// Gán strwhere
if($keyword!='')
	$strwhere.=" AND ( `tbl_tour_person`.`fullname` like '%$keyword%' )";
if($action!='' && $action!='all')
	$strwhere.=" AND ( `tbl_tour_person_request`.`status` = $action )";

$sql="SELECT count(*)  as num FROM `tbl_tourperson` WHERE 1=1 ".$strwhere;
$objdata->Query($sql);
$r=$objdata->Fetch_Assoc();
$total_rows=$r['num'];
$cur_page=isset($_GET['page'])?(int)$_GET['page']:1;
?>
<div id="list">
	<form id="frm_list" name="frm_list" method="post" action="">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="Header_list">
			<tr>
				<td>
					<strong>Tìm kiếm:</strong>
					<input type="text" name="txtkeyword" id="txtkeyword" placeholder="Keyword" value="<?php echo $keyword;?>"/>
					<input type="submit" name="button" id="button" value="Tìm kiếm" class="button" size='30'/>
					<select name="cbo_active" id="cbo_active" onchange="document.frm_list.submit();">
						<option value="all">Tất cả</option>
						<option value="0">Đặt mới</option>
						<option value="1">Hoàn thành</option>
						<option value="2">Hủy</option>
						<script language="javascript">
							cbo_Selected('cbo_active','<?php echo $action;?>');
						</script>
					</select>
				</td>
				<td align="right">
					<a href="?com=tourperson&task=add" class="btn btn-success button"><i class="fa fa-plus" aria-hidden="true"></i> Thêm mới</a>
				</td>
			</tr>
		</table>
		<div style="clear:both;height:10px;"></div>
		<table class="table table-bordered">
			<tr class="header">
				<th width="30" align="center">#</th>
				<th align="center">Tên</th>
				<th align="center">Tên tour</th>
				<th class="text-center">SĐT</th>
				<th align="center">Email</th>
				<th align="center">Thời gian</th>
				<th width="50" align="center">View</th>
				<th width="50" align="center">Trạng thái</th>
			</tr>
			<?php
			$start=($cur_page-1)*MAX_ROWS;
			$leng=MAX_ROWS;
			$sql="SELECT `tbl_tour_person`.*, `tbl_tour`.`name` AS `tour_name`, `tbl_tour`.`code` AS `tour_code` FROM `tbl_tour_person` LEFT JOIN `tbl_tour` ON `tbl_tour_person`.`tour_id` = `tbl_tour`.`id` WHERE 1=1 ".$strwhere." ORDER BY `tbl_tour_person`.`date` DESC LIMIT $start,$leng";
			$objdata->Query($sql);
			while($rows=$objdata->Fetch_Assoc()){
				$ids=$rows['id'];$start++;
				$name = stripcslashes($rows['fullname']);
				$phone = stripcslashes($rows['phone']);
				$email = stripcslashes($rows['email']);
				$time = date('H:i a d/m-Y', $rows['date']);
				$tour_name = Substring($rows["tour_name"],0,10);
				$status = $rows['status'];
				$icon_status='';
				switch ($status) {
					case '0':
						$icon_status='<img src="'.ROOTHOST_ADMIN.'images/new.gif">';
					break;
					case '1':
						$icon_status='<i class="fa fa-check-circle" style="color:green" aria-hidden="true"></i>';
					break;
					default:
						$icon_status='<i class="fa fa-times-circle" style="color:red" aria-hidden="true"></i>';
					break;
				}
				echo "<tr name='trow'>";
				echo "<td width='40px' align='center'>$start</td>";

				echo "<td>".$name."</td>";
				echo "<td>".$tour_name."</td>";
				echo "<td align='center'>".$phone."</td>";
				echo "<td>".$email."</td>";
				echo "<td>".$time."</td>";

				echo "<td  align='center'>";
				echo "<a href='index.php?com=".COMS."&amp;task=view&amp;id=$ids'><i class='fa fa-eye' aria-hidden='true'></i></a>";
				echo "</td>";

				echo "<td align='center'>";
				echo $icon_status;
				echo "</td>";

				echo "</tr>";

			}
			?>
		</table>
	</form>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="Footer_list">
		<tr>
			<td align="center">
				<?php
				paging($total_rows,MAX_ROWS,$cur_page,'?com=tourperson&page={page}');
				?>
			</td>
		</tr>
	</table>
</div>
<?php //----------------------------------------------?>
