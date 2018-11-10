<?php
class CLS_POSITIONCONTACT{
  private $pro=array(
    'ID'=>'-1',
    'positionId'=>'',
    'countryId'=>'',
    'locationId'=>'',
    'contactName'=>'',
    'Phone'=>'',
    'Address'=>'',
    'Email'=>'',
    'Avatar'=>'',
    'Website'=>'',
    'Latlng'=>'',
    'isActive'=>1,
    'Order'=>1
    );
  private $objmysql=NULL;
  public function CLS_POSITIONCONTACT(){
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
  public function getLastId(){
    return $this->objmysql->LastInsertID();
  }
  public function getListMember($where='',$limit=''){
    $sql="SELECT `tbl_position_contact`.`id`,
    `tbl_position_contact`.`location_id`,
    `tbl_position_contact`.`contact_name`,
    `tbl_position_contact`.`address`,
    `tbl_position_contact`.`phone`,
    `tbl_position_contact`.`email`,
    `tbl_position_contact`.`avatar`,
    `tbl_position_contact`.`website`,
    `tbl_position_contact`.`latlng`,
    `tbl_position_contact`.`isactive`,
    `tbl_location`.`name` as `name_location`,
    `tbl_position`.`name` as `name_position`
    FROM `tbl_position_contact`
    INNER JOIN `tbl_location`
    ON `tbl_position_contact`.`location_id` = `tbl_location`.`id`
    INNER JOIN `tbl_position`
    ON `tbl_position_contact`.`position_id` = `tbl_position`.`id`
    ".$where.' ORDER BY `tbl_position_contact`.`contact_name` '.$limit;
    return $this->objmysql->Query($sql);
  }
  
  
  
  public function getList($where='',$limit=''){
    $sql="SELECT `tbl_position_contact`.`id`,
    `tbl_position_contact`.`location_id`,
    `tbl_position_contact`.`location_id`,
    `tbl_position_contact`.`country_id`,
    `tbl_position_contact`.`position_id`,
    `tbl_position_contact`.`contact_name`,
    `tbl_position_contact`.`address`,
    `tbl_position_contact`.`phone`,
    `tbl_position_contact`.`email`,
    `tbl_position_contact`.`avatar`,
    `tbl_position_contact`.`website`,
    `tbl_position_contact`.`latlng`,
    `tbl_position_contact`.`isactive`
    FROM `tbl_position_contact` ".$where.' ORDER BY `tbl_position_contact`.`contact_name` '.$limit;
    //var_dump($sql);// die();
    return $this->objmysql->Query($sql);
  }
  public function Num_rows(){
    return $this->objmysql->Num_rows();
  }
  public function Fetch_Assoc(){
    return $this->objmysql->Fetch_Assoc();
  }


  public function listTable($strwhere="", $ajax= false){
    global $rowcount;
    $sql="SELECT `tbl_position_contact`.`id`,
    `tbl_position_contact`.`location_id`,
    `tbl_position_contact`.`contact_name`,
    `tbl_position_contact`.`position_id`,
    `tbl_position_contact`.`address`,
    `tbl_position_contact`.`email`,
    `tbl_position_contact`.`phone`,
    `tbl_position_contact`.`isactive`,
    `tbl_position`.`name` as `name_position`,
    `tbl_location`.`name` as `name_location`
    FROM `tbl_position_contact`
    INNER JOIN `tbl_location`
    ON `tbl_position_contact`.`location_id` = `tbl_location`.`id`
    INNER JOIN `tbl_position`
    ON `tbl_position_contact`.`position_id` = `tbl_position`.`id`
    ".$strwhere." ORDER BY `tbl_position_contact`.`order`";
       // var_dump($sql);
    $objdata=new CLS_MYSQL();
    $objdata->Query($sql);
    while($rows=$objdata->Fetch_Assoc()){ $rowcount++;
      $id=$rows['id'];
      $name=Substring($rows['contact_name'],0,10);
      $address=Substring($rows['address'],0,10);
      echo "<tr name='trow' id='tr-".$id."'>";
      echo "<td width='40px' align='center'>$rowcount</td>";
      if(!$ajax):
        echo "<td width=\"30\" align=\"center\"><label>";
      echo "<input type=\"checkbox\" name=\"chk\" id=\"chk\"   onclick=\"docheckonce('chk');\" value=\"$id\" />";
      echo "</label></td>";
      endif;
      echo "<td>".$name."</td>";
      echo "<td>".$address."</td>";
      echo "<td>".$rows["email"]."</td>";
      echo "<td>".$rows["phone"]."</td>";
      echo "<td>".$rows["name_location"]."</td>";

      if(!$ajax):
        echo "<td  align='center'>";
      echo "<a href='index.php?com=".COMS."&amp;task=active&amp;id=$id'>";
      showIconFun('publish',$rows["isactive"]);
      echo "</a>";
      echo "</td>";
      echo "<td  align='center'>";
      echo "<a href='index.php?com=".COMS."&amp;task=edit&amp;id=$id'>";
      showIconFun('edit','');
      echo "</a>";
      echo "</td>";
      echo "<td align='center'>";
      echo "<a href='javascript:detele_field(\"index.php?com=".COMS."&amp;task=delete&amp;id=$id\")'>";
      showIconFun('delete','');
      echo "</a>";
      echo "</td>";
      else:
        echo "<td  align='center'>";
      echo "<span class='actAjax' act='active' posId=".$rows['position_id']." value=".$id.">";
      showIconFun('publish',$rows["isactive"]);
      echo "</span>";
      echo "</td>";
      echo "<td  align='center'>";
      echo "<span class='actEdit' value=".$id.">";
      showIconFun('edit','');
      echo "</span>";
      echo "</td>";
      echo "<td align='center'>";
      echo "<span class='actAjax' act='del' posId=".$rows['position_id']." value=".$id.">";
      showIconFun('delete','');
      echo "</span>";
      echo "</td>";
      endif;
      echo "</tr>";

    }
  }
  public function getListById($id){
    $objdata=new CLS_MYSQL;
    $sql="SELECT * FROM `tbl_position_contact` WHERE `ID` = '$id'";
    $objdata->Query($sql);
    return $row=$objdata->Fetch_Assoc();
  }
  /*  public function getCodeById($id){
        $objdata=new CLS_MYSQL;
        $sql="SELECT `code` FROM `tbl_position_contact` WHERE `isactive`=0 AND `ID` = '$id'";

        $objdata->Query($sql);
        $row=$objdata->Fetch_Assoc();
        return $row['code'];
      }*/
    /*public function Delete($id){
        $sql="DELETE FROM `tbl_position_contact` WHERE `id` in ('$id')";
        return $this->objmysql->Exec($sql);
      }*/
      public function setActive($ids,$status=''){
        $sql="UPDATE `tbl_position_contact` SET `isactive`='$status' WHERE `id` in ('$ids')";
        if($status=='')
          $sql="UPDATE `tbl_position_contact` SET `isactive`=if(`isactive`=0,1,0) WHERE `id` in ('$ids')";
        return $this->objmysql->Exec($sql);
      }
      public function Order($arr_id,$arr_quan){
        $n=count($arr_id);
        for($i=0;$i<$n;$i++){
          $sql="UPDATE `tbl_position_contact` SET `order`='".$arr_quan[$i]."' WHERE `id` = '".$arr_id[$i]."' ";
          $this->objmysql->Exec($sql);
        }
      }


      public function Delete($id){
        $sql="DELETE `tbl_position_contact`, `tbl_position_gallery`, `tbl_position_video`, `tbl_position_contentrelate`, `tbl_position_services`, `tbl_foodmenu`
        FROM `tbl_position_contact`
        LEFT JOIN `tbl_position_gallery`
        ON `tbl_position_contact`.`id` = `tbl_position_gallery`.`positioncontact_id`
        LEFT JOIN `tbl_position_video`
        ON `tbl_position_contact`.`id` = `tbl_position_video`.`positioncontact_id`
        LEFT JOIN `tbl_position_contentrelate`
        ON `tbl_position_contact`.`id` = `tbl_position_contentrelate`.`positioncontact_id`
        LEFT JOIN `tbl_position_services`
        ON `tbl_position_contact`.`id` = `tbl_position_services`.`positioncontact_id`
        LEFT JOIN `tbl_foodmenu`
        ON `tbl_position_contact`.`id` = `tbl_foodmenu`.`positioncontact_id`
        WHERE `tbl_position_contact`.`id` in ('$id')";
        return $this->objmysql->Exec($sql);
      }

      public function Add_new(){
        $sql=" INSERT INTO `tbl_position_contact`(`position_id`, `country_id`, `location_id`, `contact_name`, `phone`, `address`, `email`, `avatar`, `website`, `latlng`, `isactive`, `order`) VALUES";
        $sql.="('".$this->positionId."', '".$this->countryId."', '".$this->locationId."', '".$this->contactName."', '".$this->Phone."', '".$this->Address."', '".$this->Email."', '".$this->Avatar."', '".$this->Website."', '".$this->Latlng."', '".$this->isActive."', '".$this->Order."')";
        //var_dump($sql);die();
        return $this->objmysql->Exec($sql);
      }
      public function Update(){
        $sql = "UPDATE `tbl_position_contact` SET `position_id`='".$this->positionId."', `country_id`='".$this->countryId."', `location_id`='".$this->locationId."', `contact_name`='".$this->contactName."', `phone`='".$this->Phone."', `address`='".$this->Address."', `email`='".$this->Email."',`avatar`='".$this->Avatar."', `website`='".$this->Website."', `latlng`='".$this->Latlng."' WHERE id='".$this->ID."'";
        //var_dump($sql);die();
        return $this->objmysql->Exec($sql);
      }


      /* update khi bỏ trường position_id*/
      public function updatePositionContact(){
        $sql = "UPDATE `tbl_position_contact` SET `country_id`='".$this->countryId."', `location_id`='".$this->locationId."', `contact_name`='".$this->contactName."', `phone`='".$this->Phone."', `address`='".$this->Address."', `email`='".$this->Email."',`avatar`='".$this->Avatar."', `website`='".$this->Website."', `latlng`='".$this->Latlng."' WHERE id='".$this->ID."'";
        return $this->objmysql->Exec($sql);
      }


      public function getListIdByPositionId($positionId){
        $sql="SELECT `id` FROM `tbl_position_contact` WHERE `position_id` = '$positionId'";
        return $this->objmysql->Query($sql);
      }
      /* get list position contact by location id*/
      public function getListByLocationId($locationId, $limit=''){
        $sql2="SELECT `tbl_position_contact`.`id`,
        `tbl_position_contact`.`location_id`,
        `tbl_position_contact`.`country_id`,
        `tbl_position_contact`.`position_id`,
        `tbl_position_contact`.`contact_name`,
        `tbl_position_contact`.`address`,
        `tbl_position_contact`.`phone`,
        `tbl_position_contact`.`email`,
        `tbl_position_contact`.`avatar`,
        `tbl_position_contact`.`website`,
        `tbl_position_contact`.`latlng`,
        `tbl_position_contact`.`isactive`
        FROM `tbl_position_contact` INNER JOIN `tbl_location` WHERE `tbl_location`='$locationId' ORDER BY `tbl_position_contact`.`contact_name` ".$limit."";
            //var_dump($sql); die();
        return $this->objmysql->Query($sql2);
      }



    public function getListWithLocation($where='',$limit=''){// hàm lấy ra danh sách location only và cả location của nó
      $sql="SELECT `tbl_position`.`id`,
      `tbl_position`.`code`, `tbl_position`.`name`, `tbl_position`.`intro`,
      `tbl_position`.`fulltext`, `tbl_position`.`h1`, `tbl_position`.`meta_title`,
      `tbl_position`.`meta_key`, `tbl_position`.`meta_desc`, `tbl_position`.`isactive`, `tbl_location`.`code` as `location_code`
      FROM `tbl_position_contact`
      INNER JOIN `tbl_position` ON `tbl_position`.`id`=`tbl_position_contact`.`position_id`
      INNER JOIN `tbl_location` ON `tbl_position_contact`.`location_id`=`tbl_location`.`id`
      WHERE `tbl_position`.`isactive`=1 ".$where." ORDER BY `tbl_position`.`name` ".$limit."";
        //var_dump($sql);
      return $this->objmysql->Query($sql);
    }


    /* get list combo*/
    function getListCbPositionContact($strWhere='', $getId='' ,$arrId=''){
      $sql="SELECT `tbl_position_contact`.`id`, `tbl_position_contact`.`contact_name`, `tbl_position`.`name`
      FROM `tbl_position_contact` INNER JOIN `tbl_position` ON  `tbl_position`.`id` =`tbl_position_contact`.`position_id` WHERE `tbl_position_contact`.`isactive`='1' $strWhere";
      // var_dump($sql);
      $objdata=new CLS_MYSQL();
      $objdata->Query($sql);
      if($objdata->Num_rows()<=0) return;
      while($rows=$objdata->Fetch_Assoc()){
        $id=$rows['id'];
        $name=$rows['name'];
        if(!$arrId){
          ?>
          <option value='<?php echo $id;?>' <?php if($getId && $id==$getId) echo "selected";?>><?php echo $name;?> -- (<?php echo $rows['contact_name'];?>)</option>
          <?php
        }else{?>
        <option value='<?php echo $id;?>' <?php if(isset($arrId) and in_array($id, $arrId)) echo "selected";?>><?php echo $name;?> -- (<?php echo $rows['contact_name'];?>)</option>
        <?php
      }
    }
  }
  /*Hàm lấy ra thông tin code, id positioncontact đầu tiên ( cơ sở chính của position) theo position*/
    public function getIdAndCodeOfPositionContactMain($position_id){// hàm lấy ra danh sách location only và cả location của nó
      $sql="SELECT `tbl_position`.`code`, `tbl_position_contact`.`id`
      FROM `tbl_position_contact`
      INNER JOIN `tbl_position`
      ON `tbl_position`.`id`=`tbl_position_contact`.`position_id`
      WHERE `tbl_position_contact`.`position_id`='$position_id' ORDER BY tbl_position_contact.id ASC LIMIT 0,1";
      $objdata=new CLS_MYSQL;
      $objdata->Query($sql);
      return $rows=$objdata->Fetch_Assoc();
    }
    /*Hàm lấy ra positioncontact đầu tiên ( cơ sở chính của position) theo position*/
    public function getPositionContactMain($position_id){// hàm lấy ra danh sách location only và cả location của nó
      $sql="SELECT `tbl_position_contact`.`id`, `tbl_position_contact`.`contact_name`, `tbl_position_contact`.`location_id`, `tbl_position_contact`.`position_id`
      FROM `tbl_position_contact`
      INNER JOIN `tbl_position`
      ON `tbl_position`.`id`=`tbl_position_contact`.`position_id`
      WHERE `tbl_position_contact`.`position_id`='$position_id' ORDER BY tbl_position_contact.id ASC LIMIT 0,1";
      $objdata=new CLS_MYSQL;
      $objdata->Query($sql);
      return $rows=$objdata->Fetch_Assoc();
    }

    public function getNameByid($id){
      $sql="SELECT `tbl_position_contact`.`contact_name`
      FROM `tbl_position_contact` WHERE id='$id'";
      $objdata=new CLS_MYSQL;
      $objdata->Query($sql);
      $rows=$objdata->Fetch_Assoc();
      return $rows['contact_name'];
    }

    public function getInfoPo_And_PoContact($strwhere){
        $sql="SELECT `tbl_position`.`code` AS `position_code`, `tbl_position`.`name`, `tbl_positioncontact`.`location_id` FROM tbl_position LEFT JOIN tbl_positioncontact ON tbl_position.`id` = tbl_positioncontact.`position_id` WHERE tbl_position.`isactive`=1 $strwhere";
        // echo $sql;
        $objdata = new CLS_MYSQL();
        $objdata->Query($sql);
        $row = $objdata->Fetch_Assoc();
        return $row;
    }
  }
  ?>