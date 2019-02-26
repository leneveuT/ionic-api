<?php
class Database{

    // preciser vos informations de connection à la base
    private $host = "localhost";
    private $db_name = "ionequi";
    private $username = "root";
    private $password = "";
    public $conn;

    // recupère la connection
    public function getConnection(){

        $this->conn = null;

        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
