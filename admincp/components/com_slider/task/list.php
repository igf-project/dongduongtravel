<?php
defined('ISHOME') or die('Can not acess this page, please come back!');
define('OBJ_PAGE','SLIDER');
define('TASK_NAME', '');
write_path();
$keyword='';$strwhere='Where 1=1';$action='';

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
    $strwhere.=" AND ( `slogan` like '%$keyword%' )";
if($action!='' && $action!='all' ){
    $strwhere.=" AND `isactive` = '$action'";
}

// Pagging
$sql="SELECT count(*)  as num FROM `tbl_slider` WHERE 1=1 ".$strwhere;
$objdata->Query($sql);
$r=$objdata->Fetch_Assoc();
$total_rows=$r['num'];
$cur_page=isset($_GET['page'])?(int)$_GET['page']:1;
// End pagging


if(isset($_POST["txt_order"]) && $_POST["txt_order"]!=""){
    var_dump($_POST['txt_order']);
    // $ids=$_POST["txtids"];
    // $ids = str_replace(",","','",$_POST["txt_order"]);
    // switch ($_POST["txtaction"])
    // {
    //     case "public":      $obj->setActive($ids,1);    break;
    //     case "unpublic":    $obj->setActive($ids,0);    break;
    //     case "edit":    
    //     $id=explode("','",$ids);
    //     echo "<script language=\"javascript\">window.location='index.php?com=".COMS."&task=edit&id=".$id[0]."'</script>";
    //     break;
    //     case "delete":      $obj->Delete($ids); break;
    // }
    // echo "<script language=\"javascript\">window.location='index.php?com=".COMS."'</script>";
}
?>
<div id="list">
    <script language="javascript">
        function checkinput(){
            var strids=document.getElementById("txtids");
            if(strids.value==""){
                alert('You are select once record to action');
                return false;
            }
            return true;
        }
    </script>
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
                    <a href="?com=slider&task=add" class="btn btn-success button"><i class="fa fa-plus" aria-hidden="true"></i> Thêm mới</a>
                </td>
            </tr>
        </table>
        <div style="clear:both;height:10px;"></div>
        <table class="table table-bordered">
            <tr class="header">
                <th width="30" align="center">#</th>
                <th align="center">Hình ảnh</th>
                <th align="center">Slogan</th>
                <th width="50" align="center">Hiển thị</th>
                <th width="50" align="center">Sửa</th>
                <th width="50" align="center">Xóa</th>
            </tr>
            <?php 
            $start=($cur_page-1)*MAX_ROWS;
            $leng=MAX_ROWS;
            $sql="SELECT tbl_slider.* FROM tbl_slider $strwhere LIMIT $start,$leng";
            $objdata=new CLS_MYSQL();
            $objdata->Query($sql); 
            while($rows=$objdata->Fetch_Assoc()){
                $start++;
                $ids=$rows['id'];
                $slogan=$rows['slogan'];
                $img=$rows['image'];
                $img = str_replace('../','', $img);
                $order=$rows['order'];
                echo "<tr name='trow'>";
                echo "<td width='30' align='center'>$start</td>";

                echo "<td title=''><img src='".ROOTHOST."$img' class='img-obj' width='120px'> </td>";
                echo "<td title=''>$slogan</td>";

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

                echo "<a href='index.php?com=".COMS."&amp;task=delete&amp;id=$ids' onclick=\"return confirm('Bạn có chắc muốn xóa ?')\" >";
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
                paging($total_rows,MAX_ROWS,$cur_page,'?com=slider&page={page}');
                ?>
            </td>
        </tr>
    </table>
</div>
<script>
    // function save_order(){
    //     var order_id= document.getElementsByName("txt_order");
    //     var str='';
    //     for (var i = 0; i < order_id.length; i++) {
    //         str=str+order_id[i]+',';
    //     }
    //     console.log(str);
    // }
</script>
<?php //----------------------------------------------?>
