<?php
class CLS_LOCATION{
    private $objmysql=NULL;
    public function CLS_LOCATION(){
        $this->objmysql=new CLS_MYSQL;
    }
    public function getList($where='', $limit=''){
        $sql="SELECT * FROM `tbl_location` ".$where.' ORDER BY `name` '.$limit;
		// var_dump($sql);
        return $this->objmysql->Query($sql);
    }
    public function getCount($strwhere){
        $sql="SELECT count(*) AS 'num' FROM tbl_location WHERE isactive=1 $strwhere";
        // echo $sql;
        $objdata = new CLS_MYSQL();
        $objdata->Query($sql);
        $row = $objdata->Fetch_Assoc();
        return $row['num'];
    }
	//get list member
    public function getListMember($where='', $limit=''){
        $sql="SELECT `tbl_location`.`id`,
        `tbl_location`.`country_id`,
        `tbl_location`.`name`,
        `tbl_location`.`thumb`,
        `tbl_location`.`code`,
        `tbl_location`.`intro`,
        `tbl_location`.`isactive`,
        `tbl_location_content`.`intro` as `intro_about`,
        `tbl_location_content`.`fulltext` as `fulltext`
        FROM `tbl_location`
        LEFT JOIN `tbl_location_content` 
        ON `tbl_location`.`id`=`tbl_location_content`.`location_id`
        ".$where.' ORDER BY `tbl_location`.`name` '.$limit;
		//var_dump($sql);
        return $this->objmysql->Query($sql);
    }


    public function Num_rows(){
        return $this->objmysql->Num_rows();
    }
    public function Fetch_Assoc(){
        return $this->objmysql->Fetch_Assoc();
    }
    public function getListCate($parid=0,$level=0){
        $sql="SELECT id, name FROM tbl_location WHERE `isactive`='1' ";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        $char="";
        if($level!=0){
            $char.="&nbsp;&nbsp;&nbsp;";
            $char.="|---";
        }
        if($objdata->Num_rows()<=0) return;
        while($rows=$objdata->Fetch_Assoc()){
            $id=$rows['id'];
            $name=$rows['name'];
        }
    }

    // hàm lấy danh sách location
    public function getListItem($strwhere="", $limit=""){
        global $key;
        $sql="SELECT `tbl_location`.`name`, `tbl_location`.`id`,`tbl_location`.`thumb`, `tbl_location`.`code` FROM `tbl_location` WHERE ".$strwhere." `tbl_location`.`isactive`='1' ORDER BY `tbl_location`.`name`".$limit."";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        while($rows=$objdata->Fetch_Assoc()){
            $url=ROOTHOST.$rows['code'];
            $key++;
            $alt_thumb=$rows['name'];
            $thumb=getThumb($rows['thumb'],$alt_thumb, 'img-responsive', 320, 240);
            ?>
            <a href="<?php echo $url;?>" class="col-md-4 col-sm-4 col-xs-6 tour">
                <?php echo $thumb;?>
                <div class="position">
                    <div class='centerd'>
                        <?php echo '<span>'.$rows['name'].'</span><br>';?>
                        <?php echo '<span class="country">(Việt Nam)</span>';?>
                    </div>
                </div>
            </a>
            <?php
        }
    }



