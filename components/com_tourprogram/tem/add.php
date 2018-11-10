<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
if(isset($_GET['code'])){
    $tour_code=addslashes($_GET['code']);
}
else die('PAGE NOT FOUND');


include_once(LIB_PATH.'cls.tour.php');
include_once(LIB_PATH.'cls.positioncontact.php');
include_once(LIB_PATH.'cls.position.php');
include_once(LIB_PATH.'cls.foodmenu.php');
$objTour=new CLS_TOUR();
$arr=$objTour->getIdAndNameByCode($tour_code);
$tour_id=$arr['id'];
$tour_name=$arr['name'];
$tour_num_day=$arr['num_day'];
$day_active=isset($_GET['num_day'])? $_GET['num_day'] : '1';
?>
<div class="container">
    <div class="frm-control">
        <div class="link-header">
            <h3><span class="color-1"><?php echo $tour_name;?></span>> Thêm lịch trình</h3>
        </div>
        <div class="box-step">
            <ul>
                <li>
                    <span class="number num1">01</span>
                    <span class="name">Thông tin Tour</span>
                </li>

                <li class="active">
                    <span class="number num2">02</span>
                    <span class="name">Các lịch trình Tour</span>
                </li>
                <li class="">
                    <span class="number num3">03</span>
                    <span class="name">Thư viện ảnh</span>
                </li>
            </ul>
        </div>

        <div class="mem-date">
            <ul class="list-inline text-center">
                <?php
                $i='1';
                for($i==1; $i<= $tour_num_day ; $i++):?>
                <li class="<?php echo $day_active==$i ? 'active':''?>">
                    <span>Ngày</span>
                    <span class="number"><?php echo $i;?></span>
                </li>
                <?php endfor;?>

               <!-- <li class="add">
                    <span>+</span>
                </li>-->
            </ul>
        </div>
        <div class="box-form">

            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="active">
                    <a href="#where" role="tab" data-toggle="tab">
                        <icon class="fa fa-sms"></icon>Đi đâu
                    </a>
                </li>
                <li><a href="#food" role="tab" data-toggle="tab">
                        <i class="fa fa-contact"></i>Ăn gì
                    </a>
                </li>
                <li><a href="#sleep" role="tab" data-toggle="tab">
                        <i class="fa fa-contact"></i>Ngủ ở đâu
                    </a>
                </li>

            </ul>
            <?php
            $day_next=$day_active +1;
            if($day_active < $tour_num_day) $url=ROOTHOST."member/tour/".$tour_code."/them-lich-trinh/ngay-".$day_next."";
            else $url=ROOTHOST."member/tour/".$tour_code."/them-thu-vien-anh";
            ?>
            <div class="box-btn-act">
                <a class="save-continues btn-default btn-primary"  href="<?php echo $url;?>">Lưu và tiếp tục</a>
            </div>

            <div class="tab-content">
                <div class="tab-pane fade active in" id="where">
                    <div class="row">
                        <div class="col-md-6">
                            <form id="frm-tour-where" name="frm-tour-where" method="post" action="<?php echo ROOTHOST;?>ajaxs/action_add_tourprogram/tour_where/action.php"  enctype="multipart/form-data">
                                <input name="txt_tour_id" type="hidden" id="txt_tour_id" value="<?php echo $tour_id;?>"/>
                                <input name="txt_day_id" type="hidden" id="txt_day_id" value="<?php echo $day_active;?>" />
                                <div class='form-group'>
                                    <label class="control-label"><strong>Tiêu đề </strong></label>
                                    <input name="txt_title_where" type="text" id="txt_title_where" size="45" class='form-control' value="" placeholder='' />
                                </div>

                                <div class='form-group'>
                                    <label class="control-label"><strong>Địa điểm thăm quan</strong></label>
                                    <div class='form-group'>
                                        <select id="cbo_position" name="cbo_position" class="selectpicker" data-live-search="true" title="Chọn một địa điểm">
                                            <?php
                                            $strWhere="AND `tbl_position`.`positiongrouptype_id`='62'";
                                            if(!isset($objPo)) $objPo=new CLS_POSITIONCONTACT();
                                            echo $objPo->getListCbPositionContact($strWhere);
                                            ?>
                                        </select>
                                    </div>

                                </div>

                                <div class='form-group'>
                                    <label class="control-label"><strong>Thời gian </strong></label>
                                    <input name="txt_time_where" type="text" id="txt_time_where" size="45" class='form-control' value="" placeholder='' />
                                </div>

                                <div class="form-group">
                                    <label><strong>Nội dung mô tả</strong></label>
                                    <textarea name="txt_content_where" id="txt_content_where" size="45"></textarea>
                                </div>
                                <span class="btn btn-success" onclick="addWhere()">Addnew</span>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <div class="box-respon list-result">
                                <h4>Danh sách lịch trình <span class="color-1">Ngày <?php echo $day_active;?></span> </h4>
                                <div class="box-scroll">
                                    <div id="respon-where">
                                        <?php
                                        include_once(LIB_PATH."cls.tourprogramwhere.php");
                                        $objTourProWh=new CLS_TOURPROGRAMWHERE();
                                        $str="WHERE `tour_id`=$tour_id AND `day_id`=$day_active.";
                                        $objTourProWh->getListItemForm($str, $limit='');
                                        ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="food">
                    <div class="row">
                        <div class="col-md-6">
                            <form id="frm-tour-food" name="frm-tour-food" method="post" action="<?php echo ROOTHOST;?>ajaxs/action_add_tourprogram/tour_food/action.php" enctype="multipart/form-data">
                                <input name="txt_tour_id" type="hidden" id="txt_tour_id" value="<?php echo $tour_id;?>"/>
                                <input name="txt_day_id" type="hidden" id="txt_day_id" value="<?php echo $day_active;?>" />

                                <div class='form-group'>
                                    <label class="control-label"><strong>Title </strong></label>
                                    <input name="txt_title_food" type="text" id="txt_title_food" size="45" class='form-control' value="" placeholder='' />
                                </div>
                                <div class='form-group'>
                                    <label class="control-label"><strong>Thời gian </strong></label>
                                    <input name="txt_time_food" type="text" id="txt_time_food" size="45" class='form-control' value="" placeholder='' />
                                </div>
                                <div class="row">
                                    <div class='form-group col-md-6'>
                                        <label class="control-label"><strong>Tại nhà hàng </strong></label>
                                        <div class='form-group'>
                                            <select id="cbo_position" name="cbo_position" class="selectpicker" data-live-search="true" title="Chọn một khách sạn/ nhà hàng ...">
                                                <?php
                                                $strWhere="AND `tbl_position`.`positiongrouptype_id`='63'";
                                                if(!isset($objPo)) $objPo=new CLS_POSITIONCONTACT();
                                                echo $objPo->getListCbPositionContact($strWhere);
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class='form-group col-md-6'>
                                        <label class="control-label"><strong></strong></label>
                                        <div class="box-btn">
                                            <label class="control-label" style="margin-right: 12px"><strong>Thực đơn: </strong></label><span class="btn btn-primary" id="call-food">Chọn</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="" id="respon-foodmenu">
                                    <input type="hidden" name="selectedFoodId" id="selectedFoodId" value="<?php echo isset($_SESSION['arr_food_id'])? $_SESSION['arr_food_id']:'';?>">

                                </div>

                                <div class="form-group">
                                    <label><strong>Nội dung mô tả</strong></label>
                                    <textarea name="txt_content_food" id="txt_content_food" size="45"></textarea>
                                </div>
                                <span class="btn btn-success" onclick="addFood()">Addnew</span>
                            </form>
                        </div>

                        <div class="col-md-6 ">
                            <div class="box-respon list-result" id="respon-food">

                                <h4>Danh sách thực đơn ăn uống <span class="color-1">Ngày <?php echo $day_active;?></span> </h4>
                                <div class="box-scroll ">
                                    <?php
                                    include_once(LIB_PATH."cls.tourprogramfood.php");
                                    $objTourProFo=new CLS_TOURPROGRAMFOOD();
                                    $str="WHERE `tour_id`=$tour_id AND `day_id`=$day_active.";
                                    $objTourProFo->getListItemForm($str, $limit='');
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="sleep">
                    <div class="row">
                        <div class='col-md-6'>
                            <form id="frm-tour-sleep" name="frm-tour-sleep" method="post" action="<?php echo ROOTHOST;?>ajaxs/action_add_tourprogram/tour_sleep/action.php" enctype="multipart/form-data">
                                <input name="txt_tour_id" type="hidden" id="txt_tour_id" value="<?php echo $tour_id;?>"/>
                                <input name="txt_day_id" type="hidden" id="txt_day_id" value="<?php echo $day_active;?>" />
                                <div class='form-group'>
                                    <label class="control-label"><strong>Title </strong></label>
                                    <input name="txt_title_sleep" type="text" id="txt_title_sleep" size="45" class='form-control' value="" placeholder='' />
                                </div>
                                <div class='form-group'>
                                    <label class="control-label"><strong>Khách sạn/ Nhà nghỉ</strong></label>
                                    <div class='form-group'>
                                        <select id="cbo_position" name="cbo_position" class="selectpicker" data-live-search="true" title="Chọn một khách sạn/ nhà hàng ...">
                                            <?php

                                            if(!isset($objPo)) $objPo=new CLS_POSITIONCONTACT();
                                            $strWhere="AND `tbl_position`.`positiongrouptype_id`='64'";
                                            echo $objPo->getListCbPositionContact($strWhere);
                                            ?>
                                        </select>
                                    </div>

                                </div>

                                <div class="form-group clearfix">
                                    <label><strong>Nội dung mô tả</strong></label>
                                    <textarea name="txt_content_sleep" id="txt_content_sleep" size="45"></textarea>
                                </div>
                                <span class="btn btn-success" onclick="addSleep()">Addnew</span>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <div class="box-respon list-result" id="respon-sleep">
                                <h4>Danh sách nơi ngủ nghỉ <span class="color-1">Ngày  <?php echo $day_active;?></span> </h4>
                                <?php
                                include_once(LIB_PATH."cls.tourprogramsleep.php");
                                $objTourProSl=new CLS_TOURPROGRAMSLEEP();
                                $str="WHERE `tour_id`=$tour_id AND `day_id`=$day_active.";
                                $objTourProSl->getListItemForm($str, $limit='');
                                ?>

                            </div>

                        </div>

                    </div>


                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Thêm mới</h4>
                        </div>
                        <div class="modal-body" id="data-frm">
                            <!-- show -->
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
</div>

