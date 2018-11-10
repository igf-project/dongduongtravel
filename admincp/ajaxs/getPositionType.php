<?php
include_once('../../includes/gfinnit.php');
include_once('../libs/cls.mysql.php');
if(isset($_GET['valOption'])){
    $valOption=$_GET['valOption'];
    function getListCbPositionType($valOption, $getId=''){
        $sql="SELECT id, name FROM `tbl_position_type` WHERE `tbl_position_type`.`group_id`=".$valOption." AND `tbl_position_type`.`isactive`='1' ";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        if($objdata->Num_rows()<=0){
            ?>
            <option value=''>--- Chọn kiểu đối tượng ---</option>
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
	getListCbPositionType($valOption);
}
unset($objdata);
?>