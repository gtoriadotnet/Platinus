<?php
//xlxi 2020
try{
	global $sql;
	$sql = new PDO("mysql:host=localhost;port=3306;dbname=platinus", "root", "");
	$sql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
	$sql->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
}catch(exception $e){
	die("Uh oh! We ran into an error while connecting to the database. Check back soon!");
}
function getUserIpAddr(){ if(!empty($_SERVER['HTTP_CLIENT_IP'])){ $ip = $_SERVER['HTTP_CLIENT_IP']; }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){ $ip = $_SERVER['HTTP_X_FORWARDED_FOR']; }else{ $ip = $_SERVER['REMOTE_ADDR']; } return $ip; }

$ipbans = $GLOBALS["sql"]->prepare("SELECT * FROM `ipbans`");
$ipbans->execute();

foreach ($ipbans as $ipban){
	if($ipban["ip"]==getUserIpAddr()){
		require_once($_SERVER["DOCUMENT_ROOT"] . "/internal/errordocs/begone.php");
		exit;
	}
}

if(file_get_contents(dirname($_SERVER["DOCUMENT_ROOT"]) . "/offline.txt")=="1"&&dirname($_SERVER["REQUEST_URI"])!=="/maintenance/constraint"){
	header("Location: https://" . $_SERVER['HTTP_HOST'] . "/maintenance/constraint/?return=" . urlencode("https://" . $_SERVER['HTTP_HOST'] . $_SERVER["REQUEST_URI"]));
	exit;
}

?>