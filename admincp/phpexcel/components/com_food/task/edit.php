<?php
	defined("ISHOME") or die("Can't acess this page, please come back!");
	$id="";
	if(isset($_GET["id"]))
		$id=trim($_GET["id"]);
	$obj->getList(" WHERE `id`='".$id."'");
	$row=$obj->Fetch_Assoc();
?>
<div id="action">
    <script language="javascript">
        function checkinput(){
            if($("#txt_name").val()==""){
                $("#txt_name_err").fadeTo(200,0.1,function(){
                    $(this).html('Vui lòng nhập tên thực đơn').fadeTo(900,1);
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
            <input type="hidden" name="txtid" value="<?php echo $row['id'];?>">
            <div class="tab-content">
                <div class="tab-pane fade active in" id="info">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="col-sm-3 form-control-label">Tên thực đơn*</label>
                                <div class="col-sm-9">
                                    <input type="text" name="txt_name" class="form-control" id="txt_name" placeholder="" value="<?php echo $row['name'];?>">
                                    <div id="txt_name_err" class="mes-error"></div>
                                </div>
                                <div class="clearfix"></div>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="col-sm-3 form-control-label">Đơn giá</label>
                                <div class="col-sm-9">
                                    <input type="text" name="txt_price" class="form-control" id="txt_price" placeholder="" value="<?php echo $row['price'];?>">
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="col-sm-3 form-control-label">Nhóm*</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="" name="cbo_cata">
                                        <?php
                                        include_once(LIB_PATH.'cls.catalogs.php');
                                        $objCb=new CLS_CATALOGS();
                                        $objCb->getListCbItem($row['cata_id']);
                                        ?>
                                    </select>
                                    <div id="txt_cata_err" class="mes-error"></div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="col-sm-3 form-control-label">Đơn giá đĩa to (Nếu có)</label>
                                <div class="col-sm-9">
                                    <input type="text" name="txt_pricebig" class="form-control" id="txt_pricebig" placeholder="" value="<?php echo $row['price_big'];?>">
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class='form-group'>
                                <label class="col-sm-3 control-label"><strong>Thumb</strong></label>
                                <div class="col-sm-9">
                                    <input name="fileImg" type="file" id="file-thumb" size="45" class='form-control' value="<?php echo $row['thumb'];?>" placeholder='' />
                                    <input name="url_image" type="hidden" value="<?php echo $row['thumb'];?>"/>
                                    <div id="show-img">
                                        <img class="img-display" src="<?php echo $row['thumb']==''? ROOTHOST.THUMB_DEFAULT:ROOTHOST_FRONTEND.$row['thumb'];?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="col-sm-3 form-control-label">Nổi bật</label>
                                <div class="col-sm-9">
                                    <div class="col-sm-3">
                                        <input type="radio" value="1" name="opt_ishot" >Có
                                    </div>
                                    <div class="col-sm-3">
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
                        <textarea name="txt_intro" id="txt_intro" style="min-height: 80px" class="form-control"><?php echo $row['intro'];?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-control-label"> Nội dung</label>
                        <textarea name="txt_fulltext" id="txt_fulltext" cols="45" rows="5"><?php echo $row['fulltext'];?></textarea>
                        <script language="javascript">
                            var oEdit3=new InnovaEditor("oEdit3");
                            oEdit3.width="100%";
                            oEdit3.height="100";
                            oEdit3.cmdAssetManager ="modalDialogShow('<?php echo ROOTHOST;?>extensions/editor/innovar/assetmanager/assetmanager.php',640,465)";
                            oEdit3.REPLACE("txt_fulltext");
                        </script>
                    </div>
                </div>
                <div class="tab-pane fade" id="seo">
                    <div class='form-group'>
                        <label class="col-sm-3 control-label"><strong>Mô tả tiêu đề</strong></label>
                        <div class="col-sm-9">
                            <input name="txt_metatitle" type="text" id="txt_metatitle" class='form-control' value="<?php echo $row['meta_title'];?>" placeholder='' />
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class='form-group'>
                        <label class="col-sm-3 control-label"><strong>Từ khóa</strong></label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="txt_metakey" id="txt_metakey" size="45"><?php echo $row['meta_key'];?></textarea>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class='form-group'>
                        <label class="col-sm-3 control-label"><strong>Description</strong></label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="txt_metadesc" id="txt_metadesc" size="45"><?php echo $row['meta_desc'];?></textarea>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                </div>
                <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;" />
        </form>
    </div>
    <script>
        $(document).ready(function() {
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