<?php
try{
	$db=new PDO("mysql:host=localhost;dbname=smarthome","root");
	$db->exec("set names utf8");
}
catch(PDOException $e){
	echo"Error:".$e->getMessage();
}
function SQL($db,$rs){
	return $db->query($rs);

}
switch(@$_POST['action']){
	case "getSensor":
	    $array=array();
		$rs=SQL($db,"select * from sensor");
		while($row=$rs->fetch(PDO::FETCH_ASSOC)){
			switch($row['name']){
				case "temp":
				    $row['ch_name']='溫度(°C)';
				break;               
				case "ph":
				    $row['ch_name']='PH感測';
				break;

			}
			$array[]=$row;	
		}
		echo json_encode($array);
		
	break;
	case "getTemp":
		$array=array();
		$rs=SQL($db,"SELECT * FROM history WHERE (datetime>='".date("Y-m-d")."') and (name='temp')");
		while($row=$rs->fetch(PDO::FETCH_ASSOC)){
			$array[]=array("temp"=>$row['value'],"datetime"=>$row['datetime']);
		}
		echo json_encode($array);
	break;
	case "getPH":
		$array=array();
		$rs=SQL($db,"SELECT * FROM history WHERE (datetime>='".date("Y-m-d")."') and (name='ph')");
		while($row=$rs->fetch(PDO::FETCH_ASSOC)){
			$array[]=array("ph"=>$row['value'],"datetime"=>$row['datetime']);
		}
		echo json_encode($array);
	break;
}
unset($db);
?>