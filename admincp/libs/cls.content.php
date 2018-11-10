<?php
class CLS_CONTENTS{
    private $pro=array(
        'ID'=>'-1',
        'Code'=>'',
        'CatID'=>'0',
        'locationId'=>'',
        'positionId'=>'',
        'Title'=>'',
        'Intro'=>'',
        'Fulltext'=>'',
        'ThumbIMG'=>'',
        'CDate'=>'',
        'GmID'=>'',
        'Author'=>'',
        'Meta_title'=>'',
        'Meta_key'=>'',
        'Meta_desc'=>'',
        'Visited'=>'',
        'Order'=>'',
        'IsActive'=>'1');
    private $objmysql;
    public function CLS_CONTENTS(){
        $this->objmysql=new CLS_MYSQL;
    }
    // property set value
    public function __set($proname,$value){
        if(!isset($this->pro[$proname])){
            echo ($proname.' is not member of CLS_CONTENTS Class' );
            return;
        }
        $this->pro[$proname]=$value;
    }
    public function __get($proname){
        if(!isset($this->pro[$proname])){
            echo ($proname.' is not member of CLS_CONTENTS Class' );
            return '';
        }
        return $this->pro[$proname];
    }
    public function getList($strwhere="", $limit=''){
        $sql=" SELECT * FROM `tbl_content` INNER JOIN `tbl_content_text` ON `tbl_content`.`con_id`=`tbl_content_text`.`con_id` $strwhere $limit";
        return $this->objmysql->Query($sql);
    }
    public function Num_rows(){
        return $this->objmysql->Num_rows();
    }
    public function Fetch_Assoc(){
        return $this->objmysql->Fetch_Assoc();
    }
    public function getRowCount($strwhere="",$lagid=0){
        $sql=" SELECT count(*) as num FROM view_content WHERE lag_id='$lagid' $strwhere";
        $this->objmysql->Query($sql);
        return $this->objmysql->Num_rows();
    }
    public function getCatName($catid) {
        $sql="SELECT name from view_cate where cat_id='$catid'";
        $objdata=new CLS_MYSQL;
        $objdata->Query($sql);
        if($objdata->Num_rows()>0) {
            $r=$objdata->Fetch_Assoc();
            return $r['name'];
        }
    }


    public function listTable($strwhere="", $limit){
        $sql="	SELECT `tbl_content` .`con_id`, `tbl_content` .`isactive`, `tbl_content_text` .`title`, `tbl_content_text` .`intro`, `tbl_content_text` .`author` FROM `tbl_content` INNER JOIN `tbl_content_text` ON `tbl_content`.`con_id`=`tbl_content_text`.`con_id` $strwhere ORDER BY `tbl_content`.`con_id` ASC $limit";
        //echo $sql;
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        $i=0;
        while($rows=$objdata->Fetch_Assoc())
        {	$i++;
            $ids=$rows['con_id'];
            $title=Substring(stripslashes($rows['title']),0,10);
            $intro = Substring(stripslashes($rows['intro']),0,10);
            $intro = str_get_html($intro);
            $author=$rows['author'];
            echo "<tr name=\"trow\">";
            echo "<td width=\"30\" align=\"center\">$i</td>";
            echo "<td width=\"30\" align=\"center\"><label>";
            echo "<input type=\"checkbox\" name=\"chk\" id=\"chk\" 	 onclick=\"docheckonce('chk');\" value=\"$ids\" />";
            echo "</label></td>";
            echo "<td title='$intro'>$title</td>";

            echo "<td width=\"75\">$author &nbsp;</td>";


            echo "<td align=\"center\">";

            echo "<a href='".ROOTHOST."member/tin-tuc/active/$ids'>";
            showIconFun('publish',$rows['isactive']);
            echo "</a>";

            echo "</td>";
            echo "<td align=\"center\">";

            echo "<a href='".ROOTHOST."member/tin-tuc/cap-nhat/$ids'>";
            showIconFun('edit','');
            echo "</a>";

            echo "</td>";
            echo "<td align=\"center\">";

            echo "<a class='delete-item' href='".ROOTHOST."member/tin-tuc/delete/$ids'>";
            showIconFun('delete','');
            echo "</a>";

            echo "</td>";
            echo "</tr>";
        }
    }




