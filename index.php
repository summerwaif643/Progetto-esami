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
    
    if(isset($_POST['invia']) === TRUE){

        $nome = $_POST['nome'];
        $cognome = $_POST['cognome'];
        $indirizzo = $_POST['indirizzo'];
        $recapito = $_POST['recapito'];
        
        $inserimentoCliente = "INSERT INTO Clienti (Nome, Cognome, Indirizzo, Recapito)
                                VALUES ('$nome', '$cognome', '$indirizzo', '$recapito');
        ";  
        
        $mysql = new Database();
        $mysql->insertQuery($inserimentoCliente);
        
    }
    
    ?>

</body>


</html>
