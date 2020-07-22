<?php

function getAccounts() {
	global $mysqli;
	connectDB();
	$result = $mysqli->query("SELECT * FROM `accounts` ORDER BY `modifiedDate` DESC") or die(); //это работает!!!
	closeDB();
	$i=0;
	while (($line = $result->fetch_assoc()) != false) {
		$data[$i]=$line;
		$i++;
	}
	return $data;
}

function searchAccounts($search){
	global $mysqli;
	$search='%'.$search.'%';
	connectDB();
	$result = $mysqli->query("SELECT * FROM `accounts` WHERE `name` LIKE '$search' OR `code` LIKE '$search' ORDER BY `name`") or die();
	closeDB();
	if (mysqli_num_rows($result) == 0) $data=array(array('name'=>'Ничего не найдено'));
	else {
		$i=0;
		while (($line = $result->fetch_assoc()) != false) {
			$data[$i]=$line;
			$i++;
		}
	}
	return $data;
}

function accountsByRoleAndTag($role, $tag){
	global $mysqli;
	$page=$page*$limit;
	$role='%'.$role.'%';
	$tag='%'.$tag.'%';
	connectDB();
	$result = $mysqli->query("SELECT * FROM `accounts` WHERE `id` > 0 AND `role` LIKE '$role' AND `tag` LIKE '$tag' ORDER BY `name`") or die();
	closeDB();
	$i=0;
	while (($line = $result->fetch_assoc()) != false) {
		$data[$i]=$line;
		$i++;
	}
	return $data;
}

//function getAccountDataById($id) перенес в functions.php

function updAccountData($id, $userId, $name, $www, $tel1, $tel2, $email1, $email2, $skype, $region, $parentAccount, $tag, $role, $text){
	global $mysqli;
	connectDB();

		$result = $mysqli->query("SELECT `text` FROM `accounts` WHERE  `id`=$id") or die();
		$line = $result->fetch_assoc();
		$initTxt=$line['text'];
		$result = $mysqli->query("SELECT `login` FROM `mysimplecrm_users` WHERE `id`=$userId") or die();
		$line = $result->fetch_assoc();
		$user=$line['login'];
	if (strlen($text)>0) $text=date("Ymd").' - '.$user.': '.$text.'<br>'.$initTxt;
	else $text=$initTxt;
	$result = $mysqli->query("UPDATE `accounts` SET `name` = '$name', `www` = '$www', `tel1` = '$tel1', `tel2` = '$tel2', `email1` = '$email1', `email2` = '$email2', `skype` = '$skype', `region` = '$region', `parentAccount` = '$parentAccount', `tag` = '$tag', `role` = '$role', `text` = '$text', `modifiedDate` = CURRENT_DATE( )  WHERE  `id` =$id") or die();
	closeDB();
}

function getContactsByParentAcc($id){
  global $mysqli;
	connectDB();
	$result = $mysqli->query("SELECT * FROM `contacts` WHERE `parentAcc`=$id") or die();
	closeDB();
	$i=0;
	while (($line = $result->fetch_assoc()) != false) {
		$data[$i]=$line;
		$i++;
	}
	return $data;
}
function getProjectsByCode($code){
  global $mysqli;
	connectDB();
	$result = $mysqli->query("SELECT * FROM `projects` WHERE `account`='$code'") or die();
	closeDB();
	$i=0;
	while (($line = $result->fetch_assoc()) != false) {
		$data[$i]=$line;
		$i++;
	}
	return $data;
}

function getAccountsByParentAcc($id){
  global $mysqli;
	connectDB();
	$result = $mysqli->query("SELECT * FROM `accounts` WHERE `parentAccount`=$id") or die();
	closeDB();
	$i=0;
	while (($line = $result->fetch_assoc()) != false) {
		$data[$i]=$line;
		$i++;
	}
	return $data;
}

function getMaxAccountId(){
	global $mysqli;
	connectDB();
	$result = $mysqli->query("SELECT * FROM `accounts` WHERE `id` = (SELECT MAX(`id`) FROM `accounts`)") or die();
	closeDB();
	$line = $result->fetch_assoc();
	return $line['id'];
}

function createAccount($id, $userId, $name, $code, $www, $tel1, $tel2, $email1, $email2, $skype, $region, $parentAccount, $tag, $role, $text){
	global $mysqli;
	connectDB();
  if (strlen($text)>0){
		$result = $mysqli->query("SELECT `login` FROM `mysimplecrm_users` WHERE `id`=$userId") or die();
		$line = $result->fetch_assoc();
		$user=$line['login'];
		$text=date("Ymd").' - '.$user.': '.$text;
	}
	else $text=NULL;
	$result = $mysqli->query("INSERT INTO `accounts` (`id`, `name`, `code`, `owner`, `parentAccount`, `tel1`, `tel2`, `email1`, `email2`, `skype`, `aol`, `www`, `region`, `text`, `relation`, `tag`, `role`, `modifiedDate`) VALUES ($id, '$name', '$code', '$userId', '$parentAccount', '$tel1', '$tel2', '$email1', '$email2', '$skype', 'NULL', '$www', '$region', '$text', 'NULL', '$tag', '$role', CURRENT_TIMESTAMP);") or die();
	closeDB();
}
?>
