<?php
class CLS_GALLERY{
	private $pro=array( 'ID'=>'-1',
                         'GroupID'=>'',
                         'Name'=>'',
                         'Intro'=>'',
                         'Code'=>'',
                         'Cdate'=>'',
                         'isActive'=>'',
						'GAlbumID'=>'',
						'GLink'=>'',
						'GisActive'=>1);
	private $objmysql=NULL;
	public function CLS_GALLERY(){
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
	public function getListAlbum($where='',$limit=''){
		$sql="SELECT * FROM `tbl_album` ".$where.' ORDER BY id DESC'.$limit;
		return $this->objmysql->Query($sql);
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	function listAlbum($curid=0) {
		$sql="SELECT id,name FROM tbl_album WHERE isactive=1 ORDER BY id DESC";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		while($rows=$objdata->Fetch_Assoc())
		{
			if($rows['id']== $curid)
				echo '<option value="'.$rows['id'].'" selected="selected">'.$rows['name'].'</option>';
			else echo '<option value="'.$rows['id'].'">'.$rows['name'].'</option>';
		}
	}
    function getThumbByAlbum($album_id){
        $sql="SELECT * FROM `tbl_gallery` WHERE album_id='$album_id'";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        $rows=$objdata->Fetch_Assoc();
        $img=$rows['link'];
        if($img!=''){
            $img = strpos($img,'http')!==false?$img:ROOTHOST_FRONTEND.PATH_GALLERY_REVIEW.$img;

        }
        else $img=THUMB_DEFAULT;
        $img = '<img src="'.$img.'" height="45" width="80"/>';
        return $img;
    }
	function listTable($strwhere="",$page=1){
		$star=0; if($page>1) $star=($page-1)*MAX_ROWS;
		$leng=MAX_ROWS;
		$sql="SELECT * FROM `tbl_album` $strwhere ORDER BY `id` DESC LIMIT $star,$leng";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		$i=0;
		while($rows=$objdata->Fetch_Assoc())
		{	$i++;
			$id=$rows['id'];
			$order=$rows['order'];
			$ablum=Substring(stripslashes($rows['name']),0,10);
            $img=$this->getThumbByAlbum($id);
            //echo $img;
          /*  if($img!='') {
				$img = strpos($img,'http')!==false?$img:'http://'.$_SERVER['HTTP_HOST'].$img;
				$img = '<img src="'.$img.'" height="80" width="42"/>';
			}*/
            $intro=Substring(stripslashes($rows['intro']),0,20);
			echo "<tr name='trow'>";
			echo "<td width='30' align='center'>$i</td>";
			echo "<td width='30' align='center'><label>";
			echo "<input type='checkbox' name='chk' id='chk' onclick='docheckonce(\"chk\");' value='$id' />";
			echo "</label></td>";
            echo '<td align="center">'.$img."</td>";
			echo "<td>$ablum</td>";

			echo "<td>$intro &nbsp;</td>";
            echo "<td width=\"50\" align=\"center\"><input type=\"text\" name=\"txt_order\" id=\"txt_order\" value=\"$order\" size=\"4\" class=\"order\"></td>";
			echo "<td width='50' align='center'>";
				echo "<a href='index.php?com=".COMS."&amp;task=active&amp;id=$id'>";
				showIconFun('publish',$rows["isactive"]);
				echo "</a>";
			echo "</td>";
			echo "<td width='50' align='center'>";
				echo "<a href='index.php?com=".COMS."&amp;task=edit&amp;id=$id'>";
				showIconFun('edit','');
				echo "</a>";
			echo "</td>";
			echo "<td width='50' align='center'>";
				echo "<a href='javascript:detele_field(\"index.php?com=".COMS."&amp;task=delete&amp;id=$id\")'>";
				showIconFun('delete','');
				echo "</a>";
			echo "</td>";
		  	echo "</tr>";
		}
	}
    function Add_new(){
        $sql=" INSERT INTO `tbl_album`(`name`,`group_id`,`code`,`cdate`,`intro`,`isactive`) VALUES";
        $sql.="('".$this->Name."', '".$this->GroupID."', '".$this->Code."','".$this->Cdate."','".$this->Intro."','1')";
        $this->objmysql->Exec($sql);
        return $this->objmysql->LastInsertID();

    }
    function Add_new_gallery(){
        $sql=" INSERT INTO `tbl_gallery`(`album_id`,`link`,`isactive`) VALUES";
        $sql.="('".$this->GAlbumID."','".$this->GLink."','".$this->GisActive."')";
        if($this->objmysql->Exec($sql)==true){
            $this->objmysql->Exec($sql);
            return $this->objmysql->LastInsertID();
        }
        else return '';
    }
	function Update(){
		$sql = "UPDATE tbl_album SET `name`='".$this->Name."',`code`='".$this->Code."',`intro`='".$this->Intro."',`group_id`='".$this->GroupID."' WHERE id='".$this->ID."'";
		return $this->objmysql->Exec($sql);
	}
	function setActive($ids,$status=''){
		$sql="UPDATE `tbl_album` SET `isactive`='$status' WHERE `id` in ('$ids')";
		if($status=='')
			$sql="UPDATE `tbl_album` SET `isactive`=if(`isactive`=1,0,1) WHERE `id` in ('$ids')";
		return $this->objmysql->Exec($sql);
	}
    function DeleteGallery($id){
        $sql="DELETE FROM `tbl_gallery` WHERE `id` in ('$id')";
        $this->objmysql->Exec($sql);
    }
	function Delete($id){
		$sql="DELETE FROM `tbl_album` WHERE `id` in ('$id')";
		$this->objmysql->Exec($sql);
        $sql="DELETE FROM `tbl_gallery` WHERE `album_id` in ('$id')";
		$this->objmysql->Exec($sql);
	}
    public function getListGallery($strwhere="", $path=""){
        $sql="SELECT * FROM `tbl_gallery` ".$strwhere."";
        //var_dump($sql);
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        while($rows=$objdata->Fetch_Assoc()){
            $id=$rows['id'];
            $path=$rows['link'];
            $name=Substring(stripslashes($rows['name']),0,4);
            $url="index.php?com=gallery&task=delete&id='$id'";
            ?>
            <div class="info-item">
                <img src="<?php echo ROOTHOST.PATH_GALLERY.$path;?>" width="150px">
                <div class="name"><?php echo $name;?></div>
                <div class="del-item" value="<?php echo $id;?>"></div>
            <!--<a href="<?php /*echo $url;*/?>" class="del-item"></a>-->
            </div>
           <?php
        }
    }
    public function Orders($arr_id,$arr_quan){
        $n=count($arr_id);
        for($i=0;$i<$n;$i++){
            $sql="UPDATE `tbl_album` SET `order`='".$arr_quan[$i]."' WHERE `id` = '".$arr_id[$i]."' ";
            $this->objmysql->Exec($sql);
        }
    }
}
?>