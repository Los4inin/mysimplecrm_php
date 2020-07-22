<?php require_once('func/funcProj.php');
$projId=$_GET['id'];
if (file_exists('imgproj/'.$projId.'.png')) $projlogo='imgproj/'.$projId.'.png';
else $projlogo='/imgproj/0.png';
$data=getProjectDataById($projId);
?>

<div id="content">
 <div id="leftblock">
 	<?php echo '<img src="'.$projlogo.'">';?>
  <div id="name"><?php echo '<a href="index.php?sect=project&id='.$data['id'].'">'.$data['name'].'</a>';?></div>
  <div id="code"><?php echo $data['account'].' - '.$data['number'].'<br>';?></div>

  <form action="index.php" method="get" id="EditProject">
    <input type="hidden" name = "sect" value="project">
    <input type="hidden" name = "id" value=<?php echo '"'.$data['id'].'"'?>>
  <table cellpadding="5px">
 	 <tr><td  width="155" align="right">Название:</td>
     <td align="left"><input class="txtbtn" type="text" name="name" value=<?php echo '"'.$data['name'].'"';?>></td></tr>
 	  <tr><td align="right">Компания:</td>
      <td align="left"><input class="txtbtn" type="text" name="account" value=<?php echo '"'.$data['account'].'"';?>></td></tr>
    <tr><td align="right">Номер Проекта:</td>
        <td align="left"><input class="txtbtn" type="text" name="number" value=<?php echo '"'.$data['number'].'"';?>></td></tr>
    <tr><td align="right">Производитель:</td>
      <td align="left"><input class="txtbtn" type="text" name="producerId" value=<?php echo '"'.$data['producerId'].'"';?>></td></tr>
    <tr><td align="right">Дилер:</td>
        <td align="left"><input class="txtbtn" type="text" name="dealerId" value=<?php echo '"'.$data['dealerId'].'"';?>></td></tr>
 	  <tr><td align="right">Ссылки:</td>
      <td align="left"><input class="txtbtn" type="text" name="tag" value=<?php echo '"'.$data['tag'].'"';?>></td></tr>
 	  <tr><td align="right">Статус:</td>
      <td align="left">
        <select class="txtbtn" name="status" size="3" value="active">
          <option selected value="active">Активно</option>
          <option <?php if ($data['status']=='closed') echo "selected";?> value="closed">Закрыто</option>
          <option <?php if ($data['status']=='finish') echo "selected";?> value="finish">Завершено</option>
        </select>
      </td></tr>
    <tr><td align="right" valign="top">Дополнительная информация:</td>
      <td class="txt" align="left"><input class="txtbtn" type="text" name="text"></td></tr>
  </table>
</form>
 </div>
 <div id="rightblock">
<br>
<input form="EditProject" class="txtbtn" type="submit" name="projSave" value="Сохранить">
 </div>
</div>
