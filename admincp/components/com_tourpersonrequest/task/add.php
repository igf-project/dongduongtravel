<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
define('TASK_NAME', ' Đặt tour');
write_path();
if(isset($_POST['cmdsave'])){
    $post_fullname = addslashes($_POST['txt_fullname']);
    $post_cmt = (int)$_POST['txt_cmt'];
    $post_phone = (int)$_POST['txt_phone'];
    $post_email = addslashes($_POST['txt_email']);
    $post_address = addslashes($_POST['txt_address']);
    $post_wherestart = addslashes($_POST['txt_wherestart']);
    $post_position = addslashes($_POST['txt_position']);
    $post_start_time = date('Y-m-d',strtotime($_POST['txt_timestart']));
    $post_rankhotel = addslashes($_POST['txt_rankhotel']);
    $post_numday = addslashes($_POST['txt_numday']);
    $post_numnight = addslashes($_POST['txt_numnight']);
    $post_numperson = addslashes($_POST['txt_numperson']);
    $post_numchild14 = addslashes($_POST['txt_numchild14']);
    $post_numchild59 = addslashes($_POST['txt_numchild59']);
    $post_other = addslashes($_POST['txt_other']);
    $post_date = time();
    $post_type = 0;
    $sql="INSERT INTO tbl_tour_person_request (`fullname`,`cmt`,`email`,`phone`,`address`,`number_person`,`number_child14`,`number_child59`,`time_start`,`num_day`,`num_night`,`where_start`,`position`,`rank_hotel`,`other`,`date`,`type`) VALUES ('$post_fullname','$post_cmt','$post_email','$post_phone','$post_email','$post_numperson','$post_numchild14','$post_numchild59','$post_start_time','$post_numday','$post_numnight','$post_wherestart','$post_position','$post_rankhotel','$post_other','$post_date','$post_type')";
    $objdata->Query($sql);
    echo "<script language=\"javascript\">window.location='index.php?com=".COMS."'</script>";
}
?>
<h1 align='center'>Đặt tour</h1>
<div id="action">
    <div class="box-tabs">
        <form id="frm_action" name="frm_action" method="post" action="" enctype="multipart/form-data">
            <div class="box-control">
                <a href="?com=tourpersonrequest" class="btn btn-default pull-left">Quay lại</a>
                <input type="submit" name="cmdsave" id="cmdsave"  class="btn btn-primary pull-right" value="Lưu thông tin">
            </div>
            <hr/>
            <div class="tab-content">
                <div class="row">
                    <div class="form-group col-md-6 col-sm-6">
                        <label>Tên khách hàng <font color="red">*</font></label>
                        <input class="form-control" placeholder="Họ và tên*" name="txt_fullname" id="txt_fullname" value=""/>
                        <span class="gen-error" id="err-fullname"></span>
                    </div>
                    <div class="form-group col-md-6 col-sm-6">
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <label>Số SMTND <font color="red">*</font></label>
                                <input class="form-control" type="number" placeholder="Số CMTND" name="txt_cmt" id="txt_cmt" value="" min="0"/>
                                <span class="gen-error" id="err-cmt"></span>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <label>SĐT <font color="red">*</font></label>
                                <input class="form-control" type="number" placeholder="Điện thoại*" name="txt_phone" id="txt_phone" value="" min="0"/>
                                <span class="gen-error" id="err-phone"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-6 col-sm-6">
                        <label>Email</label>
                        <input class="form-control" type="email" placeholder="Email" name="txt_email" id="txt_email" value=""/>
                        <span class="gen-error" id="err-email"></span>
                    </div>
                    <div class="form-group col-md-6 col-sm-6">
                        <label>Địa chỉ <font color="red">*</font></label>
                        <input class="form-control" placeholder="Địa chỉ*" name="txt_address" id="txt_address" value=""/>
                        <span class="gen-error" id="err-address"></span>
                    </div>

                    <div class="form-group col-md-6 col-sm-6">
                        <label>Điểm đón <font color="red">*</font></label>
                        <input class="form-control"  placeholder="Điểm đón*" name="txt_wherestart" id="txt_wherestart" value=""/>
                        <span class="gen-error" id="err-wherestart"></span>
                    </div>
                    <div class="form-group col-md-6 col-sm-6">
                        <label>Điểm đến <font color="red">*</font></label>
                        <input class="form-control" placeholder="Điểm đến (Điểm du lịch)*" name="txt_position" id="txt_position" value=""/>
                        <span class="gen-error" id="err-position"></span>
                    </div>

                    <div class="form-group col-md-6 col-sm-6">
                        <label>Thời gian khởi hành <font color="red">*</font></label>
                        <input type="date" class="form-control" placeholder="Thời gian khởi hành*" name="txt_timestart" id="txt_timestart" value=""/>
                        <span class="gen-error" id="err-timestart"></span>
                    </div>
                    <div class="form-group col-md-6 col-sm-6">
                        <label>Khách sạn</label>
                        <select id="txt_rankhotel" name="txt_rankhotel" class="form-control">
                            <option value="6">Tiêu chuẩn</option>
                            <option value="1">1 Sao</option>
                            <option value="2">2 Sao</option>
                            <option value="3">3 Sao</option>
                            <option value="4">4 Sao</option>
                            <option value="5">5 Sao</option>
                        </select>
                        <span class="gen-error" id="err-rankhotel"></span>
                    </div>
                </div>
                <p>Thời gian đi tour</p>
                <div class="row">
                    <div class="form-group col-md-6 col-sm-6 item">
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <label>Số ngày <font color="red">*</font></label>
                                <input class="form-control" type="number" placeholder="Số ngày*" name="txt_numday" id="txt_numday" value="" min="0"/>
                                <span class="gen-error" id="err-numday"></span>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <label>Số đêm <font color="red">*</font></label>
                                <input class="form-control" type="number" placeholder="Số đêm*" name="txt_numnight" id="txt_numnight" value="" min="0"/>
                                <span class="gen-error" id="err-numnight"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="box-select-price row">
                            <div class="col-md-4 col-xs-4 item">
                                <label>Người lớn</label>
                                <select class="form-control" name="txt_numperson" id="txt_num">
                                    <?php $total_person=100;
                                    $i='1';
                                    for($i==1; $i<=$total_person; $i++){?>
                                    <option class="" value="<?php echo $i;?>"><?php echo $i;?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-4 col-xs-4 item">
                                <label>Trẻ em(1-4Tuổi)</label>
                                <select class="form-control" name="txt_numchild14" id="txt_numchild14">
                                    <?php $total_child=30;
                                    $i='0';
                                    for($i==1; $i<=$total_child; $i++){?>
                                    <option class="" value="<?php echo $i;?>" ><?php echo $i;?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-4 col-xs-4 item">
                                <label>Trẻ em(5-9Tuổi)</label>
                                <select class="form-control" name="txt_numchild59" id="txt_numchild59">
                                    <?php $total_child=30;
                                    $i='0';
                                    for($i==1; $i<=$total_child; $i++){
                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <label>Yêu cầu khác</label>
                <textarea class="form-control" rows="3" name="txt_other" placeholder="Yêu cầu khác"></textarea>
                <div class="text-center">
                    <br/>
                    <a href="?com=tourpersonrequest" class="btn btn-default">Quay lại</a>
                    <input type="submit" name="cmdsave" id="cmdsave"  class="btn btn-primary" value="Lưu thông tin">
                </div>
            </form>
        </div>
    </div>
</div>

<script language="javascript">
    function checkinput(){
        var number = new RegExp('^[0-9]+$');
        if($("#txt_fullname").val()==""){
            $('#err-fullname').text('Không được bỏ trống');
            $("#txt_fullname").focus();
            return false;
        }else{
            $('#err-fullname').text('');
        }
        var cmtnd = $("#txt_cmt").val();
        if(/^[0-9]+$/.test(cmtnd)==false){
            $('#err-cmt').text('Không đúng định dạng');
            $("#txt_cmt").focus();
            return false;
        }else{
            $('#err-cmt').text('');
        }
        var phone = $("#txt_phone").val();
        if(/^[0-9]+$/.test(phone)==false){
            $('#err-phone').text('Không đúng định dạng');
            $("#txt_phone").focus();
            return false;
        }else{
            $('#err-phone').text('');
        }

        if($("#txt_address").val()==""){
            $('#err-address').text('Không được bỏ trống');
            $("#txt_address").focus();
            return false;
        }else{
            $('#err-address').text('');
        }

        if($("#txt_wherestart").val()==""){
            $('#err-wherestart').text('Không được bỏ trống');
            $("#txt_wherestart").focus();
            return false;
        }else{
            $('#err-wherestart').text('');
        }

        if($("#txt_position").val()==""){
            $('#err-position').text('Không được bỏ trống');
            $("#txt_position").focus();
            return false;
        }else{
            $('#err-position').text('');
        }

        if($("#txt_timestart").val()==""){
            $('#err-timestart').text('Không được bỏ trống');
            $("#txt_timestart").focus();
            return false;
        }else{
            $('#err-timestart').text('');
        }

        if($("#txt_numday").val()==""){
            $('#err-numday').text('Không được bỏ trống');
            $("#txt_numday").focus();
            return false;
        }else{
            $('#err-numday').text('');
        }

        if($("#txt_numnight").val()==""){
            $('#err-numnight').text('Không được bỏ trống');
            $("#txt_numnight").focus();
            return false;
        }else{
            $('#err-numnight').text('');
        }

        return true;
    }
    $(document).ready(function() {
        $('#frm_action').submit(function(){
            return checkinput();
        })
    });
</script>