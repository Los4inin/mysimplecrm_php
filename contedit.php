<?php require_once('func/funcCont.php');
$contId=$_GET['id'];
$contlogo='imgcont/'.$contId.'.png';
if (!file_exists($contlogo)) $contlogo='imgcont/0.png';
$data=getContactDataById($contId);?>

<div id="content">
 <div id="leftblock">
 	<?php echo '<img src="'.$contlogo.'">';?>
 	<div id="name"><?php echo $data['surname'].' '.$data['name'].' '.$data['middleName'];?></div>
 	<div id="code"><?php echo '<a href="index.php?sect=account&id='.$data['parentAcc'].'">'.$data['parAccName'].'</a>';?></div>

  <form action="index.php" method="get" id="EditContact">
    <input type="hidden" name = "sect" value="contact">
    <input type="hidden" name = "id" value=<?php echo '"'.$contId.'"'?>>
  <table cellpadding="5px">
 	 <tr><td  width="155" align="right">Фамилия:</td>
     <td align="left"><input class="txtbtn" type="text" name="surname" value=<?php echo '"'.$data['surname'].'"';?>></td></tr>
   <tr><td align="right">Имя:</td>
     <td align="left"><input class="txtbtn" type="text" name="name" value=<?php echo '"'.$data['name'].'"';?>></td></tr>
   <tr><td align="right">Отчество:</td>
     <td align="left"><input class="txtbtn" type="text" name="middleName" value=<?php echo '"'.$data['middleName'].'"';?>></td></tr>
   <tr><td  width="155" align="right">Пол:</td>
       <td align="left"><input class="txtbtn" type="text" name="sex" value=<?php echo '"'.$data['sex'].'"';?>></td></tr>

  <tr><td  width="155" align="right">Обращение:</td>
       <td align="left"><input class="txtbtn" type="text" name="appeal" value=<?php echo '"'.$data['appeal'].'"';?>></td></tr>

   <tr><td align="right">Должность:</td>
     <td align="left"><input class="txtbtn" type="text" name="job" value=<?php echo '"'.$data['job'].'"';?>></td></tr>
   <tr><td align="right">Телефон:</td>
     <td align="left"><input class="txtbtn" type="text" name="tel1" value=<?php echo '"'.$data['tel1'].'"';?>></td></tr>
    <tr><td align="right">Доп телефон:</td>
      <td align="left"><input class="txtbtn" type="text" name="tel2" value=<?php echo '"'.$data['tel2'].'"';?>></td></tr>
 	  <tr><td align="right">Почта рассылки:</td>
      <td align="left"><input class="txtbtn" type="text" name="mailing" value=<?php echo '"'.$data['mailing'].'"';?>></td></tr>
 	  <tr><td align="right">Доп почта:</td>
      <td align="left"><input class="txtbtn" type="text" name="mail2" value=<?php echo '"'.$data['mail2'].'"';?>></td></tr>
 	  <tr><td align="right">Скайп:</td>
      <td align="left"><input class="txtbtn" type="text" name="skype" value=<?php echo '"'.$data['skype'].'"';?>></td></tr>
 	  <tr><td align="right">Организация:</td>
      <td align="left"><input class="txtbtn" type="text" name="parentAcc" value=<?php echo '"'.$data['parentAcc'].'"';?>></td></tr>
    <tr><td align="right" valign="top">Дополнительная информация:</td>
      <td class="txt" align="left"><input class="txtbtn" type="text" name="text"></td></tr>
  </table>
</form>
 </div>
 <div id="rightblock">
<br>
<input form="EditContact" class="txtbtn" type="submit" name="contSave" value="Сохранить">
 </div>
</div>
