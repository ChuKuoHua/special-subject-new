<?PHP
if(isset($_POST['cmd'])&&!empty($_POST['cmd'])){
	$cmd=$_POST['cmd'];
	$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
	if ($socket === false) {
		$msg="socket_create() failed: reason: " . socket_strerror(socket_last_error());
	}

	$result = socket_connect($socket, "172.20.174.189", 54321);
	if ($result === false) { 
		$msg="socket_connect() failed.\nReason: ($result) " . socket_strerror(socket_last_error($socket));
	}
	socket_send($socket,$cmd,strlen($cmd),MSG_DONTROUTE);
}
?>
