<?php session_start(); 
include_once("../includes/gfconfig.php");
?>
<form name="frmcart" id="frmcart" method="post" action="#">
<?php
//unset($_SESSION['FOODCART_ID']); unset($_SESSION['FOODCART_SL']);
//unset($_SESSION['FOODCART_NA']); unset($_SESSION['FOODCART_PR']);unset($_SESSION['FOODCART_ADD']);

if(isset($_POST['food_id']) && $_POST['food_id']>0){
	if(!isset($_POST['num'])) {
		//print_r($_POST);
		$food_id = (int)$_POST['food_id'];
		$food_price = (int)$_POST['food_price'];
		$food_name = addslashes($_POST['food_name']);
		if($_POST['address']!='') $_SESSION['FOODCART_ADD'] = addslashes($_POST['address']);
		if(!isset($_SESSION['FOODCART_ID'])){
			$_SESSION['FOODCART_ID'][] = $food_id;
			$_SESSION['FOODCART_NA'][] = $food_name;
			$_SESSION['FOODCART_PR'][] = $food_price;
			$_SESSION['FOODCART_SL'][] = 1;
		}
		else {
			$flag = false;
			for ($i=0;$i<count($_SESSION['FOODCART_ID']);$i++) 
				if($_SESSION['FOODCART_ID'][$i]==$food_id) {
					$flag=true; 
					$_SESSION['FOODCART_SL'][$i] +=1;
					break;
				}
			if($flag==false) {
				$n = count($_SESSION['FOODCART_ID']);
				$_SESSION['FOODCART_ID'][$n] = $food_id;
				$_SESSION['FOODCART_NA'][$n] = $food_name;
				$_SESSION['FOODCART_PR'][$n] = $food_price;
				$_SESSION['FOODCART_SL'][$n] = 1;
			}
		}
	} else {
		$food_id = (int)$_POST['food_id'];
		$food_sl = (int)$_POST['num'];
		
		for ($i=0;$i<count($_SESSION['FOODCART_ID']);$i++) 
			if($_SESSION['FOODCART_ID'][$i]==$food_id) {
				$_SESSION['FOODCART_SL'][$i] = $food_sl; break;
			}
	}
}
if(isset($_SESSION['FOODCART_ID'])) {
	$total = 0;
	for ($i=0;$i<count($_SESSION['FOODCART_ID']);$i++) {
		$price = $_SESSION['FOODCART_PR'][$i]*$_SESSION['FOODCART_SL'][$i];
		$total+=$price;
?>
<div class='item'>
	<div class='pull-left'><input type="number" class="number_food" min="1" value="<?php echo $_SESSION['FOODCART_SL'][$i];?>" style="width:30px" name="<?php echo $_SESSION['FOODCART_ID'][$i];?>"/> <?php echo $_SESSION['FOODCART_NA'][$i];?></div>
	<div class='price pull-right'><?php echo number_format($price);?>
		<a href="#" class="glyphicon glyphicon-remove" name="<?php echo $_SESSION['FOODCART_ID'][$i];?>"></a>
	</div>
</div>
<?php } // end for ?>
<div class='total'>
	<strong>Tổng cộng<strong>
	<div class='price pull-right'><?php echo number_format($total);?></div>
</div>
<div class='text-center'>
	<input type="hidden" name="address" value="<?php echo $_SESSION['FOODCART_ADD'];?>"/>
	<a class="btn btn-success" href="<?php echo ROOTHOST;?>xac-nhan-dat-mon/" rel="nofollow">Hoàn thành chọn món</a>
</div>
<?php 
} // end if
else echo "<div class='total'>Vui lòng chọn món</div>"; 
?>
<input type="hidden" name="update_cart" value="1">
<input type="hidden" name="remove" id="removeID" value=""/>
</form>
<script>
$('#frmcart .number_food').click(function(){
	$('#frmcart').submit();
})
$('#frmcart .glyphicon-remove').click(function(){
	var remove_id = $(this).attr("name"); 
	$('#removeID').val(remove_id);
	$('#frmcart').submit();
})
</script>