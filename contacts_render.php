<div id="content">
 <div id="leftblock">
 <div id="table">
<?php
require_once("table/contactsTableHead.php");
foreach ($data as $key => $value) {
 	$i++;
 	if (($i>=$page) and ($i<=($page+$rowsOnPage))) {
    require("table/contactsTable.php");
  	}
 }
?>
  </table>
 </div></div>
 <div id="rightblock">
 <br>
 <form action="index.php" method="get">
   <input type="hidden" name = "sect" value="New_Contact">
   <input type="submit" class="txtbtn" value="Новый Контакт">
 </form>
 Поиск:
  <div class="search">
   <form method="get">
   <?php echo '<input type="hidden" name = "sect" value="'.$_GET['sect'].'">'?>
    <input class="txtbtn" name="search" type="text" placeholder="Фамилия или Имя">
   </form>
  </div>
  <br>
  Выбрать контакты.<br>
  Тип:
  <form method="get">
   <?php echo '<input type="hidden" name = "sect" value="'.$_GET['sect'].'">'?>
    <label><input type="radio" name="role" value="custom">Клиент</label><br>
    <label><input type="radio" name="role" value="dealer">Дилер</label><br>
    <label><input type="radio" name="role" value="produc">Поставщик</label><br>
    Тэги:<br>
    <?php
    $tags=accGetTags();
    foreach ($tags as $key => $value) {
    	echo '
    	<input type="checkbox" name="tag[]" value="'.$value.'">'.$value.'<br>
    	';
    }
    echo '<br>
    <input type="checkbox" name="makeCSV" value="makeCSV">Сохранить в CSV<br>
    ';
    ?>
    <input class="txtbtn" type="submit">
   </form>
   Страницы:
   <?php
   $pages = count($data)/$rowsOnPage;
	for ($i=0; $i < $pages; $i++) {
		echo '
		<a href="http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'].'&page='.$i.'">'.($i+1).'</a>
		'; /*склеиваем ссылки текущая Страницы + гет запрос*/
	}?>
 </div>
</div>
