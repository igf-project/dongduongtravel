
<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
?>
<div id="action">
    <script language="javascript">
        function checkinput(){
            if($("#txt_name").val()==""){
                $("#txt_name_err").fadeTo(200,0.1,function(){
                    $(this).html('Vui lòng nhập tên bài viết').fadeTo(900,1);
                });
                $("#txt_name").focus();
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
                        <div class="form-group">
                            <label for="" class="col-sm-3 form-control-label">Tiêu đề*</label>
                            <div class="col-sm-9">
                                <input type="text" name="txt_name" class="form-control" id="txt_name" placeholder="">
                                <div id="txt_name_err" class="mes-error"></div>
                            </div>
                            <div class="clearfix"></div>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class='form-group'>
                            <label class="col-sm-3 control-label"><strong>Hình ảnh*</strong></label>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-sm-9">
                                        <input name="txtthumb" type="text" id="file-thumb" size="45" class='form-control' value="" placeholder='' />
                                    </div>
                                    <div class="col-sm-3">
                                        <a class="btn btn-success" href="#" onclick="OpenPopup('extensions/upload_image.php');"><b style="margin-top: 15px">Chọn</b></a>
                                    </div>
                                    <div id="txt_thumb_err" class="mes-error"></div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                    </div>


                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="col-sm-3 form-control-label">Phone*</label>
                            <div class="col-sm-9">
                                <input type="text" name="txt_phone" class="form-control" id="txt_phone" placeholder="">
                                <div id="txt_name_err" class="mes-error"></div>
                            </div>
                            <div class="clearfix"></div>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="col-sm-3 form-control-label">Tel*</label>
                            <div class="col-sm-9">
                                <input type="text" name="txt_tel" class="form-control" id="txt_tel" placeholder="">
                                <div id="txt_name_err" class="mes-error"></div>
                            </div>
                            <div class="clearfix"></div>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="col-sm-3 form-control-label">Địa chỉ*</label>
                            <div class="col-sm-9">
                                <input type="text" name="txt_address" class="form-control" id="txt_address" placeholder="">
                                <div id="txt_name_err" class="mes-error"></div>
                            </div>
                            <div class="clearfix"></div>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="col-sm-3 form-control-label">Địa chỉ Map*</label>
                            <div class="col-sm-9">
                                <input type="text" name="txt_map" class="form-control" id="txt_map" placeholder="Dán iframe map ở đây">
                                <div id="txt_map_err" class="mes-error"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label for="" class="form-control-label"> Tóm tắt</label>
                    <textarea name="txt_intro" id="txt_intro" style="min-height: 80px" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="" class="form-control-label"> Nội dung</label>
                    <textarea name="txt_fulltext" id="txt_fulltext" cols="85" rows="20"></textarea>
                    <script language="javascript">
                        var oEdit3=new InnovaEditor("oEdit3");
                        oEdit3.width="100%";
                        oEdit3.height="200";
                        oEdit3.cmdAssetManager ="modalDialogShow('<?php echo ROOTHOST;?>extensions/editor/innovar/assetmanager/assetmanager.php',640,865)";
                        oEdit3.REPLACE("txt_fulltext");
                        document.getElementById("idContentoEdit3").style.height="420px";
                    </script>
                </div>
            </div>
        <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;" />
    </form>
</div>
