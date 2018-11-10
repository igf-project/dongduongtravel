<?php
class CLS_TOURPROGRAMWHERE{
    private $pro=array(
        'ID'=>'',
        'TourId'=>'',
        'DayId'=>'',
        'PositionId'=>'',
        'Title'=>'',
        'Content'=>'',
        'Time'=>''
    );
    private $objmysql=NULL;
    public function CLS_TOURPROGRAMWHERE(){
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
    public function Num_rows(){
        return $this->objmysql->Num_rows();
    }
    public function Fetch_Assoc(){
        return $this->objmysql->Fetch_Assoc();
    }
    public function getList($where='', $limit=''){
        $sql="SELECT * 
           FROM `tbl_tour_programwhere` ".$where.' ORDER BY `tbl_tour_programwhere`.`title` '.$limit;
        //var_dump($sql);
        return $this->objmysql->Query($sql);
    }
    
    public function listTable($strwhere="", $limit='', $ajax=''){
        global $rowcount;
        $sql="SELECT *
           FROM `tbl_tour_programwhere`
           ".$strwhere." ORDER BY `tbl_tour_programwhere`.`id` DESC ".$limit."";
        //var_dump($sql);
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        while($rows=$objdata->Fetch_Assoc()){   $rowcount++;
            $id=$rows['id'];
            $name=Substring($rows['title'],0,10);
             $content=Substring($rows['content'],0,15);
            echo "<tr name='trow'>";
            echo "<td width='40px' align='center'>$rowcount</td>";
            if(!$ajax):
                echo "<td width=\"30\" align=\"center\"><label>";
                echo "<input type=\"checkbox\" name=\"chk\" id=\"chk\"   onclick=\"docheckonce('chk');\" value=\"$id\" />";
                echo "</label></td>";
            endif;
            echo "<td>".$rows['num_day']."</td>";
           echo "<td>".$name."</td>";
           
            echo "<td  align='center'>";
            echo "<a href='".ROOTHOST."member/tour-type/cap-nhat/$id'>";
            showIconFun('edit','');
            echo "</a>";
            echo "</td>";
            echo "<td align='center'>";
            echo "<a class='delete-item' href='".ROOTHOST."member/tour-type/delete/".$id."' class='item-delete'>";
            showIconFun('delete','');
            echo "</a>";
            echo "</td>";
            echo "</tr>";

        }
    }


    public function getListItem($strwhere="", $limit=''){
        global $rowcount;
        $sql="SELECT *
           FROM `tbl_tour_programwhere`
           ".$strwhere." ORDER BY `tbl_tour_programwhere`.`id` ASC ".$limit."";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        while($rows=$objdata->Fetch_Assoc()){   $rowcount++;
            $id=$rows['id'];
            $title=Substring($rows['title'],0,10);
            ?>
            <li>
                <span class=""><?php echo $title;?></span>
            </li>
            <?php
        }
    }
    public function getListItemInline($strwhere="", $limit=''){
        global $rowcount;
        $sql="SELECT *
           FROM `tbl_tour_programwhere`
           ".$strwhere." ORDER BY `tbl_tour_programwhere`.`id` ASC ".$limit."";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        while($rows=$objdata->Fetch_Assoc()){   $rowcount++;
            $id=$rows['id'];
            $title=Substring($rows['title'],0,10);
            ?>
               <?php echo $title;?>,
        <?php
        }
    }

    /*hàm lấy ra ảnh từ position contact id*/
    public function getAvatarAndNameByPositionContactId($positionContactId){
        $sql="SELECT `tbl_position`.`id`,
                        `tbl_position`.`name`,
                       `tbl_position`.`avatar`,
                       `tbl_position`.`address`,
                       `tbl_location`.`code` as `location_code`,
                       `tbl_position`.`code` as `position_code`
           FROM `tbl_position`
           INNER JOIN `tbl_location`
           ON `tbl_position`.`location_id`=`tbl_location`.`id`
           WHERE `tbl_position`.`id`=$positionContactId";
          // var_dump($sql);
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        // if($objdata->Num_rows()>0){
        $row=$objdata->Fetch_Assoc();
        return $row;
        //}
        // else return "abcc";
    }



    /*hàm lấy ra danh sách lịch trình ngày, hiển thị ở thêm, sửa tour_program*/
    public function getListItemForm($strwhere="", $limit=''){
        global $rowcount;
        $sql="SELECT *
           FROM `tbl_tour_programwhere`
           ".$strwhere." ORDER BY `tbl_tour_programwhere`.`id` ASC ".$limit."";
        //var_dump($sql);
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        while($rows=$objdata->Fetch_Assoc()){   $rowcount++;
            $id=$rows['id'];
            $day='Ngày '.$rows['day_id'];
            $title=Substring($rows['title'],0,10);
             $content=Substring($rows['content'],0,15);
            $arr=$this->getAvatarAndNameByPositionContactId($rows['position_id']);
            $name_position=Substring($arr['name'],0,10);
            $thumb=$arr['avatar'];
            $location_code=$arr['location_code'];
            $position_code=$arr['position_code'];
            $position_address=$arr['address'];
            $url=ROOTHOST."/".$location_code."/".$position_code.".html";
            ?>
            <div class="item" id='tr-<?php echo $id;?>'>
                <h4 class="name"><?php echo $title;?></h4>
                <a href="<?php echo $url;?>" title="<?php echo $name_position;?>"><?php echo getThumbAjax($thumb, $name_position, 'img-position');?></a>
                <span class="txt"><span class="txt-label">Địa điểm: </span><a class="name-position" href="<?php echo $url;?>" title="<?php echo $name_position;?>"><?php echo $name_position;?></span> </a>
                <span class="txt txt-block"><span class="txt-label">Địa chỉ: </span><?php echo $position_address;?></span>
                <span class="time"><b>Thời gian: </b><?php echo $rows['time'];?></span>
                <span class="content txt-block clearfix"><b>Nội dung: </b><?php echo $content;?></span>
                <div class="abs-control">
                    <span class='actEdit' tourId="<?php echo $rows['tour_id'];?>" value="<?php echo $rows['id'];?>">sửa</span>
                    <span class='actAjax' tourId="<?php echo $rows['tour_id'];?>" act='del'  value="<?php echo $rows['id'];?>">Xóa</span>
                </div>
            </div>
        <?php
        }
    }

    /*hàm lấy ra danh sách lịch trình ngày, hiển thị ở thêm, sửa tour_program*/
    public function getListItemStyle($strwhere="", $limit='', $activeTab=''){/* activeTab is set readmore item*/
        $sql="SELECT * FROM `tbl_tour_programwhere` $strwhere ORDER BY `tbl_tour_programwhere`.`id` ASC $limit";
        // var_dump($sql);
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        $count=$objdata->Num_rows();
        if($count<1){
            echo '<p class="ms-empty"> Dữ liệu đang được cập nhật</p>';
        }
        else{
            $index='';
            while($rows=$objdata->Fetch_Assoc()){
                $index++;
                $id=$rows['id'];
                $day='Ngày '.$rows['day_id'];
                $title=Substring($rows['title'],0,10);
                $content=Substring($rows['content'],0,60);
                $arr=$this->getAvatarAndNameByPositionContactId($rows['position_id']);
                $name_position=Substring($arr['name'],0,10);
                $thumb=$arr['avatar'];
                $location_code=$arr['location_code'];
                $position_code=$arr['position_code'];
                $position_address=$arr['address'];
                $url=ROOTHOST.$location_code."/".$position_code.".html";
                ?>

                <div class="item">
                    <h4 class="name"><?php echo $title;?></h4>
                    <a href="<?php echo $url;?>" title="<?php echo $name_position;?>"><?php echo getThumbAjax($thumb, $name_position, 'img-position');?></a>

                        <span class="txt"><span class="txt-label">Địa điểm: </span><a class="name-position" href="<?php echo $url;?>" title="<?php echo $name_position;?>"><?php echo $name_position;?></span> </a>
                        <span class="address txt txt-block"><span class="txt-label">Địa chỉ: </span><?php echo $position_address;?></span>
                        <span class="time"><span class="txt-label">Thời gian: </span><?php echo $rows['time'];?></span>
                    <div class="list_img">
                        <div class="row">
                        <?php
                            $sql1="SELECT `tbl_gallery`.`arr_path`
                                FROM `tbl_position`
                                LEFT JOIN `tbl_gallery` ON `tbl_position`.`id`=`tbl_gallery`.`par_id` WHERE `tbl_position`.`code`='".$position_code."' AND `tbl_gallery`.`arr_path` IS NOT NULL AND `tbl_gallery`.`type`='1'";
                            $objdata1=new CLS_MYSQL();
                            $objdata1->Query($sql1);
                            $rows_img = $objdata1->Fetch_Assoc();
                            $arr_img = explode(', ',$rows_img['arr_path']);
                            for ($i=0 ; $i<count($arr_img); $i++) {
                                $images = getAvatar(PATH_GALLERY.$arr_img[$i],'img-rounded img-responsive','80','80');
                                if($i != 4){
                                echo '<a href="'.$url.'" title="'.$title.'" class="box-img">'.$images.'</a>';
                                }
                                else{
                                    $num=count($arr_img)-5;
                                    echo '<a href="'.$url.'" title="'.$title.'" class="box-img">'.$images.'<span class="num">+'.$num.'</span></a>';
                                    break;
                                }
                            }
                        ?>
                        </div>
                    </div>
                    <div class="detail-program">
                        <span class="txt-label">Chi tiết lịch trình:</span>
                        <span class="txt-content more<?php echo $activeTab.$index;?>"><?php echo $content;?></span>
                    </div>

                </div>
                <!-- <script type="text/javascript">
                    readMore('more<?php echo $activeTab.$index;?>', 200);
                </script> -->
            <?php
            }
        }

    }


    public function getLastId(){
        return $this->objmysql->LastInsertID();
    }
    
    public function Add_new(){
        $sql=" INSERT INTO `tbl_tour_programwhere`(`tour_id`, `day_id`, `position_id`, `title`, `content`, `time`) VALUES";
        $sql.="('".$this->TourId."', '".$this->DayId."', '".$this->PositionId."', '".$this->Title."', '".$this->Content."','".$this->Time."')";
        //var_dump($sql); die;
        return $this->objmysql->Query($sql);
    }
    public function Update(){
        $sql = "UPDATE tbl_tour_programwhere SET `title`='".$this->Title."', `content`='".$this->Content."', `position_id`='".$this->PositionId."', `time`='".$this->Time."' WHERE id='".$this->ID."'";
        return $this->objmysql->Query($sql);
        //var_dump($sql); die;
    }
    public function Delete($id){
        $sql="DELETE FROM `tbl_tour_programwhere` WHERE `id` in ('$id')";
       // var_dump($sql); die();
        return $this->objmysql->Query($sql);
    }

}
?>