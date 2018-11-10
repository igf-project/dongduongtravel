<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
$id=isset($_GET["id"])?(int)$_GET["id"]:"";
$obj->getList(' AND `tbl_slider`.`id`='.$id.'');
$row=$obj->Fetch_Assoc();
?>
<div class="container">
    <div class="frm-control">
        <h3 class="h3-header">Cập nhật Slide</h3>           
        <form id="frm_action" name="frm_action" method="post" action=""  enctype="multipart/form-data">
            <input name="txtid" type="hidden" id="txtid" size="45" value="<?php echo $row['id'];?>"/>
            <div class="tab-content">
                <div class="tab-pane fade active in" id="home">
                    <div class="row">
                        <div class='form-group'>
                            <label class="control-label"><strong>Name</strong></label>
                            <input name="txt_name" type="text" id="txt_name" size="45" class='form-control' value="<?php echo $row['name'];?>" placeholder='' />
                        </div>
                        <div class='form-group'>
                            <label class="control-label"><strong>Link</strong></label>
                            <input name="txt_link" type="text" id="txt_link" size="45" class='form-control' value="<?php echo $row['link'];?>" placeholder='' />
                        </div>                        
                    </div>
                    <div class="row">
                         <div class='form-group col-md-6'>
                            <label class="control-label"><strong>Thumb ảnh</strong></label>
                            <input name="fileImg" type="file" id="file-thumb" size="45" class='form-control' value="<?php echo $row['image'];?>" placeholder='' />
                            <input name="url_image" type="hidden" value="<?php echo $row['image'];?>"/>
                            <div id="show-img">
                                <img class="img-display" src="<?php echo $row['image']==''? ROOTHOST.THUMB_DEFAULT:ROOTHOST.$row['image'];?>">
                            </div>
                        </div>
                    </div>
                </div>                
            <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="" onclick="dosubmitAction('frm_action','save');">
        </form>
        </div>
    </div>
</div>

<?php
unset($objLo);
unset($objPosGrType);
unset($objPosType);
?>


<link rel="stylesheet" type="text/css" href="<?php echo ROOTHOST;?>global/plugins/bootstrap-summernote/summernote.css">
<script src="<?php echo ROOTHOST;?>global/plugins/select2/select2.min.js"></script>
<script src="<?php echo ROOTHOST;?>global/plugins/bootstrap-summernote/summernote.min.js" type="text/javascript"></script>
<script language="javascript">
    function checkinput(){
        if($("#txt_name").val()==""){
            alert('Name is require!');
            $("#txt_name").focus();
            return false;
        }
        if($("#txt_link").val()==""){
            alert('Link is require!');
            $("#txt_link").focus();
            return false;
        }
        return true;
    }    
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