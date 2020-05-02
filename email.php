<?PHP
require "phpmailer/class.phpmailer.php";
require "phpmailer/class.smtp.php"; 


function sendMail2($to,$subject,$body){
	$mail = new PHPMailer();
	$mail->IsSMTP(); // set mailer to use SMTP
	$mail->SMTPAuth = true; //設定SMTP需要驗證
	$mail->SMTPSecure = "ssl"; // Gmail的SMTP主機需要使用SSL連線   
	$mail->Host = "smtp.gmail.com"; //Gamil的SMTP主機  
	$mail->Port = 465;  //Gamil的SMTP主機的SMTP埠位為465埠。  
	$mail->CharSet = 'utf-8';
	$mail->Username = "raspberry123asd@gmail,com"; //設定驗證帳號
	$mail->Password = "rootroot"; //設定驗證密碼
	$mail->From = 'raspberry123asd@gmail,com';
	$mail->FromName ='智慧白蝦系統通知'; 
	
	$mail->AddAddress($to);
	//$mail->AddCC($cc);
	$mail->IsHTML(true);
	$mail->WordWrap = 50;
	$mail->Subject = $subject;
	$mail->Body = $body;
	 
	if(!$mail->Send())
	{
		echo $mail->ErrorInfo; 
		return false;
	}
	else{
		return true;
	}
}
?>