<link rel="stylesheet" type="text/css" href="<?php echo ROOTHOST;?>templates/web/css/bootstrap-select.css">
<script src="<?php echo ROOTHOST;?>templates/web/scripts/bootstrap-select.min.js"></script>
<script language="javascript">

function submitUpdate(obj){
    if(checkinputPopup() == true){
        var form = $('#frm-edit-'+obj);
        var postData = form.serializeArray();
        var url =form.attr('action');
        $.post(url, postData, function(response_data){
            $('#respon-'+obj).html(response_data);
            $('#myModal').modal('hide');
        });

    }
};

/*action add food from popup*/

function submitAddFood(){
    if(checkinputPopup() == true){
    var form = $('#frm-edit');
    var url ='<?php echo ROOTHOST;?>ajaxs/action_add_tourprogram/tour_food/addFood.php';
    var all_check = document.querySelectorAll('input[name="chk[]"]:checked');
    var aIds = [];
    var aNames= [];
    for(var x = 0, l = all_check.length; x < l;  x++)
    {
        aIds.push(all_check[x].value);
        aNames.push(all_check[x].label);
    }
    var str = aIds.join(', ');
    var strName=aNames.join(', ');
    console.log(strName);
    $.post(url, {str}, function(response_data){
        $('#respon-foodmenu').html(response_data);
        //alert(response_data);
        $('#myModal').modal('hide');
    });
    // $('#myModal').modal('hide');
    }
};


