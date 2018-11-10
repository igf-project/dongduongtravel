<?php
include_once('../../includes/gfinnit.php');
include_once('../../includes/gffunction.php');
include_once('../../includes/gfconfig.php');
include_once('../../libs/cls.mysql.php');
include_once('../../libs/cls.tour.php');
include_once('../../libs/cls.tourprogramwhere.php');
if(isset($_POST['txt_fullname'])){
    $tourId=(int)$_POST['txt_tourid'];
    $fullname=isset($_POST['txt_fullname'])? addslashes($_POST['txt_fullname']):'';
    $phone=isset($_POST['txt_phone'])? addslashes($_POST['txt_phone']):'';
    $email=isset($_POST['txt_email'])? addslashes($_POST['txt_email']):'';
    $cmt=isset($_POST['txt_cmt'])? addslashes($_POST['txt_cmt']):'';
    $numperson=isset($_POST['txt_numperson'])? addslashes($_POST['txt_numperson']):'';
}
else
    echo "Not acset Program";
$objTour=new CLS_TOUR();
$objTourPrWhere=new CLS_TOURPROGRAMWHERE();
$strWhere="AND `tbl_tour`.`id`=$tourId";
$objTour->getListAllActive($strWhere);
?>
<div class="box-book">
    <?php
    while($rows=$objTour->Fetch_Assoc()){
        $alt_thumb=$rows['name'];
        $thumb=getThumbAjax($rows['thumb'],$alt_thumb, '', 320, 240);
        $intro=strip_tags(Substring($rows['intro'], 0, 15));
        $url=ROOTHOST."tour/chi-tiet/".$rows['code'].".html";
        $date = date("d-m-Y", strtotime($rows['cdate']));
        ?>
        
        <span value="<?php echo $rows['price'];?>" id="mon"></span>
        <span value="<?php echo $rows['children_1_4'];?>" id="mon14"></span>
        <span value="<?php echo $rows['children_5_9'];?>" id="mon59"></span>
        <div class="info-tour pull-left">
            <?php echo $thumb;?>
            <div class="tour-content">
                <h3><?php echo $rows['name'];?></h3>

                <div class="price">Giá: <span class="color-1"><?php echo getFomatPrice($rows['price']);?></span> </div>
                <ul class="info-detail">
                    <li>
                        Thời gian: <?php echo $rows['num_day'].' ngày - '.$rows['num_night'].' đêm';?>
                    </li>
                    <li>
                        Khách sạn: 3 Sao
                    </li>
                    <li>
                        Lịch trình:
                        <span class="where">
                            <?php echo $objTourPrWhere->getListItemInline("WHERE `tbl_tour_programwhere`.`tour_id`='$tourId'");?>
                            <div class="clearfix"></div>
                        </span>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
        </div>
        <?php $total_money=getFomatPrice($rows['price']);?>
        
        <?php 
    } ?>
    <form class="frm-action frm-booktour pull-right" id="frm-booktour" action="<?php echo ROOTHOST."ajaxs/tour/actionBookTour.php";?>" method="POST">

        <input type="hidden" name="txt_tourid" id="txt_tourid" value="<?php echo $tourId;?>"/>
        <div class="form-group">
            <ul class="list-inline list-seach list-radio">
                <h4>Quý khách cần: </h4>
                <li><input type="radio" name="txt_type" value="1" checked="true"><span>Đặt tour</span></li>
                <li><input type="radio" name="txt_type" value="2"><span class="per-suport">Cần người tư vấn</span></li>
            </ul>
        </div>
        <h4>Thông tin khách hàng: </h4>
        <div class="form-group">
            <span class="gen-error" id="err-fullname"></span>
            <input class="form-control" placeholder="Họ và tên" name="txt_fullname" id="txt_fullname" value="<?php echo $fullname;?>"/>
        </div>
        <div class="form-group">
            <span class="gen-error" id="err-cmt"></span>
            <input class="form-control" type="number" placeholder="Số CMTND" name="txt_cmt" id="txt_cmt" value="<?php echo $cmt;?>"/>
        </div>
        <div class="form-group">
            <span class="gen-error" id="err-phone"></span>
            <input class="form-control" type="number" placeholder="Điện thoại" name="txt_phone" id="txt_phone" value="<?php echo $phone;?>"/>
        </div>
        <div class="form-group">
            <span class="gen-error" id="err-email"></span>
            <input class="form-control" type="email" placeholder="Email" name="txt_email" id="txt_email" value="<?php echo $email;?>"/>
        </div>
        <div class="form-group">
            <span class="gen-error" id="err-address"></span>
            <input class="form-control" placeholder="Địa chỉ" name="txt_address" id="txt_address" value=""/>
        </div>
        <div class="form-group box-select-price row">
            <span class="gen-error" id="err-number"></span>
            <div class="col-md-4 col-xs-4 item">
                <span>Người lớn</span>
                <select class="select" name="txt_numperson" id="txt_num" onchange="func_checkMoney()">
                    <?php $total_person=100;
                    $i='1';
                    for($i==1; $i<=$total_person; $i++){?>
                    <option class="" value="<?php echo $i;?>" <?php echo $numperson==$i? 'selected':''?>><?php echo $i;?></option>
                    <?php }
                    ?>
                </select>
            </div>
            <div class="col-md-4 col-xs-4 item">
                <span>Trẻ em: 1-4Tuổi</span>
                <select class="select" name="txt_numchild14" id="txt_numchild14" onchange="func_checkMoney()">
                    <?php $total_child=30;
                    $i='0';
                    for($i==1; $i<=$total_child; $i++){?>
                    <option class="" value="<?php echo $i;?>" <?php echo $numperson==$i? 'selected':''?>><?php echo $i;?></option>
                    <?php }
                    ?>
                </select>
            </div>
            <div class="col-md-4 col-xs-4 item">
                <span>Trẻ em: 5-9Tuổi</span>
                <select class="select" name="txt_numchild59" id="txt_numchild59" onchange="func_checkMoney()">
                    <?php $total_child=30;
                    $i='0';
                    for($i==1; $i<=$total_child; $i++){?>
                    <option class="" value="<?php echo $i;?>" <?php echo $numperson==$i? 'selected':''?>><?php echo $i;?></option>
                    <?php }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-7 col-xs-7 item">
            </div>
            <div class="col-md-5 col-xs-5 item">
                <input type="submit" id="book-tour" class="btn btn-default btn-frm btn-login" value="Xác nhận"/>
            </div>
        </div>
    </form>
