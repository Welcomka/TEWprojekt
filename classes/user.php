<?php

require_once 'database.php';

class User {
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

    // Insert
    public function insert($name, $lastname, $heslo, $uzivatelskeJmeno){
      try{
        $stmt = $this->conn->prepare("INSERT INTO uzivatel (Jmeno, Prijmeni, role, heslo, uzivatelske_jmeno) VALUES(:name, :lastname, 'uzivatel', :heslo, :uzivatelskeJmeno)");
        $stmt->bindparam(":name", $name);
        $stmt->bindparam(":lastname", $lastname);
        $stmt->bindparam(":heslo", $heslo);
        $stmt->bindparam(":uzivatelskeJmeno", $uzivatelskeJmeno);
        $stmt->execute();
        return $stmt;
      }catch(PDOException $e){
        echo $e->getMessage();
      }
    }


    // Update
    public function update($name, $lastname, $id, $heslo, $uzivatelskeJmeno){
        try{
          $stmt = $this->conn->prepare("UPDATE uzivatel SET Jmeno = :name, Prijmeni = :lastname, heslo = :heslo, uzivatelske_jmeno = :uzivatelskeJmeno WHERE uzivatelID = :id");
          $stmt->bindparam(":name", $name);
          $stmt->bindparam(":lastname", $lastname);
          $stmt->bindparam(":id", $id);
          $stmt->bindparam(":heslo", $heslo);
          $stmt->bindparam(":uzivatelskeJmeno", $uzivatelskeJmeno);
          $stmt->execute();
          return $stmt;
        }catch(PDOException $e){
          echo $e->getMessage();
        }
    }


    // Update adopce 

        public function updateAdopce($id){
        try{
          $stmt = $this->conn->prepare("UPDATE adopce SET UzivatelID = null WHERE uzivatelID = :id");
          $stmt->bindparam(":id", $id);
          $stmt->execute();
          return $stmt;
        }catch(PDOException $e){
          echo $e->getMessage();
        }
    }

      // Select role before remove
      public function selectRole($uzivatelID){
        try{
          $stmt = $this->conn->prepare("SELECT uzivatel.role FROM uzivatel WHERE uzivatelID = :id");
          $stmt->bindparam(":id", $uzivatelID);
          $stmt->execute();
          return $stmt;
        }catch(PDOException $e){
          echo $e->getMessage();
        }
    }


    // Delete
    public function delete($id){
     $this->updateAdopce($id);
      try{
        $stmt = $this->conn->prepare("DELETE FROM uzivatel WHERE uzivatelID = :id");
        $stmt->bindparam(":id", $id);
        $stmt->execute();
        return $stmt;
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
