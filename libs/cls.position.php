<?php
class CLS_POSITION{
    private $pro=array(
        'ID'=>'-1',
        'positiontypeId'=>'',
        'positiongrouptypeId'=>'',
        'Code'=>'',
        'Name'=>'',
        'Intro'=>'',
        'Fulltext'=>'',
        'H1'=>'',
        'metaTitle'=>'',
        'metaKey'=>'',
        'metaDesc'=>'',
        'isActive'=>1,
        'Order'=>1
        );
    private $objmysql=NULL;
    public function CLS_POSITION(){
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
        $sql="SELECT * FROM `tbl_position` ".$where.' ORDER BY `tbl_position`.`name` DESC '.$limit;
        // var_dump($sql);
        return $this->objmysql->Query($sql);
    }

    public function getCount($where=''){
        $sql="SELECT count(*) AS num FROM `tbl_position` WHERE isactive=1 ".$where;
        // echo $sql;
        $objdata = new CLS_MYSQL();
        $objdata->Query($sql);
        $row = $objdata->Fetch_Assoc();
        return $row['num'];
    }

    public function getListJoin($where='',$limit=''){
        $sql="SELECT * FROM `tbl_position` WHERE `tbl_position`.`isactive`=1".$where." ORDER BY `id` ASC ".$limit."";
        // echo $sql;
        return $this->objmysql->Query($sql);
    }

    public function getNameById($id){
        $objdata=new CLS_MYSQL;
        $sql="SELECT `name` FROM `tbl_position` WHERE `id` = '$id'";
        $objdata->Query($sql);
        $row=$objdata->Fetch_Assoc();
        return $row['name'];
    }


