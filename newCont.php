<?php require_once('func/funcCont.php');
$contId=getMaxContactId()+1;
$contlogo='imgcont/'.$contId.'.png';
if (!file_exists($contlogo)) $contlogo='imgcont/0.png';
?>

<div id="content">
 <div id="leftblock">
 	<?php echo '<img src="'.$contlogo.'">';?>
  <div id="name">Фамилия Имя Отчество</div>
  <div id="code">Организация</div>

  <form action="index.php" method="get" id="NewContact">
    <input type="hidden" name = "sect" value="contact">
    <input type="hidden" name = "id" value=<?php echo '"'.$contId.'"'?>>
  <table cellpadding="5px">
   <tr><td  width="155" align="right">Фамилия:</td>
    <td align="left"><input class="txtbtn" type="text" name="surname"></td></tr>
   <tr><td  width="155" align="right">Имя:</td>
     <td align="left"><input class="txtbtn" type="text" name="name"></td></tr>
   <tr><td  width="155" align="right">Отчество:</td>
     <td align="left"><input class="txtbtn" type="text" name="middleName"></td></tr>
   <tr><td  width="155" align="right">Пол:</td>
     <td align="left"><input class="txtbtn" type="text" name="sex" value="1"></td></tr>

   <tr><td  width="155" align="right">Обращение:</td>
     <td align="left"><input class="txtbtn" type="text" name="appeal"></td></tr>

   <tr><td align="right">Должность:</td>
     <td align="left"><input class="txtbtn" type="text" name="job"></td></tr>
   <tr><td align="right">Телефон:</td>
     <td align="left"><input class="txtbtn" type="text" name="tel1"></td></tr>
    <tr><td align="right">Доп телефон:</td>
      <td align="left"><input class="txtbtn" type="text" name="tel2"></td></tr>
 	  <tr><td align="right">Почта рассылки:</td>
      <td align="left"><input class="txtbtn" type="text" name="mailing"></td></tr>
 	  <tr><td align="right">Доп почта:</td>
      <td align="left"><input class="txtbtn" type="text" name="mail2"></td></tr>
 	  <tr><td align="right">Скайп:</td>
      <td align="left"><input class="txtbtn" type="text" name="skype"></td></tr>
 	  <tr><td align="right">Организация:</td>
      <td align="left"><input class="txtbtn" type="text" name="parentAcc"></td></tr>
    <tr><td align="right" valign="top">Дополнительная информация:</td>
      <td class="txt" align="left"><input class="txtbtn" type="text" name="text"></td></tr>
  </table>
</form>
 </div>
 <div id="rightblock">
<br>
<input form="NewContact" class="txtbtn" type="submit" name="CreateCont" value="Сохранить">
 </div>
</div>
