<?php require_once('func/funcAcc.php');
$accId=getMaxAccountId()+1;
$acclogo='/imgacc/'.$accId.'.png';
if (!file_exists($acclogo)) $acclogo='/imgacc/0.png';
$data=getAccountDataById(1);
?>

<div id="content">
 <div id="leftblock">
 	<?php echo '<img src="'.$acclogo.'">';?>
 	<div id="name"><?php echo $data['name'];?></div>
 	<div id="code"><?php echo $data['code'].'<br><a href="'.$data['www'].'" target="_blank">'.$data['www'].'</a>';?></div>

  <form action="index.php" method="get" id="NewAccount">
    <input type="hidden" name = "sect" value="account">
    <input type="hidden" name = "id" value=<?php echo '"'.$accId.'"'?>>
  <table cellpadding="5px">
 	 <tr><td  width="155" align="right">Название:</td>
     <td align="left"><input class="txtbtn" type="text" name="name"></td></tr>
   <tr><td  width="155" align="right">Код:</td>
     <td align="left"><input class="txtbtn" type="text" name="code"></td></tr>
   <tr><td align="right">Сайт:</td>
     <td align="left"><input class="txtbtn" type="text" name="www"></td></tr>
   <tr><td align="right">Телефон:</td>
     <td align="left"><input class="txtbtn" type="text" name="tel1"></td></tr>
    <tr><td align="right">Доп телефон:</td>
      <td align="left"><input class="txtbtn" type="text" name="tel2"></td></tr>
 	  <tr><td align="right">Почта:</td>
      <td align="left"><input class="txtbtn" type="text" name="email1"></td></tr>
 	  <tr><td align="right">Доп почта:</td>
      <td align="left"><input class="txtbtn" type="text" name="email2"></td></tr>
 	  <tr><td align="right">Скайп:</td>
      <td align="left"><input class="txtbtn" type="text" name="skype"></td></tr>
 	  <tr><td align="right">Регион:</td>
      <td align="left"><input class="txtbtn" type="text" name="region"></td></tr>
 	  <tr><td align="right">Parent Account:</td>
      <td align="left"><input class="txtbtn" type="text" name="parentAccount"></td></tr>
 	  <tr><td align="right">Ссылки:</td>
      <td align="left"><input class="txtbtn" type="text" name="tag"></td></tr>
 	  <tr><td align="right">Тип:</td>
      <td align="left">
        <select class="txtbtn" name="role" size="4" value="custom">
          <option selected value="custom">Клиент</option>
          <option <?php if ($data['role']=='dealer') echo "selected";?> value="dealer">Дилер</option>
          <option <?php if ($data['role']=='produc') echo "selected";?> value="produc">Производитель оборудования</option>
          <option <?php if ($data['role']=='servis') echo "selected";?> value="servis">Сервис(Банк, Транспорт и тд)</option>
        </select>
      </td></tr>
    <tr><td align="right" valign="top">Дополнительная информация:</td>
      <td class="txt" align="left"><input class="txtbtn" type="text" name="text"></td></tr>
  </table>
</form>
 </div>
 <div id="rightblock">
<br>
<input form="NewAccount" class="txtbtn" type="submit" name="CreateAcc" value="Сохранить">
 </div>
</div>
