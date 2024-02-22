<?php

class Connect {
    private $_servername;
    private $_username;
    private $_password;
    private $_database;

    public $_conn;

    function __construct($server, $user, $pass, $db) {
        $this->_servername = $server;
        $this->_username = $user;
        $this->_password = $pass;
        $this->_database = $db;

        try {
            $this->_conn = new PDO("mysql:host=$this->_servername;dbname=$this->_database", $this->_username, $this->_password);
            $this->_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           
        } catch (PDOException $e) {
            echo "Falha na conexão: " . $e->getMessage() . "<br/>";
        }
    }

    public function query($sql) {
        return $this->_conn->query($sql);
    }
}

$server = "localhost";
$user = "root";
$pass = "";
$db = "list";

$connection = new Connect($server, $user, $pass, $db);
?>