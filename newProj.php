<?php require_once('func/funcProj.php');
$projId=getMaxProjectId()+1;
if (file_exists('imgproj/'.$projId.'.png')) $projlogo='imgproj/'.$projId.'.png';
else $projlogo='/imgproj/0.png';
?>

<div id="content">
 <div id="leftblock">
 	<?php echo '<img src="'.$projlogo.'">';?>
 	<div id="name">Название Проекта</div>
 	<div id="code">CODE__ - 0000</div>

  <form action="index.php" method="get" id="NewProject">
    <input type="hidden" name = "sect" value="project">
    <input type="hidden" name = "id" value=<?php echo '"'.$projId.'"'?>>
  <table cellpadding="5px">
 	 <tr><td  width="155" align="right">Название:</td>
     <td align="left"><input class="txtbtn" type="text" name="name"></td></tr>
 	  <tr><td align="right">Компания:</td>
      <td align="left"><input class="txtbtn" type="text" name="account"></td></tr>
    <tr><td align="right">Номер Проекта:</td>
        <td align="left"><input class="txtbtn" type="text" name="number"></td></tr>
    <tr><td align="right">Производитель:</td>
      <td align="left"><input class="txtbtn" type="text" name="producerId"></td></tr>
    <tr><td align="right">Дилер:</td>
        <td align="left"><input class="txtbtn" type="text" name="dealerId"></td></tr>
 	  <tr><td align="right">Ссылки:</td>
      <td align="left"><input class="txtbtn" type="text" name="tag"></td></tr>
 	  <tr><td align="right">Статус:</td>
      <td align="left">
        <select class="txtbtn" name="status" size="3" value="active">
          <option selected value="active">Активно</option>
          <option value="closed">Закрыто</option>
          <option value="finish">Завершено</option>
        </select>
      </td></tr>
    <tr><td align="right" valign="top">Дополнительная информация:</td>
      <td class="txt" align="left"><input class="txtbtn" type="text" name="text"></td></tr>
  </table>
</form>
 </div>
 <div id="rightblock">
<br>
<input form="NewProject" class="txtbtn" type="submit" name="CreateProj" value="Сохранить">
 </div>
</div>
