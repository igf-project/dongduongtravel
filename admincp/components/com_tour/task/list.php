<?php
defined('ISHOME') or die('Can not acess this page, please come back!');
define('OBJ_PAGE','TOUR');
define('TASK_NAME', '');
write_path();
$objdata=new CLS_MYSQL();
$keyword='';$strwhere='';$action='';
// Khai báo SESSION
if(isset($_POST['txtkeyword'])){
  $keyword=trim($_POST['txtkeyword']);
  $_SESSION['KEY_'.OBJ_PAGE]=$keyword;
}
if(isset($_POST['cbo_active']))
    $_SESSION['ACT'.OBJ_PAGE]=addslashes($_POST['cbo_active']);
if(isset($_POST['cbo_tour_type']))
    $_SESSION['ACT_TOUR_TYPE'.OBJ_PAGE]=addslashes($_POST['cbo_tour_type']);
if(isset($_SESSION['KEY_'.OBJ_PAGE]))
    $keyword=$_SESSION['KEY_'.OBJ_PAGE];
else
    $keyword='';
$action=isset($_SESSION['ACT'.OBJ_PAGE]) ? $_SESSION['ACT'.OBJ_PAGE]:'';
$tour_type=isset($_SESSION['ACT_TOUR_TYPE'.OBJ_PAGE]) ? $_SESSION['ACT_TOUR_TYPE'.OBJ_PAGE]:'';

// Gán strwhere
if($keyword!='')
    $strwhere.=" AND ( `tbl_tour`.`name` like '%$keyword%' )";
if($action!='' && $action!='all' ){
    $strwhere.=" AND `tbl_tour`.`isactive` = '$action'";
}
if($tour_type!='' && $tour_type!='all' ){
    $strwhere.=" AND `tbl_tour`.`tour_type_id` = '$tour_type'";
}


$sql="SELECT count(*)  as num FROM `tbl_tour` WHERE 1=1 ".$strwhere;
$objdata->Query($sql);
$r=$objdata->Fetch_Assoc();
$total_rows=$r['num'];
$cur_page=isset($_GET['page'])?(int)$_GET['page']:1;
// End pagging
?>
<div id="list">
    <form id="frm_list" name="frm_list" method="post" action="">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="Header_list">
            <tr>
                <td>
                    <strong>Tìm kiếm:</strong>
                    <input type="text" name="txtkeyword" id="txtkeyword" placeholder="Keyword" value="<?php echo $keyword;?>"/>
                    <input type="submit" name="button" id="button" value="Tìm kiếm" class="button" size='30'/>
                    <strong>Kiểu tour:</strong>
                    <select name="cbo_tour_type" style="height: 26px;" id="cbo_tour_type" onchange="document.frm_list.submit();">
                        <option value="all">Tất cả</option>
                        <?php
                        $number = count($AR_TOUR_TYPE);
                        for ($i=0; $i < $number; $i++) { 
                            $id = $AR_TOUR_TYPE[$i]['id'];
                            $name = $AR_TOUR_TYPE[$i]['name'];
                            echo '<option value="'.$id.'">'.$name.'</option>';
                        }
                        ?>
                        <script language="javascript">
                            cbo_Selected('cbo_tour_type','<?php echo $tour_type;?>');
                        </script>
                    </select>
                    <strong>Hiển thị:</strong>
                    <select name="cbo_active" id="cbo_active" onchange="document.frm_list.submit();">
                        <option value="all">Tất cả</option>
                        <option value="1">Hiển thị</option>
                        <option value="0">Ẩn</option>
                        <script language="javascript">
                            cbo_Selected('cbo_active','<?php echo $action;?>');
                        </script>
                    </select>
                </td>
                <td align="right">
                    <a href="?com=tour&task=add" class="btn btn-success button"><i class="fa fa-plus" aria-hidden="true"></i> Thêm mới</a>
                </td>
            </tr>
        </table>
        <div style="clear:both;height:10px;"></div>
        <table class="table table-bordered">
            <tr class="header">
                <th width="30" align="center">#</th>
                <th align="center">Tên</th>
                <th class="text-center">Khởi hành</th>
                <th class="text-center">Thời gian</th>
                <th class="text-center">Phương tiện</th>
                <th class="text-center">Lịch trình</th>
                <th class="text-center">Thư viện ảnh</th>
                <th class="text-center">Thư viện Video</th>
                <th width="50" align="center">Hiển thị</th>
                <th width="50" align="center">Sửa</th>
                <th width="50" align="center">Xóa</th>
            </tr>
            <?php
            $start=($cur_page-1)*MAX_ROWS;
            $leng=MAX_ROWS;
            $sql="SELECT `tbl_tour` .`id`, `tbl_tour` .`isactive`, `tbl_tour` .`name`, `tbl_tour` .`start`, `tbl_tour` .`start_time`, `tbl_tour` .`expediency` FROM `tbl_tour` WHERE 1=1 $strwhere ORDER BY start DESC LIMIT $start,$leng";
            $objdata=new CLS_MYSQL();
            $objdata->Query($sql);
            while($rows=$objdata->Fetch_Assoc()){
                $start++;
                $ids=$rows['id'];
                $title=Substring(stripslashes($rows['name']),0,10);
                $start_date = date('d/m/Y',strtotime($rows['start']));
                $start_time = $rows['start_time'];
                $expediency = $rows['expediency'];
                echo "<tr name='trow'>";
                echo "<td width='30' align='center'>$start</td>";


                echo "<td title='$title'>$title</td>";
                echo "<td align='center'>$start_date</td>";
                echo "<td align='center'>$start_time</td>";
                echo "<td align='center'>$expediency</td>";


                $link_schedule = "index.php?com=".COMS."&amp;task=list_schedule&amp;tour=$ids";
                $link_gallery = "index.php?com=".COMS."&amp;task=add_gallery&amp;id=$ids";
                $link_video = "index.php?com=".COMS."&amp;task=add_video&amp;id=$ids";
                echo "<td align='center'><a target='_blank' href='".$link_schedule."' title='Cập nhật lịch trình'><i class='fa fa-truck' aria-hidden='true'></i></a></td>";
                echo "<td align='center'><a target='_blank' href='".$link_gallery."' title='Cập nhật thư viện ảnh'><i class='fa fa-picture-o'></i></a></td>";
                echo "<td align='center'><a target='_blank' href='".$link_video."' title='Cập nhật thư viện video'><i class='fa fa-video-camera'></i></a></td>";


                echo "<td align='center'><a href='index.php?com=".COMS."&amp;task=active&amp;id=$ids'>";
                showIconFun('publish',$rows['isactive']);
                echo "</a></td>";

                echo "<td align='center'><a href='index.php?com=".COMS."&amp;task=edit&amp;id=$ids'>";
                showIconFun('edit','');
                echo "</a></td>";

                echo "<td align='center'><a href='index.php?com=".COMS."&amp;task=delete&amp;id=$ids' onclick=\"return confirm('Bạn có chắc muốn xóa ?')\">";
                showIconFun('delete','');
                echo "</a></td>";

                echo "</tr>";
            }
            ?>
        </table>
    </form>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="Footer_list">
        <tr>
            <td align="center">
                <?php
                paging($total_rows,MAX_ROWS,$cur_page,'?com=tour&page={page}');
                ?>
            </td>
        </tr>
    </table>
</div>
<?php //----------------------------------------------?>