    public  function Add_new(){
        $objdata=new CLS_MYSQL;
        $objdata->Query("BEGIN");
        $sql="INSERT INTO tbl_content (`code`,`cat_id`, `location_id`, `position_id`, `thumb_img`,`cdate`, `gmem_id`,`isactive`) VALUES ";
        $sql.="('".$this->Code."','".$this->CatID."', '".$this->locationId."', '".$this->positionId."', '".$this->ThumbIMG."', NOW(),'".$this->GmID."','".$this->IsActive."')";
        //var_dump($sql);
        $result=$objdata->Exec($sql);
        $ids=$objdata->LastInsertID();
        $sql="INSERT INTO tbl_content_text (`con_id`,`intro`,`title`,`fulltext`,`author`,`meta_title`,`meta_key`,`meta_desc`) VALUES";
        $sql.="('$ids','".$this->Intro."','".$this->Title."','";
        $sql.=$this->Fulltext."','".$this->Author."','".$this->Meta_title."','".$this->Meta_key."','".$this->Meta_desc."')";
        $result1=$objdata->Query($sql);
        if($result && $result1 ){
            $objdata->Query('COMMIT');
            return $result;
        }
        else
            $objdata->Query('ROLLBACK');
    }
    function Update(){
        $objdata=new CLS_MYSQL;
        $objdata->Query("BEGIN");
        $sql="UPDATE tbl_content SET `code`='".$this->Code."',
									 `cat_id`='".$this->CatID."', 
									 `location_id`='".$this->locationId."', 
									 `position_id`='".$this->positionId."', 
									 `thumb_img`='".$this->ThumbIMG."',
									 `gmem_id`='".$this->GmID."',
									 `isactive`='".$this->IsActive."' 
								WHERE `con_id`='".$this->ID."'";
        //var_dump($sql);
        $result = $objdata->Query($sql);
        $sql="UPDATE tbl_content_text SET `title`='".$this->Title."',
										  `intro`='".$this->Intro."',
										  `fulltext`='".$this->Fulltext."',
										  `meta_title`='".$this->Meta_title."',
									      `meta_key`='".$this->Meta_key."',
									      `meta_desc`='".$this->Meta_desc."',										
										  `author`='".$this->Author."'
								WHERE `con_id`='".$this->ID."'";
        //var_dump($sql);die();
        $result1 = $objdata->Query($sql);


        if($result && $result1 ){
            $objdata->Query('COMMIT');
            return $result;
        }
        else
            $objdata->Query('ROLLBACK');
    }
    function Delete($ids){
        $objdata=new CLS_MYSQL;
        $objdata->Query("BEGIN");
        $sql="DELETE FROM `tbl_content` WHERE `con_id` in ('$ids')";
        $result=$objdata->Query($sql);
        $sql="DELETE FROM `tbl_content_text` WHERE `con_id` in ('$ids')";
        $result1=$objdata->Query($sql);
        //var_dump($sql);die();
        if($result && $result1 ){
            $objdata->Query('COMMIT');
            return $result;
        }else
            $objdata->Query('ROLLBACK');
    }
    function setActive($ids,$status=''){
        $sql="UPDATE `tbl_content` SET `isactive`='$status' WHERE `con_id` in ('$ids')";
        if($status=='')
            $sql="UPDATE `tbl_content` SET `isactive`=if(`isactive`=1,0,1) WHERE `con_id` in ('$ids')";
        return $this->objmysql->Exec($sql);
    }
    function setHot($ids,$status=''){
        $sql="UPDATE `tbl_content` SET `isHot`='$status' WHERE `con_id` in ('$ids')";
        if($status=='')
            $sql="UPDATE `tbl_content` SET `isHot`=if(`isHot`=1,0,1) WHERE `con_id` in ('$ids')";
        return $this->objmysql->Exec($sql);
    }
    function Order($ids,$order){
        $objdata=new CLS_MYSQL;
        $sql="UPDATE tbl_content SET `order`='".$order."' WHERE `con_id`='".$ids."'";
        $objdata->Query($sql);
    }
    function Orders($arids,$arods){
        for($i=0;$i<count($arids);$i++){
            $this->Order($arids[$i],$arods[$i]);
        }
    }