    /* ham lay ra danh sach dia diem cua member*/
    public function listItem($strwhere="", $limit=''){
        $sql="SELECT `tbl_position`.`id`,
        `tbl_position`.`name`,
        `tbl_position`.`code`,
        `tbl_position`.`positiontype_id`,
        `tbl_position`.`isactive`
        FROM `tbl_position`".$strwhere." ORDER BY `tbl_position`.`order` DESC ".$limit."";
        // var_dump($sql);
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        while($rows=$objdata->Fetch_Assoc()){
            $id=$rows['id'];
            $name=Substring($rows['name'],0,10);
            $position_code=$rows['code'];

            $positiontype_id=$rows['positiontype_id'];
            ?>
            <div class="item">
                <h3 class="name"><?php echo $name;?></h3>
                <?php  echo $this->getListPositionContact($rows['id'], $position_code, $positiontype_id);?>

                <div class="control">
                    <a href="<?php echo ROOTHOST;?>member/<?php echo $position_code;?>/co-so/them-moi">Thêm cơ sở</a>
                    <a href="<?php echo ROOTHOST."member/dia-diem/active/".$id;?>"><?php echo showIconFun('publish',$rows['isactive']);?>Ẩn/Hiện</a>
                    <a href="<?php echo ROOTHOST;?>member/dia-diem/edit/<?php echo $id;?>"><?php echo showIconFun('edit',true);?>Sửa</a>
                    <a class="delete-item" href="<?php echo ROOTHOST;?>member/dia-diem/delete/<?php echo $id;?>" title=""><?php echo showIconFun('delete',true);?>Xóa</a>
                </div>
            </div>
            <?php
        }
    }
    public function listTable($strwhere="", $ajax= false){
        global $rowcount;
        $sql="SELECT `tbl_position`.`id`,
        `tbl_position`.`name`,
        `tbl_position`.`code`,
        `tbl_position`.`isactive`,
        `tbl_position_contact`.`address`
        FROM `tbl_position`
        INNER JOIN `tbl_position_contact` ON `tbl_position`.`id`=`tbl_position_contact`.`position_id` ".$strwhere." ORDER BY `tbl_position`.`order` DESC";
        // var_dump($sql);
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        while($rows=$objdata->Fetch_Assoc()){	$rowcount++;
            $id=$rows['id'];
            $name=Substring($rows['name'],0,10);
            $address=Substring($rows['address'],0,10);
            echo "<tr name='trow' id='tr-".$id."'>";
            echo "<td>".$rowcount."</td>";
            echo "<td>".$name."</td>";
            echo "<td>".$address."</td>";

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

    function getListCountry($getId=0){
      $sql="SELECT id, name FROM tbl_position WHERE `isactive`='1' ";
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


public function Add_new(){
    $sql=" INSERT INTO `tbl_position`(`code`, `positiontype_id`, `positiongrouptype_id`, `name`, `intro`, `fulltext`, `h1`, `meta_title`, `meta_key`, `meta_desc`, `isactive`, `order`) VALUES";
    $sql.="('".$this->Code."', '".$this->positiontypeId."', '".$this->positiongrouptypeId."', '".$this->Name."','".$this->Intro."', '".$this->Fulltext."', '".$this->H1."', '".$this->metaTitle."', '".$this->metaKey."', '".$this->metaDesc."', '".$this->isActive."', '".$this->Order."')";
    /*var_dump($sql);die();*/
    return $this->objmysql->Exec($sql);
}

public function Update(){
    $sql = "UPDATE `tbl_position` SET `positiontype_id`='".$this->positiontypeId."',`positiongrouptype_id`='".$this->positiongrouptypeId."', `intro`='".$this->Intro."', `name`='".$this->Name."', `fulltext`='".$this->Fulltext."', `h1`='".$this->H1."', `meta_title`='".$this->metaTitle."', `meta_key`='".$this->metaKey."', `meta_desc`='".$this->metaDesc."', `code`='".$this->Code."' WHERE id='".$this->ID."'";
         //var_dump($sql);
    return $this->objmysql->Exec($sql);
}
public function DeletePositionContact($id){
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
public function Delete($id){
    $sql="DELETE `tbl_position`, `tbl_position_contact`
    FROM `tbl_position`
    LEFT JOIN `tbl_position_contact`
    ON `tbl_position`.`id` = `tbl_position_contact`.`position_id`
    WHERE `tbl_position`.`id` in ('$id')";
         //var_dump($sql); die();
    $objdata=new CLS_MYSQL;
    $result=$objdata->Query($sql);
    $result1=$this->DeletePositionContact($id);
    if($result && $result1 ){
        $objdata->Query('COMMIT');
        return $result;
    }
    else{
        $objdata->Query('ROLLBACK');
    }
}

public function setActive($ids,$status=''){
    $sql="UPDATE `tbl_position` SET `isactive`='$status' WHERE `id` in ('$ids')";
    if($status=='')
        $sql="UPDATE `tbl_position` SET `isactive`=if(`isactive`=0,1,0) WHERE `id` in ('$ids')";
    return $this->objmysql->Exec($sql);
}


/* get list combo box addnew*/
function getListCbPosition($getId=0){
    $sql="SELECT id, name FROM `tbl_position` WHERE `isactive`='1' ";
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
/* get ID by Code */
public function getIdAndNameByCode($code){
    $sql="SELECT `tbl_position`.`id`,`tbl_position`.`name` FROM `tbl_position` WHERE `tbl_position`.`code` ='$code'";
    $objdata=new CLS_MYSQL();
    $objdata->Query($sql);
    $row=$objdata->Fetch_Assoc();
    return $row;
}

/* get ID by Code */
public function getIdByCode($code){
    $sql="SELECT `tbl_position`.`id` FROM `tbl_position` WHERE `tbl_position`.`code` ='$code'";
    $objdata=new CLS_MYSQL();
    $objdata->Query($sql);
    $row=$objdata->Fetch_Assoc();
    return $row['id'];
}
public function getCodeById($id){
    $sql="SELECT `tbl_position`.`code` FROM `tbl_position` WHERE `tbl_position`.`id` ='$id'";
    $objdata=new CLS_MYSQL();
    $objdata->Query($sql);
    $row=$objdata->Fetch_Assoc();
    return $row['code'];
}

/*lấy gallery chạy slide by code*/
public function getListGallerySlider($position_code){
  $sql="SELECT `tbl_gallery`.`arr_path`
  FROM `tbl_position` 
  LEFT JOIN `tbl_gallery` ON `tbl_position`.`id`=`tbl_gallery`.`par_id` WHERE `tbl_position`.`code`='".$position_code."' AND `tbl_gallery`.`arr_path` IS NOT NULL AND `tbl_gallery`.`type`='1'";
            // var_dump($sql);
  $objdata=new CLS_MYSQL();
  $objdata->Query($sql);
  return $row=$objdata->Fetch_Assoc();
}

/* get PositionType by Code */
public function getPositionTypeByCode($code){
    $sql="SELECT `tbl_position`.`positiontype_id` FROM `tbl_position` WHERE `tbl_position`.`code` ='$code'";
    $objdata=new CLS_MYSQL();
    $objdata->Query($sql);
    $row=$objdata->Fetch_Assoc();
    return $row['positiontype_id'];
}
/* get PositionType by id */
public function getPositionTypeById($id){
    $sql="SELECT `tbl_position`.`positiontype_id` FROM `tbl_position` WHERE `tbl_position`.`id` ='$id'";
    $objdata=new CLS_MYSQL();
    $objdata->Query($sql);
    $row=$objdata->Fetch_Assoc();
    return $row['positiontype_id'];
}

public function getInfo($strwhere){
    $sql="SELECT `id`, `code`, `name` FROM tbl_position WHERE isactive=1 $strwhere";
        // echo $sql;
    $objdata = new CLS_MYSQL();
    $objdata->Query($sql);
    $row = $objdata->Fetch_Assoc();
    return $row;
}
}
?>