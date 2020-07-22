<?php

function getContacts() {
	global $mysqli;
	connectDB();
	$result = $mysqli->query("SELECT * FROM `contacts` ORDER BY `modDate` DESC") or die(); //это работает!!!
	closeDB();
	$i=0;
	while (($line = $result->fetch_assoc()) != false) {
		$data[$i]=$line;
		$i++;
	}
	return $data;
}

function searchContacts($search){
	global $mysqli;
	$search='%'.$search.'%';
	connectDB();
	$result = $mysqli->query("SELECT * FROM `contacts` WHERE `name` LIKE '$search' OR `surname` LIKE '$search' ORDER BY `surname`") or die();
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

function contactsByRoleAndTag($role, $tag){ //переписать чтобы выдавал контакты но по роли и тэгу родителя
	global $mysqli;
	$page=$page*$limit;
	$role='%'.$role.'%';
	$tag='%'.$tag.'%';
	connectDB();
	$result = $mysqli->query("SELECT `id` FROM `accounts` WHERE `role` LIKE '$role' AND `tag` LIKE '$tag' ORDER BY `name`") or die();
	$i=0;
	while (($line = $result->fetch_assoc()) != false) {
		$accID[$i]=$line['id'];
		$i++;
	}
	$sum=array('');
	foreach ($accID as $key => $value) {
		$result = $mysqli->query("SELECT * FROM `contacts` WHERE `parentAcc` = $value") or die();
		$i=0;
		while (($line = $result->fetch_assoc()) != false) {
			$iteration[$i]=$line;
			$i++;
		}
		$sum=array_merge($sum, $iteration);
	}
	closeDB();
	/*$data = array_unique($data); не работает для многомерных массивов*/
	$sum = array_diff($sum, array(''));
	//попробуем удалить дубли и многомерного массива ручками
	$aux_res = array();
	$result_res = array();
	//создание одномерного массива
	foreach ($sum as $key => $value) {
		$aux_res[$key] = $value['id'];
	}
	$aux_res = array_unique($aux_res);
//собираем обратно
	foreach ($aux_res as $key => $value) {
			$data[$key] = $sum[$key] ;
	}
	return $data;
}

function getContactDataById($id){
	global $mysqli;
	connectDB();
	$result = $mysqli->query("SELECT * FROM `contacts` WHERE `id` = $id") or die();
	closeDB();
	$line = $result->fetch_assoc();
	return $line;
}

function updContactData($id, $userId, $surname, $name, $middleName, $appeal, $sex, $job, $tel1, $tel2, $mailing, $mail2, $skype, $parentAcc, $text){
	global $mysqli;
	connectDB();
	$result = $mysqli->query("SELECT `text` FROM `contacts` WHERE  `id`=$id") or die();
	$line = $result->fetch_assoc();
	$initTxt=$line['text'];
	$result = $mysqli->query("SELECT `login` FROM `mysimplecrm_users` WHERE `id`=$userId") or die();
	$line = $result->fetch_assoc();
	$user=$line['login'];
	if (strlen($text)>0) $text=date("Ymd").' - '.$user.': '.$text.'<br>'.$initTxt;
	else $text=$initTxt;
	$result = $mysqli->query("UPDATE `contacts` SET `surname` = '$surname', `name` = '$name', `middleName` = '$middleName', `appeal` = '$appeal', `sex` = '$sex', `job` = '$job', `tel1` = '$tel1', `tel2` = '$tel2', `mailing` = '$mailing', `mail2` = '$mail2', `skype` = '$skype', `parentAcc` = '$parentAcc', `text` = '$text', `modDate` = CURRENT_DATE( ) WHERE `id` = $id") or die();
	closeDB();
}

function getMaxContactId(){
	global $mysqli;
	connectDB();
	$result = $mysqli->query("SELECT * FROM `contacts` WHERE `id` = (SELECT MAX(`id`) FROM `contacts`)") or die();
	closeDB();
	$line = $result->fetch_assoc();
	return $line['id'];
}

function createContact($id, $userId, $surname, $name, $middleName, $appeal, $sex, $job, $tel1, $tel2, $mailing, $mail2, $skype, $parentAcc, $text){
	global $mysqli;
	connectDB();
  if (strlen($text)>0){
		$result = $mysqli->query("SELECT `login` FROM `mysimplecrm_users` WHERE `id`=$userId") or die();
		$line = $result->fetch_assoc();
		$user=$line['login'];
		$text=date("Ymd").' - '.$user.': '.$text;
	}
	else $text=NULL;
	$result = $mysqli->query("INSERT INTO `contacts` (`id`, `parentAcc`, `parAccName`, `appeal`, `sex`, `surname`, `name`, `middleName`, `job`, `tel1`, `tel2`, `mailing`, `mail2`, `skype`, `owner`, `modDate`, `text`) VALUES ($id, '$parentAcc', '', '$appeal', '$sex', '$surname', '$name', '$middleName', '$job', '$tel1', '$tel2', '$mailing', '$mail2', '$skype', '$userId', CURRENT_TIMESTAMP, '$text');") or die();
	closeDB();
}
?>
