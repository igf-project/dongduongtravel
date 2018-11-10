<link rel="stylesheet" href="<?php echo ROOTHOST.THIS_TEM_ADMIN_PATH;?>css/searchableOptionList.css">
<script src="<?php echo ROOTHOST.THIS_TEM_ADMIN_PATH;?>js/searchableOptionList.js"></script>
<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
?>
<div id="action">
    <script language="javascript">
        function checkinput(){
            if($("#txt_name").val()==""){
                $("#txt_name_err").fadeTo(200,0.1,function(){
                    $(this).html('Vui lòng nhập tiêu đề').fadeTo(900,1);
                });
                $("#txt_name").focus();
                return false;
            }
            return true;
        }
    </script>
    <div class="box-tabs">
        <ul class="nav nav-tabs step-form" role="tablist">
            <li class="active">
                <a href="#home" role="tab" data-toggle="tab">
                    <div class="item">
                        <span class="ic-step">01</span>
                        <p>Album</p>
                        <label>Thông tin album</label>
                    </div>
                </a>
            </li>

            <li class=""><a href="#about" role="tab" data-toggle="tab">
                    <div class="item">
                        <span class="ic-step">02</span>
                        <p>Thư viện ảnh</p>
                        <label>Upload ảnh</label>
                    </div>
                </a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade active in" id="home">
                <div class="row">
                    <div class="col-md-6">
                        <form id="frm_action" name="frm_action" method="post" action=""  enctype="multipart/form-data">
                            <div class="form-group row">
                                <label for="" class="col-sm-3 form-control-label">Tên Album*</label>
                                <div class="col-sm-9">
                                    <input type="text" name="txt_name" class="form-control" id="txt_name" placeholder="">
                                    <div id="txt_name_err" class="mes-error"></div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 form-control-label">Nhóm ảnh</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="" name="cbo_group">
                                        <?php
                                        include_once(LIB_PATH.'cls.albumgroup.php');
                                        $objCb=new CLS_ALBUMGROUP();
                                        $objCb->getListCbItem();
                                        ?>
                                    </select>
                                    <div id="txt_cata_err" class="mes-error"></div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="form-group">
                                <label for="" class="form-control-label"> Tóm tắt</label>
                                <textarea name="txt_intro" id="txt_intro" style="min-height: 80px" class="form-control" placeholder="Mô tả về album"></textarea>
                            </div>
                            <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;" />
                        </form>
                    </div>
                </div>

             </div>
            <div class="tab-pane fade" id="about">
                <p>Nhập thông tin Album trước khi Upload thư viện ảnh</p>
            </div>
        </div>
    </div>
</div>
