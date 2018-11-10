<?php
defined('ISHOME') or die('Can not acess this page, please come back!');
$id='';
if(isset($_GET['id']))
    $id=(int)$_GET['id'];
$obj->getList(" AND `id`='$id' ",'');
$row=$obj->Fetch_Assoc();
?>
<div id="action">
    <script language="javascript">
        function checkinput(){
            if($('#txttitle').val()=="") {
                $("#txttitle_err").fadeTo(200,0.1,function(){ 
                    $(this).html('Mời bạn nhập tiêu đề Module').fadeTo(900,1);
                });
                $('#txttitle').focus();
                return false;
            }
            if( $('#cbo_type').val()=="mainmenu") {
                if($('#cbo_menutype').val()=="") {
                    $("#menutype_err").fadeTo(200,0.1,function(){ 
                        $(this).html('Mời chọn kiểu Menu cần hiển thị').fadeTo(900,1);
                    });
                    $('#cbo_menutype').focus();
                    return false;
                }
            }
            else if( $('#cbo_type').val()=="news") {
                if($('#cbo_cate').val()=="0") {
                    $("#category_err").fadeTo(200,0.1,function(){ 
                        $(this).html('Mời chọn nhóm tin').fadeTo(900,1);
                    });
                    $('#cbo_cate').focus();
                    return false;
                }
            }
            else if( $('#cbo_type').val()=="product") {
                if($('#cbo_cata').val()=="0") {
                    $("#catalogs_err").fadeTo(200,0.1,function(){ 
                        $(this).html('Mời chọn nhóm SP').fadeTo(900,1);
                    });
                    $('#cbo_cata').focus();
                    return false;
                }
            }
            return true;
        }
        function select_type(){
            var txt_viewtype=document.getElementById("txt_type");
            var cbo_viewtype=document.getElementById("cbo_type");
            for(i=0;i<cbo_viewtype.length;i++){
                if(cbo_viewtype[i].selected==true)
                    txt_viewtype.value=cbo_viewtype[i].value;
            }
            document.frm_type.submit();
        }

        $(document).ready(function() {
            $('#txttitle').blur(function(){
                if($(this).val()=="") {
                    $("#txttitle_err").fadeTo(200,0.1,function(){ 
                        $(this).html('Mời bạn nhập tiêu đề Module').fadeTo(900,1);
                    });
                    $('#txttitle').focus();
                }
            })
        });
    </script>
    <?php
    $viewtype=$row['type'];
    if(isset($_POST["txt_type"]))
        $viewtype=addslashes($_POST["txt_type"]);
    ?>
    <form id="frm_type" name="frm_type" method="post" action="" style="display:none;">
        <label>
            <input type="text" name="txt_type" id="txt_type" />
        </label>
    </form>
    <form id="frm_action" name="frm_action" method="post" action="">
        Những mục đánh dấu <font color="red">*</font> là yêu cầu bắt buộc.
        <fieldset>
            <legend><strong>Chi tiết:</strong></legend>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-3 form-control-label">Kiểu hiển thị*</label>
                        <div class="col-sm-9">
                            <select name="cbo_type" class="form-control" id="cbo_type" onchange="select_type();">
                                <?php 
                                $obj->LoadModType();?>
                                <script language="javascript">
                                    cbo_Selected('cbo_type','<?php echo $viewtype;?>');
                                    $(document).ready(function() {
                                        $("#cbo_type").select2();
                                    });
                                </script>
                            </select>
                            <input type="hidden" name="txtid" id="txtid" value="<?php echo $row['id'];?>" />
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-3 form-control-label">Tiêu đề*</label>
                        <div class="col-sm-9">
                            <input name="txttitle" type="text" id="txttitle" class="form-control" value="<?php echo stripslashes($row['title']);?>">
                            <span id="txttitle_err" class="check_error"></span>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-3 form-control-label">Hiển thị tiêu đề</label>
                        <div class="col-sm-9">
                            <label class="radio-inline"><input type="radio" name="optviewtitle" value="1" <?php if($row['viewtitle']==1) echo "checked";?>>Có</label>
                            <label class="radio-inline"><input type="radio" name="optviewtitle" value="0" <?php if($row['viewtitle']==0) echo "checked";?>>Không</label>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-3 form-control-label">Vị trí</label>
                        <div class="col-sm-9">
                            <select name="cbo_position" class="form-control" id="cbo_position">
                                <?php LoadPosition();?>
                                <script language="javascript">
                                    cbo_Selected('cbo_position','<?php echo $row['position'];?>');
                                    $(document).ready(function() {
                                        $("#cbo_position").select2();
                                    });
                                </script>
                            </select>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-3 form-control-label">Class</label>
                        <div class="col-sm-9">
                            <input type="text" name="txtclass" id="txtclass" class="form-control" value="<?php echo $row['class'];?>" />
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-3 form-control-label">Hiển thị</label>
                        <div class="col-sm-9">
                            <label class="radio-inline"><input type="radio" name="optactive" value="1" <?php if($row['isactive']==1) echo "checked";?>>Có</label>
                            <label class="radio-inline"><input type="radio" name="optactive" value="0" <?php if($row['isactive']==0) echo "checked";?>>Không</label>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </fieldset>
        <?php 
        $arr_type=array('mainmenu','html','news','product','document','album','banner','slide','footer','login','support','comments','visitcounter');
        if(in_array($viewtype,$arr_type)){ ?>
        <fieldset>
            <legend><strong><?php echo "Parameter";?>:</strong></legend>
            <div class="row">
                <?php if($viewtype=="mainmenu"){?>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-3 form-control-label">Menu</label>
                        <div class="col-sm-9">
                            <select name="cbo_menutype" class="form-control" id="cbo_menutype">
                                <option value="all">Select once menu</option>
                                <?php echo $objmenu->getListmenu("option"); ?>
                                <script language="javascript">
                                    cbo_Selected('cbo_menutype','<?php echo $row['mnu_id'];?>');
                                </script>
                            </select>
                            <span id="menutype_err" class="check_error"></span>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <?php }else if($viewtype=="news"){?>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-3 form-control-label">Nhóm tin</label>
                        <div class="col-sm-9">
                            <select name="cbo_cate" class="form-control" id="cbo_cate">
                                <option value="0">Chọn một nhóm tin</option>
                                <?php $objCate->getListCate(0,0); ?>
                            </select>  
                            <script language="javascript">
                                cbo_Selected('cbo_cate','<?php echo $row['cate_id'];?>');
                                $(document).ready(function() {
                                    $("#cbo_cate").select2();
                                });
                            </script>
                            <span id="category_err" class="check_error"></span>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <?php }else if($viewtype=="product"){?>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-3 form-control-label">Nhóm SP</label>
                        <div class="col-sm-9">
                            <select name="cbo_cata" class="form-control" id="cbo_cata">
                                <option value="0">Chọn một nhóm SP</option>
                                <?php $objCata->getListCate(0,0); ?>
                            </select>
                            <script language="javascript">
                                cbo_Selected('cbo_cata','<?php echo $row['cata_id'];?>');
                                $(document).ready(function() {
                                    $("#cbo_cata").select2();
                                });
                            </script>
                            <span id="catalogs_err" class="check_error"></span> 
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <?php }else if($viewtype=="album"){?>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-3 form-control-label">Thư viện ảnh</label>
                        <div class="col-sm-9">
                            <select name="cbo_album" class="form-control" id="cbo_album">
                                <option value="0" title="Top">Chọn một album</option>
                                <?php $objAlbum->listAlbum(); ?>
                            </select>
                            <script language="javascript">
                                cbo_Selected('cbo_album','<?php echo $row['album'];?>');
                                $(document).ready(function() {
                                    $("#cbo_album").select2();
                                });
                            </script>
                            <span id="album_err" class="check_error"></span> 
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <?php }else if($viewtype=="html"){?>
                <div class="col-sm-12">
                    <div class="form-group">
                        <textarea name="txtcontent" id="txtcontent" class="form-control"><?php echo stripslashes($row['content']);?></textarea>
                        <script language="javascript">
                            var oEdit1=new InnovaEditor("oEdit1");
                            oEdit1.width="100%";
                            oEdit1.height="300";
                            oEdit1.cmdAssetManager ="modalDialogShow('<?php echo ROOTHOST_ADMIN;?>extensions/editor/innovar/assetmanager/assetmanager.php',640,865)";
                            oEdit1.REPLACE("txtcontent");
                        </script>
                    </div>
                </div>
                <?php } else {};?>
                <div class="clearfix"></div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-3 form-control-label">Giao diện</label>
                        <div class="col-sm-9">
                            <select name="cbo_theme" class="form-control" id="cbo_theme">
                                <option value="">Select once theme</option>
                                <?php LoadModBrow("mod_".$viewtype);?>
                                <script language="javascript">
                                    cbo_Selected('cbo_theme','<?php echo $row['theme'];?>');
                                    $(document).ready(function() {
                                        $("#cbo_theme").select2();
                                    });
                                </script>
                            </select>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </fieldset>
        <?php }?>
        <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;">
    </form>
</div>