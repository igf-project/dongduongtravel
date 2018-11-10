<?php
if($UserLogin->isAdmin(1) || $UserLogin->isAdmin(2) || $UserLogin->isAdmin(3)):
    $keyword='';
defined('ISHOME') or die("Can't acess this page, please come back!");
if(!isset($_SESSION['KEYWORD_MEM']))
	$_SESSION['KEYWORD_MEM']='';
if(isset($_POST['txtkeyword'])){
	$_SESSION['KEYWORD_MEM']=addslashes($_POST['txtkeyword']);
}
$keyword=$_SESSION['KEYWORD_MEM'];
$strwhere=" isactive=1 AND ";
if($keyword!="" && $keyword!="Keyword")
	$strwhere.=" ( `username` like '%$keyword%' OR `fullname` like '%$keyword%') AND";
if($strwhere!="")
	$strwhere=" WHERE ".substr($strwhere,0,strlen($strwhere)-4);
//echo $strwhere;
$obj->getList($strwhere,'');
$total_rows=$obj->Num_rows();
if(!isset($_SESSION["CUR_PAGE_MEMBER_LEVEL"]))
	$_SESSION["CUR_PAGE_MEMBER_LEVEL"]=1;
if(isset($_POST['txtCurnpage']))
	$_SESSION['CUR_PAGE_MEMBER_LEVEL']=(int)$_POST['txtCurnpage'];

if($_SESSION['CUR_PAGE_MEMBER_LEVEL']>ceil($total_rows/MAX_ROWS))
	$_SESSION['CUR_PAGE_MEMBER_LEVEL']=ceil($total_rows/MAX_ROWS);
$cur_page=$_SESSION['CUR_PAGE_MEMBER_LEVEL'];
if($cur_page<1) $cur_page=1;
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
	</td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="1" cellpadding="5" class="list">
  <tr class="header">
	<td width="30" align="center">STT</td>
	<td align="center">Họ tên</td>
	<td align="center">Tên đăng nhập</td>
	<td align="center">ID Giới Thiệu</td>
	<td align="center">Địa chỉ</td>
	<td align="center">Điện thoại</td>
	<td align="center">CMT</td>
	<td width="120" align="center">Ngày Tham Gia</td>
	<td width="120" align="center">Ngày Kích hoạt</td>
	<td width="50" align="center">Tổng mã</td>
	<td width="100" align="center">Lệnh</td>
  </tr>
  <?php 
  $start=($cur_page-1)*MAX_ROWS;
  $obj->getList($strwhere." LIMIT $start,".MAX_ROWS);
  $stt=$start;
  while($rows=$obj->Fetch_Assoc()){
	$stt++;
	$fullname=stripslashes($rows["fullname"]);
	$username=stripslashes($rows["username"]);
	$paruser=stripslashes($rows["par_user"]);
	$add=stripslashes($rows["address"]);
	$phone=stripslashes($rows["phone"]);
	$cmt=stripslashes($rows["cmt"]);
	$phone=stripslashes($rows["phone"]);
	$cdate=date('d/m/Y H:i:s',strtotime($rows["cdate"]));
	$mdate=date('d/m/Y H:i:s',strtotime($rows["mdate"]));
	$number = $obj->count_user($username);
	echo "<tr name='trow'>";
	echo "<td align='center'>$stt</td>";
	echo "<td>$fullname</td>";
	echo "<td>$username</td>";
	echo "<td>$paruser</td>";
	echo "<td>$add</td>";
	echo "<td>$phone</td>";
	echo "<td>$cmt</td>";
	echo "<td align='center'>$cdate</td>";
	echo "<td align='center'>$mdate</td>";
	echo "<td align='center'>$number</td>";
	echo "<td width='50' align='center'>";
	echo "<a href='index.php?com=".COMS."&amp;task=add_account&amp;id=$username'>Thêm mã số</a>";			
	echo "</td>";
	echo "</tr>";
  }
  ?>
</table>
</form>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="Footer_list">
  <tr>
	<td align="center"><?php paging($total_rows,MAX_ROWS,$cur_page);?></td>
  </tr>
</table>
</div>
<?php endif;//----------------------------------------------?>