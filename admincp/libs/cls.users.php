<?php
class CLS_USERS{
	private $pro=array(
		'ID'=>'-1',
		'UserName'=>'',
		'Password'=>'',
		'FirstName'=>'',
		'LastName'=>'',
		'Birthday'=>'',
		'Gender'=>'',
		'Address'=>'',
		'Phone'=>'',
		'Mobile'=>'',
		'Email'=>'',
		'Joindate'=>'',
		'LastLogin'=>'',
		'Gmember'=>'',
		'isActive'=>'1'
		);
	private $objmysql=NULL;
	public function CLS_USERS(){
		$this->Joindate=date('Y-m-d h:i:s');
		$this->LastLogin=date('Y-m-d h:i:s');
		$this->objmysql=new CLS_MYSQL;
	}
	// property set value
	public function __set($proname,$value){
		if(!isset($this->pro[$proname])){
			echo ($proname.' is not member of CLS_USERS Class' );
			return;
		}
		$this->pro[$proname]=$value;
	}
	public function __get($proname){
		if(!isset($this->pro[$proname])){
			echo ($proname.' is not member of CLS_USERS Class' );
			return '';
		}
		return $this->pro[$proname];
	}
	public function getUsername(){
		if(isset($_SESSION[MD5($_SERVER['HTTP_HOST']).'_USERNAME']))
			return $_SESSION[MD5($_SERVER['HTTP_HOST']).'_USERNAME'];
		return '';
	}
	public function getFullname(){
		if(isset($_SESSION[MD5($_SERVER['HTTP_HOST']).'_USERLOGIN']))
			return $_SESSION[MD5($_SERVER['HTTP_HOST']).'_USERLOGIN'];
		return '';
	}
	function getMemberByID($memid){
		$sql="SELECT * FROM `tbl_user` WHERE `id`=\"$memid\" ";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		if($objdata->Num_rows()>0){
			$rows=$objdata->Fetch_Assoc();
			$this->pro['ID']=$rows['id'];
			$this->pro['UserName']=$rows['username'];
			$this->pro['Password']=$rows['password'];
			$this->pro['FirstName']=$rows['firstname'];
			$this->pro['LastName']=$rows['lastname'];
			$this->pro['Birthday']=$rows['birthday'];
			$this->pro['Gender']=$rows['gender'];
			$this->pro['Address']=$rows['address'];
			$this->pro['Phone']=$rows['phone'];
			$this->pro['Mobile']=$rows['mobile'];
			$this->pro['Email']=$rows['email'];
			$this->pro['Joindate']=$rows['joindate'];
			$this->pro['LastLogin']=$rows['lastlogin'];
			$this->pro['Gmember']=$rows['guser_id'];
			$this->pro['isActive']=$rows['isactive'];
		}
	}
	public function LOGIN($user,$pass,$type=''){
		$flag=true;
		$user=str_replace("'",'',$user);
		$pass=md5(sha1(trim($pass)));
		if($user=='' || $pass=='')
			$flag=false;
		$sql="SELECT * FROM `tbl_user` WHERE `username`='$user' AND isactive=1";
		$this->objmysql->Query($sql);
		if($this->objmysql->Num_rows()>0){
			$rows=$this->objmysql->Fetch_Assoc();
			if($rows['password']!=$pass)
				$flag=false;
		}
		else{
			$flag=false;
		}
		if($flag==true){
			$_SESSION[MD5($_SERVER['HTTP_HOST']).'_ISLOGIN']=true;
			$_SESSION[MD5($_SERVER['HTTP_HOST']).'_USERLOGIN']=$rows['firstname'].' '.$rows['lastname'];
			
			$_SESSION[MD5($_SERVER['HTTP_HOST']).'_USERID']=$rows['id'];
			$_SESSION[MD5($_SERVER['HTTP_HOST']).'_USERNAME']=$rows['username'];
			$_SESSION[MD5($_SERVER['HTTP_HOST']).'_GROUPUSER']=$rows['guser_id'];
			$this->updateLogin($user,1);
		}
		return $flag;
	}
	public function isLogin(){
		if(isset($_SESSION[MD5($_SERVER['HTTP_HOST']).'_ISLOGIN']))
			$this->autoLogout($_SESSION[MD5($_SERVER['HTTP_HOST']).'_USERLOGIN']);
		if(isset($_SESSION[MD5($_SERVER['HTTP_HOST']).'_ISLOGIN']) && $_SESSION[MD5($_SERVER['HTTP_HOST']).'_ISLOGIN']==true){
			$this->updateLogin($_SESSION[MD5($_SERVER['HTTP_HOST']).'_USERLOGIN'],1);
			return true;
		}
		return false;
	}
	public function isAdmin($gid=1) {
		if(isset($_SESSION[MD5($_SERVER['HTTP_HOST']).'_GROUPUSER']) && $_SESSION[MD5($_SERVER['HTTP_HOST']).'_GROUPUSER']==$gid)
			return true;
		return false;
	}
	public function LOGOUT(){
		$this->updateLogin($_SESSION[MD5($_SERVER['HTTP_HOST']).'_USERLOGIN'],0);
		unset($_SESSION[MD5($_SERVER['HTTP_HOST']).'_ISLOGIN']);
		unset($_SESSION[MD5($_SERVER['HTTP_HOST']).'_USERLOGIN']);
		unset($_SESSION[MD5($_SERVER['HTTP_HOST']).'_GROUPUSER']);
		unset($_SESSION[MD5($_SERVER['HTTP_HOST']).'_USERID']);
		unset($_SESSION[MD5($_SERVER['HTTP_HOST']).'_USERNAME']);
	}
	public function updateLogin($user,$flag){
		$value='';
		if($flag==1)
			$value=date('Y-m-d h:i:s');
		$sql="UPDATE `tbl_user` SET `lastLogin`='$value' WHERE `username`='$user'";
		return $this->objmysql->Query($sql);
	}
	public function autoLogout($user){
		if(!isset($user)||$user=='')
			return;
		$sql="SELECT `lastlogin` FROM `tbl_user` WHERE `username`='$user' ";
		$this->objmysql->Query($sql);
		$rows=$this->objmysql->Fetch_Assoc();
		if($rows['lastlogin']=='')
			return;
		$s=date('i')-date('i',strtotime($rows['lastlogin']));
		if($s>=60 || $s<(-1*60)){
			$this->LOGOUT();
			echo "<p align='center'>Hệ thống tự động đăng xuất sau 60 phút. Bạn vui lòng đăng nhập lại.</p>";
		}
		return;
	}
	public function getList($where=''){
		$sql="SELECT * FROM `tbl_user` ".$where;
		$this->objmysql->Query($sql);
	}
	public function Num_rows() { 
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	public function getNameById($id){
		$objdata=new CLS_MYSQL;
		$sql="SELECT `lastname`,`firstname` FROM `tbl_user`  WHERE isactive=1 AND `id` = '$id'"; 
		$objdata->Query($sql);
		$row=$objdata->Fetch_Assoc();
		return $row['lastname'].' '.$row['firstname'];
	}
	public function checkUserExists($user){
		$sql = "SELECT `username` FROM `tbl_user` WHERE `username` ='$user'";
		$this->objmysql->Query($sql);
		if($this->objmysql->Num_rows()>0) {
			return true;
		}
		return false;
	}
	public function ChangePass_User($user,$newpass) {
		$sql="UPDATE `tbl_user` SET `password`='".md5(sha1(trim($newpass)))."'";
		$sql.=" WHERE username='$user'"; 
		return $this->objmysql->Exec($sql);
	}
	// set active template
	function setActive($ids,$status=''){
		$sql="UPDATE `tbl_user` SET `isactive`='$status' WHERE `id` in ('$ids')";
		if($status=='')
			$sql="UPDATE `tbl_user` SET `isactive`=if(`isactive`=1,0,1) WHERE `id` in ('$ids')";
		return $this->objmysql->Exec($sql);
	}
	function Delete($memid){
		$sql="DELETE FROM `tbl_user` WHERE `id` in ('$memid')";
		return $this->objmysql->Query($sql);
	}
}
?>