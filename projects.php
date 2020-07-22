<?php require_once('func/funcProj.php');
$rowsOnPage=50;
?>
<div id="content">
 <div id="leftblock">
 <div id="table">
<?php
require_once('table/projTableHead.php');
 if (isset($_GET['search'])) $data = searchProjects($_GET['search']);
 elseif ((isset($_GET['status'])) or (isset($_GET['tag']))){
  if (isset($_GET['status'])) $status=$_GET['status'];
  else $status='';
  if (!isset($_GET['tag'])){
  	$tag='';
    $data = projectsByStatusAndTag($status, $tag);
  } else {
  	$tag=$_GET['tag'];
  	$data=array('');
  	foreach ($tag as $key => $value) {
  		$iteration = projectsByStatusAndTag($status, $tag);
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
 else $data = getProjects();
 $page=getPage();
 $page=$page*$rowsOnPage;
 $i=0;
  foreach ($data as $key => $value) {
  	$i++;
  	if (($i>=$page) and ($i<=($page+$rowsOnPage))) require('table/projTable.php');
  }
 ?>
   </table>
  </div></div>
<div id="rightblock">
  <br>
  <form action="index.php" method="get">
    <input type="hidden" name = "sect" value="New_Project">
    <input type="submit" class="txtbtn" value="Новый проект">
  </form>
  Поиск:
   <div class="search">
    <form method="get">
    <?php echo '<input type="hidden" name = "sect" value="'.$_GET['sect'].'">'?>
     <input class="txtbtn" name="search" type="text" placeholder="название проекта">
    </form>
   </div>
   <br>

<form method="get">
  <?php echo '<input type="hidden" name = "sect" value="'.$_GET['sect'].'">'?>
  Статус:<br>
  <label><input type="radio" name="status" value="active">Активен</label><br>
  <label><input type="radio" name="status" value="closed">Закрыт</label><br>
  <label><input type="radio" name="status" value="finish">Завершен</label><br>
  Тэги:<br>
  <?php
  $tags=projGetTags();
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
