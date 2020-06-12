<?php

class Database{
    private $databaseHostname;
    private $databaseUsername;
    private $databasePassword;
    private $databaseName;

    public $errorName;

    function console_log($output, $with_script_tags = true) {
        $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
    ');';
        if ($with_script_tags) {
            $js_code = '<script>' . $js_code . '</script>';
        }
        echo $js_code;
    }
 
    public function insertQuery($queryString){
        if($this->connect()->query($queryString)){
            return TRUE;
        }
            else return FALSE;
    }

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
        $mysql = $this->connect();

        //hasha la password
        $loginQuery = "SELECT *
                        FROM Login_Operatori
                        WHERE Login = '$username' AND
                                Password = '$password';
        ";

        $result = $mysql->query($loginQuery);

        if($result->num_rows > 0){
           return "success";
        } else {
            //error page
            return "error";
        } 

    }

    public function connect(){
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

    function __construct(){
        
    }

}

?>