function checkinputwhere(){
    if($("#txt_title_where").val()==""){
        alert('Title is require!');
        $("#txt_title_where").focus();
        return false;
    }
    if($("#txt_address_where").val()==""){
        alert('Address is require!');
        $("#txt_address_where").focus();
        return false;
    }
    if($("#txt_time_where").val()==""){
        alert('Time is require!');
        $("#txt_time_where").focus();
        return false;
    }
    if($("#cbo_position").val()==""){
        alert('Position is require!');
        $("#cbo_position").focus();
        return false;
    }
    if($("#txt_content_where").val()==""){
        alert('Content is require!');
        $("#txt_content_where").focus();
        return false;
    }

    return true;
}

function checkinputsleep(){
    if($("#txt_title_sleep").val()==""){
        alert('Title is require!');
        $("#txt_title_sleep").focus();
        return false;
    }
    if($("#cbo_position").val()==""){
        alert('Position is require!');
        $("#cbo_position").focus();
        return false;
    }
    if($("#txt_content_sleep").val()==""){
        alert('Content is require!');
        $("#txt_content_sleep").focus();
        return false;
    }
    return true;
}

function checkinputfood(){
    if($("#txt_title_food").val()==""){
        alert('Title is require!');
        $("#txt_title_food").focus();
        return false;
    }
    if($("#txt_content_food").val()==""){
        alert('Content is require!');
        $("#txt_content_food").focus();
        return false;
    }
    if($("#cbo_position").val()==""){
        alert('Position is require!');
        $("#cbo_position").focus();
        return false;
    }
    if($("#txt_time_food").val()==""){
        alert('Food is require!');
        $("#txt_time_food").focus();
        return false;
    }
    return true;
}

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
    /*   if($("#txt_content").val()==""){
     alert('Content is require!');
     $("#txt_content").focus();
     return false;
     }*/
    return true;
}

