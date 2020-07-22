<?php require_once('func/funcAcc.php');
$accId=$_GET['id'];
if (file_exists('imgacc/'.$accId.'.png')) $acclogo='imgacc/'.$accId.'.png';
else $acclogo='/imgacc/0.png';
$data=getAccountData($accId);

if (isset($_GET['accSave'])) {
  $access=getUserAccessById($userId);
  if (($access=='usr') or ($access=='adm')){
    updAccountData($accId, $userId, $_GET['name'], $_GET['www'], $_GET['tel1'], $_GET['tel2'], $_GET['email1'], $_GET['email2'], $_GET['skype'], $_GET['region'], $_GET['parentAccount'], $_GET['tag'], $_GET['role'], $_GET['text']);
    header("Location: index.php?sect=account&id=".$accId);
  }
  else echo '<script>alert("не достаточно прав для внесения изменений");</script>';
}
elseif (isset($_GET['CreateAcc'])) {
  $access=getUserAccessById($userId);
  if (($access=='usr') or ($access=='adm')){
    createAccount($accId, $userId, $_GET['name'], $_GET['code'], $_GET['www'], $_GET['tel1'], $_GET['tel2'], $_GET['email1'], $_GET['email2'], $_GET['skype'], $_GET['region'], $_GET['parentAccount'], $_GET['tag'], $_GET['role'], $_GET['text']);
    header("Location: index.php?sect=account&id=".$accId);
  }
  else echo '<script>alert("не достаточно прав для внесения изменений");</script>';
}
?>

<div id="content">
 <div id="leftblock">
 	<?php echo '<img src="'.$acclogo.'">';?>
 	<div id="name"><?php echo '<a href="index.php?sect=account&id='.$data['id'].'">'.$data['name'].'</a>';?></div>
 	<div id="code"><?php echo $data['code'].' &nbsp&nbsp id: '.$data['id'].'<br><a href="'.$data['www'].'" target="_blank">'.$data['www'].'</a>';?></div>
  <?php
  if (isset($_GET['subsect'])) {
    switch($_GET['subsect']){
      case 'cont':
        echo '<div id="table">'; //добавил
        require_once("table/contactsTableHead.php");
        $data=getContactsByParentAcc($accId);
        foreach ($data as $key => $value)
           require("table/contactsTable.php");
        echo "</table></div>";
        break;

      case 'subacc':
        echo '<div id="table">';
        require_once("table/accountsTableHead.php");
        $data=getAccountsByParentAcc($accId);
        foreach ($data as $key => $value)
           require("table/accountsTable.php");
        echo "</table></div>";
        break;

      case 'proj':
        echo '<div id="table">';
        require_once("table/projTableHead.php");
        $data=getProjectsByCode($data['code']);
        foreach ($data as $key => $value)
           require("table/projTable.php");
        echo "</table></div>";
        break;
      case 'task':
        echo "task";
        break;
      case 'letter':
        echo "letter";
        break;
      case 'news':
        echo "news";
        break;
    }
  }
  else { $parentAccount=getAccountData($data['parentAccount']);
    echo
  '<table cellpadding="5px">
    <tr><td  width="155" align="right">Телефон:</td><td align="left">'.$data['tel1'].'</td></tr>
     <tr><td align="right">Доп телефон:</td><td align="left">'.$data['tel2'].'</td></tr>
     <tr><td align="right">Почта:</td><td align="left">'.$data['email1'].'</td></tr>
     <tr><td align="right">Доп почта:</td><td align="left">'.$data['email2'].'</td></tr>
     <tr><td align="right">Скайп:</td><td align="left">'.$data['skype'].'</td></tr>
     <tr><td align="right">Регион:</td><td align="left">'.$data['region'].'</td></tr>
     <tr><td align="right">Parent Account:</td><td align="left"><a href="index.php?sect=account&id='.$parentAccount['id'].'">'.$parentAccount['name'].'</a></td></tr>
     <tr><td align="right">Ссылки:</td><td align="left">'.$data['tag'].'</td></tr>
     <tr><td align="right">Тип:</td><td align="left">'.$data['role'].'</td></tr>
     <tr><td align="right" valign="top">Дополнительная информация:</td><td class="txt" align="left">'.$data['text'].'</td></tr>
   </table>';
  } ?>


 </div>
 <div id="rightblock">
 <br>
 <form action="index.php" method="get">
   <input type="hidden" name = "sect" value="accedit">
   <input type="hidden" name = "id" <?php echo "value=".$accId;?>>
   <input type="submit" class="txtbtn" value="Изменить">
 </form><br>
 <form action="index.php" method="get">
   <input type="hidden" name = "sect" value="account">
   <input type="hidden" name = "id" <?php echo "value=".$accId;?>>
   <input type="hidden" name = "subsect" value="cont">
   <input type="submit" class="txtbtn" value="Контакты">
 </form>
 <form action="index.php" method="get">
   <input type="hidden" name = "sect" value="account">
   <input type="hidden" name = "id" <?php echo "value=".$accId;?>>
   <input type="hidden" name = "subsect" value="subacc">
   <input type="submit" class="txtbtn" value="Под-Аккаунты">
 </form>
 <form action="index.php" method="get">
   <input type="hidden" name = "sect" value="account">
   <input type="hidden" name = "id" <?php echo "value=".$accId;?>>
   <input type="hidden" name = "subsect" value="proj">
   <input type="submit" class="txtbtn" value="Проекты">
 </form>
 <form action="index.php" method="get">
   <input type="hidden" name = "sect" value="account">
   <input type="hidden" name = "id" <?php echo "value=".$accId;?>>
   <input type="hidden" name = "subsect" value="task">
   <input type="submit" class="txtbtn" value="Задачи">
 </form>
 <form action="index.php" method="get">
   <input type="hidden" name = "sect" value="account">
   <input type="hidden" name = "id" <?php echo "value=".$accId;?>>
   <input type="hidden" name = "subsect" value="letter">
   <input type="submit" class="txtbtn" value="Письма">
 </form>
 <form action="index.php" method="get">
   <input type="hidden" name = "sect" value="account">
   <input type="hidden" name = "id" <?php echo "value=".$accId;?>>
   <input type="hidden" name = "subsect" value="news">
   <input type="submit" class="txtbtn" value="Новости">
 </form> <!-- Прошерстить яндекс новости -->
 </div>
</div>
