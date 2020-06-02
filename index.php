<html>

<title>Home</title>

<body>
    <form action="<?php $_SERVER['PHP_SELF'];?>">
        nome: <input type="text" name="nome">
        <br>
        cognome: <input type="text" name="cognome">
        <br>
        indirizzo: <input type="text" name="indirizzo">
        <br>
        Recapito: <input type="number" name="recapito">
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
            <input type="submit">
    </form>
</body>


</html>
