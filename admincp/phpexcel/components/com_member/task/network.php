<?php
if($UserLogin->isAdmin(1) || $UserLogin->isAdmin(2) || $UserLogin->isAdmin(3)):
defined("ISHOME") or die("Can not acess this page, please come back!");
$objmem=new CLS_MEMBER_LEVEL;
$obj=new CLS_MYSQL;
$level = 6; $cdate = 0;
if(isset($_GET['id'])) {
	$sql = "SELECT * FROM tbl_accounts WHERE `username`='".addslashes($_GET['id'])."'";
	$obj->Query($sql);
	$kq=$obj->Fetch_Assoc();
	$level = $kq['level'];
	$cdate = $kq['cdate'];
} else {
	$sql="SELECT * FROM tbl_accounts";
	$obj->Query($sql);
	$kq=$obj->Fetch_Assoc();
}
// Tính tổng mã trong 1 cung
$count_lv1 = $objmem->count_record(1); // level=1, cung 2
$count_lv2 = $objmem->count_record(2); // level=2, cung 3 
$count_lv3 = $objmem->count_record(3); // level=3, cung 4
$count_lv4 = $objmem->count_record(4); // level=4, cung 5
$count_lv5 = $objmem->count_record(5); // level=5, cung 6
$count_lv6 = $objmem->count_record(6); // level=6, mã dừng
$count_lv = $count_lv1 + $count_lv2 + $count_lv3 + $count_lv4 + $count_lv5 + $count_lv6;
//echo $count_lv1.' + '.$count_lv2.' + '.$count_lv3.' + '.$count_lv4.' + '.$count_lv5.' + '.$count_lv6.' = '.$count_lv;

