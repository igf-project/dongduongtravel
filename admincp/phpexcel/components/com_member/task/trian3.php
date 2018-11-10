<?php
if(isset($_POST['cmd_tadd'])){
	$code=$_POST['txt_tcode'];
	$name=$_POST['txt_tname'];
	$date=date('Y-m-d h:i:s');
	$sql="INSERT INTO tbl_daimond_tree3(`code`,`name`,`cdate`,`mdate`) VALUES('$code','$name','$date','$date')";
	$objmysql=new CLS_MYSQL;
	$objmysql->Exec($sql);
	$obj_account=new CLS_ACCOUNT;
	$obj_account->calc_trian_3(0);
}
function getAll($level){
	$sql="SELECT * FROM tbl_daimond_tree3 WHERE level=$level";
	$mysql=new CLS_MYSQL;
	$mysql->Query($sql);
	$arr=array();
	while($r=$mysql->Fetch_Assoc()){
		$arr[count($arr)]=$r['name'].'-'.$r['code'];
	}
	return $arr;
}
$l0=getAll(0);
$l1=getAll(1);
$l2=getAll(2);
$l3=getAll(3);
$l4=getAll(4);
$l5=getAll(5);
?>
<form method='post' action=''>
Mã:<input type="text" name="txt_tcode"/> Tên ID:<input type="text" name="txt_tname"/><input type="submit" name="cmd_tadd" value="Add New"/>
</form>

<fieldset><legend>Danh sách mã số tri ân 3</legend>
<table class='list' width="100%">
<tr>
	<th align='center'>STT</th>
	<th align='center'>Id Chờ</th>
	<th align='center'>Id Lever 1</th>
	<th align='center'>Id Lever 2</th>
	<th align='center'>Id Lever 3</th>
	<th align='center'>Id Lever 4</th>
	<th align='center'>Id Lever 5</th>
</tr>
<?php 
$n=count($l0);
for($i=0;$i<$n;$i++){
?>
<tr>
	<td align="center"><?php echo ($i+1);?></td>
	<td><?php echo isset($l0[$i])?$l0[$i]:'';?></td>
	<td><?php echo isset($l1[$i])?$l1[$i]:'';?></td>
	<td><?php echo isset($l2[$i])?$l2[$i]:'';?></td>
	<td><?php echo isset($l3[$i])?$l3[$i]:'';?></td>
	<td><?php echo isset($l4[$i])?$l4[$i]:'';?></td>
	<td><?php echo isset($l5[$i])?$l5[$i]:'';?></td>
</tr>
<?php }?>
</table>
</fieldset>