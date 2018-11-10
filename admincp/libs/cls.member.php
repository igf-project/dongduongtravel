<?php
class CLS_MEMBER extends CLS_MYSQL{
	private $objmysql=null;
	var $pro_mem=array(
		"ID"=>"-1",
		"UserName"=>"",
		"Password"=>"",
		"Uid"=>"",
		"Driver"=>"",
		"FirstName"=>"",
		"LastName"=>"",
		"Brithday"=>"",
		"Gender"=>"",
		"Address"=>"",
		"Phone"=>"",
		"Mobile"=>"",
		"CMTND"=>"",
		"Avartar"=>"",
		"Email"=>"",
		"Joindate"=>"",
		"LastLogin"=>"",
		"Gmember"=>"",
		"isActive"=>"1"
		);
	var $num_rows;
	public function CLS_MEMBER(){
		$this->Joindate=date("Y-m-d h:i:s");
		$this->LastLogin=date("Y-m-d h:i:s");
		$this->objmysql=new CLS_MYSQL;
	}
	// property set value
	public function __set($proname,$value){
		if(!isset($this->pro_mem[$proname])){
			echo ($proname.' is not member of CLS_MEMBER Class' );
			return;
		}
		$this->pro_mem[$proname]=$value;
	}
	public function __get($proname){
		if(!isset($this->pro_mem[$proname])){
			echo ($proname.' is not member of CLS_MEMBER Class' );
			return '';
		}
		return $this->pro_mem[$proname];
	}
	function getList($where='',$limit){
		$sql='SELECT * FROM `tbl_member` '.$where.$limit;
		return $this->objmysql->Query($sql);
	}
	function getCount($where='',$limit=''){
		$sql='SELECT COUNT(*) as `number` FROM `tbl_member` '.$where.$limit;
		$objdata = new CLS_MYSQL();
		$row = $objdata->Fetch_Assoc();
		return $row['number'];
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	public function listTable($strwhere="",$page){
		$star=($page-1)*MAX_ROWS;
		$leng=MAX_ROWS;
		$sql="SELECT * FROM tbl_member WHERE 1=1 $strwhere ORDER BY `mem_id` DESC LIMIT $star,$leng";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);	$i=0;
		while($rows=$objdata->Fetch_Assoc()){	
			$i++;
			$ids=$rows['mem_id'];
			$fullname=stripslashes($rows["lastname"].' '.$rows["firstname"]);
			$username=stripslashes($rows["username"]);
			$address=stripslashes($rows["address"]);
			$phone=stripslashes($rows["phone"]);
			$email=stripslashes($rows["email"]);
			$joindate=date('d/m/Y H:i:s',strtotime($rows["joindate"]));
			$lastlogin=date('d/m/Y H:i:s',strtotime($rows["lastlogin"]));

			echo "<tr name=\"trow\">";
			echo "<td width=\"30\" align=\"center\">$i</td>";
			echo "<td width=\"30\" align=\"center\"><label>";
			echo "<input type=\"checkbox\" name=\"chk\" id=\"chk\" onclick=\"docheckonce('chk');\" value=\"$ids\" />";
			echo "</label></td>";
			echo "<td>$fullname</td>";
			echo "<td>$username</td>";
			echo "<td>$address</td>";
			echo "<td>$phone</td>";
			echo "<td>$email</td>";
			echo "<td align=\"center\">";
			echo "<a href=\"index.php?com=".COMS."&amp;task=active&amp;id=$ids\">";
			showIconFun('publish',$rows['isactive']);
			echo "</a>";

			echo "</td>";
			echo "<td align=\"center\">";

			echo "<a href=\"index.php?com=".COMS."&amp;task=edit&amp;id=$ids\">";
			showIconFun('edit','');
			echo "</a>";

			echo "</td>";
			echo "<td align=\"center\">";

			echo "<a href=\"javascript:detele_field('index.php?com=".COMS."&amp;task=delete&amp;id=$ids')\" >";
			showIconFun('delete','');
			echo "</a>";

			echo "</td>";
			echo "</tr>";
		}
	}
	function LOGIN($user,$pass){
		$flag=true;
		$user=str_replace(" ","",$user);
		$user=str_replace("'","",$user);
		$pass=md5(sha1($pass));
		if($user=="" || $pass=="")
			$flag=false;
		$sql="SELECT * FROM `tbl_member` WHERE `username`='$user'";
		// echo $sql;die;
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		if($objdata->Numrows()>0)
		{
			$rows=$objdata->FetchArray();
			if($rows["password"]!=$pass)
			{
				$flag=false;
			}
		}
		else{
			$flag=false;
		}
		if($flag==true)
		{
			$_SESSION["ISMEMBERLOGIN"]=true;
			$_SESSION["IGFMEMBERLOGIN"]=$user;
			
			$_SESSION["IGFMEMBERID"]=$rows["mem_id"];
			$_SESSION["IGFMEMBERNAME"]=$rows["username"];
			$this->updateLogin($user,1);
		}
		return $flag;
	}
	function isLogin(){
		if(isset($_SESSION["ISMEMBERLOGIN"]))
			$this->autoLogout($_SESSION["IGFMEMBERLOGIN"]);
		if(isset($_SESSION["ISMEMBERLOGIN"]) && $_SESSION["ISMEMBERLOGIN"]==true)
		{
			$this->updateLogin($_SESSION["IGFMEMBERLOGIN"],1);
			return true;
		}
		else
			return false;
	}
	function LOGOUT(){
		$this->updateLogin($_SESSION["IGFMEMBERLOGIN"],0);
		$_SESSION["ISMEMBERLOGIN"]=false;
		unset($_SESSION["ISMEMBERLOGIN"]);
		unset($_SESSION["IGFMEMBERLOGIN"]);
		unset($_SESSION["IGFMEMBERID"]);
		unset($_SESSION["IGFMEMBERNAME"]);
	}
	function updateLogin($user,$flag){
		$value="";
		if($flag==1)
			$value=date("Y-m-d h:i:s");
		$sql="UPDATE `tbl_member` SET `lastLogin`='$value' WHERE `username`='$user'";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
	}
	function autoLogout($user){
		if(!isset($user)||$user=="")
			return;
		$sql="SELECT `lastlogin` FROM `tbl_member` WHERE `username`=\"$user\" ";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		$rows=$objdata->FetchArray();
		if($rows["lastlogin"]=="")
			return;
		$s=date("i")-date("i",strtotime($rows["lastlogin"]));
		//echo ($s);
		if($s>=60 || $s<-60){
			$this->LOGOUT();
			echo "<p align=\"center\">Hệ thống tự động đăng xuất sau 60 phút. Bạn vui lòng đăng nhập lại.</p>";
		}
		return;
	}
	function getMemberByID($memid){
		$sql="SELECT * FROM `tbl_member` WHERE `mem_id`=\"$memid\" ";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		if($objdata->Numrows()>0){
			$rows=$objdata->FetchArray();
			$this->pro_mem["ID"]=$rows["mem_id"];
			$this->pro_mem["UserName"]=$rows["username"];
			$this->pro_mem["Password"]=$rows["password"];
			$this->pro_mem["FirstName"]=$rows["firstname"];
			$this->pro_mem["LastName"]=$rows["lastname"];
			$this->pro_mem["Birthday"]=$rows["birthday"];
			$this->pro_mem["Gender"]=$rows["gender"];
			$this->pro_mem["Address"]=$rows["address"];
			$this->pro_mem["Location"]=$rows["location"];
			$this->pro_mem["Phone"]=$rows["phone"];
			$this->pro_mem["Mobile"]=$rows["mobile"];
			$this->pro_mem["Email"]=$rows["email"];
			$this->pro_mem["Joindate"]=$rows["joindate"];
			$this->pro_mem["LastLogin"]=$rows["lastlogin"];
			$this->pro_mem["Gmember"]=$rows["gmem_id"];
			$this->pro_mem["isActive"]=$rows["isactive"];
		}
	}
	function getUsernameByID($memid){
		$sql="SELECT username FROM `tbl_member` WHERE `mem_id`=\"$memid\" ";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		$rows=$objdata->Fetch_Assoc();
		return $rows['username'];
	}
	function getAllList($where=""){
		$sql="SELECT * FROM `tbl_member` ".$where;
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		$this->num_rows=$objdata->Numrows();
	}
	function Numrows() { 
		return $this->num_rows;
	}
	function Add_new(){
		$sql="INSERT INTO `tbl_member`(`username`,`password`,`firstname`,`lastname`,`birthday`,`gender`,`address`,`phone`,`mobile`,`email`,`joindate`,`gmem_id`,`cmtnd`,`isactive`) VALUES ";
		$sql.=" (\"".$this->pro_mem["UserName"]."\",\"".md5(sha1($this->pro_mem["Password"]))."\",\"".$this->pro_mem["FirstName"]."\",\"".$this->pro_mem["LastName"]."\",\"".$this->pro_mem["Brithday"]."\",\"".$this->pro_mem["Gender"]."\",\"".$this->pro_mem["Address"]."\",\"".$this->pro_mem["Phone"]."\",\"".$this->pro_mem["Mobile"]."\",\"".$this->pro_mem["Email"]."\",\"".$this->pro_mem["Joindate"]."\",\"".$this->pro_mem["Gmember"]."\",\"".$this->pro_mem["CMTND"]."\",\"".$this->pro_mem["isActive"]."\") ";
		$objdata=new CLS_MYSQL();
		return $objdata->Query($sql);
	}

