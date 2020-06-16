<html>

<title>Visualizzazione Fornitori.</title>

</html>

<?php

    require 'Database.php';
    session_start();
    $mysql = new Database();
    $sessionUsername = $_SESSION['username'];

    //query per uso tipologia (innestata)
    $tipologiaQuery = "SELECT Tipologia
                        FROM Contratti 
                        WHERE Operatori_Login_Operatori_Login = '$sessionUsername';";

    $result = $mysql->connect()->query($tipologiaQuery);
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $tipo = $row['Tipologia'];
        }
    }

    //query effettiva con uso della precedente query 
    $fornituraQuery = "SELECT NomeApparato, Prezzo, TipoApparecchiatura, NomeAzienda
                        FROM Apparecchiature JOIN Fornitori on idFornitore = Fornitori_idFornitore
                        WHERE TipoApparecchiatura = '$tipo';"
    ;

    $result = $mysql->connect()->query($fornituraQuery);
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            echo '  Nome Apparato: ' . $row['NomeApparato'] . '<br>' .
                    'Prezzo: ' . $row['Prezzo'] . '€' . '<br>'   .
                    'Tipo apparecchiatura: ' . $row['TipoApparecchiatura'] . '<br>' .
                    'Nome Azienda Fornitrice: ' . $row['NomeAzienda'] . '<br>' . '<br>' . ''
                    ;
        }
    }



?>