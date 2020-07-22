<?php require_once('func/funcProj.php');
$projId=$_GET['id'];
if (file_exists('imgproj/'.$projId.'.png')) $projlogo='imgproj/'.$projId.'.png';
else $projlogo='/imgproj/0.png';
$data=getProjectDataById($projId);

if (isset($_GET['projSave'])) {
  $access=getUserAccessById($userId);
  if (($access=='usr') or ($access=='adm')){
    updProjectData($projId, $userId, $_GET['name'], $_GET['account'], $_GET['number'], $_GET['producerId'], $_GET['dealerId'], $_GET['tag'], $_GET['status'], $_GET['text']);
    header("Location: index.php?sect=project&id=".$projId);
  }
  else echo '<script>alert("не достаточно прав для внесения изменений");</script>';
}
elseif (isset($_GET['CreateProj'])) {
  $access=getUserAccessById($userId);
  if (($access=='usr') or ($access=='adm')){
    createProject($projId, $userId, $_GET['name'], $_GET['account'], $_GET['number'], $_GET['producerId'], $_GET['dealerId'], $_GET['tag'], $_GET['status'], $_GET['text']);
    header("Location: index.php?sect=project&id=".$projId);
  }
  else echo '<script>alert("не достаточно прав для внесения изменений");</script>';
}?>
<div id="content">
 <div id="leftblock">
 	<?php echo '<img src="'.$projlogo.'">';?>
 	<div id="name"><?php echo '<a href="index.php?sect=project&id='.$data['id'].'">'.$data['name'].'</a>';?></div>
 	<div id="code"><?php echo $data['account'].' - '.$data['number'].'<br>';?></div>
  <?php
 $parentAccount=getAccountData($data['account']);
 $producer=getAccountData($data['producerId']);
 $dealer=getAccountData($data['dealerId']);
    echo
  '<table cellpadding="5px">
     <tr><td width="155" align="right">Компания:</td><td align="left"><a href="index.php?sect=account&id='.$parentAccount['id'].'">'.$parentAccount['name'].'</a></td></tr>
     <tr><td align="right">Производитель:</td><td align="left"><a href="index.php?sect=account&id='.$producer['id'].'">'.$producer['name'].'</a></td></tr>
     <tr><td align="right">Дилер:</td><td align="left"><a href="index.php?sect=account&id='.$dealer['id'].'">'.$dealer['name'].'</a></td></tr>
     <tr><td align="right">Ссылки:</td><td align="left">'.$data['tag'].'</td></tr>
     <tr><td align="right">Статус:</td><td align="left">'.$data['status'].'</td></tr>
     <tr><td align="right" valign="top">Дополнительная информация:</td><td class="txt" align="left">'.$data['text'].'</td></tr>
   </table>'; ?>
 </div>
 <div id="rightblock">
 <br>
 <form action="index.php" method="get">
   <input type="hidden" name = "sect" value="projedit">
   <input type="hidden" name = "id" <?php echo "value=".$projId;?>>
   <input type="submit" class="txtbtn" value="Редактировать">
 </form><br>
 </div>
</div>
