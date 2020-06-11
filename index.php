<html>

<title>Home</title>

<body>
    <form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
        nome: <input type="text" name="nome" required>
        <br>
        cognome: <input type="text" name="cognome" required>
        <br>
        indirizzo: <input type="text" name="indirizzo" required>
        <br>
        Recapito: <input type="number" name="recapito" required>
        <br>
        Tipo contratto:
        <br>
            <input type="radio" name="offerta" value="adsl" method="POST">
            <label for="tipoContratto1"> ADSL 21.90 </label>
            <br>
            <input type="radio" name="offerta" value="fttc">
            <label for="tipoContratto2"> Fibra FTTC 29.90</label>
            <br>
            <input type="radio" name="offerta" value="ftth">
            <label for="tipoContratto3"> Fibra FTTH a progetto a partire da 600 </label>
            <br>
        <input type="checkbox" value="privacyCheck" required>
        Dichiaro di aver accettato l'informativa sulla privacy e di accettare
        il trattamento dei dati personali ai sensi del GPDR UE 2016/679
        <br>
        <input type="submit" name="invia" value="submit">
    </form>

    <?php
    /* GENERAL TODO 
    Sanitizza tutti gli input 
    Indicizzazione successo dopo submit inizialoe
    
    */

    require 'Database.php' ;

    function console_log($output, $with_script_tags = true) {
        $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
    ');';
        if ($with_script_tags) {
            $js_code = '<script>' . $js_code . '</script>';
        }
        echo $js_code;
    }

    session_start();
    
    if(isset($_POST['invia']) === TRUE){
        //Gestione attributi cliente
        $mysql = new Database();
        $date = new DateTime();

        $nome = $_POST['nome'];
        $cognome = $_POST['cognome'];
        $indirizzo = $_POST['indirizzo'];
        $recapito = $_POST['recapito'];

        //Gestione contratto
        $offerta = $_POST['offerta'];
        switch($offerta){
            case 'adsl':
                $tipologia = "ADSL";
                $prezzo = 20.90;
                $apparecchiatura = "Fritz!Box 7272";
                $idApparecchiatura = 1;
                $idOperatore = 1;
                $idLogin = 1;
                break;

            case 'fttc':
                $tipologia = "FTTC";
                $prezzo = 29.99;
                $apparecchiatura = "Fritz!Box 7430";
                $idApparecchiatura = 3;
                $idOperatore = 2;
                $idLogin = 2;
                break;
                
            case 'ftth':
                $tipologia = "FTTH";
                $prezzo = 500;
                $apparecchiatura = "Fritz!Box 7590";
                $idApparecchiatura = 6;
                $idOperatore = 3;
                $idLogin = 3;
                break;
        }
        
        $inserimentoCliente = "INSERT INTO Clienti (Nome, Cognome, Indirizzo, Recapito)
                                VALUES ('$nome', '$cognome', '$indirizzo', '$recapito');
        ";  

        $mysql->insertQuery($inserimentoCliente);
        $lastId = $mysql->lastId();
        $time = var_dump($date->getTimestamp());

        $inserimentoContratto = "INSERT INTO Contratti (PrezzoMensile,
                                                        Tipologia,
                                                        DataInizio,
                                                        Apparecchiature_idApparecchiature,
                                                        Operatori_idOperatori,
                                                        Operatori_Login_Operatori_idLogin,
                                                        Clienti_idClienti)
                                                VALUES  ('$prezzo',
                                                        '$tipologia',
                                                        '$time',
                                                        '$idApparecchiatura',
                                                        '$idOperatore',
                                                        '$idLogin',
                                                        '$lastId'
                                                        );";
        
        $mysql->insertQuery($inserimentoContratto);
        
    }
    
    ?>

</body>


</html>
