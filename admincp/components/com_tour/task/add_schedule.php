<link rel="stylesheet" href="<?php echo ROOTHOST.TEM_PATH;?>web/css/searchableOptionList.css">
<script src="<?php echo ROOTHOST.TEM_PATH;?>web/scripts/searchableOptionList.js"></script>
<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
define('TASK_NAME', 'Thêm mới đặt tour');
write_path();

$date= isset($_GET['date'])?(int)$_GET['date']:'0';
$tour= isset($_GET['tour'])?(int)$_GET['tour']:'0';
if($date=='0' || $tour=='0') die("PAGE NOT FOUND !");

$sql="SELECT arr_location FROM tbl_tour WHERE isactive=1 AND id=$tour";
$objdata->Query($sql);
$row_Lo = $objdata->Fetch_Assoc();
$arr_location = stripcslashes($row_Lo['arr_location']);
?>
<style>
    .back{ position: absolute; top: 0; }
    .color-1{ color: #21a117 !important; }
    .box-respon {
        background-color: #fafafa;
        padding: 12px;
        margin-top: 18px;
    }
    .box-respon .item .img-position{
        width: 120px;
        height: auto;
        float: left;
        margin-right: 12px;
    }
    .box-scroll{height: 500px; overflow: auto;}
    .list-result .item{
        overflow: hidden;
        margin-bottom: 8px;
        padding: 10px 60px 10px 0px;
        position: relative;
        border-bottom: 1px solid #eee;
    }
    .list-result .item h4{
        font-size: 16px;
        color: #21a117;
        padding: 0px;
        margin: 0px 0px 8px 0px;
    }
    .list-result .item .content{ margin-top: 5px; }
    .list-result .item .abs-control{
        position: absolute;
        right: 10px;
        top: 15px;
    }
    .list-result .item .abs-control span{
        display: block;
        border: 1px solid #eee;
        padding: 2px 8px;
        margin-bottom: 6px;
        font-size: 11px;
        cursor: pointer;
    }
    .list-result .item .abs-control span{
        display: block;
        border: 1px solid #eee;
        padding: 2px 8px;
        margin-bottom: 6px;
        font-size: 11px;
        cursor: pointer;
    }
    #respon-foodmenu .del-item{
        color: #000000;
        font-weight: bold;
        padding: 0px 5px;
        cursor: pointer;
        margin-left: 5px;
    }
    #respon-foodmenu .del-item:hover{color: #FFF;}
    .tags {
        padding: 0;
        list-style: none;
        overflow: hidden;
    }
</style>
<div style="position: relative;">
    <h1 align='center'>Thêm lịch trình ngày <?php echo $date ?></h1><hr/>
    <a href="?com=tour&task=list_schedule&tour=<?php echo $tour;?>" class="btn btn-default pull-left back">Quay lại</a>
