<?php
class Config{ 
    protected $host; 
    protected $user;
    protected $pass;
    protected $dbname;
    function dbConfig(){
    $this->host= "localhost";
    $this->user= "root";
    $this->pass= "apollomoon";
    $this->dbname= "smsi";
    } 
}
?>