	// hàm lấy danh sách location theo dang slider
    public function getListItemSlider($strwhere="", $limit=""){
        global $key;
        $sql="SELECT `tbl_location`.`name`, `tbl_location`.`id`,`tbl_location`.`thumb`, `tbl_location`.`code` FROM `tbl_location` WHERE ".$strwhere." `isactive`='1'  ORDER BY `name`".$limit."";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        $lastRec=$objdata->Num_rows();
        while($rows=$objdata->Fetch_Assoc()):
           $url=ROOTHOST.$rows['code'];
       $key++;
       $alt_thumb=$rows['name'];
       $thumb=getThumb($rows['thumb'],$alt_thumb, 'img-responsive', 320, 240);
       ?>
       <?php if ($key % 6 == 1): ?>
        <div class="swiper-slide">
            <div class="box">
            <?php endif;?>
            <a href="<?php echo $url;?>" class="col-md-4 col-sm-4 col-xs-6 tour">
               <?php echo $thumb;?>
               <div class="position">
                  <div class='centerd'>
                      <?php echo '<span>'.$rows['name'].'</span><br>';?>
                      <?php echo '<span class="country">(Việt Nam)</span>';?>
                  </div>
              </div>
          </a>
          <?php if ($key % 6 == 0 || $key == $lastRec): ?>
          </div>
      </div>
  <?php endif;?>
  <?php
  endwhile;
}

public function getLastId(){
    return $this->objmysql->LastInsertID();
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
/* combo box*/
function getListCbLocation($getId='', $swhere='', $arrId=''){
    $sql="SELECT id, name, code FROM tbl_location WHERE ".$swhere." `isactive`='1' ORDER BY `name` ASC";

    $objdata=new CLS_MYSQL();
    $objdata->Query($sql);
    if($objdata->Num_rows()<=0) return;
    while($rows=$objdata->Fetch_Assoc()){
        $id=$rows['id'];
        $name=$rows['name'];
        if(!$arrId){
            ?>
            <option value='<?php echo $rows['id'];?>' <?php if(isset($getId) && $id==$getId) echo "selected";?>><?php echo $name;?></option>
            <?php
        }else{?>
        <option value='<?php echo $id;?>' <?php if(isset($arrId) and in_array($id, $arrId)) echo "selected";?>><?php echo $name;?></option>
        <?php
    }
    ?>


    <?php
}
}
/* get ID by Code */
public function getIdAndNameByCode($id){
    $sql="SELECT `tbl_location`.`id`,`tbl_location`.`name` FROM `tbl_location` WHERE `tbl_location`.`code` ='$id'";
    $objdata=new CLS_MYSQL();
    $objdata->Query($sql);
    $row=$objdata->Fetch_Assoc();
    return $row;
}

/* combo box*/
function getListCbLocationHome($getId='', $swhere=''){
    $sql="SELECT id, name, code FROM tbl_location WHERE ".$swhere." `isactive`='1' ORDER BY `name` ASC";
    $objdata=new CLS_MYSQL();
    $objdata->Query($sql);
    if($objdata->Num_rows()<=0) return;
    while($rows=$objdata->Fetch_Assoc()){
        $id=$rows['id'];
        $code=$rows['code'];
        $name=$rows['name'];
        ?>
        <option value='<?php echo $rows['code'];?>' <?php if(isset($getId) && $code==$getId) echo "selected";?>><?php echo $name;?></option>
        <?php
    }
}

/* lấy ra location hiển thị menu*/
function getListMenuCategory($swhere=''){
    $sql="SELECT DISTINCT `tbl_location`.`name`,`tbl_location`.`code`
    FROM tbl_location, tbl_tour
    WHERE find_in_set(tbl_location.id, `tbl_tour`.`arr_location`) > 0 $swhere  ORDER BY `tbl_location`.`name` ASC";
    $objdata=new CLS_MYSQL();
    $objdata->Query($sql);
    if($objdata->Num_rows()<=0) return;
    while($rows=$objdata->Fetch_Assoc()){
        $code=$rows['code'];
        $name=$rows['name'];
        ?>
        <li><a href='<?php echo ROOTHOST."tour/".$code."/danh-sach";?>' title="<?php echo $name;?>"><?php echo $name;?></a></li>
        <?php
    }
}

/* lấy ra location hiển thị ở block tour*/
function getListItemWith($swhere='', $selectId=''){
    $sql="SELECT DISTINCT `tbl_location`.`name`,`tbl_location`.`code`, `tbl_location`.`id`
    FROM tbl_location, tbl_tour
    WHERE find_in_set(tbl_location.id, `tbl_tour`.`arr_location`) > 0 $swhere  ORDER BY `tbl_location`.`name` ASC";
    $objdata=new CLS_MYSQL();
    $objdata->Query($sql);
    if($objdata->Num_rows()<=0) return;
    while($rows=$objdata->Fetch_Assoc()){
        ?>
        <li class="item <?php if($selectId){echo $rows['id']==$selectId ? 'active':'';}?>" value="<?php echo $rows['id'];?>"  title="<?php echo $rows['name'];?>"><a href="<?php echo ROOTHOST."tour/".$rows['code']."/danh-sach";?>" class="item-location"><?php echo $rows['name'];?></a></li>
        <?php
    }
}

/* lấy ra location hiển thị ở tìm kiếm nâng cao*/
function getListFrmSearch($swhere=''){
    $sql="SELECT DISTINCT `tbl_location`.`name`,`tbl_location`.`code`, `tbl_location`.`id`
    FROM tbl_location, tbl_tour
    WHERE find_in_set(tbl_location.id, `tbl_tour`.`arr_location`) > 0 $swhere  ORDER BY `tbl_location`.`name` ASC";
    $objdata=new CLS_MYSQL();
    $objdata->Query($sql);
    if($objdata->Num_rows()<=0) return;
    $index='';
    while($rows=$objdata->Fetch_Assoc()){
        $index++;
        ?>
        <label><input name="chondiemden" type="radio" val_name="<?php echo $rows['name'];?>" value="<?php echo $rows['id'];?>" <?php echo $index==1? 'checked':'';?>><?php echo $rows['name'];?></label>
        <?php
    }
}



public function getNameById($id){
    $objdata=new CLS_MYSQL;
    $sql="SELECT `name` FROM `tbl_location` WHERE `id` = '$id'";
    $objdata->Query($sql);
    $row=$objdata->Fetch_Assoc();
    return $row['name'];
}
public function getCodeById($id){
    $objdata=new CLS_MYSQL;
    $sql="SELECT `code` FROM `tbl_location` WHERE `id` = '$id'";
    $objdata->Query($sql);
    $row=$objdata->Fetch_Assoc();
    return $row['code'];
}

public function getInfo($strwhere){
    $sql="SELECT `id`, `code`, `name` FROM tbl_location WHERE isactive=1 $strwhere";
        // echo $sql;
    $objdata = new CLS_MYSQL();
    $objdata->Query($sql);
    $row = $objdata->Fetch_Assoc();
    return $row;
}
}
?>