<link rel="stylesheet" href="<?php echo ROOTHOST.THIS_TEM_PATH;?>css/jquery.mCustomScrollbar.css">
<script src="<?php echo ROOTHOST.THIS_TEM_PATH;?>scripts/jquery.mCustomScrollbar.concat.min.js"></script>
<?php
include_once('../../includes/gfinnit.php');
include_once('../../includes/gffunction.php');
include_once('../../includes/gfconfig.php');
include_once('../../libs/cls.mysql.php');
include_once('../../libs/cls.location.php');
$objLo=new CLS_LOCATION();
?>
<form action="<?php echo ROOTHOST."tim-kiem.html"?>" method="POST">
    <div class="list-path">
        <span>Tìm Tour:</span>
        <span id="search-where">Đà Lạt<input  name="name_location" type="hidden" value="Đà Lạt"></span> &gt;
        <span id="search-day">2 ngày <input  name="name_day" type="hidden" value="2 ngày"></span> &gt;
        <span id="search-ex">Ô tô<input  name="name_ex" type="hidden" value="Ô tô"></span> &gt;
        <span id="search-hotel">Tiêu chuẩn<input  name="name_hotel" type="hidden" value="Tiêu chuẩn"></span>
        <input class="myButton" id="searchsubmit" type="submit" name="submit-form" value="Tìm kiếm"/>
    </div>
    <div class="filter-name clearfix"></div>
    <ul class="list">
        <li id="filtermanu">
            <h3>Điểm đến</h3>
            <div class="scroll mCustomScrollbar" id="check-where">
                <!--<label>-- Trong nước --</label>-->
                <?php
                $objLo->getListFrmSearch();
                ?>
            </div>
        </li>

        <li id="filtermanu">
            <h3>Thời gian</h3>
            <div class="scroll mCustomScrollbar" id="check-day">

                <label><input class="chonthoigian" name="chonthoigian" type="radio" val_name="2 ngày" value="2" checked="checked">2 ngày</label>
                <label><input class="chonthoigian" name="chonthoigian" type="radio" val_name="3 ngày" value="3">3 ngày</label>
                <label><input class="chonthoigian" name="chonthoigian" type="radio" val_name="4 ngày" value="4">4 ngày</label>
                <label><input class="chonthoigian" name="chonthoigian" type="radio" val_name="5 ngày" value="5">5 ngày</label>
                <label><input class="chonthoigian" name="chonthoigian" type="radio" val_name="6 ngày" value="6">6 ngày</label>
                <label><input class="chonthoigian" name="chonthoigian" type="radio" val_name="7 ngày" value="7">7 ngày</label>
                <label><input class="chonthoigian" name="chonthoigian" type="radio" val_name="8 ngày" value="8">8 ngày</label>
                <label><input class="chonthoigian" name="chonthoigian" type="radio" val_name="9 ngày" value="9">9 ngày</label>
                <label><input class="chonthoigian" name="chonthoigian" type="radio" val_name="10 ngày" value="10">10 ngày</label>
                <label><input class="chonthoigian" name="chonthoigian" type="radio" val_name="11 ngày" value="11">11 ngày</label>
                <label><input class="chonthoigian" name="chonthoigian" type="radio" val_name="12 ngày" value="12">12 ngày</label>
            </div>
        </li>
        <li id="check-ex">
            <h3>Phương tiện</h3>
            <label><input class="chonphuongtien" name="chonphuongtien" checked="checked" type="radio" val_name="Ô tô" value="oto">Ô tô</label>
            <label><input class="chonphuongtien" name="chonphuongtien" type="radio" val_name="Máy bay" value="may-bay">Máy bay</label>
            <label><input class="chonphuongtien" name="chonphuongtien" type="radio" val_name="Tàu thủy" value="tau-thuy">Tàu thủy</label>
            <label><input class="chonphuongtien" name="chonphuongtien" type="radio" val_name="Tàu hỏa" value="tau-hoa">Tàu hỏa</label>
        </li>
        <li id="check-hotel">
            <h3>Khách sạn</h3>
            <label><input class="chonkhachsan" name="chonkhachsan" type="radio" checked="checked" value="6">Tiêu chuẩn</label>
            <label><input class="chonkhachsan" name="chonkhachsan" type="radio" val_name="1 sao" value="1">1 sao</label>
            <label><input class="chonkhachsan" name="chonkhachsan" type="radio" val_name="2 sao" value="2">2 sao</label>
            <label><input class="chonkhachsan" name="chonkhachsan" type="radio" val_name="3 sao" value="3">3 sao</label>
            <label><input class="chonkhachsan" name="chonkhachsan" type="radio" val_name="4 sao" value="4">4 sao</label>
            <label><input class="chonkhachsan" name="chonkhachsan" type="radio" val_name="5 sao" value="5">5 sao</label>
        </li>
    </ul>

    <script>
        $('#check-where input[type="radio"]').click(function(){
            var value=$(this).attr('val_name');
            $('#search-where').html(value+ '<input type="hidden" name="name_location" value="'+ value +'">');
        });
        $('#check-day input[type="radio"]').click(function(){
            var value=$(this).attr('val_name');
            $('#search-day').html(value+ '<input type="hidden" name="name_day" value="'+ value +'">');
        });
        $('#check-ex input[type="radio"]').click(function(){
            var value=$(this).attr('val_name');
            $('#search-ex').html(value+ '<input type="hidden" name="name_ex" value="'+ value +'">');
        });
        $('#check-hotel input[type="radio"]').click(function(){
            var value=$(this).attr('val_name');
            $('#search-hotel').html(value+ '<input type="hidden" name="name_hotel" value="'+ value +'">');
        });
    </script>
</form>
