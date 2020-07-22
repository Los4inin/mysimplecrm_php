<?php require_once('func/setFunc.php');
$access=getAccessByUserId($_SESSION['id']);
?>
   <div id="content">
    <div id="leftblock">
      <br><br><br><br><br><br><br><br><br><br><br><br><br>
Так как из MDCRM мы получаем табличку контактов с указанием имени ParentAccount, но не его Id, как нам нужно - кнопка ниже запустит скрипт, который выставит Id согласно имени. Работает только с правами доступа админимтратора
      <form action="index.php" method="get">
       <input type="hidden" name = "sect" value="set">
       <input type="submit" name="SetParentAccID">
      </form>
      <?php
      if (isset($_GET['SetParentAccID'])) {
        if ($access=='adm') setParentAccIdInCont();
        else echo "<br>У Вас не достаточно прав доступа!";
      }
        ?>

    </div>
    <div id="rightblock">

    </div>
   </div>