	function Update(){
		$sql="UPDATE `tbl_member` SET `firstname`=\"".$this->pro_mem["FirstName"]."\",`lastname`=\"".$this->pro_mem["LastName"]."\",`birthday`=\"".$this->pro_mem["Brithday"]."\",`gender`=\"".$this->pro_mem["Gender"]."\",`address`=\"".$this->pro_mem["Address"]."\",`phone`=\"".$this->pro_mem["Phone"]."\",`mobile`=\"".$this->pro_mem["Mobile"]."\",`email`=\"".$this->pro_mem["Email"]."\",`gmem_id`=\"".$this->pro_mem["Gmember"]."\",`cmtnd`=\"".$this->pro_mem["CMTND"]."\",`isactive`=\"".$this->pro_mem["isActive"]."\" ";
		$sql.=" WHERE `mem_id`=\"".$this->pro_mem["ID"]."\"";
		$objdata=new CLS_MYSQL();
		return $objdata->Query($sql);
	}
	function ChangePass(){
		$sql="UPDATE `tbl_member` SET `password`='".md5(sha1($this->pro_mem["Password"]))."'";
		$sql.=" WHERE `mem_id`=\"".$this->pro_mem["ID"]."\"";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
	}
	public function setActive($ids,$status=''){
        $sql="UPDATE `tbl_member` SET `isactive`='$status' WHERE `mem_id` in ('$ids')";
        if($status=='')
            $sql="UPDATE `tbl_member` SET `isactive`=if(`isactive`=1,0,1) WHERE `mem_id` in ('$ids')";
        return $this->objmysql->Exec($sql);
    }
	function ActiveOnce($memid){
		$sql="UPDATE `tbl_member` SET `isactive` = IF(isactive=1,0,1) WHERE `mem_id` in ('$memid')";
		$objdata=new CLS_MYSQL();
		return $objdata->Query($sql);
	}
	function Publish($memid){
		$sql="UPDATE `tbl_member` SET `isactive` = \"1\" WHERE `mem_id` in ('$memid')";
		$objdata=new CLS_MYSQL();
		return $objdata->Query($sql);
	}
	function UnPublish($memid){
		$sql="UPDATE `tbl_member` SET `isactive` = \"0\" WHERE `mem_id` in ('$memid')";
		$objdata=new CLS_MYSQL();
		return $objdata->Query($sql);
	}
	function Delete($memid){
		$sql="DELETE FROM `tbl_member` WHERE `mem_id` in ('$memid')";
		$objdata=new CLS_MYSQL();
		return $objdata->Query($sql);
	}
}
?>