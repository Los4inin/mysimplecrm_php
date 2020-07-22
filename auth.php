   <div id="content">
    <div id="table">

     <div align="center"><h2>Авторизация на сайте:</h2>
      <form action="index.php" method="post">
       Логин: <input type="text" name="login"><br>
       Пароль: <input type="password" name="password"><br>
       <input type="submit" name="authorization">
      </form>
     </div>

    </div>
    <div id="rightblock">

    </div>
   </div>

<?php
    if (isset($_POST['authorization'])) {
        if (empty($_POST['login']))
            echo '<script>alert("Поле логин не заполненно");</script>';
        elseif (empty($_POST['password']))
            echo '<script>alert("Поле пароль не заполненно");</script>';
        else {
            $login = $_POST['login'];
            $password = $_POST['password'];
            connectDB();
            #$result = $mysqli->query("SELECT `id` FROM `mysimplecrm_users` WHERE `login` = '$login' AND `password` = MD5('$password')");
            $result = $mysqli->query("SELECT `id` FROM `mysimplecrm_users` WHERE `login` = '$login' AND `password` = '$password'"); 
            $user = $result->fetch_assoc();
            closeDB();
            if (empty($user['id']))
                echo '<script>alert("Неверные Логин или Пароль");</script>';
            else {
                $_SESSION['password'] = $password;
                $_SESSION['login'] = $login;
                $_SESSION['id'] = $user['id'];
            }
        }
    }
?>
