<?php

    require 'Database.php';
    //ottenimento variabile 
    $idCliente = $_GET['idClienti'];

    //Rimozione in base all'id con ON DELETE CASCADE
    $deleteQuery = "DELETE FROM CLIENTI where idClienti = '$idCliente';";

    $mysql = new Database();
    //esecuzioneQuery
    $mysql->insertQuery($deleteQuery);
    echo "Utente eliminato.";

?>