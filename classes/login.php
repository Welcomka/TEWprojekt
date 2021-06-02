<?php
require_once 'database.php';

class Login{

    private $conn;

    // Constructor
    public function __construct(){
      $database = new Database();
      $db = $database->dbConnection();
      $this->conn = $db;
    }

    // Execute queries SQL
    public function runQuery($sql){
      $stmt = $this->conn->prepare($sql);
      return $stmt;
    }


    public function overeniUzivatele($uzivatelskeJmeno, $heslo){ 
        
        try{
            $stmt = $this->conn->prepare("SELECT * FROM UZIVATEL WHERE uzivatelske_jmeno = :uzivatelskeJmeno AND heslo = :heslo");
            $stmt->bindparam(":uzivatelskeJmeno", $uzivatelskeJmeno);
            $stmt->bindparam(":heslo", $heslo);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
            

          }catch(PDOException $e){
            echo $e->getMessage();
          }
        }

        // Redirect URL method
    public function redirect($url){
        header("Location: $url");
      }
    }

?>