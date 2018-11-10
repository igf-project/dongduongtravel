<?php
class CLS_FOODMENU{
    private $pro=array(
        'ID'=>'-1',
        'LocationId'=>'',
        'PositionId'=>'',
        'CateId'=>'',
        'RecomId'=>'',
        'PositionContactId'=>'',
        'Name'=>'',
        'Code'=>'',
        'Thumb'=>'',
        'Score'=>'',
        'Intro'=>'',
        'Fulltext'=>'',
        'isActive'=>1
        );
    private $objmysql=NULL;
    public function CLS_FOODMENU(){
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
        $sql="SELECT * FROM `tbl_foodmenu` ".$where.' ORDER BY `tbl_foodmenu`.`name` DESC '.$limit;
        return $this->objmysql->Query($sql);
    }
    public function getListJoin($where='',$limit=''){
        $sql="SELECT `tbl_foodmenu`.`name`, `tbl_foodmenu`.`thumb`, `tbl_foodmenu`.`code`, `tbl_position`.`name` AS `position_name`, `tbl_position`.`code` AS `position_code`
        FROM `tbl_foodmenu`
        LEFT JOIN `tbl_position`
        ON `tbl_foodmenu`.`position_id` =`tbl_position`.`id`
        $where
        ORDER BY `tbl_foodmenu`.`name` DESC $limit";
        return $this->objmysql->Query($sql);
    }

    public function listTable($strwhere=""){
        global $rowcount;
        $sql="SELECT `tbl_foodmenu`.`id`,
        `tbl_foodmenu`.`name`,
        `tbl_foodmenu`.`code`,
        `tbl_foodmenu`.`position_id`,
        `tbl_foodmenu`.`positioncontact_id`,
        `tbl_foodmenu`.`code`,
        `tbl_foodmenu`.`isactive`,
        `tbl_foodmenu`.`intro`,
        `tbl_foodmenu`.`thumb`,
        `tbl_foodmenu`.`fulltext`
        FROM `tbl_foodmenu` ".$strwhere." ORDER BY `tbl_foodmenu`.`name`";
        //var_dump($sql);
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        while($rows=$objdata->Fetch_Assoc()){   $rowcount++;
            $ids=$rows['id'];
            $position_id=$rows['position_id'];
            $positioncontact_id=$rows['positioncontact_id'];
            $ids=$rows['id'];
            $name=Substring($rows['name'],0,10);
            $content=Substring($rows['intro'],0,20);
            echo "<tr name='trow' id='tr-".$ids."'>";
            echo "<td>".$rowcount."</td>";
            $thumb='';
            if($rows['thumb']!='') {
                $thumb = stripslashes($rows['thumb']);
                $thumb = getThumb($thumb, false, false, 100, 65);
            }
            echo "<td>$thumb</td>";
            echo "<td name='".$name."'>".$name."</td>";
            echo "<td>".$content."</td>";

            echo "<td>";
            echo "<a href='".ROOTHOST."member/thuc-don/active/".$position_id."/".$positioncontact_id."/".$ids."'>";
            showIconFun('publish',$rows['isactive']);
            echo "</a>";
            echo "</td>";
            echo "<td>";
            echo "<a href='".ROOTHOST."member/thuc-don/cap-nhat/".$position_id."/".$positioncontact_id."/".$ids."'>";
            showIconFun('edit','');
            echo "</a>";
            echo "</td>";
            echo "<td>";
            echo "<a href='".ROOTHOST."member/thuc-don/delete/".$position_id."/".$positioncontact_id."/".$ids."'>";
            showIconFun('delete','');
            echo "</a>";
            echo "</td>";
            echo "</tr>";
        }
    }

