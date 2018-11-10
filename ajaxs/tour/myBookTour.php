<?php
include_once('../../includes/gfinnit.php');
include_once('../../includes/gffunction.php');
include_once('../../includes/gfconfig.php');
include_once('../../libs/cls.mysql.php');
include_once('../../libs/cls.tourpersonrequest.php');
?>
    <form class="frm-action mybooktour" id="frm-booktour" action="<?php echo ROOTHOST."ajaxs/tour/actionMyBookTour.php";?>" method="POST">
        <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4>Đặt tour theo yêu cầu</h4>
        <div class="row">
            <div class="form-group col-md-6 col-sm-6">
                <input class="form-control" placeholder="Họ và tên*" name="txt_fullname" id="txt_fullname" value=""/>
                <span class="gen-error" id="err-fullname"></span>
            </div>
            <div class="form-group col-md-6 col-sm-6">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <input class="form-control" type="number" placeholder="Số CMTND*" name="txt_cmt" id="txt_cmt" value="" min="0"/>
                        <span class="gen-error" id="err-cmt"></span>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <input class="form-control" type="number" placeholder="Điện thoại*" name="txt_phone" id="txt_phone" value="" min="0"/>
                        <span class="gen-error" id="err-phone"></span>
                    </div>
                </div>
            </div>
            <div class="form-group col-md-6 col-sm-6">
                <input class="form-control" type="email" placeholder="Email" name="txt_email" id="txt_email" value=""/>
                <span class="gen-error" id="err-email"></span>
            </div>
            <div class="form-group col-md-6 col-sm-6">
                <input class="form-control" placeholder="Địa chỉ*" name="txt_address" id="txt_address" value=""/>
                <span class="gen-error" id="err-address"></span>
            </div>

            <div class="form-group col-md-6 col-sm-6">
                <input class="form-control"  placeholder="Điểm đón*" name="txt_wherestart" id="txt_wherestart" value=""/>
                <span class="gen-error" id="err-wherestart"></span>
            </div>
            <div class="form-group col-md-6 col-sm-6">
                <input class="form-control" placeholder="Điểm đến (Điểm du lịch)*" name="txt_position" id="txt_position" value=""/>
                <span class="gen-error" id="err-position"></span>
            </div>

            <div class="form-group col-md-6 col-sm-6">
                <input class="form-control" placeholder="Thời gian khởi hành*" name="txt_timestart" id="txt_timestart" value=""/>
                <span class="gen-error" id="err-timestart"></span>
            </div>
            <div class="form-group col-md-6 col-sm-6">
                <input class="form-control" placeholder="Khách sạn" name="txt_rankhotel" id="txt_rankhotel" value=""/>
                <span class="gen-error" id="err-rankhotel"></span>
            </div>

            <div class="col-md-6 col-sm-6 col-xs-6 form-group item">
                <textarea class="textarea" name="txt_other" placeholder="Yêu cầu khác"></textarea>
            </div>
            <div class="form-group col-md-6 col-sm-6 item">
                <span>Thời gian đi tour</span>
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <input class="form-control" type="number" placeholder="Số ngày*" name="txt_numday" id="txt_numday" value="" min="0"/>
                        <span class="gen-error" id="err-numday"></span>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <input class="form-control" type="number" placeholder="Số đêm*" name="txt_numnight" id="txt_numnight" value="" min="0"/>
                        <span class="gen-error" id="err-numnight"></span>
                    </div>
                </div>

                <div class="box-select-price row">
                    <div class="col-md-4 col-xs-4 item">
                        <span>Người lớn</span>
                        <select class="select" name="txt_numperson" id="txt_num">
                            <?php $total_person=100;
                            $i='1';
                            for($i==1; $i<=$total_person; $i++):?>
                                <option class="" value="<?php echo $i;?>"><?php echo $i;?></option>
                            <?php endfor;
                            ?>
                        </select>
                        <!-- <input class="form-control" type="number" placeholder="Số người (người lớn)" name="txt_numperson" id="txt_num" value="<?php /*echo $numperson;*/?>"/>-->
                    </div>
                    <div class="col-md-4 col-xs-4 item">
                        <span>Trẻ em(1-4Tuổi)</span>
                        <select class="select" name="txt_numchild14" id="txt_numchild14">
                            <?php $total_child=30;
                            $i='0';
                            for($i==1; $i<=$total_child; $i++):?>
                                <option class="" value="<?php echo $i;?>" ><?php echo $i;?></option>
                            <?php endfor;
                            ?>
                        </select>
                    </div>
                    <div class="col-md-4 col-xs-4 item">
                        <span>Trẻ em(5-9Tuổi)</span>
                        <select class="select" name="txt_numchild59" id="txt_numchild59">
                            <?php $total_child=30;
                            $i='0';
                            for($i==1; $i<=$total_child; $i++):?>
                                <option class="" value="<?php echo $i;?>"><?php echo $i;?></option>
                            <?php endfor;
                            ?>
                        </select>
                    </div>
                </div>

            </div>
        </div>

      <!--  <div class="row">
            <h4>Phương tiện</h4>
            <div class="form-group col-md-6 col-sm-6">
                Ô tô
                <ul class="list-inline">
                    <li><input type="checkbox">Xe con 4 chỗ</li>
                    <li><input type="checkbox">Xe khách 16 chỗ</li>
                    <li><input type="checkbox">Xe khách 24 chỗ</li>
                    <li><input type="checkbox">Xe khách 40 chỗ</li>
                </ul>
            </div>
            <div class="form-group col-md-6 col-sm-6">
                Máy bay
                <ul class="list-inline">
                    <li><input type="checkbox">Vietnam Eline</li>
                    <li><input type="checkbox">Xe khách 16 chỗ</li>
                    <li><input type="checkbox">Xe khách 24 chỗ</li>
                    <li><input type="checkbox">Xe khách 40 chỗ</li>
                </ul>
            </div>
        </div>