function confirm_mes(act){
    if(confirm('Bạn có muốn ' +act+ ' bản ghi này!')){
        return true;
    }
    return false;
}


/*
function addObj(obj){
     var func_check[]='checkinput'+obj;
   //alert(func_check);
     if(func_check()){
        var form = $('#frm-tour-'+obj);
        var postData = form.serializeArray();
        var url=form.attr('action');
        $.post(url, postData, function(response_data){
            $('#respon-'+obj).html(response_data);
        });
        return false;
    }
}
*/

function addWhere(){
    if(checkinputwhere()){
        var form = $('#frm-tour-where');
        var postData = form.serializeArray();
        var url=form.attr('action');
        $.post(url, postData, function(response_data){
            $('#respon-where').html(response_data);
        });

        return false;

    }

}

function addSleep(){
    if(checkinputsleep()){
        var form = $('#frm-tour-sleep');
        var postData = form.serializeArray();
        var url=form.attr('action');
        $.post(url, postData, function(response_data){
            $('#respon-sleep').html(response_data);
        });
        return false;
    }
}
function addFood(){
    if(checkinputfood()){
        var form = $('#frm-tour-food');
        var postData = form.serializeArray();
        var url=form.attr('action');
        $.post(url, postData, function(response_data){
            $('#respon-food').html(response_data);
        });
        return false;
    }
}


$(document).ready(function() {
    /*call food */
    $('#call-food').click(function(){
        if($("#cbo_position").val()==""){
            alert('Position is require before add Food menu!');
            $("#cbo_position").focus();
            return false;
        }
        var arr_selected=$("#selectedFoodId").val();

        var val=$("#cbo_position").val();
        //alert(val);
        var text=$("#cbo_position option:selected").html();
        $.get('<?php echo ROOTHOST;?>ajaxs/action_add_tourprogram/tour_food/actionFormAddFood.php',{val, text, arr_selected},function(response_data){
            $('#myModal').modal('show');
            $('#myModalLabel').html('Add Foodmenu');
            $('#data-frm').html(response_data);
        })
    });


    $('#where .actEdit').click(function(){
        var val=$(this).attr('value');
        var tour_id=$(this).attr('tourId');
        $.get('<?php echo ROOTHOST;?>ajaxs/action_add_tourprogram/tour_where/actionFormEdit.php',{val, tour_id},function(response_data){
            $('#myModalLabel').html('Edit record');
            $('#myModal').modal('show');
            $('#data-frm').html(response_data);
        })
    });

    $('#food .actEdit').click(function(){
        var val=$(this).attr('value');
        var tour_id=$(this).attr('tourId');
        $.get('<?php echo ROOTHOST;?>ajaxs/action_add_tourprogram/tour_food/actionFormEdit.php',{val, tour_id},function(response_data){
            $('#myModal').modal('show');
            $('#myModalLabel').html('Edit record');
            $('#data-frm').html(response_data);
        })
    });

    $('#sleep .actEdit').click(function(){
        var val=$(this).attr('value');
        var tour_id=$(this).attr('tourId');
        $.get('<?php echo ROOTHOST;?>ajaxs/action_add_tourprogram/tour_sleep/actionFormEdit.php',{val, tour_id},function(response_data){
            $('#myModal').modal('show');
            $('#myModalLabel').html('Edit record');
            $('#data-frm').html(response_data);
        })
    });


    $('#where .actAjax').click(function(){
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
            //$("#tr-"+ data['val']).html(response_data);

        });
        $("#tr-"+ data['val']).remove();
    });

    $('#food .actAjax').click(function(){
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
        $.post('<?php echo ROOTHOST;?>ajaxs/action_add_tourprogram/tour_food/comAction.php',data,function(response_data){
            //$("#tr-"+ data['val']).html(response_data);

        });
        $("#tr-"+ data['val']).remove();
    });


    $('#sleep .actAjax').click(function(){
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
        $.post('<?php echo ROOTHOST;?>ajaxs/action_add_tourprogram/tour_sleep/comAction.php',data,function(response_data){
            //$("#tr-"+ data['val']).html(response_data);

        });
        $("#tr-"+ data['val']).remove();
    });
});

</script>