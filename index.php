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
        Recapito: <input type="tel" name="recapito" required>
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
    require 'Database.php' ;

    session_start();
    
    if(isset($_POST['invia']) === TRUE){
        //Gestione attributi cliente
        //classe per connessione al database
        $mysql = new Database();
        $date = new DateTime();

        $nome = $_POST['nome'];
        $cognome = $_POST['cognome'];
        $indirizzo = $_POST['indirizzo'];
        $recapito = $_POST['recapito'];

        //sanitizzazione input
        $nome = preg_replace('/[^A-Za-z0-9 ]/', '', $nome);
        $cognome = preg_replace('/[^A-Za-z0-9 ]/', '', $cognome);
        $indirizzo = preg_replace('/[^A-Za-z0-9 ]/', '', $indirizzo);
        $recapito = preg_replace('/[^A-Za-z0-9 ]/', '', $recapito);

        //Gestione contratto
        $offerta = $_POST['offerta'];
        //assegnazione operatori ed apparecchiatura per la tabella contratti
        switch($offerta){
            case 'adsl':
                $tipologia = "ADSL";
                $prezzo = 20.90;
                $apparecchiatura = "Fritz!Box 7272";
                $idApparecchiatura = 1;
                $idOperatore = 1;
                $idLogin = "ppanozzo@gmail.com";
                break;

            case 'fttc':
                $tipologia = "FTTC";
                $prezzo = 29.99;
                $apparecchiatura = "Fritz!Box 7430";
                $idApparecchiatura = 3;
                $idOperatore = 2;
                $idLogin = "vsepe@gmail.com";
                break;
                
            case 'ftth':
                $tipologia = "FTTH";
                $prezzo = 500;
                $apparecchiatura = "Fritz!Box 7590";
                $idApparecchiatura = 6;
                $idOperatore = 3;
                $idLogin = "dditrocchio@gmail.com";
                break;
        }
        
        //query per inserimento dei dati cliente
        $inserimentoCliente = "INSERT INTO Clienti (Nome, Cognome, Indirizzo, Recapito)
                                VALUES ('$nome', '$cognome', '$indirizzo', '$recapito');
        ";  

        $mysql->insertQuery($inserimentoCliente);
        
        //funzione per combaciamento chiave esterna (vedere Database.php)
        $lastId = $mysql->lastId();

        //query per inserimento contratto
        $inserimentoContratto = "INSERT INTO Contratti (PrezzoMensile,
                                                        Tipologia,
                                                        DataInizio,
                                                        Apparecchiature_idApparecchiature,
                                                        Operatori_idOperatori,
                                                        Operatori_Login_Operatori_Login,
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