-->
            <div class="row">

                <div class="text-center">
                    <input type="submit" id="book-tour" class="btn btn-default btn-success" style="margin-top: 8px" value="Xác nhận"/>
                </div>
            </div>
        </form>

    <div class="clearfix"></div>
<script>

    function checkinput(){
      if($("#txt_fullname").val()==""){
          $("#err-fullname").html('Họ và tên là bắt buộc!');
         $("#txt_fullname").focus();
         return false;
      }
       else{
          $("#err-fullname").html('');
      }
        if($("#txt_cmt").val()==""){
            $("#err-cmt").html('Số chứng minh thư là bắt buộc!');
            $("#txt_cmt").focus();
            return false;
        }
        else{
            $("#err-cmt").html('');
        }
        if($("#txt_phone").val()==""){
            $("#err-phone").html('Số điện thoại là bắt buộc!');
            $("#txt_phone").focus();
            return false;
        }
        else{
            $("#err-phone").html('');
        }
        if($("#txt_email").val()==""){
            $("#err-email").html('Email là bắt buộc!');
            $("#txt_email").focus();
            return false;
        }
        else{
            $("#err-email").html('');
        }
        if($("#txt_address").val()==""){
            $("#err-address").html('Địa chỉ là bắt buộc!');
            $("#txt_address").focus();
            return false;
        }
        else{
            $("#err-address").html('');
        }

        if($("#txt_wherestart").val()==""){
            $("#err-wherestart").html('Điểm đón là bắt buộc!');
            $("#txt_wherestart").focus();
            return false;
        }
        else{
            $("#err-wherestart").html('');
        }
        if($("#txt_position").val()==""){
            $("#err-position").html('Điểm đến là bắt buộc!');
            $("#txt_position").focus();
            return false;
        }
        else{
            $("#err-position").html('');
        }
        if($("#txt_timestart").val()==""){
            $("#err-timestart").html('Thời gian khởi hành là bắt buộc!');
            $("#txt_timestart").focus();
            return false;
        }
        else{
            $("#err-timestart").html('');
        }
        if($("#txt_numday").val()==""){
            $("#err-numday").html('Thời gian khởi hành là bắt buộc!');
            $("#txt_numday").focus();
            return false;
        }
        else{
            $("#err-numday").html('');
        }
        if($("#txt_numnight").val()==""){
            $("#err-numnight").html('Số ngày là bắt buộc!');
            $("#txt_numnight").focus();
            return false;
        }
        else{
            $("#err-numnight").html('');
        }



        if($("#txt_numperson").val()==""){
            $("#err-number").html('Số người lớn là bắt buộc!');
            $("#txt_numperson").focus();
            return false;
        }
        else{
            $("#err-number").html('');
        }
        return true;
    }
    $('.mybooktour').submit(function(){
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

</script>