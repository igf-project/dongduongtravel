<?php
$cbo_location=''; $price_rank='';
$strWhere='';
if(isset($_POST['submit-form'])){
    $chondiemden=isset($_POST['chondiemden'])? $_POST['chondiemden']:'';
    $chonthoigian=isset($_POST['chonthoigian'])? $_POST['chonthoigian']:'';
    $chonphuongtien=isset($_POST['chonphuongtien'])? $_POST['chonphuongtien']:'';
    $chonkhachsan=isset($_POST['chonkhachsan'])? $_POST['chonkhachsan']:'';
   $name_location=isset($_POST['name_location'])? $_POST['name_location']:'';
   $name_day=isset($_POST['name_day'])? $_POST['name_day']:'';
   $name_ex=isset($_POST['name_ex'])? $_POST['name_ex']:'';
   $name_hotel=isset($_POST['name_hotel'])? $_POST['name_hotel']:'';
}
else Die('PAGE NOT FOUND');

$strWhere="AND find_in_set($chondiemden, `tbl_tour`.`arr_location`) > 0 AND `tbl_tour`.`num_day`=$chonthoigian AND `tbl_tour`.`expediency`Like '%$chonphuongtien%' AND `tbl_tour`.`rank_hotel`='$chonkhachsan'";
if(!isset($_SESSION['PAGE_PRICE'])) $_SESSION['PAGE_PRICE']='';
?>
<div class="container box-list-tour block-tour">
    <div class="page-content">
        <div class="box-title">
            <h3 class="title">Kết quả tìm kiếm từ: <span class="color-1"><?php echo $name_location." > ".$name_day." > ".$name_ex." > ".$name_hotel;?></span></h3>
            <!--<div class="box-find pull-right">
                <form class="form-inline" action="<?php /*echo $url_form;*/?>" method="post">
                    <div class="form-group">
                        <label for="">Đơn giá</label>
                        <select class="form-control" id="cbo_price" name="cbo_price">
                            <option value="0">-- Tất cả --</option>
                            <option class="" <?php /*echo $price_rank==1? 'selected':'';*/?> value="1">Dưới 1 triệu</option>
                            <option class="" <?php /*echo $price_rank==2? 'selected':'';*/?> value="2">Từ 1 đến 3 triệu</option>
                            <option class="" <?php /*echo $price_rank==3? 'selected':'';*/?> value="3">Từ 3 đến 5 triệu</option>
                            <option class="" <?php /*echo $price_rank==4? 'selected':'';*/?> value="4">Từ 5 đến 7 triệu</option>
                            <option class="" <?php /*echo $price_rank==5? 'selected':'';*/?> value="5">Từ 7 đến 10 triệu</option>
                            <option class="" <?php /*echo $price_rank==6? 'selected':'';*/?> value="6">Trên 10 triệu</option>
                        </select>
                    </div>
                    <input type="submit" name="finder" class="btn btn-default btn-border btn-finder" value="Finder"/>
                </form>
            </div>-->
        </div>
        <div class="content row list-item" id="data-respon">

            <?php
            $limit='';

            $cur_page=isset($_POST['txtCurnpage'])? $_POST['txtCurnpage']: '1';
            $obj->getListAllActive($strWhere);
            $total_rows=$obj->Num_rows();
            if($total_rows < 1){
                echo EMPTY_DATA;
            }
            $total_page=ceil($total_rows/MAX_ROWS);
            if($cur_page >= 1 AND $cur_page <= $total_page){
                if($total_rows<MAX_ROWS){
                    $start=($cur_page-1)*MAX_ROWS;
                }
                else{
                    $start=($cur_page-1)*MAX_ROWS + 1;
                }
                $limit='LIMIT '.$start.','.MAX_ROWS;
            }
            $obj->getListItem($strWhere, $limit);
            ?>
        </div>
    </div>
</div>
<?php
$max_rows=MAX_ROWS;
paging($total_rows, $max_rows, $cur_page);
?>
</div>
<script>
    /*call ajax*/
    /*$('.findter-location .item').click(function(){
     *//*$('body').addClass('div-relati');*//*
     var name=$(this).attr('title');
     var val=$(this).attr('value');
     $('.findter-location .item').removeClass('active');
     $(this).addClass('active');
     $.get('<?php echo ROOTHOST;?>ajaxs/tour/getListTour.php',{val, name},function(response_data){
     $('#data-respon').html(response_data);
     *//*$('body').removeClass('div-relati');*//*
     })
     })*/
</script>