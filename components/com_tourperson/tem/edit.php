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

$obj->getList('WHERE `tbl_tour_person`.`tour_id`='.$tour_id.'');
$row=$obj->Fetch_Assoc();
?>
<div class="container">
    <div class="frm-control">
        <h3><span class="color-1"><?php echo $tour_name;?></span> > Cập nhật liên hệ tour</h3>
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
				<li>
                    <span class="number num3">03</span>
                    <span class="name">Dịch vụ Tour</span>
                </li>
                 <li class="active">
                    <span class="number num4">04</span>
                    <span class="name">Tour contact</span>
                </li>
                <li class="">
                    <span class="number num5">05</span>
                    <span class="name">Thư viện ảnh</span>
                </li>
               
            </ul>
        </div>
		<form id="frm_action" name="frm_action" method="post" action=""  enctype="multipart/form-data">
			<input name="txtid" type="hidden" value="<?php echo $row['id'];?>"/>
			<input name="txt_tour_id" type="hidden" value="<?php echo $tour_id;?>"/>
			<div class="row">
				<div class='form-group col-md-6'>
					<label class="control-label"><strong>Họ và tên</strong></label>
					<input name="txt_fullname" type="text" id="txt_fullname" size="45" class='form-control' value="<?php echo $row['fullname'];?>" placeholder='' />
				</div>
				<div class='form-group col-md-6'>
					<label class="control-label"><strong>Mã số CMTND </strong></label>
					<input name="txt_cmt" type="text" id="txt_cmt" size="45" class='form-control' value="<?php echo $row['cmt'];?>" placeholder='' />
				</div>
				<div class='form-group col-md-6'>
					<label class="control-label"><strong>Email </strong></label>
					<input name="txt_email" type="text" id="txt_email" size="45" class='form-control' value="<?php echo $row['email'];?>" placeholder='' />
				</div>
				<div class='form-group col-md-6'>
					<label class="control-label"><strong>Phone</strong></label>
					<input name="txt_phone" type="text" id="txt_phone" size="45" class='form-control' value="<?php echo $row['phone'];?>" placeholder='' />
				</div>
				<div class='form-group col-md-6'>
					<label class="control-label"><strong>Address</strong></label>
					<input name="txt_address" type="text" id="txt_address" size="45" class='form-control' value="<?php echo $row['address'];?>" placeholder='' />
				</div>
			</div>
				
			<a class="save btn-default btn-primary"  href="#" onclick="dosubmitAction('frm_action','save');" title="Save">Save</a>
			<input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;">
		</form>

</div>
<script language="javascript">
    function checkinput(){
         if($("#txt_fullname").val()==""){
            alert('Fullname is require!');
            $("#txt_fullname").focus();
            return false;
        }
        if($("#txt_cmt").val()==""){
            alert('Chứng minh thư nhân dân is require!');
            $("#txt_cmt").focus();
            return false;
        }
        if($("#txt_address").val()==""){
            alert('Address where is require!');
            $("#txt_address").focus();
            return false;
        }
		 // check validate email
        if($("#txt_email").val() !=""){
            var value=$("#txt_email").val();
            var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
            if(!value.match(re)){
                alert('Email is not validate!');
                $("#txt_email").focus();
                return false;
            }
        }
        else{
            alert('Email is require!');
            $("#txt_email").focus();
            return false;
        }


        /* Check is number phone*/
        if($("#txt_phone").val() !=""){
            var valueP=$("#txt_phone").val();
            var phoneno =/^[\d\.\-]+$/;;
            if(!valueP.match(phoneno)){
                alert('Phone is not validate number!');
                $("#txt_phone").focus();
                return false;
            }
        }
        else{
            alert('Number Phone is require!');
            $("#txt_phone").focus();
            return false;
        }
		
        return true;
    }
   
</script>