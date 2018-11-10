<?php
defined('ISHOME') or die('Can not acess this page, please come back!');
define('OBJ_PAGE','FOODMENURECOMMEND');
define('TASK_NAME', '');
write_path();
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
    $strwhere.=" AND ( `name` like '%$keyword%' )";
if($action!='' && $action!='all' ){
    $strwhere.=" AND `isactive` = '$action'";
}

// Pagging
$sql="SELECT count(*)  as num FROM `tbl_foodmenu_recommend` WHERE 1=1 ".$strwhere;
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
                <td><strong>Tìm kiếm:</strong>
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
                    <a href="?com=foodmenurecommend&task=add" class="btn btn-success button"><i class="fa fa-plus" aria-hidden="true"></i> Thêm mới</a>
                </td>
            </tr>
        </table>
        <div style="clear:both;height:10px;"></div>
        <table class="table table-bordered">
            <tr class="header">
                <th width="30" align="center">#</th>
                <th align="center">Tên</th>
                <th align="center">Giới thiệu</th>
                <th width="50" align="center">Hiển thị</th>
                <th width="50" align="center">Sửa</th>
                <th width="50" align="center">Xóa</th>
            </tr>
            <?php 
            $start=($cur_page-1)*MAX_ROWS;
            $leng=MAX_ROWS;
            $sql="SELECT * FROM tbl_foodmenu_recommend WHERE 1=1 $strwhere LIMIT $start,$leng";
            $objdata=new CLS_MYSQL();
            $objdata->Query($sql); 
            while($rows=$objdata->Fetch_Assoc()){
                $start++;
                $ids=$rows['id'];
                $name=$rows['name'];
                $intro= Substring($rows['intro'],0, 10);

                echo "<tr name='trow'>";
                echo "<td width='30' align='center'>$start</td>";

                echo "<td title=''>$name</td>";
                echo "<td title=''>$intro</td>";

                echo "<td align='center'>";
                echo "<a href='index.php?com=".COMS."&amp;task=active&amp;id=$ids'>";
                showIconFun('publish',$rows['isactive']);
                echo "</a>";
                echo "</td>";

                echo "<td align='center'>";
                echo "<a href='index.php?com=".COMS."&amp;task=edit&amp;id=$ids'>";
                showIconFun('edit','');
                echo "</a>";
                echo "</td>";

                echo "<td align='center'>";
                echo "<a href='index.php?com=".COMS."&amp;task=delete&amp;id=$ids' onclick=\"return confirm('Bạn có chắc muốn xóa ?')\">";
                showIconFun('delete','');
                echo "</a>";
                echo "</td>";

                echo "</tr>";
            }
            ?>
        </table>
    </form>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="Footer_list">
        <tr>
            <td align="center">
                <?php 
                paging($total_rows,MAX_ROWS,$cur_page,'?com=foodmenurecommend&page={page}');
                ?>
            </td>
        </tr>
    </table>
</div>
<?php //----------------------------------------------?>
