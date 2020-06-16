<?php
    require 'Database.php';
    session_start();

    $mysql = new Database();
    $sessionUsername = $_SESSION['username'];

    //Query per ottenimento dati creazione xml 
    $queryDati = "SELECT idClienti, Nome, Cognome, Indirizzo, Recapito,
                    Contratti.idContratti, Contratti.PrezzoMensile, Contratti.Tipologia, Contratti.DataInizio
                    FROM Clienti FULL JOIN Contratti ON idClienti = Clienti_idClienti
                    WHERE Operatori_Login_Operatori_Login = '$sessionUsername';";
    
    $result = $mysql->connect()->query($queryDati);
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            //costruzione xml all'interno della query
            echo '
                <Cliente>
                    <ID> ' . $row['idClienti'] . ' </ID>
                    <Nome> ' . $row ['Nome'] .' </Nome>
                    <Cognome> ' . $row['Cognome'] .' </Cognome>
                    <Indirizzo> ' . $row['Indirizzo'] .' </Indirizzo>
                    <Recapito> ' . $row['Recapito'] .' </Recapito>

                    <Contratto>
                        <ID> ' . $row['idContratti'] .' </ID>
                        <Prezzo Mensile> ' . $row['PrezzoMensile'] . '  </Prezzo Mensile>
                        <Tipologia> ' . $row['Tipologia'] . ' </Tipologia>
                        <Data inizio> ' . $row['DataInizio'] . ' </Data inizio>
                    </Contratto>
                </Cliente>
                <br>
            ';
            }
    }
?>