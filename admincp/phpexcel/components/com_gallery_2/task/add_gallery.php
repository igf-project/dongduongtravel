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
            <li class="">
                <a href="#home" role="tab" data-toggle="tab">
                    <div class="item">
                        <span class="ic-step">01</span>
                        <p>Album</p>
                        <label>Thông tin album</label>
                    </div>
                </a>
            </li>

            <li class="active"><a href="#about" role="tab" data-toggle="tab">
                    <div class="item">
                        <span class="ic-step">02</span>
                        <p>Thư viện ảnh</p>
                        <label>Upload ảnh</label>
                    </div>
                </a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade " id="home">
                <div class="col-md-6">
                    <form id="frm_action" name="frm_action" method="post" action=""  enctype="multipart/form-data">
                        <?php
                        $id=isset($_GET['id'])? (int)$_GET['id']:'';
                        $obj->getListAlbum(" WHERE `id`='".$id."'");
                        $row=$obj->Fetch_Assoc();
                        ?>
                        <input type="hidden" name="txtid" class="form-control"  value="<?php echo $row['id'];?>">
                        <div class="form-group row">
                            <label for="" class="col-sm-3 form-control-label">Tên Album*</label>
                            <div class="col-sm-9">
                                <input type="text" name="txt_name" class="form-control" id="txt_name" value="<?php echo $row['name'];?>" placeholder="">
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
                                    $objCb->getListCbItem($row['group_id']);
                                    ?>
                                </select>
                                <div id="txt_cata_err" class="mes-error"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group">
                            <label for="" class="form-control-label"> Tóm tắt</label>
                            <textarea name="txt_intro" id="txt_intro" style="min-height: 80px" class="form-control"><?php echo $row['intro'];?></textarea>
                        </div>
                        <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;" />
                    </form>
                </div>

            </div>
            <div class="tab-pane fade active in" id="about">
                <form id="frm-upload-img" class="" enctype="multipart/form-data">
                    <input type="hidden" name="album_id" class="form-control"  value="<?php echo $row['id'];?>">
                    <div class="box-select" style="margin-bottom: 12px;">
                        <div class="col-md-6">
                            <div class="form-group">
                                <h4 for="" class="form-control-label" style="margin-bottom: 15px">Upload thư viện ảnh</h4>

                                <div class="clearfix"></div>
                                <div class="row">
                                    <div class='form-group col-md-8 col-action'>
                                        <input name="fileImg[]" type="file" id="file-img" class="form-control"/>
                                    </div>
                                    <div class='form-group col-md-4'>
                                        <input class="btn btn-success" type="submit" value="Upload">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <p>
                                <b>Lưu ý khi upload ảnh:</b><br/><br/>
                                1 - Chỉ được phép upload các định dạng: JPEG,PNG,JPG.<br/>
                                2 - Dung lượng ảnh <2M.<br/>
                                3 - Tên ảnh viết thường không dấu, không chứa dấu cách, các ký tự đặc biệt.<br/>
                                4 - Upload thư viện gallery theo tỉ lệ 16/9 để đảm bảo ảnh hiển thị đẹp, không bị bóp méo.<br/>
                            </p>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="clearfix"></div>
                </form>
                <h4>Danh sách ảnh Upload</h4>
                <div id="respon-img">
                    <?php $obj->getListGallery("WHERE album_id='$id'", PATH_GALLERY); ?>
                </div>
            </div>
        </div>



</div>
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
    <script language="javascript">

        /* add gallery */
        $("#frm-upload-img").submit(function(event){
            if($('#file-img').val()!= ''){
               // var par_id=$('#par_id').val();
                event.preventDefault();
                var formData = new FormData($(this)[0]);
                $.ajax({
                    url: '<?php echo ROOTHOST;?>ajaxs/action_upload_gallery/uploadImage.php',
                    type: 'POST',
                    data: formData,
                    async: false,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (returndata) {
                        $('#respon-img').append(returndata);
                        //alert(returndata);
                    }
                });
            }
            else{
                alert('Choose link Images is Require!')
            }
            $('#file-img').val("");
            return false;
        });
        /*del image*/
        $('#respon-img .del-item').click(function(){
            if(confirm("Bạn có muốn chắc xóa ảnh này")){
                var imgId=$(this).attr('value');
                var par_id=$('#par_id').val();
                $.post('<?php echo ROOTHOST;?>ajaxs/action_upload_gallery/delImage.php',{imgId, par_id},function(response_data){
                    // $('#respon-img').append(response_data);
                    //alert(response_data);
                });
                var parent= $(this).parent();
                parent.remove();
            }
            else return false;
        });
        $('#file-img').val("");


    </script>
