<html>

<body>
<form action="<?php $_SERVER['PHP_SELF'];?>" method= "POST">

    <button type="submit" value="salva"> Salva dati </button>

</form>

</body>

</html>
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
    $mysql = $mysql->connect();

    $sessionUsername = $_SESSION['username'];
    console_log($sessionUsername . "quaaa");

    $selectQuery = "SELECT (Nome, Cognome, Indirizzo, Recapito,
                            PrezzoMensile, Tipologia, DataInizio)
                    FROM    Clienti FULL JOIN Contratti ON idClienti = idContratti
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