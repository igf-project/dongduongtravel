<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
?>
<div class="container">
<div class="frm-control">
    <h3>Danh sách nhóm quà tặng</h3>
    <?php
    $keyword=''; $action='';
    if(!isset($_SESSION['PAGE_KEY'])) $_SESSION['PAGE_KEY']='';
    if(!isset($_SESSION['PAGE_ACT'])) $_SESSION['PAGE_ACT']='';

    if(isset($_POST['txtkeyword'])){
        $_SESSION['PAGE_KEY']=addslashes($_POST['txtkeyword']);
        $_SESSION['PAGE_ACT']=$_POST['cbo_active'];
    }
    $keyword = $_SESSION['PAGE_KEY'];
    $action = $_SESSION['PAGE_ACT'];
    $strwhere='';
    if($keyword!='' && $keyword!='Keyword')
        $strwhere.="AND ( `tbl_location`.`name` like '%$keyword%')";
    if($action!='' && $action!='all' ){
        $action=(int)$action;
        $strwhere.="AND `tbl_location`.`isactive` = '$action'";
    }
    $limit='';
    $cur_page=isset($_POST['txtCurnpage'])? $_POST['txtCurnpage']: '1';
        $obj->getList(' WHERE 1=1 '.$strwhere,$limit);
        $total_rows=$obj->Num_rows();
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
    ?>

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
            <div class='row'>
                <div class='col-lg-6 col-md-6 frm'>
					<div class="form-inline">
					   <label class="sr-only" for="exampleInputAmount">Tìm kiếm</label>
						<div class="input-group">
						  <input type="text" class="form-control" name="txtkeyword" id="txtkeyword" value="<?php echo $keyword;?>" placeholder='keyword'/>
						 <div class="input-group-addon"><input type="submit" name="button" id="button" value="Search" class="button" /></div>
						</div>
					</div>
				</div>
                <div class='col-lg-6 col-md-6 box-selected text-right'>
                    <select name="cbo_active" id="cbo_active" onchange="document.frm_list.submit();">
                        <option value="all">All</option>
                        <option value="1">Hiện</option>
                        <option value="0">Ẩn</option>
                       <script language="javascript">
                            cbo_Selected('cbo_active','<?php echo $action;?>');
                        </script>
                    </select>
                    <a href="<?php echo ROOTHOST;?>member/nhom-qua-tang/them-moi" class="add-new btn btn-success pull-right">Thêm mới</a>
                </div>
            </div>

            <div class="mem-list mem-location">
            <table class="table">
                <tr>
                    <th>
                        #
                    </th>
                    <th>
                        Name
                    </th>
                    <th width="60px">
                        Ẩn/hiện
                    </th>
                    <th width="60px">
                        Sửa
                    </th>
                     <th width="60px">
                     Xóa
                    </th>
                </tr>
            
                <?php $obj->listTable(' WHERE 1=1 '.$strwhere, $limit);?>
                </table>
            </div>
        </form>
<?php
$max_rows=MAX_ROWS;
paging($total_rows, $max_rows, $cur_page);

unset($obj);

?>
</div>
</div>