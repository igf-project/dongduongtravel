<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
define('TASK_NAME', ' Đặt tour');
write_path();

if(isset($_GET['id'])){
    $ID = (int)strip_tags($_GET['id']);
}else die("Page not found!");

if(isset($_POST['cmdsave'])){
    $post_status=(int)$_POST['otp_status'];
    $sql="UPDATE tbl_tour_person SET status= $post_status WHERE id=$ID ";
    $objdata->Query($sql);
    echo "<script language=\"javascript\">window.location='index.php?com=".COMS."'</script>";
}

$sql="SELECT * FROM tbl_tour_person WHERE id=$ID ";
$objdata->Query($sql);
$row= $objdata->Fetch_Assoc();
$str_status='';
if($row['status']==1) $str_status='Đặt tour';
else $str_status='Cần người tư vấn';
?>
<style type="text/css">
    ul.nav li>span{
        width: 150px;
        display: inline-block;
    }
</style>
<h1 align='center'>Thông tin đặt tourperson</h1><hr/>
<div id="action">
    <div class="row">
        <div class="col-sm-6">
            <h3>Thông tin khách hàng</h3><hr>
            <ul class="nav">
                <li><span>Tên: </span><label><?php echo $row['fullname'] ?></label></li>
                <li><span>Số CMTND: </span><label><?php echo $row['cmt'] ?></label></li>
                <li><span>SĐT: </span><label><?php echo $row['phone'] ?></label></li>
                <li><span>Email: </span><label><?php echo $row['email'] ?></label></li>
                <li><span>Địa chỉ: </span><label><?php echo $row['address'] ?></label></li>
                <li><span>Người lớn: </span><label><?php echo $row['number_person'] ?></label></li>
                <li><span>Trẻ em(1-4 tuổi): </span><label><?php echo $row['number_child14'] ?></label></li>
                <li><span>Trẻ em(5-9 tuổi): </span><label><?php echo $row['number_child59'] ?></label></li>
                <li><span>Kiểu tour: </span><label><?php echo $str_status ?></label></li>
            </ul>
        </div>

        <div class="col-sm-6">
            <h3>Thông tin tour</h3><hr>
            <?php
            $sql="SELECT * FROM tbl_tour WHERE id=".$row['tour_id'];
            $objdata->Query($sql);
            $row_tour = $objdata->Fetch_Assoc();
            $location_id = $row_tour['arr_location'];
            ?>
            <ul class="nav">
                <li><span>Tên: </span><label><?php echo $row_tour['name'] ?></label></li>
                <li><span>Số ngày: </span><label><?php echo $row_tour['num_day'] ?></label> ngày <label><?php echo $row_tour['num_night'] ?></label> đêm</li>
                <li><span>Khởi hành: </span><label><?php echo $row_tour['start_time'] ?></label> ngày <label><?php echo date('d-m-Y',strtotime($row_tour['start'])) ?></label></li>
                <li><span>Phương tiện: </span><label><?php echo $row_tour['expediency'] ?></label></li>
                <li><span>Khách sạn: </span><label><?php echo $row_tour['rank_hotel'] ?> sao</label></li>
                <li>
                    <span>Lịch trình: </span>
                    <label>
                        <?php
                        $sql="SELECT * FROM tbl_location WHERE id IN (".$location_id.")";
                        $objdata->Query($sql);
                        $str_log='';
                        while ($row_loc=$objdata->Fetch_Assoc()) {
                            $str_log.=$row_loc['name'].',';
                        }
                        echo substr($str_log,0,strlen($str_log)-1);
                        ?>
                    </label>
                </li>
            </ul>
        </div>
    </div><br><br>

    <form id="frm_action" class="text-center" name="frm_action" method="post" action="">
        <ul class="list-inline">
            <li>
                <div class="radio">
                    <label><input type="radio" name="otp_status" value="1" <?php if($row['type']==1) echo 'checked'; ?>>Xác nhận hoàn thành</label>
                </div>
            </li>
            <li>
                <div class="radio">
                    <label><input type="radio" name="otp_status" value="2" <?php if($row['type']==2) echo 'checked'; ?>>Hủy đặt tour</label>
                </div>
            </li>
        </ul>
        <div class="text-center">
            <br/>
            <a href="?com=tourperson" class="btn btn-default">Quay lại</a>
            <input type="submit" name="cmdsave" id="cmdsave" class="btn btn-primary" value="Lưu thông tin">
        </div>
    </form>
</div>