    //get list style item
    public function getListItem($strwhere="", $limit="", $location='', $viewtype=''){
        $sql="SELECT `tbl_content`.`con_id`, `tbl_content`.`code`, `tbl_content`.`thumb_img`, `tbl_content`.`cdate`,
				`tbl_content_text`.`title`, `tbl_content_text`.`intro`, `tbl_content_text`.`author`
			FROM `tbl_content` 
			INNER JOIN `tbl_content_text` ON `tbl_content`.`con_id`=`tbl_content_text`.`con_id` ".$strwhere." ORDER BY `tbl_content_text`.`con_id` DESC";
        //var_dump($sql);
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        while($rows=$objdata->Fetch_Assoc()):

            $intro=strip_tags(Substring($rows['intro'], 0, 20));
            if($location AND $viewtype)
                $url=ROOTHOST.$location."/kham-pha/".$viewtype."/".$rows['code'].".html";
            else
                $url=ROOTHOST."tin-tuc/chi-tiet/".$rows['code'].".html";
            $date = date("d-m-Y", strtotime($rows['cdate']));
            $title=Substring($rows['title'], 0, 20);
            ?>
            <div class="col-md-6 col-sm-6 item">
                <div class="col-item">
                    <?php echo getThumb($rows['thumb_img'],$rows['title'], 'thumb', '200px', '160px');?>
                    <h4 class="name"><a href="<?php echo $url;?>" title="<?php echo $rows['title'];?>"><?php echo $title;?></a></h4>
                    <span class="author">By: <?php echo $rows['author'];?></span>
                    <p class="intro"><?php echo $intro;?></p>
						<span class="date">
							<?php echo $date;?>
						</span>
                    <a class="btn-readmore" href="<?php echo $url;?>">Chi tiết</a>
                </div>
            </div>
        <?php endwhile;?>
    <?php }

    // hàm lấy danh sách tin theo dang slider
    public function getListItemSlider($strwhere="", $limit=""){
        global $stt;
        $sql="SELECT `tbl_content`.`con_id`, `tbl_content`.`code`, `tbl_content`.`thumb_img`, `tbl_content`.`cdate`,
				`tbl_content_text`.`title`, `tbl_content_text`.`intro`, `tbl_content_text`.`author`
			FROM `tbl_content`
			INNER JOIN `tbl_content_text` ON `tbl_content`.`con_id`=`tbl_content_text`.`con_id` ".$strwhere." ORDER BY `tbl_content_text`.`con_id` DESC $limit";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        $lastRecord=$objdata->Num_rows();
        while($rows=$objdata->Fetch_Assoc()):
            $stt++;
            $title=Substring($rows['title'], 0, 8);
            $intro=strip_tags(Substring($rows['intro'], 0, 20));
            $url=ROOTHOST."tin-tuc/chi-tiet/".$rows['code'].".html";
            $date = date("d-m-Y", strtotime($rows['cdate']));
            ?>
            <?php if ($stt % 4 == 1): ?>
            <div class="swiper-slide">
            <div class="box">
        <?php endif;?>
            <div class="col-md-3 col-sm-3 col-xs-6 tour">
                <a href="<?php echo $url;?>" title="<?php echo $rows['title'];?>"><?php echo getThumb($rows['thumb_img'],$rows['title'], 'img-responsive', '300px', '150px');?></a>
                <div class="tour-content">
                    <h3><i class="fa fa-map-marker"></i><span><a href="<?php echo $url;?>" title="<?php echo $rows['title'];?>"><?php echo $title;?></a></span></h3>
                    <div class="intro"><?php echo $intro;?></div>
                    <div class="box">
                        <img src="https://graph.facebook.com/894479910619616/picture?type=large" class="user_avar pull-left" width="50">
                        <div class="pull-left">
                            <div class="author">Thuy Nguyen</div>
                            <div class="cdate">1 ngày trước</div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <?php if ($stt % 4 == 0 || $stt == $lastRecord): ?>
            </div>
            </div>
        <?php endif;?>
        <?php endwhile;
    }





    //get list content relate box mod
    public function getListMod($strwhere="", $limit="", $location='', $viewtype=''){
        $sql="SELECT `tbl_content`.`con_id`, `tbl_content`.`code`, `tbl_content`.`thumb_img`, `tbl_content`.`cdate`,
				`tbl_content_text`.`title`, `tbl_content_text`.`intro`, `tbl_content_text`.`author`
			FROM `tbl_content` 
			INNER JOIN `tbl_content_text` ON `tbl_content`.`con_id`=`tbl_content_text`.`con_id` ".$strwhere." ORDER BY `tbl_content_text`.`con_id` DESC $limit";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        while($rows=$objdata->Fetch_Assoc()):

            $intro=strip_tags(Substring($rows['intro'], 0, 22));
            $url=ROOTHOST.$location."/kham-pha/".$viewtype."/".$rows['code'].".html";
            $date = date("d-m-Y", strtotime($rows['cdate']));
            ?>
            <div class="col-item">
                <?php echo getThumb($rows['thumb_img'],$rows['title'], 'thumb', '120px', '90px');?>
                <h4 class="name">
                    <a href="<?php echo $url;?>" title="<?php echo $rows['title'];?>">
                        <?php echo $rows['title'];?>
                        <span class="date">
							(<?php echo $date;?>)
						</span>
                    </a>

                </h4>

                <p class="intro"><?php echo $intro;?></p>

            </div>
        <?php endwhile;?>
    <?php }

