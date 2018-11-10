<?php
class CLS_VIDEO{
    private $pro=array(
        'ID'=>'-1',
        'parId'=>'',
        'arrPath'=>'',
        'Type'=>'',
        'isActive'=>1,
        'Order'=>1
    );
    private $objmysql=NULL;
    public function CLS_VIDEO(){
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
        $sql="SELECT * FROM `tbl_video` where 1=1 ".$where.' ORDER BY `name` '.$limit;
        return $this->objmysql->Query($sql);
    }
    public function Num_rows(){
        return $this->objmysql->Num_rows();
    }
    public function Fetch_Assoc(){
        return $this->objmysql->Fetch_Assoc();
    }



    public function Add_new(){
        $sql=" INSERT INTO `tbl_video`(`par_id`, `arr_path`, `type`, `isactive`, `order`) VALUES";
        $sql.="('".$this->parId."', '".$this->arrPath."', '".$this->Type."', '".$this->isActive."', '".$this->Order."')";
        //var_dump($sql); die;
		return $this->objmysql->Exec($sql);
    }
    /*update for type ...*/
    public function Update($type=''){
        $sql = "UPDATE `tbl_video` SET `arr_path`=".$this->arrPath." WHERE par_id='".$this->parId."' AND type='".$this->Type."'";
        return $this->objmysql->Exec($sql);
    }
    public function Delete($id){
        $sql="DELETE FROM `tbl_video` WHERE `id` in ('$id')";
        return $this->objmysql->Exec($sql);
    }
    public function setActive($ids,$status=''){
        $sql="UPDATE `tbl_video` SET `isactive`='$status' WHERE `id` in ('$ids')";
        if($status=='')
            $sql="UPDATE `tbl_video` SET `isactive`=if(`isactive`=0,1,0) WHERE `id` in ('$ids')";
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
            /* if (get_headers($url)[0] == 'HTTP/1.0 200 OK') {
                 break;
             }*/
        }
        return $url;
    }


    public function getTitle($id){
        $content = file_get_contents("http://youtube.com/get_video_info?video_id=".$id);
        parse_str($content, $ytarr);
        return $ytarr['title'];
    }
    public function getListInfoVideo($strwhere=""){
        $sql="SELECT * FROM tbl_video ".$strwhere."";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        while($rows=$objdata->Fetch_Assoc()){
            $arr=explode(', ', $rows['arr_path']);
            $id=$rows['id'];
            foreach($arr as $key => $list):?>
                <div class="info-item">
                    <img src="<?php echo $this->youtube_image($list);?>" width="150px">
                    <span><?php echo $this->getTitle($list);?></span>
                    <span class="del-item" value="<?php echo $list;?>" nameid="<?php echo $id;?>"></span>
                </div>
            <?php endforeach;
        }
    }
    public function getTypeById($id){
        $sql="SELECT `type` FROM tbl_video WHERE id='$id'";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        $rows=$objdata->Fetch_Assoc();
        return $rows['type'];
    }
}
?>