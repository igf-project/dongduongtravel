<?php
class CLS_BOOKING{
    private $pro=array(
        'ID'=>'-1',
        // 'ParID'=>'0',
        'Time'=>'',
        'NumberPeople'=>'',
        'NumberTable'=>'',
        'Location'=>'',
        'Email'=>'',
        'Phone'=>'',
        'Type'=>'',
        'isActive'=>1);
    private $objmysql=null;
    public function CLS_BOOKING(){
        $this->objmysql=new CLS_MYSQL;
    }
    public function __set($proname,$value){
        if(!isset($this->pro[$proname])){
            echo ("Can not found $proname member");
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
    public function getList($where=' ',$limit=' '){
        $sql="SELECT * FROM `tbl_booking_food` WHERE 1=1 ".$where.$limit;
        // echo $sql;
        return $this->objmysql->Query($sql);
    }
    public function Num_rows(){
        return $this->objmysql->Num_rows();
    }
    public function Fetch_Assoc(){
        return $this->objmysql->Fetch_Assoc();
    }
    // public function getNameById($id){
    // 	$sql="SELECT `name` FROM `tbl_vendor` WHERE `isactive`=1 AND `id`=$id";
    // 	// echo $sql;
    // 	$objmysql=new CLS_MYSQL;
    // 	$objmysql->Query($sql);
    // 	$row=$objmysql->Fetch_Assoc();
    // 	return $row['name'];
    // }

    public function Add_new(){
        $sql="INSERT INTO `tbl_booking_food` (`time`,`number_people`, `number_table`, `location`, `email`, `phone`, `type`, `isactive`) VALUES ";
        $sql.="('".$this->Time."','".$this->NumberPeople."','".$this->NumberTable."','".$this->Location."','".$this->Email."','".$this->Phone."','";

        $sql.=$this->Type."','".$this->isActive."')";
        echo $sql;
        return $this->objmysql->Exec($sql);
    }
    public function listTable($strwhere="",$page){
        $star=($page-1)*MAX_ROWS;
        $leng=MAX_ROWS;
        $sql="SELECT * FROM tbl_booking_food $strwhere ORDER BY `id` DESC LIMIT $star,$leng";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);	$i=0;
        while($rows=$objdata->Fetch_Assoc())
        {	$i++;
            $ids=$rows['id'];
            $fullname=$rows['fullname'];
            $email=$rows['email'];
            $phone=$rows['phone'];
            $number=$rows['number_people'];
            $number_table=$rows['number_table'];
            $location=$rows['location'];
            $time=$date = gmdate("d/m/Y H:i A", $rows['time'] + 7*3600);
            echo "<tr name=\"trow\">";
            echo "<td width=\"30\" align=\"center\">$i</td>";
            echo "<td width=\"30\" align=\"center\"><label>";
            echo "<input type=\"checkbox\" name=\"chk\" id=\"chk\" 	 onclick=\"docheckonce('chk');\" value=\"$ids\" />";
            echo "</label></td>";
            echo "<td title=''>$fullname</td>";
            echo "<td title=''>$phone</td>";
            echo "<td title=''>$email</td>";
            echo "<td title=''>$number</td>";
            echo "<td title=''>$number_table</td>";
            echo "<td title=''>$location</td>";
            echo "<td title=''>$time</td>";
            echo "<td align=\"center\">";
            echo "<a href=\"javascript:detele_field('index.php?com=".COMS."&amp;task=delete&amp;id=$ids')\" >";
            showIconFun('delete','');
            echo "</a>";
            echo "</td>";
            echo "</tr>";
        }
    }

    public function Update(){
        $sql="UPDATE `tbl_booking_food` SET
				
				`time`='".$this->Time."',
				`number_people`='".$this->NumberPeople."',
				`number_table`='".$this->NumberTable."',
				`location`='".$this->Location."',
				`email`='".$this->Email."',
				`phone`='".$this->Phone."',	
				`type`='".$this->Type."',
				`isactive`='".$this->isActive."'
		WHERE `id`='".$this->ID."'";
        // echo $sql;
        return $this->objmysql->Exec($sql);
    }
    function Order($arr_id,$arr_quan){
        $n=count($arr_id);
        for($i=0;$i<$n;$i++){
            $sql="UPDATE `tbl_booking_food` SET `order`='".$arr_quan[$i]."' WHERE `id` = '".$arr_id[$i]."' ";
            // echo $sql."<br/>";
            $this->objmysql->Exec($sql);
        }
    }
    function setActive($ids,$status=''){
        $sql="UPDATE `tbl_booking_food` SET `isactive`='$status' WHERE `id` in ('$ids')";
        if($status=='')
            $sql="UPDATE `tbl_booking_food` SET `isactive`=if(`isactive`=1,0,1) WHERE `id` in ('$ids')";
        return $this->objmysql->Exec($sql);
    }
    function Delete($id){
        $sql="DELETE FROM `tbl_booking_food` WHERE `id` in ('$id')";
        return $this->objmysql->Exec($sql);
    }
}
?>