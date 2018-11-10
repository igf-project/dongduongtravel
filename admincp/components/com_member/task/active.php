<?php
	defined('ISHOME') or die('Can not acess this page, please come back!');
	$id='';
	if(isset($_GET['id']))
		$id=addslashes($_GET['id']);
	$obj->setActive($id);
?>
<script>window.location.href='<?php echo 'index.php?com='.COMS;?>'</script>