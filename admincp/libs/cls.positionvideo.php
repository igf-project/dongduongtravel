<?php
class CLS_POSITIONVIDEO{
    private $pro=array(
        'ID'=>'-1',
        'positionId'=>'',
        'arrVideoId'=>'',
        'isActive'=>1,
        'Order'=>1
    );
    private $objmysql=NULL;
    public function CLS_POSITIONVIDEO(){
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
        $sql="SELECT * FROM `tbl_position_video` where 1=1 ".$where.' ORDER BY `name` '.$limit;
        return $this->objmysql->Query($sql);
    }
    public function Num_rows(){
        return $this->objmysql->Num_rows();
    }
    public function Fetch_Assoc(){
        return $this->objmysql->Fetch_Assoc();
    }

    public function Add_new(){
        $sql=" INSERT INTO `tbl_position_video`(`position_id`, `arr_videoid`, `isactive`) VALUES";
        $sql.="('".$this->positionId."', '".$this->arrVideoId."', '".$this->isActive."')";
        return $this->objmysql->Exec($sql);
    }
    public function Update(){
        $sql = "UPDATE tbl_position_video SET `arr_videoid`=".$this->arrVideoId." WHERE `position_id`='".$this->positionId."'";
        return $this->objmysql->Exec($sql);
    }
    public function Delete($id){
        $sql="DELETE FROM `tbl_position_video` WHERE `position_id` in ('$id')";
        return $this->objmysql->Exec($sql);
    }
    public function setActive($ids,$status=''){
        $sql="UPDATE `tbl_position_video` SET `isactive`='$status' WHERE `id` in ('$ids')";
        if($status=='')
            $sql="UPDATE `tbl_position_video` SET `isactive`=if(`isactive`=0,1,0) WHERE `id` in ('$ids')";
        return $this->objmysql->Exec($sql);
    }

    public function youtube_image($id) {
        $resolution = array (
            'mqdefault',
            'maxresdefault',
            'sddefault',
            'hqdefault',
            'default'
        );

        for ($x = 0; $x < sizeof($resolution); $x++) {
            $url = 'http://img.youtube.com/vi/' . $id . '/' . $resolution[$x] . '.jpg';
        }
        return $url;
    }


    public function getTitle($id){
        $content = file_get_contents("http://youtube.com/get_video_info?video_id=".$id);
        parse_str($content, $ytarr);
        return $ytarr['title'];
    }


    public function getListInfoVideo($strwhere=""){
        $sql="SELECT * FROM tbl_position_video ".$strwhere."";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        while($rows=$objdata->Fetch_Assoc()){
            $arr=explode(', ', $rows['arr_videoid']);
            foreach($arr as $key => $list){
                echo '<div class="info-item">';
                echo '<img src="'.$this->youtube_image($list).'"width="150px">';
                echo '<span>'.$this->getTitle($list).'</span>';
                echo '<span class="del-item" onclick="del_itemvideo(this)" value="'.$list.'"></span>';
                echo '</div>';
            }
        }
    }


}
?>