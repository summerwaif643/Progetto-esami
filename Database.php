<?php

class Database{
    private $databaseHostname;
    private $databaseUsername;
    private $databasePassword;
    private $databaseName;

    public $errorName;

    /*
    Classe per la gestione alla connessione del database. 
    Esiste per due motivi;
        Aprire una connessione ogni qualvolta che c'e' n'e' bisogno
        in modo da non tenere una connessione aperta per tutta la 
        durata della sessione
        e
        Creare piu' astrattismo possibile. 

    */

    //inserimento della query basato su stringa 
    public function insertQuery($queryString){
        if($this->connect()->query($queryString)){
            return TRUE;
        }
            else return FALSE;
    }

    //Select sull'ultimo ID AUTOINCREMENT nella tabella clienti per chiavi esterne
    public function lastId(){
        $mysql = $this->connect();
        $lastIdQuery = "SELECT MAX(idClienti) FROM Clienti";
        
        $result = $mysql->query($lastIdQuery);

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                    $id = $row["MAX(idClienti)"];                
            }
            return $id;
        }   else return FALSE;
    }

    public function login($username, $password){
        //
        $mysql = $this->connect();
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);

        if(password_verify($password, $hashPassword)){
            $loginQuery = "SELECT *
                        FROM Login_Operatori
                        WHERE Login = '$username';
        ";
        echo 'password verificata\n';
        echo $username;
        $result = $mysql->query($loginQuery);

            if($result->num_rows > 0){
                echo "LINEEEEEEEEEEEE";
                return "success";
                } else {
                    //error page
                    return "error";
                 } 

            }
        
    }

    public function connect(){
        //funzione di connessione al database. 
        $this->databaseHostname = "localhost";
        $this->databaseName = 'isp';
        $this->databasePassword = ''; 
        $this->databaseUsername = 'root';

        $connection = new mysqli($this->databaseHostname, 
                                    $this->databaseUsername, 
                                    $this->databasePassword, 
                                    $this->databaseName);
        return $connection;
    }

}

?>