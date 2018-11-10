
<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
if(isset($_GET['positioncontact_id']) and (int)$_GET['positioncontact_id']){
    $positioncontact_id=$_GET['positioncontact_id'];
    $position_code=$_GET['code'];
}
else die('PAGE NOT FOUND');
$obj->getList('WHERE `tbl_position_contact`.`id`='.$positioncontact_id.'');
$row=$obj->Fetch_Assoc();
include_once(LIB_PATH.'cls.positiongrouptype.php');
include_once(LIB_PATH.'cls.positiontype.php');
include_once(LIB_PATH.'cls.countries.php');
include_once(LIB_PATH.'cls.location.php');
include_once(LIB_PATH.'cls.positioncontact.php');
?>
<div class="container">
    <div class="frm-control">
        <h3 class="h3-header">Cập nhật cơ sở</h3>
        <div class="box-step">

            <ul>
                <li class="active">
                    <span class="number num1">01</span>
                    <span class="name">Thông tin cơ sở</span>
                </li>
                <li>
                    <span class="number num2">02</span>
                    <span class="name">Địa chỉ Map</span>
                </li>
                <li>
                    <span class="number num3">03</span>
                    <span class="name">Thư viện ảnh</span>
                </li>
                <li>
                    <span class="number num4">04</span>
                    <span class="name">Thư viện video</span>
                </li>
                <li>
                    <span class="number num5">05</span>
                    <span class="name">Tin liên quan</span>
                </li>
            </ul>
        </div>
        <div id="action">
            <h3 class="title">Thông tin cơ sở</h3>
            <!-- Tab panes -->
            <form id="frm_action" name="frm_action" method="post" action=""  enctype="multipart/form-data">
                <input name="txtid" type="hidden" id="txtid" size="45" class='form-control' value="<?php echo $positioncontact_id;?>" placeholder='' />
                <input name="txt_position_code" type="hidden" id="txt_position_code" size="45" class='form-control' value="<?php echo $position_code;?>" placeholder='' />
                    <div id="list">
                        <div class="row">
                            <div class='form-group col-md-6'>
                                <label class="control-label"><strong>Tên cơ sở</strong></label>
                                <input name="txt_contact_name" type="text" id="txt_contact_name" size="45" class='form-control' value="<?php echo $row['contact_name'];?>" placeholder='' />
                            </div>
                        </div>
                        <div class="row">
                            <div class='form-group col-md-6'>
                                <label class="control-label"><strong>Thuộc quốc gia</strong></label>
                                <select name="cbo_countries" id="cbo_countries" class='form-control'>
                                    <option value="">--- Chọn quốc gia ---</option>
                                    <?php
                                    if(!isset($objcountry)) $objcountry=new CLS_COUNTRIES();
                                    echo $objcountry->getListCbCountries($row['country_id']);
                                    ?>
                                </select>
                            </div>
                            <div class='form-group col-md-6'>
                                <label class="control-label"><strong>Thuộc tỉnh thành</strong></label>
                                <select name="cbo_location" id="cbo_location" class='form-control'>
                                    <option value="">--- Chọn tỉnh/ thành phố ---</option>
                                    <?php
                                    if(!isset($objLo)) $objLo=new CLS_LOCATION();
                                    $strWhere='`tbl_location`.`country_id`='.$row["country_id"].' AND ';
                                    echo $objLo->getListCbLocation($row['location_id'], $strWhere);
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class='form-group col-md-6'>
                                <label class="control-label"><strong>Địa chỉ</strong></label>
                                <input name="txt_address" type="text" id="txt_address" size="45" class='form-control' value="<?php echo $row['address'];?>" placeholder='' />
                            </div>
                            <div class='form-group col-md-6'>
                                <label class="control-label"><strong>Email</strong></label>
                                <input name="txt_email" type="text" id="txt_email" size="45" class='form-control' value="<?php echo $row['email'];?>" placeholder='' />
                            </div>
                        </div>
                        <div class="row">
                            <div class='form-group col-md-6'>
                                <label class="control-label"><strong>Phone</strong></label>
                                <input name="txt_phone" type="text" id="txt_phone" size="45" class='form-control' value="<?php echo $row['phone'];?>" placeholder='' />
                            </div>

                            <div class='form-group col-md-6'>
                                <label class="control-label"><strong>Website</strong></label>
                                <input name="txt_website" type="text" id="txt_website" size="45" class='form-control' value="" placeholder='' />
                            </div>
                        </div>
                        <div class="row">
                            <div class='form-group col-md-6'>
                                <label class="control-label"><strong>Ảnh đại diện</strong></label>
                                <input name="fileImg" type="file" id="file-thumb" size="45" class='form-control' value="" placeholder='' />
								<input name="url_image" type="hidden" value="<?php echo $row['thumb'];?>"/>                               
							   <div id="show-img">
                                    <img class="img-display" src="<?php echo $row['avatar']==''? ROOTHOST.THUMB_DEFAULT:ROOTHOST.$row['avatar'];?>">
                                </div>
                            </div>
                        </div>
                    </div>
                <a class="save btn-default btn-primary"  href="#" onclick="dosubmitAction('frm_action','save');" title="Save">Continues</a>
                <!--<a href="<?php /*echo ROOTHOST;*/?>member/dia-diem/co-so/dia-chi-map.html" class="btn btn-primary">Lưu</a>-->
                <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;">
            </form>

    </div>
</div>

<script language="javascript">
    function checkinput(){
        if($("#txt_contact_name").val()==""){
            alert('Name is require!');
            $('.nav-tabs a[href="#profile"]').tab('show');
            $("#txt_contact_name").focus();
            return false;
        }
        if($("#cbo_countries").val()==""){
            alert('Countries is require!');
            $('.nav-tabs a[href="#profile"]').tab('show');
            $("#cbo_countries").focus();
            return false;
        }
        if($("#cbo_location").val()==""){
            alert('Location is require!');
            $('.nav-tabs a[href="#profile"]').tab('show');
            $("#cbo_location").focus();
            return false;
        }
        if($("#txt_address").val()==""){
            alert('Address is require!');
            $('.nav-tabs a[href="#profile"]').tab('show');
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

    /*func add new position contact*/
    $(document).ready(function() {
        $('#cbo_position_group_type').change(function(){
            var valOption=this.value;
            $.get('<?php echo ROOTHOST;?>ajaxs/getPositionType.php',{valOption},function(response_data){
                $('#cbo_position_type').html(response_data);
            })
        });
        $('#cbo_countries').change(function(){
            var valOption=this.value;
            $.get('<?php echo ROOTHOST;?>ajaxs/getLocation.php',{valOption},function(response_data){
                $('#cbo_location').html(response_data);
                //alert(response_data);
            })
        });

        $('.actActive').click(function(){
            var val=$(this).attr('value');
            $.get('ajaxs/actionList.php',{val},function(response_data){
                $('#actActive').html(response_data);
            })
        });

        $('.actEdit').click(function(){
            var val=$(this).attr('value');
            $.get('ajaxs/actionFormEdit.php',{val},function(response_data){
                $('#myModal').modal('show');
                $('#data-frm').html(response_data);
            })
        });

        /* load thumb when select File*/
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


    });

</script>