<div class="sum-money" id="money">Tổng tiền thanh toán: <?php echo $total_money;?></div>
    <div class="clearfix"></div>
</div>
<div id="abc"></div>
<script>

    function checkinput(){
      if($("#txt_fullname").val()==""){
          $("#err-fullname").html('Fullname is require!');
          $("#txt_fullname").focus();
          return false;
      }
      else{
          $("#err-fullname").html('');
      }
      if($("#txt_cmt").val()==""){
        $("#err-cmt").html('Number CMTND is require!');
        $("#txt_cmt").focus();
        return false;
    }
    else{
        $("#err-cmt").html('');
    }
    if($("#txt_phone").val()==""){
        $("#err-phone").html('Phone is require!');
        $("#txt_phone").focus();
        return false;
    }
    else{
        $("#err-phone").html('');
    }
    if($("#txt_email").val()==""){
        $("#err-email").html('Email is require!');
        $("#txt_email").focus();
        return false;
    }
    else{
        $("#err-email").html('');
    }
    if($("#txt_address").val()==""){
        $("#err-address").html('Address is require!');
        $("#txt_address").focus();
        return false;
    }
    else{
        $("#err-address").html('');
    }
    if($("#txt_numperson").val()==""){
        $("#err-number").html('Number Person is require!');
        $("#txt_numperson").focus();
        return false;
    }
    else{
        $("#err-number").html('');
    }
    return true;
}
$('.frm-booktour').submit(function(){
    if(checkinput()==true){
        var postData = $(this).serializeArray();
        var url=$(this).attr('action');
        $.post(url, postData, function(response_data){
            $('#myModal').modal('hide');

               // $('#abc').html(response_data);
           });
        alert("Đặt tour thành công!");
        return false;
    }
    else
        return false;
})
function formatNumber (num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")
}

function func_checkMoney(){
    var mon=($('#mon').attr('value'));
    var mon14=($('#mon14').attr('value'));
    var mon59=($('#mon59').attr('value'));
    var num_child14=($('#txt_numchild14').val());
    var num_child59=($('#txt_numchild59').val());
    var num_per=($('#txt_num').val());
    $total=mon*num_per + num_child14*mon14 + num_child59*mon59;
    $('#money').html('Tổng tiền thanh toán: '+formatNumber($total)+ ' VND');
}

</script>