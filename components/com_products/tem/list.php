<link rel="stylesheet" href="<?php echo ROOTHOST.TEM_PATH;?>web/css/searchableOptionList.css">
<script src="<?php echo ROOTHOST.TEM_PATH;?>web/scripts/searchableOptionList.js"></script>
<?php
$strWhere='';
$arr_group='';
$arr_location='';


/*Finter*/
if(isset($_GET['txt_group']) || isset($_GET['arrLocation'])){
    if(isset($_GET['txt_group'])){
        $arr_group1 = $_GET['txt_group'];
        $arr_group=implode(',',$arr_group1);
        $strWhere.=" AND `tbl_product`.`cata_id` IN ($arr_group)";
    }

    if(isset($_GET['arrLocation'])){
        $arr_location=implode(',',$_GET['arrLocation']);
        $strWhere.=" AND `tbl_product`.`location_id` IN ($arr_location)";
    }
}
?>

<div class="container box-list-tour">
    <div class="page-content">
        <div class="box-filter">
            <form class="frm-content" action="" method="get">
                <div class="box-content">
                    <div class="col-md-6 filter-item">
                        <h3>Quà tặng theo nhóm</h3>
                        <ul class="list-group filter-group">
                            <li class="item active" value="0" id="item-all">
                                <span>Tất cả</span>
                            </li>
                            <?php
                            $obj_Cata->getList();
                            while($rows=$obj_Cata->Fetch_Assoc()){?>
                            <li class="item" title="<?php echo $rows['name'];?>">
                                <label class="radio-inline">
                                    <input type="checkbox" class="" name="txt_group[]" value="<?php echo $rows['cat_id'];?>"
                                    <?php
                                    if(isset($_GET['txt_group']) AND $_GET['txt_group']!=''){
                                        if( in_array($rows['cat_id'],$_GET['txt_group']) ){
                                            echo "checked";
                                        }
                                    };?>/>
                                    <span><?php echo $rows['name'];?></span>
                                </label>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h3>Địa danh</h3>
                        <select id="cbo_location" class="cbo_location" name="arrLocation[]" multiple="multiple">
                            <?php
                            if(isset($_GET['arrLocation']) AND $_GET['arrLocation']!='')
                                echo $objLo->getListCbLocation(false, false, $_GET['arrLocation']);
                            else
                                echo $objLo->getListCbLocation();
                            ?>
                        </select>
                        <script>
                            $('#cbo_location').searchableOptionList();
                        </script>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-color btn-default btn-filter">Tìm kiếm</button>
                </div>
            </form>
            <div class="clearfix"></div>
        </div>

        <div class="list-item gift">
            <h3 class="title">Quà tặng</h3>
            <div class="row">
                <?php
                $limit='';
                $cur_page=isset($_GET['page'])?(int)$_GET['page']:1;
                $max_rows = MAX_ROWS;
                $start=($cur_page-1)*$max_rows;
                $total_rows = $obj->getCount($strWhere);
                $limit='LIMIT '.$start.','.$max_rows;
                if($total_rows>0){
                    $obj->getListItem($strWhere, $limit);
                    echo '<div class="clear-fix"></div><div class="text-center">';
                    paging($total_rows, $max_rows, $cur_page,'?page={page}');
                    echo '</div>';
                }else{
                    echo '<div class="text-center">Dữ liệu trống !</div>';
                }
                ?>
            </div>
        </div>
    </div>

</div>
<script>
    function checkInputChecked(){
        var act=$('.filter-group .item input[type=checkbox]');
        var flag=false;
        for(i=0;i<act.length;i++){
            if(act[i].checked==true){
                flag=true;
            }
        }
        if(flag==true) $('#item-all').removeClass('active');
        else $('#item-all').addClass('active');
    }
    $('.filter-group .item').click(function(){
        checkInputChecked();
    })
    $('document').ready(function(){
        checkInputChecked();
    })

</script>