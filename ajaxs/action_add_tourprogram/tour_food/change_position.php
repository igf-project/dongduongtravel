<?php
/**
 * Created by PhpStorm.
 * User: tranhiep
 * Date: 5/22/2017
 * Time: 3:12 PM
 */
session_start();
include_once('../../../includes/gfinnit.php');
include_once('../../../includes/function.php');
include_once('../../../libs/cls.mysql.php');
$objdata=new CLS_MYSQL();

$position = isset($_POST['position'])? addslashes($_POST['position']):0;
$sql="SELECT id, name FROM tbl_foodmenu WHERE position_id=$position AND `isactive`='1' ORDER BY `name` ASC";
$objdata->Query($sql);
echo '<select id="txt_arr_foodid" class="form-control" name="txt_arr_foodid[]" multiple="multiple">';
if($objdata->Num_rows()>0){
    while($row_Food=$objdata->Fetch_Assoc()){
        $id=$row_Food['id'];
        $name=$row_Food['name'];
        echo '<option value="'.$id.'">'.$name.'</option>';
    }
}
echo '</select>';
?>
<script>
    $('#txt_arr_foodid').searchableOptionList({
        showSelectAll: true,
        texts:{
            selectAll: 'Click all',
            selectNone: 'Remove',
            searchplaceholder: 'ch?n th?c ??n'
        }
    });
</script>
