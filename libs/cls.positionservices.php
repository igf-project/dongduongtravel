<?php
class CLS_POSITIONSERVICES{
    private $pro=array(
        'ID'=>'-1',
        'PositionId'=>'',
        'PositionContactId'=>'',
        'Name'=>'',
        'Code'=>'',
        'Thumb'=>'',
        'Intro'=>'',
        'Fulltext'=>'',
        'isActive'=>1
    );
    private $objmysql=NULL;
    public function CLS_POSITIONSERVICES(){
        $this->objmysql=new CLS_MYSQL;
    }
    // property set value
    public function __set($proname,$value){
        if(!isset($this->pro[$proname])){
            echo ('Can not found $proname member');
            return;
        }
        $this->pro[$proname]=$value;
    }
    public function __get($proname){
        if(!isset($this->pro[$proname])){
            echo ("Can not found $proname member");
            return;
        }
        return $this->pro[$proname];
    }
    public function getList($where='',$limit=''){
        $sql="SELECT * FROM `tbl_position_services` ".$where.' ORDER BY `tbl_position_services`.`name` DESC '.$limit;
       //var_dump($sql);
        return $this->objmysql->Query($sql);
    }


    public function listTable($strwhere=""){
        global $rowcount;
        $sql="SELECT `tbl_position_services`.`id`,
                    `tbl_position_services`.`name`,
                    `tbl_position_services`.`code`,
                    `tbl_position_services`.`isactive`,
                    `tbl_position_services`.`intro`
                    FROM `tbl_position_services` ".$strwhere." ORDER BY `tbl_position_services`.`name`";
        //var_dump($sql);
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        while($rows=$objdata->Fetch_Assoc()){   $rowcount++;
            $ids=$rows['id'];
            $name=Substring($rows['name'],0,10);
            $intro=Substring($rows['intro'],0,10);
            echo "<tr name='trow' id='tr-".$ids."'>";
            echo "<td>".$rowcount."</td>";
            echo "<td><input type=\"checkbox\" name=\"chk[]\" id=\"chk\" label='".$name."' onclick=\"docheckonce('chk');\" value=\"$ids\" /></td>";
            echo "<td name='".$name."'>".$name."</td>";
            echo "<td>".$intro."</td>";
            echo "</tr>";

        }
    }

    public function listAjax($strwhere=""){
        global $rowcount;
        $sql="SELECT `tbl_position_services`.`id`,
                    `tbl_position_services`.`name`,
                    `tbl_position_services`.`positioncontact_id`,
                    `tbl_position_services`.`code`,
                    `tbl_position_services`.`thumb`,
                    `tbl_position_services`.`isactive`,
                    `tbl_position_services`.`intro`
                    FROM `tbl_position_services` ".$strwhere." ORDER BY `tbl_position_services`.`name`";
       // var_dump($sql);
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        while($rows=$objdata->Fetch_Assoc()){   $rowcount++;
            $id=$rows['id'];
            $name=Substring($rows['name'],0,10);
            echo "<tr name='trow' id='tr-".$id."'>";
            echo "<td width='40px' align='center'>$rowcount</td>";
            echo "<td><span class='td-service ".$rows['thumb']."'></span></td>";
            echo "<td>".$name."</td>";
            echo "<td  align='center'>";
            echo "<span class='actEdit' value=".$id.">";
            showIconFun('edit','');
            echo "</span>";
            echo "</td>";
            echo "<td align='center'>";
            echo "<span class='actAjax' act='del' value=".$id.">";
            showIconFun('delete','');
            echo "</span>";
            echo "</td>";
            echo "</tr>";

        }
    }

    public function Num_rows(){
        return $this->objmysql->Num_rows();
    }

    public function Fetch_Assoc(){
        return $this->objmysql->Fetch_Assoc();
    }
    public function getLastId(){
        return $this->objmysql->LastInsertID();
    }



  public function Add_new(){
        $sql=" INSERT INTO `tbl_position_services`(`position_id`, `positioncontact_id`,`name`, `code`,`thumb`, `intro`, `fulltext`, `isactive`) VALUES";
        $sql.="( '".$this->PositionId."', '".$this->PositionContactId."', '".$this->Name."', '".$this->Code."','".$this->Thumb."', '".$this->intro."', '".$this->fulltext."', '".$this->isActive."')";
      //var_dump($sql); die();
        return $this->objmysql->Exec($sql);
    }

    public function Update(){
        $sql = "UPDATE `tbl_position_services` SET `name`='".$this->Name."', `intro`='".$this->Intro."', `fulltext`='".$this->Fulltext."', `code`='".$this->Code."', `thumb`='".$this->Thumb."' WHERE id='".$this->ID."'";
        return $this->objmysql->Exec($sql);
    }
    public function Delete($id){
        //$sql="DELETE FROM `tbl_position_services` WHERE `id` in ('$id')";
        $sql="DELETE FROM `tbl_position_services`
                WHERE `tbl_position_services`.`id` in ('$id')";
         //var_dump($sql); die();
        return $this->objmysql->Exec($sql);
    }

    public function setActive($ids,$status=''){
        $sql="UPDATE `tbl_position_services` SET `isactive`='$status' WHERE `id` in ('$ids')";
        if($status=='')
            $sql="UPDATE `tbl_position_services` SET `isactive`=if(`isactive`=0,1,0) WHERE `id` in ('$ids')";
        return $this->objmysql->Exec($sql);
    }



    /* get ID by Code */
    public function getIdAndNameByCode($code){
        $sql="SELECT `tbl_position_services`.`id`,`tbl_position_services`.`name` FROM `tbl_position_services` WHERE `tbl_position_services`.`code` ='$code'";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        $row=$objdata->Fetch_Assoc();
        return $row;
    }

    public function getCodeById($id){
        $sql="SELECT `tbl_position_services`.`code` FROM `tbl_position_services` WHERE `tbl_position_services`.`id` ='$id'";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        $row=$objdata->Fetch_Assoc();
        return $row['code'];
    }
    public function getListItemSlider($strWhere=''){
        $sql="SELECT `tbl_position_services`.`code` as `service_code`,
            `tbl_position_services`.`name`,
            `tbl_position_services`.`intro`,
            `tbl_position_services`.`thumb`,
            `tbl_position`.`code` as `position_code`,
            `tbl_location`.`code` as `location_code`
            FROM `tbl_position`
            INNER JOIN `tbl_position_services`
            ON `tbl_position`.`id`=`tbl_position_services`.`position_id`
            LEFT JOIN `tbl_location`
            ON `tbl_position`.`location_id`=`tbl_location`.`id`
            $strWhere";
            // var_dump($sql);
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        $lastRe=$objdata->Num_rows();
        $index='';
        while($rows=$objdata->Fetch_Assoc()):
            $url=ROOTHOST.$rows['location_code']."/".$rows['position_code']."/dich-vu/".$rows['service_code'].".html";
            $index++;
            ?>
            <?php if ($index % 6 == 1): ?>
            <div class="swiper-slide">
            <div class="box">
        <?php endif;?>
            <div class="col-md-6 col-item">
                <div class="ic-<?php echo $index;?> ic"></div>
                <h4><a href="<?php echo $url;?>"> <?php echo $rows['name'];?></a></h4>
                <p><?php echo Substring($rows['intro'],0, 15);?></p>
            </div>
            <?php if ($index % 6 == 0 || $index == $lastRe): ?>
            </div>
            </div>
        <?php endif;?>
        <?php endwhile;
    }
}
?>