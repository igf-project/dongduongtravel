<?php
class CLS_TOURPROGRAMFOOD{
    private $pro=array(
        'ID'=>'',
        'TourId'=>'',
        'DayId'=>'',
        'PositionId'=>'',
        'Title'=>'',
        'Content'=>'',
        'Time'=>'',
        'ArrFoodId'=>''
    );
    private $objmysql=NULL;
    public function CLS_TOURPROGRAMFOOD(){
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
           FROM `tbl_tour_programfood` ".$where.' ORDER BY `tbl_tour_programfood`.`title` '.$limit;
        //var_dump($sql);
        return $this->objmysql->Query($sql);
    }
    
    public function listTable($strwhere="", $limit='', $ajax=''){
        global $rowcount;
        $sql="SELECT *
           FROM `tbl_tour_programfood`
           ".$strwhere." ORDER BY `tbl_tour_programfood`.`id` DESC ".$limit."";
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

/*hàm lấy ra ảnh từ position contact id*/
    public function getAvatarAndNameByPositionContactId($positionId){
        $sql="SELECT `tbl_position`.`id`,
                        `tbl_position`.`name`,
                       `tbl_position`.`avatar`,
                       `tbl_location`.`code` as `location_code`,
                       `tbl_position`.`code` as `position_code`
           FROM `tbl_position`
           INNER JOIN `tbl_location`
           ON `tbl_position`.`location_id`=`tbl_location`.`id`
           WHERE `tbl_position`.`id`=$positionId";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        // if($objdata->Num_rows()>0){
        $row=$objdata->Fetch_Assoc();
        return $row;
        //}
        // else return "abcc";
    }



    /*hàm lấy ra danh thức thực đơn từ program food menu*/
    public function getFoodByProgramFoodId($arrFoodId){
        $sql="SELECT `tbl_foodmenu`.`id`,`tbl_foodmenu`.`name` FROM `tbl_foodmenu` WHERE `id` IN (".$arrFoodId.")";
        //var_dump($sql);
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        if(count($objdata->Query($sql) > 0)){
            WHILE($rows=$objdata->Fetch_Assoc()){
                echo '<li class="list-tag">'.$rows['name'].'</li>';
            }
        }
        else
            return "Không có thực đơn nào được chọn!";
    }


    public function getListItemForm($strwhere="", $limit=''){
        global $rowcount;
        $sql="SELECT tbl_tour_programfood.* FROM `tbl_tour_programfood` ".$strwhere." ORDER BY `tbl_tour_programfood`.`id` ASC ".$limit."";
        echo $sql;
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        while($rows=$objdata->Fetch_Assoc()){
            $rowcount++;
            $id=$rows['id'];
            $title=Substring($rows['title'],0,10);
            $content=Substring($rows['content'],0,15);
            $arr=$this->getAvatarAndNameByPositionContactId($rows['position_id']);
            $name_position=Substring($arr['name'],0,10);
            $thumb=$arr['avatar'];
            $location_code=$arr['location_code'];
            $position_code=$arr['position_code'];
            $url=ROOTHOST."/".$location_code."/".$position_code.".html";
            ?>
            <div class="item" id='tr-<?php echo $id;?>'>
                <a href="<?php echo $url;?>" title="<?php echo $name_position;?>"><?php echo getThumbAjax($thumb, $name_position, 'img-position');?></a>
                <h4 class="name"><?php echo $title;?></h4>
                <span class="txt"><span class="txt-label">Địa điểm: </span><a class="name-position" href="<?php echo $url;?>" title="<?php echo $name_position;?>"><?php echo $name_position;?></span> </a>
                <span class="time"><b>Thời gian: </b><?php echo $rows['time'];?></span>
                <span class="time"><b>Nội dung: </b><?php echo $content;?></span>
                <ul class="list-inline list-food">
                    <li><b>Thực đơn: </b></li>
                    <?php echo $this->getFoodByProgramFoodId($rows['arr_food_id']);?>
                </ul>


                <div class="abs-control">
                    <span class='actEdit' tourId="<?php echo $rows['tour_id'];?>" value="<?php echo $rows['id'];?>">sửa</span>
                    <span class='actAjax' tourId="<?php echo $rows['tour_id'];?>" act='del'  value="<?php echo $rows['id'];?>">Xóa</span>
                </div>
            </div>
            <?php

        }
    }


    public function getListItemStyle($strwhere="", $limit='', $activeTab=''){/* activeTab is set readmore item*/
        $sql="SELECT * FROM `tbl_tour_programfood` ".$strwhere." ORDER BY `tbl_tour_programfood`.`id` ASC ".$limit."";
        //var_dump($sql);
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
                $title=Substring($rows['title'],0,10);
                $content=Substring($rows['content'],0,60);
                $arr=$this->getAvatarAndNameByPositionContactId($rows['position_id']);
                $name_position=Substring($arr['name'],0,10);
                $thumb=$arr['avatar'];
                $location_code=$arr['location_code'];
                $position_code=$arr['position_code'];
                $url=ROOTHOST.$location_code."/".$position_code.".html";
                ?>

                <div class="item item-food">
                    <a href="<?php echo $url;?>" title="<?php echo $name_position;?>"><?php echo getThumb($thumb, $name_position, 'img-position');?></a>
                    <h4 class="name"><?php echo $title;?></h4>
                    <span class="txt"><span class="txt-label">Địa điểm: </span><a href="<?php echo $url;?>" class=" name-position" title="<?php echo $name_position;?>"><?php echo $name_position;?></a> </span>
                    <span class="txt time"><span class="txt-label">Thời gian: </span><?php echo $rows['time'];?></span>
                    <ul class="list-inline list-food">
                        <span class="txt-label">Thực đơn: </span>
                        <?php echo $this->getFoodByProgramFoodId($rows['arr_food_id']);?>
                    </ul>
                    <span class="txt-content txt more<?php echo $activeTab.$index;?>"><span class="txt-label">Chi tiết: </span><?php echo $content;?></span>

                </div>
                <!--<script type="text/javascript">
                    readMore('more<?php /*echo $activeTab.$index;*/?>', 10);
                </script>-->
            <?php
            }
        }
    }
 
     public function getLastId(){
        return $this->objmysql->LastInsertID();
    }
    
    public function Add_new(){
        $sql=" INSERT INTO `tbl_tour_programfood`(`tour_id`, `day_id`, `position_id`, `title`, `content`, `time`, `arr_food_id`) VALUES";
        $sql.="('".$this->TourId."', '".$this->DayId."', '".$this->PositionId."', '".$this->Title."', '".$this->Content."', '".$this->Time."', '".$this->ArrFoodId."')";
        //var_dump($sql); die;
        return $this->objmysql->Query($sql);
    }
    public function Update(){
        $sql = "UPDATE tbl_tour_programfood SET `title`='".$this->Title."', `content`='".$this->Content."', `time`='".$this->Time."', `arr_food_id`='".$this->ArrFoodId."' WHERE id='".$this->ID."'";
        return $this->objmysql->Query($sql);
        //var_dump($sql); die;
    }
    public function Delete($id){
        $sql="DELETE FROM `tbl_tour_programfood` WHERE `id` in ('$id')";
       // var_dump($sql); die();
        return $this->objmysql->Query($sql);
    }

}
?>