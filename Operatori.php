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

//classe per connessione al database
$mysql = new Database();

if(isset($_POST['accedi'])){
    $username = $_POST["username"];
    $password = $_POST["password"];

    $username = preg_replace('/[^A-Za-z0-9 ]/', '', $username);
    $password = preg_replace('/[^A-Za-z0-9 ]/', '', $password);

    if($mysql->login($username, $password) != "error"){
        
        //asssegnazione della variabile di sessione username per uso in visualizzazioenContratti.php e altri
        $_SESSION['username'] = $username;
        return header('location: visualizzazioneContratti.php');
    } else echo "Username o password sono errati. ";
}


?>
</html>