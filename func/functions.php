<?php
	$mysqli = false;
function connectDB() {
		global $mysqli;
		$mysqli = new mysqli("localhost", "***", "***", "***");
		$mysqli->query("SET NAMES 'utf8'");
}

function closeDB() {
		global $mysqli;
		$mysqli->close();
}

function getPage(){
   if (isset($_GET['page'])) $page=$_GET['page'];
   else $page=0;
   return $page;
}

function accGetTags(){
	global $mysqli;
	connectDB();
	$result = $mysqli->query("SELECT `tag` FROM `accounts`") or die();
	closeDB();
	$tagsArray=array('');
	while (($line = $result->fetch_assoc()) != false) {
		$tags=explode(' ', $line['tag']);
		$tagsArray=array_merge($tagsArray, $tags);
	}
	$tagsArray=array_unique($tagsArray);
	$tagsArray = array_diff($tagsArray, array(''));
	$tagsArray = array_filter($tagsArray);
	asort($tagsArray);
	return $tagsArray;
}

function getUserAccessById($id){
	global $mysqli;
	connectDB();
	$result = $mysqli->query("SELECT `access` FROM  `mysimplecrm_users` WHERE  `id`=$id") or die();
	closeDB();
	$line = $result->fetch_assoc();
	return $line['access'];
}

function getAccountDataById($id){
	global $mysqli;
	connectDB();
	$result = $mysqli->query("SELECT * FROM `accounts` WHERE `id` = $id") or die();
	closeDB();
	$line = $result->fetch_assoc();
	return $line;
}
function getAccountData($request){
	global $mysqli;
	connectDB();
	if (strlen(''.$request)==6)
		$result = $mysqli->query("SELECT * FROM `accounts` WHERE `code` = '$request'") or die();
	else
		$result = $mysqli->query("SELECT * FROM `accounts` WHERE `id` = $request") or die();
	closeDB();
	$line = $result->fetch_assoc();
	return $line;
}
?>
