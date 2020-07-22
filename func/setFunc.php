<?php
function getAccessByUserId($id){
  global $mysqli;
	connectDB();
  $result = $mysqli->query("SELECT `access` FROM `mysimplecrm_users` WHERE `id`=$id");
  closeDB();
  $access=$result->fetch_assoc();
  return $access['access'];
}



function setParentAccIdInCont(){
  global $mysqli;
	connectDB();
  $result = $mysqli->query("SELECT `id` , `name` FROM  `accounts`");
	while (($line = $result->fetch_assoc()) != false) {
		$idName[$line['id']]=$line['name'];
	}
foreach ($idName as $key => $value) {
  $result = $mysqli->query("UPDATE `contacts` SET `parentAcc` =  '$key' WHERE  `parAccName` = '$value'");
}
  closeDB();
}

?>
