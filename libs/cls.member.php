<?php
class CLS_MEMBER{
	private $pro=array(
		'Username'=>'',
		'Password'=>'',
		'Driver'=>'system',
		'Uid'=>'',
		'First_name'=>'',
		'Last_name'=>'',
		'Birthday'=>'',
		'Gender'=>'',
		'Avatar'=>'',
		'Address'=>'',
		'City'=>0,
		'Country'=>0,
		'Tel'=>'',
		'Email'=>'',
		'Facebook'=>'',
		'GmemId'=>'',
		'Twitter'=>'');
	private $objmysql=null;
	public function CLS_MEMBER(){
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
	public function getList($where=''){
		$sql="SELECT * FROM `tbl_member_profile` ".$where;
		return $this->objmysql->Query($sql);
	}
	public function getListAccountGmem($where=''){
		$sql="SELECT * FROM `tbl_account_gmem` ".$where;
		var_dump($sql);
		return $this->objmysql->Query($sql);
	}
	public function getNameByUser($user){
		$sql="SELECT CONCAT(last_name,' ',first_name) AS fullname FROM `tbl_member_profile` WHERE username='$user'";
		$objdata=new CLS_MYSQL;
		$objdata->Query($sql);
		$row=$objdata->Fetch_Assoc();
		return $row['fullname'];
	}
	public function getAvarByUser($user){
		$sql="SELECT avatar FROM `tbl_member_profile` WHERE username='$user'";
		$objdata=new CLS_MYSQL;
		$objdata->Query($sql);
		$row=$objdata->Fetch_Assoc();
		if($row['avatar']!='') return $row['avatar'];
		else return ROOTHOST.'avatar/icon-profile.png';
	}
    public function getGmemIdAndNameByUser($user){
        $sql="SELECT `tbl_account_gmem`.`gmem_id`, `tbl_gmem`.`name` AS `g_name`
            FROM `tbl_account_gmem`
            INNER JOIN `tbl_gmem` ON `tbl_account_gmem`.`gmem_id`=`tbl_gmem`.`gmem_id` WHERE `tbl_account_gmem`.`username`='$user'";
        //var_dump($sql);
        $objdata=new CLS_MYSQL;
        $objdata->Query($sql);
        $row=$objdata->Fetch_Assoc();
        if($row['gmem_id']!='') return $row;
        else return '';
    }
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	//--------------------------------------------------------------------------
	public function ChangePass($user,$pass){
		$pass=md5(sha1($pass));
		$sql="UPDATE tbl_member_account SET password='$pass' WHERE username='$user' ";
		return $this->objmysql->Exec($sql);
	}
	public function SystemLogin($user,$pass){
		$pass=md5(sha1($pass));
		$sql="SELECT * FROM tbl_member_account WHERE isactive=1 AND username='$user'";
		$objdata=new CLS_MYSQL;
		$objdata->Query($sql);
		$r=$objdata->Fetch_Assoc();
		if($pass==$r['password']){
			// login success
			$this->setUserLogin($r);
			$this->setActionTime();
			// update thông tin
			$this->setInfoLogin($user);
			return true;
		}else{
			return false;
		}
	}
	public function isLogin(){
		if(!isset($_SESSION['MEMBER_LOGIN_'.md5($_SERVER['HTTP_HOST'])]))
			return false;
		if(!isset($_SESSION['ACTION_TIME']))
			return false;
		$this_time=time();
		if($this_time-$_SESSION['ACTION_TIME']>10*60){
			$this->Logout();
			return false;
		}
		return true;
	}
	public function Logout(){
		unset($_SESSION['MEMBER_LOGIN_'.md5($_SERVER['HTTP_HOST'])]);
		unset($_SESSION['ACTION_TIME']);
	}
	public function setInfoLogin($user){
		$this_time=time();
		$sess_id=session_id();
		$ip=$_SERVER['REMOTE_ADDR'];
		$sql="UPDATE tbl_member_account SET iplogin='$ip', session_id='$sess_id', lastlogin=$this_time, WHERE username='$user'";
		$this->objmysql->Exec($sql);
	}
	public function setActionTime(){
		$_SESSION['ACTION_TIME']=time();
	}
	public function setUserLogin($r){
		$_SESSION['MEMBER_LOGIN_'.md5($_SERVER['HTTP_HOST'])]=json_encode($r);
	}
	public function getUserLogin(){
		if(isset($_SESSION['MEMBER_LOGIN_'.md5($_SERVER['HTTP_HOST'])]))
			return json_decode($_SESSION['MEMBER_LOGIN_'.md5($_SERVER['HTTP_HOST'])]);
		else return;
	}



	//-----------------------------------------------------------------
	Public function Add_new(){
		$sql="INSERT INTO tbl_member_account(`username`,`password`,`driver`,`uid`) VALUES ('{$this->Username}','{$this->Password}','{$this->Driver}','{$this->Uid}')";
		$result1=$this->objmysql->Exec($sql);
		$sql="INSERT INTO tbl_member_profile VALUES ('{$this->Username}','{$this->First_name}','{$this->Last_name}','{$this->Birthday}','{$this->Gender}',
			'{$this->Avatar}','{$this->Address}','{$this->City}','{$this->Country}','{$this->Tel}','{$this->Email}','{$this->Facebook}','{$this->Twitter}')";
		$result2=$this->objmysql->Exec($sql);
		$sql="INSERT INTO tbl_account_gmem(`username`,`gmem_id`) VALUES ('{$this->Username}','{$this->GmemId}')";
		$result3=$this->objmysql->Exec($sql);
		if($result1==true && $result2==true && $result3==true)
			return true;
		else 
			return false;
	}
	public function Update(){
		$sql="UPDATE tbl_member_profile SET username='{$this->Username}',first_name='{$this->First_name}',last_name='{$this->Last_name}',birthday='{$this->Birthday}',gender='{$this->Gender}',
			avata='{$this->Avatar}',address='{$this->Address}',city='{$this->City}',country='{$this->Country}',tel='{$this->Tel}',email='{$this->Email}',facebook='{$this->Facebook}',twitter='{$this->Twitter}')";
		$this->objmysql->Exec($sql);
	}
	public function UpdateAvar(){
		$sql="UPDATE `tbl_member_profile` SET `avatar`='".$this->Avatar."' ";
		$sql.=" WHERE `username`='{$this->Username}'";
	}
	
	
	public function getInfoGmemByUser($user){
		$sql="SELECT * 
		FROM `tbl_account_gmem` 
		LEFT JOIN `tbl_gmem` ON `tbl_gmem`.`gmem_id`=`tbl_account_gmem`.`gmem_id`
		WHERE `tbl_account_gmem`.`username`='".$user."'";
		//var_dump($sql);
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        while($rw=$objdata->Fetch_Assoc())
        {	
			$name=$rw['name'];
			echo '<span>'.$name.'</span>';
		}
	}
	
	public function ChangeLevel(){
		$sql="UPDATE tbl_account_gmem SET gmem_id='{$this->GmemId}' WHERE `username`='{$this->Username}'";
		//var_dump($sql);
		$this->objmysql->Exec($sql);
	}
  public function listTable($strwhere=""){
        //$sql="	SELECT `tbl_member_profile`.`username`, `tbl_member_account`.`driver`, `tbl_gmem`.`gmem_id`, `tbl_member_account`.`isactive`, `tbl_member_account`.`uid`
        $sql="	SELECT *
                FROM `tbl_member_account`
                INNER JOIN `tbl_member_profile` ON `tbl_member_profile`.`username`=`tbl_member_account`.`username`
                $strwhere";
				
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);	$i=0;
        while($rows=$objdata->Fetch_Assoc())
        {	$i++;
            $ids=$rows['username'];
            $name = $rows['username'];
            $driver=$rows['driver'];
			//$arr_name=$this->getInfoGmemByUser($name);
            echo "<tr name='trow'>";
            echo "<td width='30' align='center'>$i</td>";
            echo "<td>$name</td>";
            echo "<td>$driver</td>";
			echo '<td>';
				echo $this->getInfoGmemByUser($name);
			echo "</td>";
            echo "<td>";
            echo "<a href='".ROOTHOST."member/tai-khoan/active/".$ids."'>";
            showIconFun('publish',$rows['isactive']);
            echo "</a>";
            echo "</td>";

           echo "<td>";
            echo "<span class='act' value='".$name."'>";
            showIconFun('edit','');
            echo "</span>";
            echo "</td>";

            echo "<td>";
            echo "<a href='".ROOTHOST."member/tai-khoan/delete/".$ids."'>";
            showIconFun('delete','');
            echo "</a>";
            echo "</td>";
            echo "</tr>";
        }
    }
}
?>