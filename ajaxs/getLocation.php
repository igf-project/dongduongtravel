<?php
include_once('../includes/gfinnit.php');
include_once('../libs/cls.mysql.php');
if(isset($_GET['valOption'])){
    $valOption=$_GET['valOption'];
    function getListCbLocation($valOption, $getId=''){
        $sql="SELECT id, name FROM `tbl_location` WHERE `tbl_location`.`country_id`=".$valOption." AND `tbl_location`.`isactive`='1' ";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        if($objdata->Num_rows()<=0){
            ?>
            <option value=''>--- Chọn kiểu tỉnh/ thành phố ---</option>
        <?php
        }
        while($rows=$objdata->Fetch_Assoc()){
            $id=$rows['id'];
            $name=$rows['name'];
            ?>
            <option value='<?php echo $id;?>' <?php if(isset($getId) && $id==$getId) echo "selected";?>><?php echo $name;?></option>
        <?php
        }
    }
    getListCbLocation($valOption);
}
unset($obj);
?>