<?php
class CLS_CARD{
	private $pro=array(
					  'ID'=>'-1',
					  'ParID'=>'0',
					  'Name'=>'',
					  'Intro'=>'',
					  'isAdmin'=>'1',
					  'isActive'=>1
					  );
	private $objmysql=NULL;
	public function CLS_CARD(){
		$this->objmysql=new CLS_MYSQL;
	}
	// property set value
	public function __set($proname,$value){
		if(!isset($this->pro[$proname])){
			echo ($proname.' is not member of CLS_CARD Class for set' );
			return;
		}
		$this->pro[$proname]=$value;
	}
	public function __get($proname){
		if(!isset($this->pro[$proname])){
			echo ($proname.' is not member of CLS_CARD Class for get' );
			return '';
		}
		return $this->pro[$proname];
	}
	public function getList($where='',$limit=''){
		$sql='SELECT * FROM `tbl_card` '.$where.' ORDER BY `cdate` '.$limit;
		return $this->objmysql->Query($sql);
	}
	public function getMemberUsed($cardcode){
		$sql='SELECT `member` FROM `tbl_card_transection` WHERE `cardcode`="'.$cardcode.'"';
		$objdata=new CLS_MYSQL;
		$objdata->Query($sql);
		$r=$objdata->Fetch_Assoc(); 
		return $r['member']; 
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	public function checkActivePacket($code){
		$sql="SELECT * FROM `tbl_card` WHERE `cardcode`='$code' AND `status`=0";
		$objdata=new CLS_MYSQL;
		$objdata->Query($sql);
		if($objdata->Num_rows()==1) return true;
		else return false;
	}
    public function checkActivePacketUser($code, $type){
        $sql="SELECT * FROM `tbl_card` WHERE `cardcode`='$code' AND `type`='$type' AND `status`=0";
        $objdata=new CLS_MYSQL;
        $objdata->Query($sql);
        if($objdata->Num_rows()==1) return true;
        else return false;
    }
	public function UseCode($code){
		$sql="UPDATE tbl_card SET `status`=1 WHERE cardcode='$code'";
		$objdata=new CLS_MYSQL;
		$objdata->Query($sql);
	}
    public function buyCard($code){
        $sql="UPDATE tbl_card SET `status`=1 WHERE cardcode='$code'";
        $objdata=new CLS_MYSQL;
        $objdata->Query($sql);
    }
    /* get random card theo gói*/
    public function getCard($type_packet,$num, $user_buy){
        $sql="SELECT * FROM tbl_card  WHERE `type`='$type_packet' AND `status`=0 AND `user_buy`='$user_buy' LIMIT 0,$num";
        $objdata=new CLS_MYSQL;
        $objdata->Query($sql);
        $count=$objdata->Num_rows();
        if($count<1 || $count<$num){
            echo '<div style="text-align: center; margin-bottom: 15px">';
            echo '<p style="color: red; font-size: 15px;">Số thẻ trong kho không đủ để giao dịch. Vui lòng tạo thêm mã thẻ!</p>';
            echo '<a style="color: blue; font-size: 13px;" href="index.php?com=card&task=add">Click vào đây để tạo mã</a>';
            echo '</div>';
            return false;
        }
        $stt='';
        while($r=$objdata->Fetch_Assoc()){
            $stt++;
            $id=$r['cardcode'];
            $packet=substr($r['packet'],0,2);
            $cdate=date('h:i:s d/m/Y',$r['cdate']);
            $author=$r['author'];
            $type=$r['type'];
            $type_packet=substr($type,2,strlen($packet));
            $money=$type_packet*$packet.'000000';
            echo "<tr name='trow'>";
            echo "<td align='center'>$stt</td>";
            echo "<td align='center'>$id</td>";
            echo "<td align='center'>$packet</td>";
            echo "<td align='center'>$type</td>";
            echo "<td align='center'>$money</td>";
            echo "<td align='center'>$cdate</td>";
            echo "<td align='center'>$author</td>";
            echo "</tr>";
        }
    }
    public function insertDetail($card_id, $cardcode){
        $sql="INSERT INTO tbl_card_cart_detail(`cart_id`, `cardcode`) VALUES('$card_id','$cardcode')";
        $objdata=new CLS_MYSQL;
        $objdata->Query($sql);
    }
    public function updateCard($username, $cardcode){
        $sql=" UPDATE tbl_card SET user_buy = '$username' WHERE `cardcode`='$cardcode'";
        $objdata=new CLS_MYSQL;
        $objdata->Query($sql);
    }
    /*active status*/
    public function setActiveCart($ids){
        $sql1="UPDATE `tbl_wallet` SET `status`=1 WHERE `id`='$ids'";
        $objdata=new CLS_MYSQL();
        $result1=$objdata->Query($sql1);
        $sql2="UPDATE `tbl_card_cart` SET `status`=1 WHERE `wallet_id`='$ids'";
        $objdata=new CLS_MYSQL();
        $result2=$objdata->Query($sql2);
        if($result1 && $result2 ){
            $objdata->Query('COMMIT');
        }
        else {
            $objdata->Query('ROLLBACK');
        }
    }

    /*add vào chi tiết cart khi active đơn mua thẻ*/
    public function addCardDetail($type_packet, $num, $cart_id, $username){
       $sql="SELECT * FROM tbl_card  WHERE `type`='$type_packet' AND `status`=0 AND `user_buy` is NULL LIMIT 0,$num";
		//echo $sql;
        $objdata=new CLS_MYSQL;
        $objdata->Query($sql);
        $count=$objdata->Num_rows();
        if($count<1 || $count<$num) {
            echo '<div style="text-align: center; margin-bottom: 15px">';
            echo '<p style="color: red; font-size: 15px;">Số thẻ trong kho không đủ để xác nhận giao dịch. Vui lòng tạo thêm mã thẻ!</p>';
            echo '<a style="color: blue; font-size: 13px;" href="index.php?com=card&task=add">Click vào đây để tạo mã</a>';
            echo '</div>';
            return false;
        }
       while($r=$objdata->Fetch_Assoc()){
            $cardcode=$r['cardcode'];
           $this->insertDetail($cart_id, $cardcode);
           $this->updateCard($username, $cardcode);
           $this->setActiveCart($cart_id);
        }
        return true;
    }
    public function checkCard($type_packet,$num){
        $sql="SELECT count(`cardcode`) as `count` FROM tbl_card  WHERE `type`='$type_packet' AND `status`=0";
        //echo $sql;
        $objdata=new CLS_MYSQL;
        $objdata->Query($sql);
        $row=$objdata->Fetch_Assoc();
        $count=$row['count'];
        if($count < $num) return false;
        else return true;
    }

	private function getCardNumber(){
		$thisdate=date('Ymd');
		$thisdate=substr($thisdate,2,6);
		$code=substr($thisdate,0,3).rand(100000,999999).substr($thisdate,3,3);
		return $code;
	}
	public function Add_new($packet,$packet_type,$num,$author){
		if($packet==0 || $num==0) return false;
		$sql="INSERT INTO `tbl_card`(`cardcode`,`packet`,`type`,`cdate`,`author`) VALUES ";
		$cdate=mktime(date('H'),date('i'),date('s'),date('m'),date('d'),date('Y'));
		for($i=0;$i<$num;$i++){
			$code=$this->getCardNumber();
			$sql.="('$code','$packet','$packet_type','$cdate','$author'),";
		}
		$sql=substr($sql,0,-1);
		return $this->objmysql->Query($sql);
	}
	public function Delete($id){
		$sql="DELETE FROM `tbl_card` WHERE `cardcode` in ('$id')";
		return $this->objmysql->Query($sql);
	}
	public function setActive($ids,$status=''){
		$sql="UPDATE `tbl_card` SET `isactive`='$status' WHERE `cardcode` in ('$ids')";
		if($status=='')
			$sql="UPDATE `tbl_card` SET `isactive`=if(`isactive`=1,0,1) WHERE `cardcode` in ('$ids')";
		return $this->objmysql->Exec($sql);
	}
}
?>