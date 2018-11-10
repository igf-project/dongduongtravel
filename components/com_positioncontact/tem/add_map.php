<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
if(isset($_GET['positioncontact_id']) and (int)$_GET['positioncontact_id']){
    $id=$_GET['positioncontact_id'];
    $position_code=$_GET['code'];
}
else die('PAGE NOT FOUND');
?>
<div class="container">
    <div class="frm-control">
        <div class="link-header">
            <h3><span class="color-1"><?php echo $position_code;?></span></h3>
        </div>
        <div class="box-step column-5">
            <ul>
                <li class="">
                    <span class="number num1">01</span>
                    <span class="name">Thông tin địa điểm</span>
                </li>
                <li class="active">
                    <span class="number num2">02</span>
                    <span class="name">Địa chỉ Map</span>
                </li>
                <li>
                    <span class="number num3">03</span>
                    <span class="name">Thư viện ảnh</span>
                </li>
                <li>
                    <span class="number num4">04</span>
                    <span class="name">Thư viện video</span>
                </li>
                <li>
                    <span class="number num5">05</span>
                    <span class="name">Tin liên quan</span>
                </li>
            </ul>
        </div>
        <div class="box-form">
            <h3 class="title">Add địa chỉ Map</h3>
            <!-- Tab panes -->
            <div class="box-btn-act top20">
                <a href="<?php echo ROOTHOST;?>member/<?php echo $position_code;?>/co-so/them-thu-vien-anh/<?php echo $id;?>" class="save-continues btn-default btn-primary">Lưu và tiếp tục</a>
            </div>
            <form id="frm_action" name="frm_action" method="post" action="">
                <div class="row">
                     <div class='form-group col-md-6'>
                         <label class="control-label"><strong>Địa chỉ Map</strong></label>
                         <button class="btn">Add Map</button>
                     </div>
                </div>

                <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;">
            </form>

        </div>

    </div>
</div>






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

        return true;
    }
    var ComponentsEditors = function () {
        var handleWysihtml5 = function () {
            if (!jQuery().wysihtml5) {
                return;
            }
            if ($('.wysihtml5').size() > 0) {
                $('.wysihtml5').wysihtml5({
                    "stylesheets": ["global/plugins/bootstrap-wysihtml5/wysiwyg-color.css"]
                });
            }
        }
        var handleSummernote = function () {
            $('#txt_intro').summernote({height: 80});
            $('#txt_fulltext').summernote({height: 150});
        }
        return {
            //main function to initiate the module
            init: function () {
                handleWysihtml5();
                handleSummernote();
            }
        }
    }();

    /*func add new position contact*/


    $(document).ready(function() {
        ComponentsEditors.init();

        $('#tabs span').click(function(){
            $('#tabs span').removeClass('active');
            $(this).addClass('active');
            var tabActive=$(this).attr('href');
            //console.log(tabActive);
            $('.tab-content').hide();
            $(tabActive).show();
        });



        //ComponentsEditorsFulltext.init();
        $('#cbo_position_group_type').change(function(){
            var valOption=this.value;
            $.get('<?php echo ROOTHOST;?>ajaxs/getPositionType.php',{valOption},function(response_data){
                $('#cbo_position_type').html(response_data);
            })
        });


        $('.actActive').click(function(){
            var val=$(this).attr('value');
            $.get('ajaxs/actionList.php',{val},function(response_data){
                $('#actActive').html(response_data);
            })
        });

        $('.actEdit').click(function(){
            var val=$(this).attr('value');
            $.get('ajaxs/actionFormEdit.php',{val},function(response_data){
                $('#myModal').modal('show');
                $('#data-frm').html(response_data);
            })
        });

    });



</script>