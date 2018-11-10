<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
include_once(LIB_PATH.'cls.tourprogramwhere.php');
$objTourPrWhere=new CLS_TOURPROGRAMWHERE();
?>
<div class="container">
<div class="frm-control">
    <h3>Danh sách Tour</h3>
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
        $strwhere.="WHERE ( `tbl_tour`.`name` like '%$keyword%')";
    if($action!='' && $action!='all' ){
        $action=(int)$action;
        $strwhere.="WHERE `tbl_tour`.`isactive` = '$action'";
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
						 <div class="input-group-addon"><input type="submit" name="button" id="button" value="Search" class="button"/></div>
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
                    <a href="<?php echo ROOTHOST;?>member/tour/them-moi" class="add-new btn btn-success pull-right">Thêm mới</a>
                </div>
            </div>

            <div class="mem-list mem-tour">
                <?php
				$sql="SELECT `tbl_tour`.`id`,
                    `tbl_tour`.`name`,
					`tbl_tour`.`thumb`,
                    `tbl_tour`.`code`,
                    `tbl_tour`.`num_day`,
                    `tbl_tour`.`isactive`
					 FROM `tbl_tour`".$strwhere." ORDER BY `tbl_tour`.`id` DESC ".$limit."";
					$objdata=new CLS_MYSQL();
					$objdata->Query($sql);
					while($rows=$objdata->Fetch_Assoc()){
						$id=$rows['id'];
						$name=Substring($rows['name'],0,10);
						$position_code=$rows['code'];
						$num_day=(int)$rows['num_day'];
					 ?>
						<div class="item">
						
						<img class="img-position" src="<?php echo $rows['thumb']==''? ROOTHOST.THUMB_DEFAULT : ROOTHOST.$rows['thumb'];?>"/>
							<h3 class="name"><?php echo $name;?></h3>
							<div class="info-detail">
								<div class="content">
                                    <?php
                                    $i='1';
                                    for($i==1; $i<= $num_day; $i++):?>

                                    <ul class="list-inline">
                                        <li class="color-1">
										Ngày <?php echo $i;?>:
                                        </li>
                                        <?php echo $objTourPrWhere->getListItem("WHERE `tbl_tour_programwhere`.`tour_id`='$id' AND `tbl_tour_programwhere`.`day_id`=$i");?>
                                    </ul>
                                    <?php endfor;?>
								</div>

							</div>
							
							<div class="control">
								<a href="<?php echo ROOTHOST."member/tour/active/".$id;?>"><?php echo showIconFun('publish',$rows['isactive']);?>Ẩn/Hiện</a>
								<a href="<?php echo ROOTHOST."member/tour/cap-nhat/".$id;?>"><?php echo showIconFun('edit',true);?>Sửa</a>
								<a class="delete-item" href="<?php echo ROOTHOST;?>member/tour/delete/<?php echo $id;?>" title=""><?php echo showIconFun('delete',true);?>Xóa</a>
							</div>
						</div>
				<?php
				}
				?>
				
            </div>
        </form>
<?php
$max_rows=MAX_ROWS;
paging($total_rows, $max_rows, $cur_page);
unset($obj);
?>
</div>
</div>