// Tính tổng mã từ mã gốc đến mã của 1 cung bất kỳ (trừ 1 mã gốc)
$vt_lv1 = ($count_lv6+$count_lv5+$count_lv4+$count_lv3+$count_lv2+$count_lv1-1); // cung 1
$vt_lv2 = ($count_lv6+$count_lv5+$count_lv4+$count_lv3+$count_lv2-1); // cung 2
$vt_lv3 = ($count_lv6+$count_lv5+$count_lv4+$count_lv3-1); // cung 3
$vt_lv4 = ($count_lv6+$count_lv5+$count_lv4-1); // cung 4
$vt_lv5 = ($count_lv6+$count_lv5-1); // cung 5
$vt_lv6 = ($count_lv6-1); // cung 6
?>
<div align="center">Lọc KQ theo từ khóa <input id="searchInput" placeholder="Nhập từ khóa cần lọc"><br/></div>
<div class='list_mem'>
<div class=''>
	<div class="column_item"><h3>Cung 1</h3>
	<div class="item_acc">
	<?php
	$sql1="SELECT * FROM tbl_accounts WHERE level=0 AND `cdate`>=$cdate";
	$obj->Query($sql1);
	while($r=$obj->Fetch_Assoc()){
		echo "<a href='#'><i class='fa fa-creadit-card-alt'></i>{$r['account']}</a>";
	}
	?>	
	</div></div>
	<div class="column_item"><h3>Cung 2</h3>
	<div class="item_acc">
	<?php
	if($level>0) {
		$sql2="SELECT * FROM tbl_accounts WHERE level=1 ORDER BY id DESC";
		$obj->Query($sql2); 
		$n=$stt=0;
		while($r=$obj->Fetch_Assoc()){
			if($n<($vt_lv1%2)){
				$stt++;
				echo "<a href='#' style='color:blue'>{$stt}. <i class='fa fa-creadit-card-alt'></i>{$r['account']}</a>";
			}else echo "<a href='#'><i class='fa fa-creadit-card-alt'></i>{$r['account']}</a>";
			$n++;
		}
	}
	?>
	</div></div>
	<div class="column_item"><h3>Cung 3</h3>
	<div class="item_acc">
	<?php
	if($level>1) {
		$sql3="SELECT * FROM tbl_accounts WHERE level=2 ORDER BY id DESC";
		$obj->Query($sql3);
		$n=$stt=0;
		while($r=$obj->Fetch_Assoc()){
			if($n<($vt_lv2%3)){
				$stt++;
				echo "<a href='#' style='color:blue'>{$stt}. <i class='fa fa-creadit-card-alt'></i>{$r['account']}</a>";
			}else echo "<a href='#'><i class='fa fa-creadit-card-alt'></i>{$r['account']}</a>";
			$n++;
		}
	}
	?>
	</div></div>
	<div class='column_item'><h3>Cung 4</h3>
	<div class="item_acc">
	<?php
	if($level>2) {
		$sql3="SELECT * FROM tbl_accounts WHERE level=3 ORDER BY id DESC";
		$obj->Query($sql3);$n=$stt=0;
		while($r=$obj->Fetch_Assoc()){
			if($n<($vt_lv3%4)){
				$stt++;
				echo "<a href='#' style='color:blue'>{$stt}. <i class='fa fa-creadit-card-alt'></i>{$r['account']}</a>";
			}else echo "<a href='#'><i class='fa fa-creadit-card-alt'></i>{$r['account']}</a>";
			$n++;
		}
	}
	?>
	</div></div>
	<div class='column_item'><h3>Cung 5</h3>
	<div class="item_acc">
	<?php
	if($level>3) {
		$sql4="SELECT * FROM tbl_accounts WHERE level=4 ORDER BY id DESC";
		$obj->Query($sql4);$n=$stt=0;
		while($r=$obj->Fetch_Assoc()){
			if($n<($vt_lv4%8)){
				$stt++;
				echo "<a href='#' style='color:blue'>{$stt}. <i class='fa fa-creadit-card-alt'></i>{$r['account']}</a>";
			}else echo "<a href='#'><i class='fa fa-creadit-card-alt'></i>{$r['account']}</a>";
			$n++;
		}
	}
	?>
	</div></div>
	<div class='column_item'><h3>Cung 6</h3>
	<div class="item_acc">
	<?php
	if($level>4) {
		$sql5="SELECT * FROM tbl_accounts WHERE level=5 ORDER BY id DESC";
		$obj->Query($sql5);$n=$stt=0;
		while($r=$obj->Fetch_Assoc()){
			if($n<($vt_lv5%11)){
				$stt++;
				echo "<a href='#' style='color:blue'>{$stt}. <i class='fa fa-creadit-card-alt'></i>{$r['account']}</a>";
			}else echo "<a href='#'><i class='fa fa-creadit-card-alt'></i>{$r['account']}</a>";
			$n++;
		}
	}
	?>
	</div></div>
	<div class='column_item'><h3>Cung thoát</h3>
	<div class="item_acc">
	<?php
	if($level>5) {
		$sql6="SELECT * FROM tbl_accounts WHERE level=6 ORDER BY id DESC";
		$obj->Query($sql6);
		while($r=$obj->Fetch_Assoc()){
			if($r['status']==0)
				echo "<a href='#' style='color:red'><i class='fa fa-creadit-card-alt'></i>{$r['account']}</a>";
			else echo "<a href='#'><i class='fa fa-creadit-card-alt'></i>{$r['account']}</a>";
		}
	}
	?>
	</div></div>
</div></div>
<style>
.list_mem {font-size:15px; clear:both}
.list_mem .column_item { float:left; width:13%; margin:8px}
.list_mem h3 {
    border-bottom: 2px solid #eee;
    padding: 10px; 
	font-size:16px;
    text-align: center;
}
.list_mem a {
    display: block;
    padding: 10px;
    text-align: center;
}
.list_mem a:nth-child(even) {
    background: #f5f5f5;
}
.list_mem a:nth-child(odd) {
    background: #fff;
}
</style>
<script>
$("#searchInput").keyup(function() {
	var rows = $(".item_acc").find("a").hide();
	var data = this.value.split(" ");
	$.each(data, function(i, v) {
		rows.filter(":contains('" + v + "')").show();
	});
});
</script>
<?php endif;?>