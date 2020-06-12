<html>

<title> Dati Clienti</title>

    <body>
        <a href="/Progetto-esami/saveData.php"> Salva i dati dei clienti </a>
        <br>
        <a href="/Progetto-esami/viewSuppliers.php"> Controlla gli apparati </a>
        <br>
        <br>


<?php

function console_log($output, $with_script_tags = true) {
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . ');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}

    require 'Database.php';
    session_start();

    $mysql = new Database();

    $sessionUsername = $_SESSION['username'];
    console_log($sessionUsername . "quaaa");

    $selectQuery = "SELECT idClienti, Nome, Cognome, Indirizzo, Recapito,
                            Contratti.idContratti, Contratti.PrezzoMensile, Contratti.Tipologia, Contratti.DataInizio 
                    FROM    Clienti FULL JOIN Contratti ON idClienti = Clienti_idClienti
                    WHERE   Operatori_Login_Operatori_Login = '$sessionUsername';
                    ";

    $result = $mysql->connect()->query($selectQuery);
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            echo 'Nome: '. $row['Nome'] . '<br>' .
                    'Cognome: ' . $row['Cognome'] . '<br>' . 
                    'Indirizzo: ' . $row['Indirizzo'] . '<br>' .
                    'Recapito: ' . $row['Recapito'] . '<br>' .
                    'PrezzoMensile: ' . $row['PrezzoMensile'] . '<br>' . 
                    'Tipologia: ' . $row['Tipologia'] . '<br>' .
                    'DataInizio: ' . $row['DataInizio'] . '<br>' .
                    "<a href='/Progetto-esami/delete.php?idClienti=" . $row['idClienti'] . '&idContratti=' . $row['idContratti'] . "'" . "> Elimina Utente. </a>" .
                    '<br>' . 
                    '<br>'
                    ;
                   
            
        }
    }

?>    
    </body>
        </html>