    //get list content relate box mod
    public function getListModItem($strwhere="", $limit=""){
        $sql="SELECT `tbl_content`.`con_id`, `tbl_content`.`code`, `tbl_content`.`thumb_img`, `tbl_content`.`cdate`,
				`tbl_content_text`.`title`, `tbl_content_text`.`intro`, `tbl_content_text`.`author`
			FROM `tbl_content`
			INNER JOIN `tbl_content_text` ON `tbl_content`.`con_id`=`tbl_content_text`.`con_id` ".$strwhere." ORDER BY `tbl_content_text`.`con_id` DESC $limit";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        while($rows=$objdata->Fetch_Assoc()):
            $intro=strip_tags(Substring($rows['intro'], 0, 22));
            $url=ROOTHOST."tin-tuc/chi-tiet/".$rows['code'].".html";
            $date = date("d-m-Y", strtotime($rows['cdate']));
            ?>
            <div class="col-item">
                <?php echo getThumb($rows['thumb_img'],$rows['title'], 'thumb', '120px', '90px');?>
                <h4 class="name">
                    <a href="<?php echo $url;?>" title="<?php echo $rows['title'];?>">
                        <?php echo $rows['title'];?>
                        <span class="date">
							(<?php echo $date;?>)
						</span>
                    </a>
                </h4>
            </div>
        <?php endwhile;?>
    <?php }

    public function listTableContentRelate($strwhere="", $del="", $par_id=""){
        $sql="SELECT * FROM `tbl_content_text` WHERE ".$strwhere." ORDER BY `con_id` DESC";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        $i=0;
        while($rows=$objdata->Fetch_Assoc())
        {	$i++;
            $ids=$rows['con_id'];
            $title=Substring(stripslashes($rows['title']),0,10);
            //include_once("../../../includes/simple_html_dom.php");
            $intro = Substring(stripslashes($rows['intro']),0,10);
            //$intro = str_get_html($intro);
            $author=$rows['author'];
            ?>
            <tr class="">
                <?php
                echo "<td width=\"30\" align=\"center\">$i</td>";

                if(!$del):
                    echo "<td width=\"30\" align=\"center\"><label>";
                    echo "<input type=\"checkbox\" name=\"chk[]\" id=\"chk\" 	 onclick=\"docheckonce('chk');\" value=\"$ids\" />";
                    echo "</label></td>";
                endif;

                echo "<td title='$title'>$title</td>";
                echo "<td width=\"75\">$author &nbsp;</td>";
                ?>
                <?php if($del):?>
                    <td><span class="btn-del-relate" value="<?php echo $ids;?>" txt_parid="<?php echo $par_id;?>"></span></td>
                <?php else:?>
                    <!--<td><span class="btn-add-relate btn-primary">Add</span> </td>-->
                <?php endif;?>
            </tr>
        <?php
        }
    }
    public function getListAddRelate($strwhere="", $del="", $positionId=""){
        $sql="SELECT * FROM `tbl_content_text` WHERE ".$strwhere." ORDER BY `con_id` DESC";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        $i=0;
        while($rows=$objdata->Fetch_Assoc())
        {	$i++;
            $ids=$rows['con_id'];
            $title=Substring(stripslashes($rows['title']),0,10);
            //include_once("../../../includes/simple_html_dom.php");
            $intro = Substring(stripslashes($rows['intro']),0,10);
            //$intro = str_get_html($intro);
            $author=$rows['author'];
            ?>
            <tr class="">
                <?php
                echo "<td width=\"30\" align=\"center\">$i</td>";

                if(!$del):
                    echo "<td width=\"30\" align=\"center\"><label>";
                    echo "<input type=\"checkbox\" name=\"chk[]\" id=\"chk\" 	 onclick=\"docheckonce('chk');\" value=\"$ids\" />";
                    echo "</label></td>";
                endif;

                echo "<td title='$title'>$title</td>";
                echo "<td width=\"75\">$author &nbsp;</td>";
                ?>
                <?php if($del):?>
                    <td><span class="btn-del-relate" value="<?php echo $ids;?>" txt_position_id="<?php echo $positionId;?>"></span> </td>
                <?php else:?>
                    <!--<td><span class="btn-add-relate btn-primary">Add</span> </td>-->
                <?php endif;?>
            </tr>
        <?php
        }
    }
}
?>
