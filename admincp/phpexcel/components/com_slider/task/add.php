
<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
$flag=false;
if(!isset($UserLogin)) $UserLogin=new CLS_USERS;
if($UserLogin->isAdmin()==true)
    $flag=true;
if($flag==false){
    echo ('<div id="action" style="background-color:#fff"><h4>Bạn không có quyền truy cập. <a href="index.php">Vui lòng quay lại trang chính</a></h4></div>');
    return false;
}
?>
<div id="action">
    <script language="javascript">
        function checkinput(){
            if($("#txtthumb").val()==""){
                $("#txt_thumb_err").fadeTo(200,0.1,function(){
                    $(this).html('Vui lòng chọn hình ảnh').fadeTo(900,1);
                });
                $("#txtthumb").focus();
                return false;
            }
            return true;
        }
    </script>
<div class="box-tabs">
    <form id="frm_action" name="frm_action" method="post" action=""  enctype="multipart/form-data">
        <div class="tab-content">
            <div class="tab-pane fade active in" id="info">
                <div class="row">
                <div class="col-md-6">
                    <div class='form-group'>
                        <label class="col-sm-3 control-label"><strong>Hình ảnh*</strong></label>
                        <div class="col-sm-9">
                            <div class="row">
                                <div class="col-sm-9">
                                    <input name="txtthumb" type="text" id="file-thumb" size="45" class='form-control' value="" placeholder='' />
                                    <div id="txt_thumb_err" class="mes-error"></div>
                                </div>
                                <div class="col-sm-3">
                                    <a class="btn btn-success" href="#" onclick="OpenPopup('extensions/upload_image.php');"><b style="margin-top: 15px">Chọn</b></a>
                                </div>

                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-3 form-control-label">Slogan</label>
                        <div class="col-sm-9">
                            <input type="text" name="txt_slogan" class="form-control" id="txt_slogan" placeholder="">
                            <div id="txt_slogan_err" class="mes-error"></div>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-3 form-control-label">Mô tả</label>
                        <div class="col-sm-9">
                            <input type="text" name="txt_intro" class="form-control" id="txt_intro" placeholder="">
                            <div id="txt_name_err" class="mes-error"></div>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>
        <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;" />
    </form>
</div>
