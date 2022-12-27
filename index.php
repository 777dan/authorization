<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
//unset($_SESSION['login']);
//unset($_SESSION['passwd']);
//unset($_SESSION['authorized']);
//session_unset();
?>
<html>

<head>
    <title>My home page</title>
</head>
<!-- домашняя страничка-->
<?php
// print_r($_SESSION); // виводимо змінні сесії 
?>
<br><a href="authorize.php">Вход</a>
<br><a href="reg.php">Регистрация</a>

</html>