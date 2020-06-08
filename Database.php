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
            return 'Success!';
        }
            else return 'Fallimento!';
    }

    private function connect(){
        $this->databaseHostname = "localhost";
        $this->databaseName = 'isp';
        $this->databasePassword = ''; 
        $this->databaseUsername = 'root';

        $connection = new mysqli($this->databaseHostname, $this->databaseUsername, $this->databasePassword, $this->databaseName);
        return $connection;
    }

    function __construct(){
        
    }

}


?>