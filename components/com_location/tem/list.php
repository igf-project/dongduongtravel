<?php
$limit=''; $strWhere='';
?>
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
                $cur_page=isset($_GET['page'])?(int)$_GET['page']:1;
                $max_rows = MAX_ROWS;
                $start=($cur_page-1)*$max_rows;
                $total_rows = $obj->getCount($strWhere);
                $limit='LIMIT '.$start.','.MAX_ROWS;
                if($total_rows>0){
                    $obj->getListItem($strWhere, $limit);
                    echo '<div class="text-center">';
                    paging($total_rows, $max_rows, $cur_page,'?page={page}');
                    echo '</div>';
                }else{
                    echo '<p class="notic-mes">Dữ liệu đang được cập nhật. Vui lòng quay lại sau!</p>';
                }
                ?>
            </div>
        </div>
    </div>
</div>