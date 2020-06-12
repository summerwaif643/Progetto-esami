<?php

    require 'Database.php';
    $idCliente = $_GET['idClienti'];
    $deleteQuery = "DELETE FROM CLIENTI where idClienti = '$idCliente';";

    $mysql = new Database();
    $mysql->insertQuery($deleteQuery);
    echo "Utente eliminato.";

?>