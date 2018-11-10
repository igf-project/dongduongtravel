
<?php
defined('ISHOME') or die('Can not acess this page, please come back!');
define('OBJ_PAGE','POSITION');
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
if(isset($_SESSION['KEY_'.OBJ_PAGE]))
    $keyword=$_SESSION['KEY_'.OBJ_PAGE];
else
    $keyword='';
$action=isset($_SESSION['ACT'.OBJ_PAGE]) ? $_SESSION['ACT'.OBJ_PAGE]:'';

// Gán strwhere
if($keyword!='')
    $strwhere.=" AND ( `tbl_position`.`name` like '%$keyword%' )";
if($action!='' && $action!='all' ){
    $strwhere.=" AND `tbl_position`.`isactive` = '$action'";
}


$sql="SELECT count(*)  as num FROM `tbl_position` WHERE 1=1 ".$strwhere;
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
                    <a href="?com=position&task=add" class="btn btn-success button"><i class="fa fa-plus" aria-hidden="true"></i> Thêm mới</a>
                </td>
            </tr>
        </table>
        <div style="clear:both;height:10px;"></div>
        <table class="table table-bordered">
            <tr class="header">
                <th width="30" align="center">#</th>
                <th align="center">Tên</th>
                <th >Địa chỉ</th>
                <th class="text-center">Thư viện ảnh</th>
                <th class="text-center">Thư viện video</th>
                <th width="50" align="center">Hiển thị</th>
                <th width="50" align="center">Sửa</th>
                <th width="50" align="center">Xóa</th>
            </tr>
            <?php
            $start=($cur_page-1)*MAX_ROWS;
            $leng=MAX_ROWS;
            $sql="SELECT * FROM `tbl_position` WHERE 1=1 ".$strwhere." ORDER BY `order` DESC, name ASC LIMIT $start,$leng";
            $objdata=new CLS_MYSQL();
            $objdata->Query($sql);
            while($rows=$objdata->Fetch_Assoc()){   
                $start++;
                $id=$rows['id'];
                $name=Substring($rows['name'],0,10);
                $address=Substring($rows['address'],0,10);
                echo "<tr name='trow' id='tr-".$id."'>";
                echo "<td>".$start."</td>";

                echo "<td>".$name."</td>";
                echo "<td>".$address."</td>";

                $link_gallery = "index.php?com=".COMS."&amp;task=add_gallery&amp;id=$id";
                $link_video = "index.php?com=".COMS."&amp;task=add_video&amp;id=$id";
                echo "<td align='center'><a href='".$link_gallery."' title='Cập nhật thư viện ảnh'><i class='fa fa-picture-o'></i></a></td>";
                echo "<td align='center'><a href='".$link_video."' title='Cập nhật thư viện video'><i class='fa fa-video-camera'></i></a></td>";

                echo "<td align='center'><a href='index.php?com=".COMS."&amp;task=active&amp;id=$id'>";
                showIconFun('publish',$rows['isactive']);
                echo "</a></td>";

                echo "<td align='center'><a href='index.php?com=".COMS."&amp;task=edit&amp;id=$id'>";
                showIconFun('edit','');
                echo "</a></td>";

                echo "<td align='center'><a href='index.php?com=".COMS."&amp;task=delete&amp;id=$id' onclick=\"return confirm('Bạn có chắc muốn xóa ?')\">";
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
                paging($total_rows,MAX_ROWS,$cur_page,'?com=position&page={page}');
                ?>
            </td>
        </tr>
    </table>
</div>
<?php //----------------------------------------------?>
