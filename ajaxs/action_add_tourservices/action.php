<?php
include_once('../../includes/gfinnit.php');
include_once('../../includes/function.php');
include_once('../../includes/gfconfig.php');
include_once('../../libs/cls.mysql.php');
include_once('../../libs/cls.tourservices.php');
$obj=new CLS_TOURSERVICES();
$obj->TourId=(int)$_POST['txt_tour_id'];
$obj->ServiceTypeId='';
$obj->Name=addslashes($_POST['txt_name']);
$obj->Content=addslashes($_POST['txt_content']);
$obj->Quantity=addslashes($_POST['txt_quantity']);
$obj->Price=addslashes($_POST['txt_price']);
$obj->Type=addslashes($_POST['cbo_type']);

if(isset($_POST['txtid'])){
    $obj->ID=$_POST['txtid'];
    $obj->Update();
}
else{
    $obj->Add_new();
}
$ajax='';
$str="WHERE `tour_id`=".$obj->TourId;
$obj->listAjax($str, $limit=''); /*load list width call ajax*/
?>

<script language="javascript">
		
	 function submitUpdate(){
		//if(checkinput() == true){
		var form = $('#frm-edit');
		var postData = form.serializeArray();
		var url ='<?php echo ROOTHOST;?>ajaxs/action_add_tourservices/action.php';
		$.post(url, postData, function(response_data){
			$('#respon-list').html(response_data);
			$('#myModal').modal('hide');
		});

            // }
	};
	
	
    function checkinput(){
       /*  if($("#txt_name").val()==""){
            alert('Name is require!');
            $("#txt_name").focus();
            return false;
        }
        if($("#cbo_category").val()==""){
            alert('Category is require!');
            $("#cbo_category").focus();
            return false;
        }
        if($("#txt_start").val()==""){
            alert('Start where is require!');
            $("#txt_start").focus();
            return false;
        }
		if($("#txt_num_date").val()==""){
            alert('Number date is require!');
            $("#txt_num_date").focus();
            return false;
        }
		if($("#txt_num_night").val()==""){
            alert('Number night is require!');
            $("#txt_num_night").focus();
            return false;
        }
		if($("#fileImg").val()==""){
            alert('Thumb image is choose!');
            $("#fileImg").focus();
            return false;
        }
		if($("#txt_version").val()==""){
            alert('Version tour date is require!');
            $("#txt_version").focus();
            return false;
        }
		if($("#txt_price").val()==""){
            alert('Version tour date is require!');
            $("#txt_price").focus();
            return false;
        }
		if($("#txt_price14").val()==""){
            alert('Price for children 1-4 is require!');
            $("#txt_price14").focus();
            return false;
        }
		if($("#txt_price59").val()==""){
            alert('Price for children 5-9 is require!');
            $("#txt_price59").focus();
            return false;
        } */
        return true;
    }
   
	$('.actEdit').click(function(){
		var val=$(this).attr('value');
		var tour_id=$(this).attr('tourId');
		$.get('<?php echo ROOTHOST;?>ajaxs/action_add_tourservices/actionFormEdit.php',{val, tour_id},function(response_data){
			$('#myModal').modal('show');
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
		$.post('<?php echo ROOTHOST;?>ajaxs/action_add_tourservices/comAction.php',data,function(response_data){
			$("#tr-"+ data['val']).html(response_data);
		})
		//console.log('aa');
	});

	
</script>
