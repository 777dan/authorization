<?php
if (!isset($_GET['goReg'])) {
    echo "<form>
Login: <input type='text' name='loginReg'>
Password: <input type='password' name='passwdReg'>
<input type='submit' name='goReg' value='GoReg'>
</form>";
} else {
    $loginReg = $_GET['loginReg'];
    $passwdReg = $_GET['passwdReg'];
    $filename = "array.txt";
    $file = fopen($filename, "r+");
    $content = fread($file, filesize($filename));
    $delContentFile = fopen($filename, "w");
    $arr = unserialize($content);
    // print_r($arr);
    foreach ($arr as $login => $password) {
        if ($_GET['loginReg'] != $login) {
            $passwdReg = password_hash($passwdReg, PASSWORD_DEFAULT);
            $arr[$loginReg] = $passwdReg;
            // print_r($arr);
            $updArr = serialize($arr);
            fwrite($delContentFile, $updArr);
            break;
        } else {
            echo "Ошибка регистрации!";
        }
    }
    fclose($file);
}
