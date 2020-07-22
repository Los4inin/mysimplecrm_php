<?php

function getProjects() {
	global $mysqli;
	connectDB();
	$result = $mysqli->query("SELECT * FROM `projects` ORDER BY `modDate` DESC"); //это работает!!!
	closeDB();
	$i=0;
	while (($line = $result->fetch_assoc()) != false) {
		$data[$i]=$line;
		$i++;
	}
	return $data;
}

function searchProjects($search){
	global $mysqli;
	$search='%'.$search.'%';
	connectDB();
	$result = $mysqli->query("SELECT * FROM `projects` WHERE `name` LIKE '$search' ORDER BY `modDate` DESC");
	closeDB();
	$i=0;
	while (($line = $result->fetch_assoc()) != false) {
		$data[$i]=$line;
		$i++;
	}
	return $data;
}

function projGetTags(){
	global $mysqli;
	connectDB();
	$result = $mysqli->query("SELECT `tag` FROM `projects`") or die();
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

function projByTag($tag){
	global $mysqli;
	$tag='%'.$tag.'%';
	connectDB();
	$result = $mysqli->query("SELECT * FROM `projects` WHERE `tag` LIKE '$tag' ORDER BY `modDate` DESC") or die();
	closeDB();
	$i=0;
	while (($line = $result->fetch_assoc()) != false) {
		$data[$i]=$line;
		$i++;
	}
	return $data;
}

function getProjectDataById($id){
	global $mysqli;
	connectDB();
	$result = $mysqli->query("SELECT * FROM `projects` WHERE `id` = $id") or die();
	closeDB();
	$line = $result->fetch_assoc();
	return $line;
}

function updProjectData($id, $userId, $name, $account, $number, $producerId, $dealerId, $tag, $status, $text){
	global $mysqli;
	connectDB();

		$result = $mysqli->query("SELECT `text` FROM `projects` WHERE `id`=$id") or die();
		$line = $result->fetch_assoc();
		$initTxt=$line['text'];
		$result = $mysqli->query("SELECT `login` FROM `mysimplecrm_users` WHERE `id`=$userId") or die();
		$line = $result->fetch_assoc();
		$user=$line['login'];
		if (strlen($text)>0) $text=date("Ymd").' - '.$user.': '.$text.'<br>'.$initTxt;

	else $text=$initTxt;
	$result = $mysqli->query("UPDATE `projects` SET `name` = '$name', `account` = '$account', `number` = '$number',`producerId` = '$producerId',`dealerId` = '$dealerId', `tag` = '$tag', `status` = '$status', `text` = '$text', `modDate` = CURRENT_DATE( ) WHERE  `id` =$id") or die();
	closeDB();
}

function createProject($id, $userId, $name, $account, $number, $producerId, $dealerId, $tag, $status, $text){
	global $mysqli;
	connectDB();
  if (strlen($text)>0){
		$result = $mysqli->query("SELECT `login` FROM `mysimplecrm_users` WHERE `id`=$userId") or die();
		$line = $result->fetch_assoc();
		$user=$line['login'];
		$text=date("Ymd").' - '.$user.': '.$text;
	}
	else $text=NULL;
	$result = $mysqli->query("INSERT INTO `projects` (`id`, `name`, `account`, `number`, `owner`, `producerId`, `dealerId`, `tag`, `status`, `text`, `modDate`) VALUES ($id, '$name', '$account', '$number', '$userId', '$producerId', '$dealerId', '$tag', '$status', '$text', CURRENT_TIMESTAMP);") or die();
	closeDB();
}

function getMaxProjectId(){
	global $mysqli;
	connectDB();
	$result = $mysqli->query("SELECT * FROM `projects` WHERE `id` = (SELECT MAX(`id`) FROM `projects`)") or die();
	closeDB();
	$line = $result->fetch_assoc();
	return $line['id'];
}

function projectsByStatusAndTag($status, $tag){
	global $mysqli;
	$status='%'.$status.'%';
	$tag='%'.$tag.'%';
	connectDB();
	$result = $mysqli->query("SELECT * FROM `projects` WHERE `status` LIKE '$status' AND `tag` LIKE '$tag' ORDER BY `modDate` DESC") or die();
	closeDB();
	$i=0;
	while (($line = $result->fetch_assoc()) != false) {
		$data[$i]=$line;
		$i++;
	}
	return $data;
}
?>
