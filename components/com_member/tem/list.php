<div class="box-list">
    <div class="container list-location asean">
        <div class="page-content">
            <div class="box-path">
                <ul class="list-inline">
                    <li class="home"><a href="<?php echo ROOTHOST.'trang-chu/'?>">Trang chủ</a></li>
                    > <li><a class="active" href="#">Danh sách địa danh</a></li>
                </ul>
            </div>
            <div class="content row">

                <?php
                $limit='';
                $strWhere='';
                $cur_page=isset($_POST['txtCurnpage'])? $_POST['txtCurnpage']: '1';
                $obj->getList($strWhere,'');
                $total_rows=$obj->Num_rows();
                $total_page=ceil($total_rows/MAX_ROWS);
                if($cur_page >= 1 AND $cur_page <= $total_page){
                    $start=($cur_page-1)*MAX_ROWS + 1;
                    $limit='LIMIT '.$start.','.MAX_ROWS;
                }
                $obj->getListItem($strWhere, $limit);
                ?>
            </div>
        </div>
    </div>
</div>
<?php
$max_rows=MAX_ROWS;
paging($total_rows, $max_rows, $cur_page);
?>
</div>