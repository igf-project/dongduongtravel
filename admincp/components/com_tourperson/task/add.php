<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
define('TASK_NAME', ' Đặt tour');
write_path();
if(isset($_POST['cmdsave'])){
    $obj->TourId=(int)$_POST['cbo_tour'];
    $obj->Fullname=addslashes($_POST['txt_fullname']);
    $obj->Cmt=addslashes($_POST['txt_cmt']);
    $obj->Email=addslashes($_POST['txt_email']);
    $obj->Phone=addslashes($_POST['txt_phone']);
    $obj->Address=addslashes($_POST['txt_address']);
    $obj->NumberPerson=(int)$_POST['txt_numperson'];
    $obj->NumberChild14=(int)$_POST['txt_numchild14'];
    $obj->NumberChild59=(int)$_POST['txt_numchild59'];
    $obj->Type=(int)$_POST['txt_type'];
    $obj->Add_new();
    echo "<script language=\"javascript\">window.location='index.php?com=".COMS."'</script>";
}
?>
<h1 align='center'>Đặt tour </h1>
<div id="action">
    <div class="box-tabs">
        <form id="frm_action" name="frm_action" method="post" action="" enctype="multipart/form-data">
            <div class="box-control">
                <a href="?com=tourperson" class="btn btn-default pull-left">Quay lại</a>
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
                        <label>Số SMTND <font color="red">*</font></label>
                        <input class="form-control" type="number" placeholder="Số CMTND" name="txt_cmt" id="txt_cmt" value="" min="0"/>
                        <span class="gen-error" id="err-cmt"></span>
                    </div>
                    <div class="form-group col-md-6 col-sm-6">
                        <label>SĐT <font color="red">*</font></label>
                        <input class="form-control" type="number" placeholder="Điện thoại*" name="txt_phone" id="txt_phone" value="" min="0"/>
                        <span class="gen-error" id="err-phone"></span>
                    </div>
                    <div class="form-group col-md-6 col-sm-6">
                        <label>Email</label>
                        <input class="form-control" type="email" placeholder="Email" name="txt_email" id="txt_email" value=""/>
                        <span class="gen-error" id="err-email"></span>
                    </div>
                    <div class="form-group col-md-6 col-sm-6">
                        <label>Chọn tour <font color="red">*</font></label>
                        <select id="cbo_tour" class="form-control" name="cbo_tour" required>
                            <option value="0">-- Chọn một tour --</option>
                            <?php
                            $sql="SELECT `id`, `name` FROM tbl_tour WHERE isactive=1 ";
                            $objdata->Query($sql);
                            while ($row_tour=$objdata->Fetch_Assoc()) {
                                $tour_id = (int)$row_tour['id'];
                                $tour_name = stripcslashes($row_tour['name']);
                                echo '<option value="'.$tour_id.'">'.$tour_name.'</option>';
                            }
                            ?>
                        </select>
                        <span class="gen-error" id="err-tour"></span>
                    </div>
                    <div class="form-group col-md-6 col-sm-6">
                        <label>Kiểu tour</label>
                        <div class="col-md-12 row">
                            <label class="radio-inline"><input type="radio" value="1" name="txt_type" checked>Đặt tour</label>
                            <label class="radio-inline"><input type="radio" value="0" name="txt_type">Cần người tư vấn</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Địa chỉ</label>
                    <textarea class="form-control" placeholder="Địa chỉ*" name="txt_address" id="txt_address" rows="3"></textarea>
                    <span class="gen-error" id="err-address"></span>
                </div>
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
                <div class="text-center">
                    <br/>
                    <a href="?com=tourperson" class="btn btn-default">Quay lại</a>
                    <input type="submit" name="cmdsave" id="cmdsave" class="btn btn-primary" value="Lưu thông tin">
                </div>
            </div>
        </form>
    </div>
</div>
</div>

<script>
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
        if($("#cbo_tour").val()==""){
            $("#err-tour").text('Chọn một tour');
            return false;
        }else{
            $('#err-tour').text('');
        }
        return true;
    }
    $(document).ready(function() {
        $("#cbo_tour").select2();
        $('#frm_action').submit(function(){
            return checkinput();
        })
    });
</script>