<?php require_once('func/funcCont.php');
$contId=$_GET['id'];
if (file_exists('imgcont/'.$contId.'.png')) $contlogo='imgcont/'.$contId.'.png';
else $contlogo='/imgcont/0.png';
$data=getContactDataById($contId);

if (isset($_GET['contSave'])) {
  $access=getUserAccessById($userId);
  if (($access=='usr') or ($access=='adm')){
    updContactData($contId, $userId, $_GET['surname'], $_GET['name'], $_GET['middleName'], $_GET['appeal'], $_GET['sex'], $_GET['job'], $_GET['tel1'], $_GET['tel2'], $_GET['mailing'], $_GET['mail2'], $_GET['skype'], $_GET['parentAcc'], $_GET['text']);
    header("Location: index.php?sect=contact&id=".$contId);
  }
  else echo '<script>alert("не достаточно прав для внесения изменений");</script>';
}
elseif (isset($_GET['CreateCont'])) {
  $access=getUserAccessById($userId);
  if (($access=='usr') or ($access=='adm')){
    createContact($contId, $userId, $_GET['surname'], $_GET['name'], $_GET['middleName'], $_GET['appeal'], $_GET['sex'], $_GET['job'], $_GET['tel1'], $_GET['tel2'], $_GET['mailing'], $_GET['mail2'], $_GET['skype'], $_GET['parentAcc'], $_GET['text']);
    header("Location: index.php?sect=contact&id=".$contId);
  }
  else echo '<script>alert("не достаточно прав для внесения изменений");</script>';
}
?>

<div id="content">
 <div id="leftblock">
 	<?php echo '<img src="'.$contlogo.'">';?>
 	<div id="name"><?php echo $data['surname'].' '.$data['name'].' '.$data['middleName'];?></div>
 	<div id="code"><?php $accData=getAccountDataById($data['parentAcc']); $parAccName=$accData['name']; echo '<a href="index.php?sect=account&id='.$data['parentAcc'].'">'.$parAccName.'</a>';?></div>
 	<table cellpadding="5px">
 	 <tr><td  width="155" align="right">Обращение:</td><td align="left"><?php echo $data['appeal'];?></td></tr>
 	  <tr><td align="right">Должность:</td><td align="left"><?php echo $data['job'];?></td></tr>
 	  <tr><td align="right">Телефон:</td><td align="left"><?php echo $data['tel1'];?></td></tr>
 	  <tr><td align="right">Телефон:</td><td align="left"><?php echo $data['tel2'];?></td></tr>
 	  <tr><td align="right">Почта:</td><td align="left"><?php echo $data['mailing'];?></td></tr>
 	  <tr><td align="right">Почта:</td><td align="left"><?php echo $data['mail2'];?></td></tr>
 	  <tr><td align="right">skype:</td><td align="left"><?php echo $data['skype'];?></td></tr>
    <tr><td align="right">id:</td><td align="left"><?php echo $data['id'];?></td></tr>
 	  <tr><td align="right">Дата последнего изменения:</td><td align="left"><?php echo $data['modDate'];?></td></tr>
 	  <tr><td align="right" valign="top">Дополнительная информация:</td><td class="txt" align="left"><?php echo $data['text'];?></td></tr>
 	</table>
 </div>
 <div id="rightblock">
   <br>
   <form action="index.php" method="get">
     <input type="hidden" name = "sect" value="contedit">
     <input type="hidden" name = "id" <?php echo "value=".$contId;?>>
     <input type="submit" class="txtbtn" value="Изменить">
   </form><br>

 Письма<br>

 </div>
</div>
