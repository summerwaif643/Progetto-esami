<?php

    require 'Database.php';

    $mysql = new Database();
    $mysql->connect();

    if($mysql->connect()->connect_error){
        echo $mysql->connect()->connect_error;
    }

    $sessionUsername = $_SESSION['username'];

    $selectQuery = "SELECT (Nome, Cognome, Indirizzo, Recapito,
                            PrezzoMensile, Tipologia, DataInizio)
                    FROM    Clienti JOIN Contratti ON idClienti = idContratti
                    WHERE   Operatori_Login_Operatori_idLogin = '$sessionUsername';
                    ";

    $result = $mysql->query($selectQuery);
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            echo 'Nome: '. $row['Nome'] . '<br>' .
                    'Cognome: ' . $row['Cognome'] . '<br>' . 
                    'Indirizzo: ' . $row['Indirizzo'] . '<br>' .
                    'Recapito: ' . $row['Recapito'] . '<br>' .
                    'PrezzoMensile: ' . $row['PrezzoMensile'] . '<br>' . 
                    'Tipologia: ' . $row['Tipologia'] . '<br>' .
                    'DataInizio: ' . $row['DataInizio'] . '<br>';
            
        }
    }

?>