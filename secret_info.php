<?php
if (session_status() != PHP_SESSION_ACTIVE) {
	session_start();
} // створюємо нову сесію або відновлюємо поточну   
if (!isset($_SESSION['authorized']))  // перевіряємо правильність авторизації    
    header("Location: authorize.php"); 
    // якщо помилка, то перенаправляємо на сторінку авторизації
?>
<html>
<head><title>Secret info</title></head>
 <!-- здесь располагается "секретна інформація"-->
 <?php 
 if (isset($_SESSION['login'])){
    echo "Здравствуйте, " . $_SESSION['login'] . ". Вход в аккаунт успешно завершён!";
}
    // print_r($_SESSION);// виводимо змінні сесії ?> 
    <br><a href="index.php">На главную</a>
</html>