</div>
<div id="action">
    <div class="box-tabs">    
        <ul class="nav nav-tabs" role="tablist">
            <li class="active">
                <a href="#where" role="tab" data-toggle="tab">
                    <icon class="fa fa-sms"></icon>Đi đâu
                </a>
            </li>
            <li>
                <a href="#food" role="tab" data-toggle="tab">
                    <i class="fa fa-contact"></i> Ăn gì
                </a>
            </li>
            <li>
                <a href="#sleep" role="tab" data-toggle="tab">
                    <i class="fa fa-contact"></i> Ngủ ở đâu
                </a>
            </li>
        </ul><br>

        <div class="tab-content">
            <div class="tab-pane fade active in" id="where">
                <div class="row">
                    <div class="col-md-6">
                        <form id="frm-tour-where" name="frm-tour-where" method="post" action="" enctype="multipart/form-data">
                            <input name="txt_tour_id" type="hidden" id="txt_tour_id" value="<?php echo $tour;?>"/>
                            <input name="txt_day_id" type="hidden" id="txt_day_id" value="<?php echo $date;?>" />
                            <div class='form-group'>
                                <label class="control-label">Tiêu đề </label><small><font color="red"> *</font></small>
                                <input name="txt_title_where" type="text" id="txt_title_where" class='form-control'/>
                                <font id="err-title_where" color="red"></font>
                            </div>

                            <div class='form-group'>
                                <label class="control-label">Địa điểm thăm quan</label><small><font color="red"> *</font></small>
                                <div class='form-group'>
                                    <select id="cbo_position" name="cbo_position" class="form-control">
                                        <option value="">-- Chọn một địa điểm --</option>
                                        <?php
                                        $sql="SELECT `id`,`name` FROM tbl_position WHERE positiongrouptype_id=62 AND location_id IN($arr_location) ORDER BY `name` ASC";
                                        $objdata->Query($sql);
                                        while ($row_pos=$objdata->Fetch_Assoc()) {
                                            echo '<option value="'.$row_pos["id"].'">'.$row_pos["name"].'</option>';
                                        }
                                        ?>
                                    </select>
                                    <font id="err-cbo_position" color="red"></font>
                                </div>
                            </div>

                            <div class='form-group'>
                                <label class="control-label">Thời gian </label>
                                <input name="txt_time_where" type="text" id="txt_time_where" class='form-control'/>
                                <font id="err-time_where" color="red"></font>
                            </div>

                            <div class="form-group">
                                <label>Nội dung mô tả</label><small><font color="red"> *</font></small>
                                <textarea name="txt_content_where" class="form-control" id="txt_content_where" rows="5"></textarea>
                                <font id="err-content_where" color="red"></font>
                            </div>
                            <span class="btn btn-success" onclick="addWhere()">Add new</span>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <div class="box-respon list-result">
                            <h4>Danh sách lịch trình <span class="color-1">Ngày <?php echo $date;?></span> </h4>
                            <div class="box-scroll">
                                <div id="respon-where">
                                    <?php
                                    $objTourProWh=new CLS_TOURPROGRAMWHERE();
                                    $str="WHERE `tour_id`=$tour AND `day_id`=$date.";
                                    $objTourProWh->getListItemForm($str, $limit='');
                                    ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="food">
                <div class="row">
                    <div class="col-md-6">
                        <form id="frm-tour-food" name="frm-tour-food" method="post" action="" enctype="multipart/form-data">
                            <input name="txt_tour_id" type="hidden" id="txt_tour_id" value="<?php echo $tour;?>"/>
                            <input name="txt_day_id" type="hidden" id="txt_day_id" value="<?php echo $date;?>" />

                            <div class='form-group'>
                                <label class="control-label">Tên </label><small><font color="red"> *</font></small>
                                <input name="txt_title_food" type="text" id="txt_title_food" class='form-control'/>
                                <font id="err-title_food" color="red"></font>
                            </div>
                            <div class='form-group'>
                                <label class="control-label">Thời gian </label><small><font color="red"> *</font></small>
                                <input name="txt_time_food" type="text" id="txt_time_food" class='form-control'/>
                                <font id="err-time_food" color="red"></font>
                            </div>
                            <div class='form-group'>
                                <label class="control-label">Tại nhà hàng </label><small><font color="red"> *</font></small>
                                <div class='form-group'>
                                    <select id="cbo_position_food" name="cbo_position" class="form-control" style="width: 100%;">
                                        <option value="">-- Chọn một nhà hàng --</option>
                                        <?php
                                        $sql="SELECT `id`,`name` FROM tbl_position WHERE positiongrouptype_id=63 AND location_id IN($arr_location) ORDER BY `name` ASC";
                                        $objdata->Query($sql);
                                        while ($row_pos=$objdata->Fetch_Assoc()) {
                                            echo '<option value="'.$row_pos["id"].'">'.$row_pos["name"].'</option>';
                                        }
                                        ?>
                                    </select>
                                    <font id="err-cbo_position_food" color="red"></font>
                                </div>
                            </div>
                            <label class="control-label">Thực đơn </label><small> (Chọn nhà hàng trước)</small>
                            <div id="respon-foodmenu" class="form-group">
                            </div>
                            <div class="form-group">
                                <label>Nội dung mô tả</label>
                                <textarea class="form-control" rows="5" name="txt_content_food" id="txt_content_food1"></textarea>
                                <font id="err-content_food" color="red"></font>
                            </div>
                            <span class="btn btn-success" onclick="addFood()">Addnew</span>
                        </form>
                    </div>

                    <div class="col-md-6 ">
                        <div class="box-respon list-result" id="respon-food">
                            <h4>Danh sách thực đơn ăn uống <span class="color-1">Ngày <?php echo $date;?></span> </h4>
                            <div class="box-scroll ">
                                <?php
                                $objTourProFo=new CLS_TOURPROGRAMFOOD();
                                $str="WHERE `tour_id`=$tour AND `day_id`=$date.";
                                $objTourProFo->getListItemForm($str, $limit='');
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="sleep">
                <div class="row">
                    <div class='col-md-6'>
                        <form id="frm-tour-sleep" name="frm-tour-sleep" method="post" action="" enctype="multipart/form-data">
                            <input name="txt_tour_id" type="hidden" id="txt_tour_id" value="<?php echo $tour;?>">
                            <input name="txt_day_id" type="hidden" id="txt_day_id" value="<?php echo $date;?>">
                            <div class='form-group'>
                                <label class="control-label">Tên </label><small><font color="red"> *</font></small>
                                <input name="txt_title_sleep" type="text" id="txt_title_sleep" class='form-control'/>
                                <font id="err-title_sleep" color="red"></font>
                            </div>
                            <div class='form-group'>
                                <label class="control-label">Khách sạn/ Nhà nghỉ</label><small><font color="red"> *</font></small>
                                <div class='form-group'>
                                    <select id="cbo_position_sleep" name="cbo_position" class="form-control" style="width: 100%;">
                                        <option value="">-- Chọn một khách sạn/ nhà nghỉ --</option>
                                        <?php
                                        $sql="SELECT `id`,`name` FROM tbl_position WHERE positiongrouptype_id=64 AND location_id IN($arr_location) ORDER BY `name` ASC";
                                        $objdata->Query($sql);
                                        while ($row_pos=$objdata->Fetch_Assoc()) {
                                            echo '<option value="'.$row_pos["id"].'">'.$row_pos["name"].'</option>';
                                        }
                                        ?>
                                    </select>
                                    <font id="err-cbo_position_sleep" color="red"></font>
                                </div>
                            </div>
                            <div class="form-group clearfix">
                                <label>Nội dung mô tả</label>
                                <textarea class="form-control" name="txt_content_sleep" id="txt_content_sleep" rows="5"></textarea>
                                <font id="err-content_sleep" color="red"></font>
                            </div>
                            <span class="btn btn-success" onclick="addSleep()">Addnew</span>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <div class="box-respon list-result" id="respon-sleep">
                            <h4>Danh sách nơi ngủ nghỉ <span class="color-1">Ngày <?php echo $date;?></span> </h4>
                            <?php
                            $objTourProSl=new CLS_TOURPROGRAMSLEEP();
                            $str="WHERE `tour_id`=$tour AND `day_id`=$date.";
                            $objTourProSl->getListItemForm($str, $limit='');
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Thêm mới</h4>
            </div>
            <div class="modal-body" id="data-frm">
            </div>
        </div>
    </div>
