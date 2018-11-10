<?php
class CLS_TOURPROGRAMSLEEP{
    private $pro=array(
        'ID'=>'',
        'TourId'=>'',
        'DayId'=>'',
        'PositionId'=>'',
        'Title'=>'',
        'Content'=>''
    );
    private $objmysql=NULL;
    public function CLS_TOURPROGRAMSLEEP(){
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
           FROM `tbl_tour_programsleep` ".$where.' ORDER BY `tbl_tour_programsleep`.`title` '.$limit;
        //var_dump($sql);
        return $this->objmysql->Query($sql);
    }
    
    public function listTable($strwhere="", $limit='', $ajax=''){
        global $rowcount;
        $sql="SELECT *
           FROM `tbl_tour_programsleep`
           ".$strwhere." ORDER BY `tbl_tour_programsleep`.`id` DESC ".$limit."";
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
    

    public function listAjax($strwhere="", $limit=''){
        global $rowcount;
        $sql="SELECT *
           FROM `tbl_tour_programsleep`
           ".$strwhere." ORDER BY `tbl_tour_programsleep`.`id` ASC ".$limit."";
        //var_dump($sql);
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        while($rows=$objdata->Fetch_Assoc()){   $rowcount++;
            $id=$rows['id'];
            $day='Ngày '.$rows['day_id'];
            $title=Substring($rows['title'],0,10);
             $content=Substring($rows['content'],0,15);
             echo "<tr name='trow' id='tr-".$id."'>";
            echo "<td width='40px' align='center'>$rowcount</td>";
            echo "<td>".$day."</td>";
            echo "<td>".$title."</td>";
           
             echo "<td  align='center'>";
            echo "<span class='actEdit' tourId=".$rows['tour_id']." value=".$id.">";
            showIconFun('edit','');
            echo "</span>";
            echo "</td>";
            echo "<td align='center'>";
            echo "<span class='actAjax' tourId=".$rows['tour_id']." act='del'  value=".$id.">";
            showIconFun('delete','');
            echo "</span>";
            echo "</td>";
            echo "</tr>";

        }
    }




    public function getAvatarAndNameByPositionContactId($positionContactId){
        $sql="SELECT `tbl_position`.`id`,
            `tbl_position`.`name`,
           `tbl_position`.`avatar`,
           `tbl_location`.`code` as `location_code`,
           `tbl_position`.`code` as `position_code`
           FROM `tbl_position`
           INNER JOIN `tbl_location`
           ON `tbl_position`.`location_id`=`tbl_location`.`id`
           WHERE `tbl_position`.`id`=$positionContactId";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        $row=$objdata->Fetch_Assoc();
        return $row;
    }

    public function getListItemForm($strwhere="", $limit=''){
        global $rowcount;
        $sql="SELECT *
           FROM `tbl_tour_programsleep`
           ".$strwhere." ORDER BY `tbl_tour_programsleep`.`id` ASC ".$limit."";
      // var_dump($sql);
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        while($rows=$objdata->Fetch_Assoc()){   $rowcount++;
            $id=$rows['id'];
            $day='Ngày '.$rows['day_id'];
            $title=Substring($rows['title'],0,10);
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
                <div class="abs-control">
                    <span class='actEdit' tourId="<?php echo $rows['tour_id'];?>" value="<?php echo $rows['id'];?>">sửa</span>
                    <span class='actAjax' tourId="<?php echo $rows['tour_id'];?>" act='del'  value="<?php echo $rows['id'];?>">Xóa</span>
                </div>
            </div>
        <?php

        }
    }

    public function getListItemStyle($strwhere="", $limit='', $activeTab=''){
        global $rowcount;
        $sql="SELECT * FROM `tbl_tour_programsleep` ".$strwhere." ORDER BY `tbl_tour_programsleep`.`id` ASC ".$limit."";
        // var_dump($sql);
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        $count=$objdata->Num_rows();
        if($count<1){
            echo '<p class="ms-empty"> Dữ liệu đang được cập nhật</p>';
        }
        else{
            while($rows=$objdata->Fetch_Assoc()){   $rowcount++;
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
                <div class="item" id='tr-<?php echo $id;?>'>
                    <a href="<?php echo $url;?>" title="<?php echo $name_position;?>"><?php echo getThumb($thumb, $name_position, 'img-position');?></a>
                    <h4 class="name"><?php echo $title;?></h4>
                    <span class="txt"><span class="txt-label">Địa điểm: </span><a class="name-position" href="<?php echo $url;?>" title="<?php echo $name_position;?>"><?php echo $name_position;?></span> </a>
                    <span class="txt-content txt"><span class="txt-label">Chi tiết: </span><?php echo $content;?></span>
                </div>
            <?php
            }
        }
    }

 
     public function getLastId(){
        return $this->objmysql->LastInsertID();
    }
    
    public function Add_new(){
        $sql=" INSERT INTO `tbl_tour_programsleep`(`tour_id`, `day_id`, `position_id`, `title`, `content`) VALUES";
        $sql.="('".$this->TourId."', '".$this->DayId."', '".$this->PositionId."', '".$this->Title."', '".$this->Content."')";
        //var_dump($sql); die;
        return $this->objmysql->Query($sql);
    }
    public function Update(){
        $sql = "UPDATE tbl_tour_programsleep SET `title`='".$this->Title."', `content`='".$this->Content."' WHERE id='".$this->ID."'";
        return $this->objmysql->Query($sql);
        //var_dump($sql); die;
    }
    public function Delete($id){
        $sql="DELETE FROM `tbl_tour_programsleep` WHERE `id` in ('$id')";
       // var_dump($sql); die();
        return $this->objmysql->Query($sql);
    }

}
?>