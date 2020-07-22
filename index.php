<?php
 session_start();
 require_once('func/functions.php');
	$sect = '';
	if (isset($_GET["sect"]))
		$sect = $_GET["sect"];
	else $sect = 'reg';

$logined = false;
if (isset($_SESSION['login']) && isset($_SESSION['id'])) {
  $logined=true;
  $userId=$_SESSION['id'];
}
//потом сделать остальный по аналогии в начала сбор данных а внизу рендер
if ($sect=='contacts') require_once('contacts_data.php');
?>
<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8">
 <title>MySympleCRM</title>
 <link rel="stylesheet" type="text/css" href="css/main.css" charset="utf-8">
 <link rel="stylesheet" href="css/font-awesome.min.css">
 <meta name="description" content="MySympleCRM - простая удобная и открытая CRM система">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link href="img/favicon.ico" rel="shortcut icon" type="image/x-icon">
</head>
<body>
 <div id="wrapper">
  <header>
   <div id="logo">
	<a href="/index.php" title="На главную">
	 <img src="img/logo.png" title="MySympleCRM" alt="MySympleCRM">
	</a>
   </div>
   <div class="bigres">
   <div id="menu">CRM for IMTT. <?php if($logined) echo "User - ".$_SESSION['login'];?></div>
   </div>
  </header>

  <div id="main">
   <div id="leftmenu"><div class="bigres">
   	<div id="leftmenubtn"><a href="/index.php?sect=accounts"><i class="fa fa-industry" aria-hidden="true"></i> Компании</a></div><br>
   	<div id="leftmenubtn"><a href="/index.php?sect=contacts"><i class="fa fa-users" aria-hidden="true"></i> Контакты</a></div><br>
   	<div id="leftmenubtn"><a href="/index.php?sect=projects"><i class="fa fa-briefcase" aria-hidden="true"></i> Проекты</a></div><br>
   	<div id="leftmenubtn"><a href="/index.php?sect=mail"><i class="fa fa-envelope-o" aria-hidden="true"></i> Письма</a></div><br>
    <div id="leftmenubtn"><a href="/index.php?sect=set"><i class="fa fa-cog" aria-hidden=""></i> Настройки</a></div>
   </div>
   <div class="smallres">
   	<div id="leftmenubtn"><a href="/index.php?sect=accounts"><i class="fa fa-industry" aria-hidden="true"></i></a></div><br>
   	<div id="leftmenubtn"><a href="/index.php?sect=contacts"><i class="fa fa-users" aria-hidden="true"></i></a></div><br>
   	<div id="leftmenubtn"><a href="/index.php?sect=projects"><i class="fa fa-briefcase" aria-hidden="true"></i></a></div><br>
   	<div id="leftmenubtn"><a href="/index.php?sect=mail"><i class="fa fa-envelope-o" aria-hidden="true"></i></a></div><br>
    <div id="leftmenubtn"><a href="/index.php?sect=set"><i class="fa fa-cog" aria-hidden=""></i></a></div>
   </div>
 </div>
   <!-- Переменный блок -->
   <?php
   if ($logined) {
    if ($sect=='accounts') require_once('accounts.php');
    elseif ($sect=='contacts') require_once('contacts_render.php');
    elseif ($sect=='projects') require_once('projects.php');
    elseif ($sect=='task') require_once('tasks.php');
    elseif ($sect=='mail') require_once('emails.php');
    elseif ($sect=='set') require_once('settings.php');
    elseif ($sect=='New_Account') require_once('newAcc.php');
    elseif ($sect=='account') require_once('account.php');
    elseif ($sect=='accedit') require_once('accedit.php');
    elseif ($sect=='New_Contact') require_once('newCont.php');
    elseif ($sect=='contact') require_once('contact.php');
    elseif ($sect=='contedit') require_once('contedit.php');
    elseif ($sect=='project') require_once('project.php');
    elseif ($sect=='projedit') require_once('projedit.php');
    elseif ($sect=='New_Project') require_once('newProj.php');
    else require_once('logined.php');
   }
   else require_once('auth.php');?>

  </div>
  <footer>
   <div id="telmail"></div>
  </footer>
 </div>
</body>
</html>
