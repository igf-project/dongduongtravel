<link rel="stylesheet" href="<?php echo ROOTHOST.THIS_TEM_ADMIN_PATH;?>css/searchableOptionList.css">
<script src="<?php echo ROOTHOST.THIS_TEM_ADMIN_PATH;?>js/searchableOptionList.js"></script>
<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
?>
<div id="action">
    <script language="javascript">
        function checkinput(){
            var el=$(".sol-selected-display-item");
            if(el.length==0){
                $("#txt_arr_err").fadeTo(200,0.1,function(){
                    $(this).html('Vui lòng add thực đơn').fadeTo(900,1);
                });
            }
            if($("#txt_name").val()==""){
                $("#txt_name_err").fadeTo(200,0.1,function(){
                    $(this).html('Vui lòng nhập tiêu đề menu').fadeTo(900,1);
                });
                $("#txt_name").focus();
                return false;
            }
            if($("#file-thumb").val()==""){
                $("#txt_thumb_err").fadeTo(200,0.1,function(){
                    $(this).html('Vui lòng Chọn ảnh').fadeTo(900,1);
                });
                $("#file-thumb").focus();
                return false;
            }

            return true;
        }
    </script>
<div class="box-tabs">
    <form id="frm_action" name="frm_action" method="post" action=""  enctype="multipart/form-data">
        <div class="tab-content">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="" class="col-sm-3 form-control-label">Tiêu đề menu*</label>
                            <div class="col-sm-9">
                                <input type="text" name="txt_name" class="form-control" id="txt_name" placeholder="">
                                <div id="txt_name_err" class="mes-error"></div>
                            </div>
                            <div class="clearfix"></div>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class='form-group row'>
                            <label class="col-sm-3 form-control-label">Hình ảnh*</label>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-sm-9">
                                        <input name="txtthumb" type="text" id="file-thumb" size="45" class='form-control' value="" placeholder='Chọn đường dẫn ảnh' />
                                    </div>
                                    <div class="col-sm-3">
                                        <a class="btn btn-success pull-right" href="#" onclick="OpenPopup('extensions/upload_image.php');"><b style="margin-top: 15px">Chọn</b></a>
                                    </div>
                                    <div class="col-sm-9">
                                        <div id="txt_thumb_err" class="mes-error"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="box-select" style="margin-bottom: 12px; margin-left: 10px">
                                <label for="" class="form-control-label">Add thực đơn</label>
                                <div class="clearfix"></div>
                                <select id="cbo_location" class="cbo_location" name="arrFood[]" multiple="multiple">
                                    <?php
                                    include_once(LIB_PATH.'cls.food.php');
                                    if(!isset($objfood)) $objfood=new CLS_FOOD();
                                    echo $objfood->getListCbItem();
                                    ?>

                                </select>
                                <script>
                                    $('#cbo_location').searchableOptionList();
                                </script>
                                <div class="mes-error" id="txt_arr_err"></div>
                            </div>

                        </div>
                    </div>

                    <div class="clearfix"></div>
                </div>

            </div>
        <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;" />
    </form>
</div>
