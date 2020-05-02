<?php
require "email.php"; //呼叫email.php
try{
  $db = new PDO("mysql:host=localhost;dbname=smarthome","root");
  $db->exec("set names utf8");
}
catch (PDOException $e){
  echo "Error:".$e->getMessage();
}
switch(@$_GET['type']){
  case "sensor":

	if(isset($_GET['tempValue'])&&isset($_GET['phValue'])){
	$tempValue=$_GET['tempValue'];
	$phValue=$_GET['phValue'];
	
	$db->exec("UPDATE sensor SET value=".$tempValue." WHERE name='temp'");
	$db->exec("UPDATE sensor SET value=".$phValue." WHERE name='ph'");
	
	$db->exec("INSERT INTO history(name, value) VALUES ('temp',".$tempValue."),('ph',".$phValue.")");
	}
	break;
	
  case "tempAlert"://PH感測超過設定值送信  
  		 sendMail2("raspberry123asd@gmail.com","temp警報","temp異常請盡快做處理");//收信者，主旨，內容
 	break;
	
  case "phAlert"://PH感測超過設定值送信
  		 sendMail2("raspberry123asd@gmail.com","ph警報","ph值過高或過低請盡快做處理");//收信者，主旨，內容
 	break;
  }
  
 
?>