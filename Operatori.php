<html>
<title> Login Operatori </title>
<form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
    Username: <input type="text" name="username" required>
    <br>
    Password: <input type="text" name="password" required>
    <br>
    <input type="submit" name="accedi" value="submit" required>

</form>

<?php

require 'Database.php';
session_start();

$mysql = new Database();

if(isset($_POST['accedi'])){
    $username = $_POST["username"];
    $password = $_POST["password"];

    if($mysql->login($username, $password) != "error"){
        $_SESSION['username'] = $username;
        return header('location: visualizzazioneContratti.php');
    } else echo "Username o password sono errati. ";
}


?>
</html>