</div>

<script language="javascript">
    function checkinputwhere(){
        if($("#txt_title_where").val()==""){
            $("#err-title_where").text('Title is require!');
            return false;
        }else{
            $("#err-title_where").text('');
        }

        if($("#cbo_position").val()==""){
            $("#err-cbo_position").text('Position is require!');
            return false;
        }else{
            $("#err-cbo_position").text('');
        }

        if($("#txt_time_where").val()==""){
            $("#err-time_where").text('Time is require!');
            return false;
        }else{
            $("#err-time_where").text('');
        }

        if($("#txt_content_where").val()==""){
            $("#err-content_where").text('Content is require!');
            return false;
        }else{
            $("#err-content_where").text('');
        }

        return true;
    }

    function checkinputfood(){
        if($("#txt_title_food").val()==""){
            $("#err-title_food").text('Title is require!');
            return false;
        }else{
            $("#err-title_food").text('');
        }

        if($("#txt_time_food").val()==""){
            $("#err-time_food").text('Time is require!');
            return false;
        }else{
            $("#err-time_food").text('');
        }

        if($("#cbo_position_food").val()==""){
            $("#err-cbo_position_food").text('Position is require!');
            return false;
        }else{
            $("#err-cbo_position_food").text('');
        }

        return true;
    }

    function checkinputsleep(){
        if($("#txt_title_sleep").val()==""){
            $("#err-title_sleep").text('Title is require!');
            return false;
        }else{
            $("#err-title_sleep").text('');
        }

        if($("#cbo_position_sleep").val()==""){
            $("#err-cbo_position_sleep").text('Position is require!');
            return false;
        }else{
            $("#err-cbo_position_sleep").text('');
        }

        return true;
    }

    function checkinputPopupWhere(){
        if($("#frm-edit-where #txt_title_where_ajaxs").val()==""){
            alert('Title is require!');
            $("#txt_title_where_ajaxs").focus();
            return false;
        }
        if($("#frm-edit-where #cbo_position_where_ajaxs").val()==""){
            alert('Address is require!');
            $("#cbo_position_where_ajaxs").focus();
            return false;
        }
        if($("#frm-edit-where #txt_time_where_ajaxs").val()==""){
            alert('Time is require!');
            $("#txt_time_where_ajaxs").focus();
            return false;
        }
        return true;
    }

    function checkinputPopupFood(){
        if($("#frm-edit-food #txt_title_food_ajaxs").val()==""){
            alert('Title is require!');
            $("#txt_title_food_ajaxs").focus();
            return false;
        }
        if($("#frm-edit-food #cbo_position_food_ajaxs").val()==""){
            alert('Address is require!');
            $("#cbo_position_food_ajaxs").focus();
            return false;
        }
        if($("#frm-edit-food #txt_time_food_ajaxs").val()==""){
            alert('Time is require!');
            $("#txt_time_food_ajaxs").focus();
            return false;
        }
        return true;
    }

    function checkinputPopupSleep(){
        if($("#frm-edit-sleep #txt_title_sleep_ajaxs").val()==""){
            alert('Title is require!');
            $("#txt_title_sleep_ajaxs").focus();
            return false;
        }
        if($("#frm-edit-sleep #cbo_position_sleep_ajaxs").val()==""){
            alert('Address is require!');
            $("#cbo_position_sleep_ajaxs").focus();
            return false;
        }
        return true;
    }

    function confirm_mes(act){
        if(confirm('Bạn có muốn ' +act+ ' bản ghi này!')){
            return true;
        }
        return false;
    }

    function addWhere(){
        if(checkinputwhere()){
            var form = $('#frm-tour-where');
            var postData = form.serializeArray();
            var url='<?php echo ROOTHOST;?>ajaxs/action_add_tourprogram/tour_where/action.php';
            $.post(url, postData, function(response_data){
                 $('#respon-where').html(response_data);
            });
            return false;
        }
    }

    function addFood(){
        if(checkinputfood()){
            var form = $('#frm-tour-food');
            var postData = form.serializeArray();
            var url="<?php echo ROOTHOST;?>ajaxs/action_add_tourprogram/tour_food/action.php";
            $.post(url, postData, function(response_data){
                $('#respon-food').html(response_data);
            });
            return false;
        }
    }

    function addSleep(){
        if(checkinputsleep()){
            var form = $('#frm-tour-sleep');
            var postData = form.serializeArray();
            var url="<?php echo ROOTHOST;?>ajaxs/action_add_tourprogram/tour_sleep/action.php";
            $.post(url, postData, function(response_data){
                $('#respon-sleep').html(response_data);
            });
            return false;
        }
    }

    function submitUpdateWhere(){
        if(checkinputPopupWhere() == true){
            var form = $('#frm-edit-where');
            var postData = form.serializeArray();
            var url =form.attr('action');
            $.post(url, postData, function(response_data){
                $('#respon-where').html(response_data);
                $('#myModal').modal('hide');
            });

        }
    };

    function submitUpdateFood(){
        if(checkinputPopupFood() == true){
            var form = $('#frm-edit-food');
            var postData = form.serializeArray();
            var url =form.attr('action');
            $.post(url, postData, function(response_data){
                $('#respon-food').html(response_data);
                $('#myModal').modal('hide');
            });

        }
    };

    function submitUpdateSleep(){
        if(checkinputPopupSleep() == true){
            var form = $('#frm-edit-sleep');
            var postData = form.serializeArray();
            var url =form.attr('action');
            $.post(url, postData, function(response_data){
                $('#respon-sleep').html(response_data);
                $('#myModal').modal('hide');
            });

        }
    };

    $(document).ready(function() {
        $('#cbo_position').select2();
        $('.cbo_position').select2();
        $('#cbo_position_food').select2();
        $('#cbo_position_sleep').select2();
        
        $("input#file-thumb").change(function(e) {

            for (var i = 0; i < e.originalEvent.srcElement.files.length; i++) {
                var file = e.originalEvent.srcElement.files[i];
                var img = document.createElement("img");
                var reader = new FileReader();
                reader.onloadend = function() {
                    img.src = reader.result;
                }
                reader.readAsDataURL(file);
                $('#show-img').addClass('show-img');
                $('#show-img').html(img);
            }
        });


        $('#where .actEdit').click(function(){
            var val=$(this).attr('value');
            var tour_id=$(this).attr('tourId');
            var url='<?php echo ROOTHOST;?>ajaxs/action_add_tourprogram/tour_where/actionFormEdit.php';
            $.get(url,{val, tour_id},function(response_data){
                $('#myModalLabel').html('<label>Sửa lịch trình</label>');
                $('#myModal').modal('show');
                $('#data-frm').html(response_data);
            })
        });

        $('#food .actEdit').click(function(){
            var val=$(this).attr('value');
            var tour_id=$(this).attr('tourId');
            $.get('<?php echo ROOTHOST;?>ajaxs/action_add_tourprogram/tour_food/actionFormEdit.php',{val, tour_id},function(response_data){
                $('#myModal').modal('show');
                $('#myModalLabel').html('Sửa thực đơn');
                $('#data-frm').html(response_data);
            })
        });

        $('#sleep .actEdit').click(function(){
            var val=$(this).attr('value');
            var tour_id=$(this).attr('tourId');
            $.get('<?php echo ROOTHOST;?>ajaxs/action_add_tourprogram/tour_sleep/actionFormEdit.php',{val, tour_id},function(response_data){
                $('#myModal').modal('show');
                $('#myModalLabel').html('Sửa địa điểm ngủ nghỉ');
                $('#data-frm').html(response_data);
            })
        });

        $('#where .actAjax').click(function(){
            var data = {
                'val': $(this).attr('value'),
                'tour_id': $(this).attr('tourId'),
                'act': $(this).attr('act')
            }
            if(data['act']=='del'){
                if(confirm_mes('xóa')==false){
                    return;
                };
            }
            $.post('<?php echo ROOTHOST;?>ajaxs/action_add_tourprogram/tour_where/comAction.php',data,function(response_data){
            });
            $("#tr-"+ data['val']).remove();
        });

        $('#food .actAjax').click(function(){
            var data = {
                'val': $(this).attr('value'),
                'tour_id': $(this).attr('tourId'),
                'act': $(this).attr('act')
            }
            if(data['act']=='del'){
                if(confirm_mes('xóa')==false){
                    return;
                };
            }
            $.post('<?php echo ROOTHOST;?>ajaxs/action_add_tourprogram/tour_food/comAction.php',data,function(response_data){
            });
            $("#tr-"+ data['val']).remove();
        });

        $('#sleep .actAjax').click(function(){
            var data = {
                'val': $(this).attr('value'),
                'tour_id': $(this).attr('tourId'),
                'act': $(this).attr('act')
            }
            if(data['act']=='del'){
                if(confirm_mes('xóa')==false){
                    return;
                };
            }
            $.post('<?php echo ROOTHOST;?>ajaxs/action_add_tourprogram/tour_sleep/comAction.php',data,function(response_data){
            });
            $("#tr-"+ data['val']).remove();
        });

        $('#cbo_position_food').change(function(){
            var position = $(this).val();
            var url='<?php echo ROOTHOST;?>ajaxs/action_add_tourprogram/tour_food/change_position.php';
            $.post(url,{position}, function(req){
                $('#respon-foodmenu').html(req);
            })
        })
    });
</script>
