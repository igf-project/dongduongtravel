<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
if(isset($_GET['code'])){
    $tour_code=addslashes($_GET['code']);
}
else die('PAGE NOT FOUND');


include_once(LIB_PATH.'cls.tour.php');
$objTour=new CLS_TOUR();
$arr=$objTour->getIdAndNameByCode($tour_code);
$tour_id=$arr['id'];
$tour_name=$arr['name'];
?>
<div class="container">
    <div class="frm-control">
		<div class="link-header">
            <h3><span class="color-1"><?php echo $tour_name;?></span>> Thêm dịch vụ Tour</h3>
        </div>
       <div class="box-step">
            <ul>
				<li>
                    <span class="number num1">01</span>
                    <span class="name">Thông tin Tour</span>
                </li>
                <li>
                    <span class="number num2">02</span>
                    <span class="name">Các lịch trình Tour</span>
                </li>
                 <li class="active">
                    <span class="number num3">04</span>
                    <span class="name">Dịch vụ Tour</span>
                </li>
				<li>
                    <span class="number num4">02</span>
                    <span class="name">Tour contact</span>
                </li>
                <li class="">
                    <span class="number num5">03</span>
                    <span class="name">Thư viện ảnh</span>
                </li>
               
            </ul>
        </div>
		
		<div class="row">
			<div class="col-md-6">
				<form id="frm-tour-program" name="frm_action" method="post" action="<?php echo ROOTHOST.'ajaxs/action_add_tourservices/action.php';?>" enctype="multipart/form-data">
				<input name="txt_tour_id" type="hidden" value="<?php echo $tour_id;?>"/>
				
				  <div class="row">
					<div class='form-group col-md-12'>
						 <label class="control-label"><strong>Name</strong></label>
						 <input name="txt_name" type="text" id="txt_name" size="45" class='form-control' value="" placeholder='' />
					 </div>
				 </div>
				  <div class="row">
					<div class='form-group col-md-6'>
						 <label class="control-label"><strong>Đơn giá</strong></label>
						 <input name="txt_price" type="text" id="txt_price" size="45" class='form-control' value="" placeholder='' />
					 </div>
					 <div class='form-group col-md-6'>
						 <label class="control-label"><strong>Số lượng</strong></label>
						 <input name="txt_quantity" type="text" id="txt_quantity" size="45" class='form-control' value="" placeholder='' />
					 </div>
				 </div>
				 <div class="row">
					<div class='form-group col-md-12'>
						 <label class="control-label"><strong>Loại dịch vụ</strong></label>
						<select name="cbo_type" id="cbo_type" class='form-control'>
							<option value='1'>Dịch vụ chung</option>
							<option value='2'>Dịch vụ khác (Có tính phí)</option>
						</select>
					 </div>
				 </div>
				 <div class="form-group">
					 <label><strong>Nội dung mô tả</strong></label>
					 <textarea name="txt_content" id="txt_content" size="45" placeholder='Mô tả hành trình trong ngày'></textarea>
				 </div>
				<span class="save btn-default btn-primary" id="btn-add-program">Save</span>
				<a href="<?php echo ROOTHOST.'member/tour/'.$tour_code.'/them-lien-he'?>" class="save btn-default btn-success">Continues</a>
			</form>

			</div>
			<div class="col-md-6">
		
				<h3>Danh sách dịch vụ</h3>
				 <table class="table" style="width: 100%">
					<tr>
						<th>#</th>
						<th>Name</th>
						<th width="50" class="text-center">Sửa</th>
						<th width="50" class="text-center">Xóa</th>
					</tr>
					<tbody id="respon-list" class="list-result">
					<?php
						$str="WHERE `tour_id`=".$tour_id;
						$obj->listAjax($str, $limit=''); /*load list width call ajax*/
					?>
					</tbody>
				</table>
			</div>
			<div class="clearfix"></div>
		</div>
</div>

 <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Update Record</h4>
                </div>
                <div class="modal-body" id="data-frm">
                    <!-- show -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="submitUpdate()">Save changes</button>
                </div>
            </div>
        </div>
    </div>

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
        if($("#txt_num_day").val()==""){
            alert('Day is require!');
            $("#txt_num_day").focus();
            return false;
        }
        if($("#txt_title").val()==""){
            alert('Title is require!');
            $("#txt_title").focus();
            return false;
        }
        if($("#txt_content").val()==""){
            alert('Content is require!');
            $("#txt_content").focus();
            return false;
        }
        return true;
    }
	
    $(document).ready(function() {
		   /* add */
		$(document).on('click','#btn-add-program',function(e) {
			if(checkinput()){
				 var form = $('#frm-tour-program');
				var postData = form.serializeArray();
				var url=form.attr('action');
				$.post(url, postData, function(response_data){
					$('#respon-list').html(response_data);
					form.reset();
				});
			}
		   
			return false;
		});
		
		
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

    });

</script>