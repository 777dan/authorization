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
	$filename = "array.txt";
	$file = fopen($filename, "r+");
	$content = fread($file, filesize($filename));
	$arr = unserialize($content);
	$countBool = false;
	foreach ($arr as $login => $password) {
		if ($_GET['login'] == $login && password_verify($_GET['passwd'], $password)) {
			$countBool = true;
			// echo "$login: $password <br>";
			$_SESSION['authorized'] = 1;
			header("Location: secret_info.php");
			ob_end_flush();
			break;
			// перенаправляємо на сторінку secret_info.php
		} else {
			$countBool = false;
			// $_SESSION['err'] = 1;
			// unset($_SESSION['authorized']);
			// header("Location: authorize.php");
			// ob_end_flush();
		}
	}
	if ($countBool == false) {
		$_SESSION['err'] = 1;
		unset($_SESSION['authorized']);
		header("Location: authorize.php");
		ob_end_flush();
	}
	fclose($file);
}
