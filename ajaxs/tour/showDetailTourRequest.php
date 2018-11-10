<?php
include_once('../../includes/gfinnit.php');
include_once('../../includes/gffunction.php');
include_once('../../includes/gfconfig.php');
include_once('../../libs/cls.mysql.php');
include_once('../../libs/cls.tour.php');
include_once('../../libs/cls.tourpersonrequest.php');
if(isset($_GET['value'])){
    $id=isset($_GET['value'])? (int)($_GET['value']):'';
}
else
    echo "Not acset Program";

    $objTourPer=new CLS_TOURPERSONREQUEST();
    $strWhere="WHERE `tbl_tour_person_request`.`id`=$id";
    $objTourPer->getList($strWhere);
    WHILE($rows=$objTourPer->Fetch_Assoc()):
        ?>
    <div class="col-md-6">
        <div class="info-user">
        <h4>Thông tin khách hàng</h4>
        <table class="tbl">
            <tr>
                <td class="td-label">Họ và tên</td>
                <td><?php echo $rows['fullname'];?></td>
            </tr>
            <tr>
                <td class="td-label">CMTND:</td>
                <td><?php echo $rows['cmt'];?></td>
            </tr>
            <tr>
                <td class="td-label">Email:</td>
                <td><?php echo $rows['email'];?></td>
            </tr>
            <tr>
                <td class="td-label">Phone:</td>
                <td><?php echo $rows['phone'];?></td>
            </tr>
            <tr>
                <td class="td-label">Address:</td>
                <td><?php echo $rows['address'];?></td>
            </tr>
            <tr>
                <td class="td-label" style="color: red">Đặt tour lúc:</td>
                <td style="color: red">
                    <?php  echo $date = gmdate("d/m/Y H:i A", $rows['date'] + 7*3600);?>
                </td>
            </tr>
        </table>
        </div>
    </div>
    <div class="col-md-6">

        <h4>Thông tin Tour đặt</h4>
        <table class="tbl">
            <tr>
                <td class="td-label">Điểm đón</td>
                <td><?php echo $rows['where_start'];?></td>
            </tr>
            <tr>
                <td class="td-label">Điểm du lịch:</td>
                <td><?php echo $rows['position'];?></td>
            </tr>
            <tr>
                <td class="td-label">Thời gian khởi hành:</td>
                <td><?php echo $rows['time_start'];?></td>
            </tr>
            <tr>
                <td class="td-label">Thời gian đi tour:</td>
                <td><?php echo $rows['num_day']." ngày ".$rows['num_night']." đêm";?></td>
            </tr>
            <tr>
                <td class="td-label">Yêu cầu khách sạn:</td>
                <td><?php echo $rows['rank_hotel'];?></td>
            </tr>
            <tr>
                <td class="td-label">Người lớn:</td>
                <td><?php echo $rows['number_person'];?></td>
            </tr>
            <tr>
                <td class="td-label">Trẻ em (1-4 Tuổi):</td>
                <td><?php echo $rows['number_child14'];?></td>
            </tr>
            <tr>
                <td class="td-label">Trẻ em (5-9 Tuổi):</td>
                <td><?php echo $rows['number_child59'];?></td>
            </tr>

        </table>
    </div>
        <h4>Thông yêu cầu khác</h4>
        <?php echo $rows['other'];?>
    <div class="clearfix"></div>
    <?php endwhile;?>
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