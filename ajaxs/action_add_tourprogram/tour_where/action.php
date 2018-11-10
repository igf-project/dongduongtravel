<?php
include_once('../../../includes/gfinnit.php');
include_once('../../../includes/gffunction.php');
include_once('../../../includes/gfconfig.php');
include_once('../../../libs/cls.mysql.php');
include_once('../../../libs/cls.tourprogramwhere.php');
$objdata = new CLS_MYSQL();
$obj = new CLS_TOURPROGRAMWHERE();

$post_TourId = 		(int)$_POST['txt_tour_id'];
$post_DayId=		(int)$_POST['txt_day_id'];
$post_Title =		addslashes($_POST['txt_title_where']);
$post_PositionId=	addslashes($_POST['cbo_position']);
$post_Content=		addslashes($_POST['txt_content_where']);
$post_Time=			addslashes($_POST['txt_time_where']);

if(isset($_POST['txtid'])){
	$post_ID=$_POST['txtid'];
	$sql="UPDATE tbl_tour_programwhere SET
			`title`='".$post_Title."',
			`content`='".$post_Content."',
			`position_id`='".$post_PositionId."',
			`time`='".$post_Time."'
			WHERE id='".$post_ID."'";
	$objdata->Query($sql);
}
else{
	$sql="INSERT INTO `tbl_tour_programwhere`(`tour_id`, `day_id`, `position_id`, `title`, `content`, `time`) VALUES
	('".$post_TourId."', '".$post_DayId."', '".$post_PositionId."', '".$post_Title."', '".$post_Content."','".$post_Time."')";
	$objdata->Query($sql);
}
$str="WHERE `tour_id`=$post_TourId AND `day_id`=$post_DayId.";
$obj->getListItemForm($str,'');
?>
<script language="javascript">
    function checkinputPopup(){
        if($("#frm-edit #txt_title_where").val()==""){
            alert('Title is require!');
            $("#txt_title_where").focus();
            return false;
        }
        if($("#frm-edit #txt_address_where").val()==""){
            alert('Address is require!');
            $("#txt_address_where").focus();
            return false;
        }
        if($("#frm-edit #txt_time_where").val()==""){
            alert('Time is require!');
            $("#txt_time_where").focus();
            return false;
        }
        return true;
    }

	$('.actEdit').click(function(){
		var val=$(this).attr('value');
		var tour_id=$(this).attr('tourId');
		$.get('<?php echo ROOTHOST;?>ajaxs/action_add_tourprogram/tour_where/actionFormEdit.php',{val, tour_id},function(response_data){
			$('#myModal').modal('show');
            $('#myModalLabel').html('Edit record');
			$('#data-frm').html(response_data);
		})
	});
			
	 function confirm_mes(act){
		if(confirm('Bạn có muốn ' +act+ ' bản ghi này!')){
			return true;
		}
		return false;
	}	
	$('.actAjax').click(function(){
		var data = {
			'val': $(this).attr('value'),
			'tour_id': $(this).attr('tourId'),
			'act': $(this).attr('act')
		}
		if(data['act']=='del'){/* check confirm nếu xóa item*/
			if(confirm_mes('xóa')==false){
				return;
			};

		}
		$.post('<?php echo ROOTHOST;?>ajaxs/action_add_tourprogram/tour_where/comAction.php',data,function(response_data){
			$("#tr-"+ data['val']).html(response_data);
		})
		//console.log('aa');
	});

	
</script>
