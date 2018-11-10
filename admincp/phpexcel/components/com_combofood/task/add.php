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
                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>
        <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;" />
    </form>
</div>
