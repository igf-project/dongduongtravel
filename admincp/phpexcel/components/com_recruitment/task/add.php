
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
    <ul class="nav nav-tabs" role="tablist">
        <li class="active">
            <a href="#info" role="tab" data-toggle="tab">
                Thông tin
            </a>
        </li>
        <li>
            <a href="#seo" role="tab" data-toggle="tab">
                Seo
            </a>
        </li>
    </ul>
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
                        <div class="form-group">
                            <label for="" class="col-sm-3 form-control-label">Nhóm tin*</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="" name="cbo_cata">
                                    <?php
                                    include_once(LIB_PATH.'cls.category.php');
                                    $objCb=new CLS_CATEGORY();
                                    $objCb->getListCbItem('','WHERE type=2');
                                    ?>
                                </select>
                                <div id="txt_cata_err" class="mes-error"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="col-sm-3 form-control-label">Tuyển dụng cho cơ sở*</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="" name="cbo_showroom">
                                    <option value="0">Tuyển dụng chung</option>
                                    <?php
                                    include_once(LIB_PATH.'cls.showroom.php');
                                    $objCbshow=new CLS_SHOWROOM();
                                    $objCbshow->getListCbItem();
                                    ?>
                                </select>
                                <div id="txt_cata_err" class="mes-error"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="col-sm-3 form-control-label">Nổi bật</label>
                            <div class="col-sm-9">
                                <div class="col-sm-6">
                                <input type="radio" value="1" name="opt_ishot" >Có
                                </div>
                                <div class="col-sm-6">
                                    <input type="radio" value="0" name="opt_ishot" checked>Không
                                </div>
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
            <div class="tab-pane fade" id="seo">
                <div class='form-group'>
                    <label class="col-sm-3 control-label"><strong>Mô tả tiêu đề</strong></label>
                    <div class="col-sm-9">
                        <input name="txt_metatitle" type="text" id="txt_metatitle" class='form-control' value="" placeholder='' />
                    </div>
                     <div class="clearfix"></div>
                </div>
                <div class='form-group'>
                    <label class="col-sm-3 control-label"><strong>Từ khóa</strong></label>
                    <div class="col-sm-9">
                        <textarea class="form-control" name="txt_metakey" id="txt_metakey" size="45"></textarea>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div class='form-group'>
                    <label class="col-sm-3 control-label"><strong>Description</strong></label>
                    <div class="col-sm-9">
                        <textarea class="form-control" name="txt_metadesc" id="txt_metadesc" size="45"></textarea>
                    </div>
                    <div class="clearfix"></div>
                </div>

             </div>
        <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;" />
    </form>
</div>
