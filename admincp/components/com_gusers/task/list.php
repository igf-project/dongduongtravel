<?php
defined('ISHOME') or die("Can't acess this page, please come back!");
define('OBJ_PAGE','GUSER');
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
    $strwhere.=" AND `name` like '%$keyword%' ";
if($action!='' && $action!='all' ){
    $strwhere.=" AND `isactive` = '$action'";
}

// Pagging
$sql="SELECT count(*)  as num FROM `tbl_gusers` WHERE 1=1 ".$strwhere;
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
                    Tìm kiếm
                    <input type="text" name="txtkeyword" id="txtkeyword" placeholder="Keyword" value="<?php echo $keyword;?>"/>
                    <input type="submit" name="button" id="button" value="Tìm kiếm" class="button" />
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
                    <a href="?com=gusers&task=add" class="btn btn-success button"><i class="fa fa-plus" aria-hidden="true"></i> Thêm mới</a>
                </td>
            </tr>
        </table>
        <div style="height: 10px;clear: both;"></div>
        <table class="table table-bordered">
            <tr class="header">
                <td width="70" align="center">Parent ID</td>
                <td align="center">Tên</td>
                <td align="center">Mô tả</td>
                <td width="80" align="center">Hiển thị</td>
                <td width="50" align="center">Sửa</td>
                <td width="50" align="center">Xóa</td>
            </tr>
            <?php $obj->listTableGmem($strwhere,$cur_page,0,0); ?>
        </table>
    </form>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="Footer_list">
        <tr>
            <td align="center">	  
                <?php 
                paging($total_rows,MAX_ROWS,$cur_page,'?com=gusers&page={page}');
                ?>
            </td>
        </tr>
    </table>
</div>