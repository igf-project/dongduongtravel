<?php
//ini_set('display_errors',1);
$COM='members';
?>
<div class='container'>
	<div id="col_main">
		<div class='content' style='padding:50px 0;'>
		<?php
		$viewtype='';
		if(isset($_GET['viewtype'])){
			$viewtype=addslashes($_GET['viewtype']);
		}
		if(is_file(COM_PATH.'com_'.$COM.'/tem/'.$viewtype.'.php'))
			include_once('tem/'.$viewtype.'.php');	
		unset($viewtype); unset($obj); unset($COM);
		?>
		</div>
	</div>
	<div class='clr'></div>
</div>