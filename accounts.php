<?php require_once('func/funcAcc.php');
$rowsOnPage=50;
?>
<div id="content">
 <div id="leftblock">
 <div id="table">
<?php
require_once("table/accountsTableHead.php");
 if (isset($_GET['search'])) $data = searchAccounts($_GET['search']);
 elseif ((isset($_GET['role'])) or (isset($_GET['tag']))){
  if (isset($_GET['role'])) $role=$_GET['role'];
  else $role='';
  if (!isset($_GET['tag'])){
  	$tag='';
    $data = accountsByRoleAndTag($role, $tag);
  } else {
  	$tag=$_GET['tag'];
  	$data=array('');
  	foreach ($tag as $key => $value) {
  		$iteration = accountsByRoleAndTag($role, $value);
  		$data=array_merge($data, $iteration);
  	}
  	/*$data = array_unique($data); не работает для многомерных массивов*/
  	$data = array_diff($data, array(''));
  	//попробуем удалить дубли и многомерного массива ручками
  	$aux_res = array();
    $result_res = array();
    //создание одномерного массива
    foreach ($data as $key => $value) $aux_res[$key] = $value['id'];
    $aux_res = array_unique($aux_res);
 	//собираем обратно
    foreach ($aux_res as $key => $value) $result_res[$key] = $data[$key] ;
	$data=$result_res;
  }
 }
 else $data = getAccounts();
$page=getPage();
$page=$page*$rowsOnPage;
$i=0;
 foreach ($data as $key => $value) {
 	$i++;
 	if (($i>=$page) and ($i<=($page+$rowsOnPage))) require("table/accountsTable.php");
 }
?>
  </table>
 </div></div>
 <div id="rightblock">
 <br>
 <form action="index.php" method="get">
   <input type="hidden" name = "sect" value="New_Account">
   <input type="submit" class="txtbtn" value="Новая Компания">
 </form>
 Поиск:
  <div class="search">
   <form method="get">
   <?php echo '<input type="hidden" name = "sect" value="'.$_GET['sect'].'">'?>
    <input class="txtbtn" name="search" type="text" placeholder="название компании">
   </form>
  </div>
  <br>
  Выбрать аккаунты.<br>
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
    }?>
    <input class="txtbtn" type="submit">
   </form>
   Страницы:
   <?php
   $pages = count($data)/$rowsOnPage;
	for ($i=0; $i < $pages; $i++) {
		echo '
		<a href="http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'].'&page='.$i.'">'.($i+1).'</a>
		';
	}?>
 </div>
</div>
