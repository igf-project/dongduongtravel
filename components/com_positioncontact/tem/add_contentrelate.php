<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
include_once(LIB_PATH.'cls.positioncontentrelate.php');
include_once(LIB_PATH.'cls.content.php');
$objPoConRe=new CLS_POSITIONCONTENTRELATE();
$objCon=new CLS_CONTENTS();
if(isset($_GET['positioncontact_id']) and (int)$_GET['positioncontact_id']){
    $positioncontact_id=$_GET['positioncontact_id'];
    $position_code=$_GET['code'];
}
else die('PAGE NOT FOUND');
/*lấy ra positiontype_id*/
include_once(LIB_PATH.'cls.position.php');
$objPo=new CLS_POSITION();
$positiontype_id=$objPo->getPositionTypeByCode($position_code);
$arr_type_position=explode(',', ARR_TYPEPOSITION);

$arr=$objPo->getIdAndNameByCode($position_code);
$position_id=$arr['id'];
$position_name=$arr['name'];
?>
<div class="container">
    <div class="frm-control">
        <div class="link-header">
            <h3><span class="color-1"><?php echo $position_name;?></span> > Thêm bài viết liên quan</h3>
        </div>
        <div class="box-step column-4">
            <ul>
                <li class="">
                    <span class="number num1">01</span>
                    <span class="name">Thông tin cơ sở</span>
                </li>
                <li class="">
                    <span class="number num3">02</span>
                    <span class="name">Thư viện ảnh</span>
                </li>
                <li>
                    <span class="number num4">03</span>
                    <span class="name">Thư viện video</span>
                </li>
                <li class="active">
                    <span class="number num5">04</span>
                    <span class="name">Tin liên quan</span>
                </li>
            </ul>
        </div>
        <div class="box-form">
            <form name="frm_action" class="box-sub" method="post" action="" enctype="multipart/form-data" >
                <input name="position_id" type="hidden" id="position_id" value="<?php echo $positioncontact_id;?>" />
                <div id="respon-arr-added"><!--Append lại giá trị khi xóa bài liên quan-->
                    <?php $arrConId=$objPoConRe->getArrIdByPositionContactId("WHERE `positioncontact_id`= $positioncontact_id");?>

                </div>

                <div class="row">
                    <div class='form-group col-md-6 col-upload'>
                        <h3 class="title">Search bài viết liên quan</h3>
                        <input name="text" type="text" id="txt_search" size="45" class='form-control' value="" placeholder='' />
                    </div>
                    <div class='form-group col-md-6'>
                        <span  id="search-content" class="btn btn-relate btn-success">Tìm kiếm</span>
                    </div>
                </div>
            </form>
            <div class="box-btn-act top30">
                <a class="save-continues btn-default btn-primary"   href="<?php echo ROOTHOST;?>member/dia-diem/danh-sach">Hoàn thành</a>
            </div>
            <h3 class="title color-1">Danh sách các bài viết liên quan</h3>
            <table class="table" style="width: 100%">
                <tr>
                    <th>STT</th>
                    <th>Tiêu đề</th>
                    <th>Tác giả</th>
                    <th width="80" class="text-center">Xóa</th>
                </tr>
                <tbody id="respon-list" class="list-result">
                <?php
                $strWhere="`con_id`IN ($arrConId)";
                $objCon->getListAddRelate($strWhere, $del="true", $positioncontact_id);
                ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Thêm bài viết liên quan</h4>
                </div>
                <div class="modal-body" id="data-frm">
                    <!-- show -->
                </div>
            </div>
        </div>
    </div>
</div>


<link rel="stylesheet" type="text/css" href="<?php echo ROOTHOST;?>global/plugins/bootstrap-summernote/summernote.css">
<script src="<?php echo ROOTHOST;?>global/plugins/select2/select2.min.js"></script>
<script src="<?php echo ROOTHOST;?>global/plugins/bootstrap-summernote/summernote.min.js" type="text/javascript"></script>
<script language="javascript">
    /*search content relate*/
    $('#search-content').click(function(){
        if($('#txt_search').val() != ''){
            var txt_keyword = $('#txt_search').val();
            var position_id = $('#position_id').val();
            var txt_arr_added = $('#txt_arr_added').val();
            $.post('<?php echo ROOTHOST;?>ajaxs/action_content_relate/searchContent.php',{txt_keyword, position_id, txt_arr_added},function(response_data){
                $('#myModal').modal('show');
                $('#data-frm').html(response_data);
            });
        }
        else alert('Keyword is requies!');
    });
    /* add content relate*/
    $(document).on('click','#btn-add-content',function(e) {
        var flag = false;
        var checks = document.getElementsByName('chk[]');
        var boxLength = checks.length;
        for ( i=0; i < boxLength; i++ ) {

            if(checks[i].checked == true){
                var flag=true;
                break;
            }
        }
        if(flag==true){
            var form = $('#frm-relate');
            var postData = form.serializeArray();

            var url=form.attr('action');
            $.post(url, postData, function(response_data){

                $('#respon-list').append(response_data);
            });
            $('#myModal').modal('hide');
        }else{
            return false;
        }

        return false;
    });


    /*del content relate*/
    $('.btn-del-relate').click(function(){
        if(confirm("Bạn có muốn chắc xóa ảnh này")){
        var txt_id=$(this).attr('value');
        var txt_position_id=$(this).attr('txt_position_id');
        $.post('<?php echo ROOTHOST;?>ajaxs/action_content_relate/delContent.php', {txt_id, txt_position_id}, function(response_data){
            $('#respon-arr-added').html(response_data);
        });
        var parent= $(this).parent().parent();
        parent.remove();
        }else return false;
    });

    $(document).ready(function() {
        $('.saveTab').click(function(){
            $('.nav-tabs > .active').next('li').find('a').trigger('click');
        });

        $('.btnPrevious').click(function(){
            $('.nav-tabs > .active').prev('li').find('a').trigger('click');
        });
    });
</script>