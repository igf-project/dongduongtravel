<?php
// CRERATE BY TUYENNX-nxtuyen.pro@gmail.com
// AUTHOR SITE glowfuture.com or www.glowfuture.com
class CLS_MAILER {
	var $pro=array(
			  "FROM"=>"",
			  "TO"=>"",
			  "CC"=>"",
			  "BCC"=>"",
			  "HEADER"=>"",
			  "SUBJECT"=>"",
			  "CONTENT"=>"",
			  "SMTP_MAIL"=>"",
			  "SMTP_SERVER"=>"mail.igf.com.vn.com",
			  "SMTP_PORT"=>"25",
			  "SMTP_USER"=>"",
			  "SMTP_PASS"=>"",
              "time"=>""
			);
	// property set value
    function CLS_MAILER() {
        $this->time=date("Y-m-d h:i:s");
		$this->pro["SMTP_SERVER"] = SMTP_SERVER;
		$this->pro["SMTP_PORT"] = SMTP_PORT;
		$this->pro["SMTP_USER"] = base64_encode(SMTP_USER);
		$this->pro["SMTP_PASS"] = base64_encode(SMTP_PASS);
		$this->pro["SMTP_MAIL"] = SMTP_MAIL;
    }
	function __set($proname,$value){
		if(!isset($this->pro[$proname])){
			echo "Error";
			return;
		}
		$this->pro[$proname]=$value;
	}
	function __get($proname){
		if(!isset($this->pro[$proname])){
			echo "Error";
			return;
		}
		return $this->pro[$proname];
	}
	function sendMail_SMTP () {
		if ($this->pro["SMTP_PORT"] == ""){
			$this->pro["SMTP_PORT"] = 25;
		}
		if ($SMTPIN = fsockopen ($this->pro["SMTP_SERVER"], $this->pro["SMTP_PORT"])){
			fputs ($SMTPIN, "EHLO ".$HTTP_HOST."\r\n");
			$talk["hello"] = fgets ( $SMTPIN, 1024 );
			fputs($SMTPIN, "auth login\r\n");
			$talk["res"]=fgets($SMTPIN,1024);
			fputs($SMTPIN, $this->pro["SMTP_USER"]."\r\n");
			$talk["user"]=fgets($SMTPIN,1024);
			fputs($SMTPIN, $this->pro["SMTP_PASS"]."\r\n");
			$talk["pass"]=fgets($SMTPIN,256);
			fputs ($SMTPIN, "MAIL FROM: <".$this->pro["SMTP_MAIL"].">\r\n");
			$talk["From"] = fgets ( $SMTPIN, 1024 );
			fputs ($SMTPIN, "RCPT TO: <".$this->pro["SMTP_MAIL"].">\r\n");
			$talk["To"] = fgets ($SMTPIN, 1024);
			fputs($SMTPIN, "DATA\r\n");
			$talk["data"]=fgets( $SMTPIN,1024 );
			fputs($SMTPIN, "To: <".$this->pro["TO"].">\r\nFrom: <".$this->pro["FROM"].">\r\nSubject:".$this->pro["SUBJECT"]."\r\n\r\n\r\n".$this->pro["CONTENT"]."\r\n.\r\n");
			$talk["send"]=fgets($SMTPIN,256);
			//CLOSE CONNECTION AND EXIT ...
			fputs ($SMTPIN, "QUIT\r\n");
			fclose($SMTPIN);
		}
		return $talk; 
	}
	function sendMail_PHPmail() {
		ini_set("SMTP",$this->pro["SMTP_SERVER"]);
		ini_set("smtp_port",80);
		ini_set("sendmail_from", $this->pro["SMTP_MAIL"]);
		mail($this->pro["TO"],$this->pro["SUBJECT"],$this->pro["CONTENT"],$this->pro["HEADER"]);
	}
	function SendMail($type=''){
		if($type=="phpmail") {
			$this->sendMail_PHPmail();
		}else {
			$this->sendMail_SMTP();
		}
	}
}

?>