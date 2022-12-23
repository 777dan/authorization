<?php
ob_start();
if (session_status() != PHP_SESSION_ACTIVE) {
	session_start();
}
// створюємо нову сесію або відновлюємо поточну
if (!isset($_GET['go'])) {
	echo "<form>
    Login: <input type='text' name='login'>
    Password: <input type='password' name='passwd'>
    <input type='submit' name='go' value='Go'>
  </form>";
	if (isset($_SESSION['err']) && ($_SESSION['err'] == 1)) {
		$_SESSION['err'] = 0;
		echo "Неправильне введення, спробуйте ще раз!<br>";
	}
} else {
	$_SESSION['login'] = $_GET['login'];
	$_SESSION['passwd'] = $_GET['passwd'];
	// реєструємо змінні login та passwd як глобальні змінні для цієї сесії
	include "array.php";
	foreach ($loginArr as $login => $password) {
		if ($_GET['login'] == $login && password_verify($_GET['passwd'], $password)) {
			$_SESSION['authorized'] = 1;
			header("Location: secret_info.php");
			ob_end_flush();
			break;
			// перенаправляємо на сторінку secret_info.php
		} 
		else {
			$_SESSION['err'] = 1;
			unset($_SESSION['authorized']);
			header("Location: authorize.php");
			ob_end_flush();
		}
	}
}
