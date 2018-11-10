<?php
include_once('../../includes/gfinnit.php');
include_once('../../includes/gffunction.php');
include_once('../../includes/gfconfig.php');
include_once('../../libs/cls.mysql.php');
include_once('../../libs/cls.positioncontact.php');
$obj=new CLS_POSITIONCONTACT();

?>
<!--<form class="form-inline">
    <div class="form-group">
        <input type="text" class="form-control" id="" placeholder="Tìm kiếm thực đơn">
    </div>
    <button type="submit" class="btn btn-default">Tìm kiếm</button>
</form>
-->

<h5>Danh sách địa điểm </h5>
<div class="scoll-box" style="height: 200px">
    <table class="table" style="width: 100%">
        <tr>
            <th>#</th>
            <th><input type="checkbox" name="chkall" id="chkall" value="" onclick="docheckall('chk',this.checked);" /></th>
            <th>Tên</th>
            <th>Địa chỉ</th>
        </tr>
        <?php
        $strwhere="WHERE `tbl_foodmenu`.`positioncontact_id`=$positioncontact_id";
        //  $strwhere="WHERE `tbl_foodmenu`.`position_id`=$position_id AND `tbl_foodmenu`.`id` NOT IN ($arr_selected)";
        $obj->listTable($strwhere);
        ?>
    </table>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary" onclick="submitAddFood()">Done</button>
</div>





