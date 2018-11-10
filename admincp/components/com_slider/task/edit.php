<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
define('TASK_NAME', 'Sửa banner slider');
write_path();
if(isset($_GET["id"])){
    $ID=trim($_GET["id"]);
}else die('Page not found !');

if(isset($_POST["cmdsave"])){        
    $obj->Link=$_POST['txt_link'];
    $obj->Slogan=addslashes($_POST['txt_name']);
    $obj->isActive='1';
    $path='../'.PATH_THUMB;
    /*upload thumb*/
    if(isset($_FILES['fileImg']) AND $_FILES['fileImg']['name']!=''){                    
        $objUpload=new CLS_UPLOAD();
        $obj->Image=str_replace('../', '', $objUpload->UploadFile('fileImg', $path));
    }
    else $obj->Image=$_POST['url_image'];
    $obj->ID=$_POST['txtid'];
    $obj->Update();
    echo "<script language=\"javascript\">window.location='index.php?com=".COMS."'</script>";
}

$obj->getList(" WHERE `id`='".$ID."'");
$row=$obj->Fetch_Assoc();
?>
<h1 align='center'>Sửa banner slider </h1><hr/>
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
            <input type="hidden" name="txtid" value="<?php echo $row['id'];?>">
            <div class="box-control">
                <a href="?com=slider" class="btn btn-default pull-left">Quay lại</a>
                <input type="submit" name="cmdsave" id="cmdsave"  class="btn btn-primary pull-right" value="Lưu thông tin">
            </div>
            <div class="tab-content">
                <div class="tab-pane fade active in" id="info">
                    <div class="row">
                        <div class='form-group col-sm-6'>
                            <label class="control-label"><strong>Tên slide</strong><font color="red">*</font></label>
                            <input name="txt_name" type="text" id="txt_name" class='form-control' value="<?php echo $row['slogan'] ?>" placeholder='Tên slide'/>
                        </div>
                        <div class='form-group col-sm-6'>
                            <label class="control-label"><strong>Link</strong></label>
                            <input name="txt_link" type="text" id="txt_link" size="45" class='form-control' value="<?php echo $row['link'] ?>" placeholder='Link'/>
                        </div>
                        <div class='form-group col-sm-6'>
                            <label class="control-label"><strong>Thumb ảnh</strong></label>
                            <input name="fileImg" type="file" id="file-thumb" size="45" class='form-control' value="" placeholder='' />
                            <input name="url_image" type="hidden" value="<?php echo $row['image'];?>"/>
                            <div id="show-img">
                                <img class="img-display" src="<?php echo $row['image']==''? ROOTHOST.THUMB_DEFAULT:ROOTHOST.$row['image'];?>">
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-center">
                        <br/>
                        <a href="?com=slider" class="btn btn-default">Quay lại</a>
                        <input type="submit" name="cmdsave" id="cmdsave"  class="btn btn-primary" value="Lưu thông tin">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#frm_action').submit(function(){
            return checkinput();
        })
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