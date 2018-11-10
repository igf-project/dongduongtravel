
<?php
session_start();
include_once('../../includes/gfinnit.php');
include_once('../../includes/gfconfig.php');
include_once('../../libs/cls.mysql.php');
include_once('../../libs/cls.member_level.php');
$objdata=new CLS_MYSQL;
if(!isset($objmem))
    $objmem=new CLS_MEMBERLEVEL();

if(isset($_POST['txt'])){
	$username = addslashes($_POST['txt']);
    $total_money = $objmem->CountMoneyNotFomatUser(1,'tbl_wallet',$username);
    $m_wallet_waitting=-1*($objmem->getWaittingWallet($username, 'tbl_wallet'));/* Tiền đóng băng trong ví nội bộ*/
    $sum_total_wallet=$total_money - $m_wallet_waitting;/* Tiền được thực thi*/

    $hh_thoatcung = $objmem->CountMoneyNotFomatUser(1,'tbl_hh_histories',$username);
    $hh_tructiep = $objmem->CountMoneyNotFomatUser(1,'tbl_hh_tructiep',$username);
    $hh_hoanvon = $objmem->CountMoneyNotFomatUser(1,'tbl_hh_hoanvon',$username);
    $hh_chilaidinhky = $objmem->CountMoneyNotFomatUser(1,'tbl_hh_laidinhky',$username);
    $vinoibo = $objmem->CountMoneyNotFomatUser(1,'tbl_wallet',$username);
    $total=$hh_thoatcung+$hh_tructiep+$hh_hoanvon+$hh_chilaidinhky+$vinoibo;
  /*
	$sql = "SELECT username FROM tbl_member_level WHERE username='$username'";
	$objdata->Query($sql);
	if($objdata->Num_rows()>0) echo '1';
	else echo '0';*/



?>
<tr>
    <td width="150" align="right" bgcolor="#EEEEEE"><strong>Tổng tiền HH thoát cung</strong></td>
    <td id=""><?php echo number_format($hh_thoatcung);?> VNĐ</td>
</tr>
<tr>
    <td width="150" align="right" bgcolor="#EEEEEE"><strong>Tổng tiền HH tư vấn</strong></td>
    <td id=""><?php echo number_format($hh_tructiep);?> VNĐ</td>
</tr>
<tr>
    <td width="150" align="right" bgcolor="#EEEEEE"><strong>Tổng tiền HH hoàn vốn</strong></td>
    <td id=""><?php echo number_format($hh_hoanvon);?> VNĐ</td>
</tr>
<tr>
    <td width="150" align="right" bgcolor="#EEEEEE"><strong>Tổng tiền HH chia lãi định kì</strong></td>
    <td id=""><?php echo number_format($hh_chilaidinhky);?> VNĐ</td>
</tr>
<tr>
    <td width="150" align="right" bgcolor="#EEEEEE"><strong>Tiền ví nội bộ</strong></td>
    <td id=""><?php echo number_format($vinoibo);?> VNĐ</td>
</tr>
<tr>
    <td width="150" align="right" bgcolor="#EEEEEE"><strong>Tổng tiền tất cả</strong></td>
    <td id=""><?php echo number_format($total);?> VNĐ</td>
</tr>
<tr>
    <td width="150" align="right" bgcolor="#EEEEEE"><strong>Tiền đang chờ xử lý (Tiền đóng băng)</strong></td>
    <td id=""><?php echo number_format($m_wallet_waitting);?> VNĐ</td>
</tr>
<tr>
    <td width="150" align="right" bgcolor="#EEEEEE"><strong>Tổng tiền thực thi</strong></td>
    <td id=""><?php echo number_format($sum_total_wallet);?> VNĐ</td>
</tr>
<?php }?>