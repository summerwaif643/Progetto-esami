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

$mysql = new Database();

if(isset($_POST['accedi'])){
    $username = $_POST["username"];
    $password = $_POST["password"];

    $mysql->login($username, $password);
    
}


?>
</html>