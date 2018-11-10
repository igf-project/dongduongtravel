<?php
session_start();
include_once('../includes/gfinnit.php');
include_once('../includes/gfconfig.php');
include_once('../libs/cls.mysql.php');
include_once('../libs/cls.member.php');
$obj=new CLS_MEMBER;
$objdata=new CLS_MYSQL;
if(isset($_POST['value'])){
	$value=$_POST['value']; print_r($value);
	if(isset($value['id'])) $fbid=$value['id'];
	if($fbid=='false' or $fbid==false) echo 'Không tìm thấy Facebook ID đăng nhập !';
	else 
	{	$sql="SELECT * FROM tbl_account WHERE uid='$fbid'";
		$objdata->Query($sql);
		$flag=false; $isexist=0;
		if($objdata->Num_rows()==1){
			$isexist=1;
			$r=$objdata->Fetch_Assoc();
			if($r['isactive']==0)
				$flag=false;
			else{
				$obj->setUserLogin($r);
				$flag=true;
				echo 'active';
			}
		}
		
		if($flag==false){
			$fullname= $value['last_name'].' '.$value['first_name'];
			$emailfb = $value['email'];
			// tiến hành đăng ký với trạng thái là no active
			if($isexist==0){
				//$avata=addslashes($value['picture']['data']['url']);
				// Avatar large
				$avata = 'https://graph.facebook.com/'.$fbid.'/picture?type=large';
				$cdate = mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"));
				// Lưu vào bảng account
				$sql="INSERT INTO tbl_account (`username`,`driver`,`uid`,`cdate`,`isactive`) 
						VALUES ('$emailfb','fb','$fbid','$cdate','0')";
				echo $sql;
				$objdata->Query($sql);
				// Lưu vào bảng member
				//$sql="INSERT INTO tbl_member (`driver`,`uid`,`cdate`,`isactive`) 
						//VALUES ('fb','$fbid','$cdate','0')";
				//$objdata->Query($sql);
			}
			?>
			<h4 align='center'>Chào <?php echo $fullname;?>! Bạn đã đăng ký thành công</h4>
			<p align='center'>Đây là lần đầu tiên bạn đăng nhập. Vui lòng nhập Email kích hoạt tài khoản.</p>
			<div align='center'>
				<input type='text' value='' placeholder='email@igf.com.vn' id='email_active' name="email_active"/><br/>
				<input type='hidden' value='<?php echo $fbid;?>' name='txtid' id="txtid"/>
				<span class='mess_mail' style='color:#f00;font-weight:bold;'></span>
			</div>
			<?php
		}
	}
}else{
	echo 'Không tìm thấy Facebook ID đăng nhập';
}
?>