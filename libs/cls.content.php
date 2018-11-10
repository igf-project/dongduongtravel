<?php
class CLS_CONTENTS{
    private $objmysql;
    public function CLS_CONTENTS(){
        $this->objmysql=new CLS_MYSQL;
    }
    public function getList($strwhere="", $limit=''){
        $sql=" SELECT * FROM `tbl_contents` $strwhere $limit";
        return $this->objmysql->Query($sql);
    }
    public function Num_rows(){
        return $this->objmysql->Num_rows();
    }
    public function Fetch_Assoc(){
        return $this->objmysql->Fetch_Assoc();
    }

    public function getCount($strwhere){
        $sql=" SELECT count(*) AS 'num' FROM `tbl_contents` $strwhere";
        $objdata= new CLS_MYSQL();
        $objdata->Query($sql);
        $rows = $objdata->Fetch_Assoc();
        return $rows['num'];
    }

    //get list style item
    public function getListItem($strwhere="", $limit="", $location='', $viewtype=''){
        $sql="SELECT `id`, `code`, `thumb`, `cdate`,`title`, `intro`, `author` FROM `tbl_contents` ".$strwhere." ORDER BY `cdate` DESC ".$limit;
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
                    <?php echo getThumb($rows['thumb'],$rows['title'], 'thumb', '200px', '160px');?>
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
        $sql="SELECT `tbl_contents`.`id`, `tbl_contents`.`code`, `tbl_contents`.`thumb`, `tbl_contents`.`cdate`,`tbl_contents`.`title`, `tbl_contents`.`intro`, `tbl_contents`.`author` FROM `tbl_contents` ".$strwhere." ORDER BY `id` DESC $limit";
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
                <a href="<?php echo $url;?>" title="<?php echo $rows['title'];?>"><?php echo getThumb($rows['thumb'],$rows['title'], 'img-responsive', '300px', '150px');?></a>
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
        $sql="SELECT `tbl_contents`.`id`, `tbl_contents`.`code`, `tbl_contents`.`thumb`, `tbl_contents`.`cdate`,
				`tbl_content_text`.`title`, `tbl_content_text`.`intro`, `tbl_content_text`.`author`
			FROM `tbl_content` 
			INNER JOIN `tbl_content_text` ON `tbl_content`.`id`=`tbl_content_text`.`id` ".$strwhere." ORDER BY `tbl_content_text`.`id` DESC $limit";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        while($rows=$objdata->Fetch_Assoc()):

            $intro=strip_tags(Substring($rows['intro'], 0, 22));
            $url=ROOTHOST.$location."/kham-pha/".$viewtype."/".$rows['code'].".html";
            $date = date("d-m-Y", strtotime($rows['cdate']));
            ?>
            <div class="col-item">
                <?php echo getThumb($rows['thumb'],$rows['title'], 'thumb', '120px', '90px');?>
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
        $sql="SELECT * FROM `tbl_contents` ".$strwhere." ORDER BY `cdate` DESC $limit";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        while($rows=$objdata->Fetch_Assoc()):
            $intro=strip_tags(Substring($rows['intro'], 0, 22));
            $url=ROOTHOST."tin-tuc/chi-tiet/".$rows['code'].".html";
            $date = date("d-m-Y", strtotime($rows['cdate']));
            ?>
            <div class="col-item">
                <?php echo getThumb($rows['thumb'],$rows['title'], 'thumb', '120px', '90px');?>
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
        $sql="SELECT * FROM `tbl_content_text` WHERE ".$strwhere." ORDER BY `id` DESC";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        $i=0;
        while($rows=$objdata->Fetch_Assoc())
        {	$i++;
            $ids=$rows['id'];
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
        $sql="SELECT * FROM `tbl_content_text` WHERE ".$strwhere." ORDER BY `id` DESC";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        $i=0;
        while($rows=$objdata->Fetch_Assoc())
        {	$i++;
            $ids=$rows['id'];
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