    public function listAjax($strwhere=""){
        global $rowcount;
        $sql="SELECT `tbl_foodmenu`.`id`,
        `tbl_foodmenu`.`name`,
        `tbl_foodmenu`.`positioncontact_id`,
        `tbl_foodmenu`.`code`,
        `tbl_foodmenu`.`thumb`,
        `tbl_foodmenu`.`isactive`,
        `tbl_foodmenu`.`intro`
        FROM `tbl_foodmenu` ".$strwhere." ORDER BY `tbl_foodmenu`.`name`";
        //var_dump($sql);
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        while($rows=$objdata->Fetch_Assoc()){   $rowcount++;
            $id=$rows['id'];
            $name=Substring($rows['name'],0,10);

            echo "<tr name='trow' id='tr-".$id."'>";
            echo "<td width='40px' align='center'>$rowcount</td>";
            echo "<td>".getThumbAjax($rows['thumb'],'','thumb-small')."</td>";
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
        $sql=" INSERT INTO `tbl_foodmenu`(`location_id`, `position_id`, `cate_id`, `recom_id`,  `positioncontact_id`, `name`, `code`,`thumb`,`score`, `intro`, `fulltext`, `isactive`) VALUES";
        $sql.="('".$this->LocationId."', '".$this->PositionId."', '".$this->CateId."', '".$this->RecomId."', '".$this->PositionContactId."', '".$this->Name."', '".$this->Code."','".$this->Thumb."', '".$this->Score."', '".$this->Intro."', '".$this->Fulltext."', '".$this->isActive."')";
      // var_dump($sql); die();
        return $this->objmysql->Exec($sql);
    }

    public function Update(){
        $sql = "UPDATE `tbl_foodmenu` SET `name`='".$this->Name."', `intro`='".$this->Intro."', `cate_id`='".$this->CateID."', `recom_id`='".$this->RecomId."', `fulltext`='".$this->Fulltext."', `code`='".$this->Code."', `thumb`='".$this->Thumb."' WHERE id='".$this->ID."'";
         //var_dump($sql);die();
        return $this->objmysql->Exec($sql);
    }
    public function Delete($id){
        $sql="DELETE `tbl_foodmenu`
        FROM `tbl_foodmenu`
        WHERE `tbl_foodmenu`.`id` in ('$id')";
         //var_dump($sql); die();
        return $this->objmysql->Exec($sql);
    }

    public function setActive($ids,$status=''){
        $sql="UPDATE `tbl_foodmenu` SET `isactive`='$status' WHERE `id` in ('$ids')";
        if($status=='')
            $sql="UPDATE `tbl_foodmenu` SET `isactive`=if(`isactive`=0,1,0) WHERE `id` in ('$ids')";
        return $this->objmysql->Exec($sql);
    }


    /* get list combo box addnew*/
    function getListCbFoodMenu($getId=0){
        $sql="SELECT id, name FROM `tbl_foodmenu` WHERE `isactive`='1' ";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        if($objdata->Num_rows()<=0) return;
        while($rows=$objdata->Fetch_Assoc()){
            $id=$rows['id'];
            $name=$rows['name'];
            ?>
            <option value='<?php echo $id;?>' <?php if($getId && $id==$getId) echo "selected";?>><?php echo $name;?></option>
            <?php
        }
    }
    /* get list combo box addnew*/
    function getListCbFoodCategory($getId=''){
        $sql="SELECT id, name FROM `tbl_foodmenu_category` WHERE `isactive`='1' ";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        if($objdata->Num_rows()<=0) return;
        while($rows=$objdata->Fetch_Assoc()){
            $id=$rows['id'];
            $name=$rows['name'];
            ?>
            <option value='<?php echo $id;?>' <?php if($getId && $id==$getId) echo "selected";?>><?php echo $name;?></option>
            <?php
        }
    }
    /* get list combo box addnew*/
    function getListCbFoodRecommend($getId=''){
        $sql="SELECT id, name FROM `tbl_foodmenu_recommend` WHERE `isactive`='1' ";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        if($objdata->Num_rows()<=0) return;
        while($rows=$objdata->Fetch_Assoc()){
            $id=$rows['id'];
            $name=$rows['name'];
            ?>
            <option value='<?php echo $id;?>' <?php if($getId && $id==$getId) echo "selected";?>><?php echo $name;?></option>
            <?php
        }
    }


    /* get ID and by Code */
    public function getIdAndNameByCode($code){
        $sql="SELECT `tbl_foodmenu`.`id`,`tbl_foodmenu`.`name` FROM `tbl_foodmenu` WHERE `tbl_foodmenu`.`code` ='$code'";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        $row=$objdata->Fetch_Assoc();
        return $row;
    }
    /* get ID by Code */
    public function getNameAndCodeById($id){
        $sql="SELECT `tbl_foodmenu`.`code`,`tbl_foodmenu`.`name` FROM `tbl_foodmenu` WHERE `tbl_foodmenu`.`id` ='$id'";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        $row=$objdata->Fetch_Assoc();
        return $row;
    }

    public function getCodeById($id){
        $sql="SELECT `tbl_foodmenu`.`code` FROM `tbl_foodmenu` WHERE `tbl_foodmenu`.`id` ='$id'";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        $row=$objdata->Fetch_Assoc();
        return $row['code'];
    }
    
      // hàm lấy danh sách ẩm thực
    public function getListItem($strwhere="", $limit=""){
        $sql="SELECT `tbl_tour`.`id`,`tbl_tour`.`code`, `tbl_tour`.`name`, `tbl_tour`.`intro`, `tbl_tour`.`fulltext`, `tbl_tour`.`thumb`, `tbl_tour`.`cdate`, `tbl_tour_price`.`price`, `tbl_tour`.`num_day`, `tbl_tour`.`num_night`, `tbl_tour`.`expediency`
        FROM ``tbl_foodmenu`` 
        WHERE `tbl_foodmenu`.`isactive`='1' $strwhere ORDER BY `tbl_tour`.`id` DESC $limit";
        //var_dump($sql);
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        while($rows=$objdata->Fetch_Assoc()):
            $position_code=$row['position_code'];
            $url=ROOTHOST.$location_code."/".$position_code."/am-thuc/".$row['code'].".html";
            ?>
            <div class="col-md-3 col-sm-3 col-xs-6 column">
                <a href="<?php echo $url;?>" title=""><?php echo getThumb($row['thumb'],$row['name'],'img-responsive img-full');?></a>
                <div class="item">
                    <h3 class="ellipsis"><a  href="<?php echo $url;?>" title="<?php echo $row['name'];?>"><?php echo $row['name'];?></a></h3>
                    <h3 class="ellipsis" ><a  href="<?php echo $url;?>" title="<?php echo $row['contact_name'];?>" style="color: #21a117"><?php echo $row['contact_name'];?></a></h3>
                    <div class="box-score"><span class="score">9.5</span><a href="">320 Đánh giá</a></div>
                    <div class="clearfix"></div>
                </div>
            </div>
        <?php endwhile;
    }

    public function getNameById($id){
        $objdata=new CLS_MYSQL;
        $sql="SELECT `name` FROM `tbl_foodmenu` WHERE `id` = '$id'";
        $objdata->Query($sql);
        $row=$objdata->Fetch_Assoc();
        return $row['name'];
    }

    public function getCout($strwhere){
        $objdata=new CLS_MYSQL;
        $sql="SELECT COUNT(`tbl_foodmenu`.`id`) AS `number` FROM `tbl_foodmenu` $strwhere";
        $objdata->Query($sql);
        $row=$objdata->Fetch_Assoc();
        return $row['number'];
    }
}
?>