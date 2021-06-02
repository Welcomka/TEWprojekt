<?php

require_once 'database.php';

class Adopce {
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
    public function insert($kockaID, $uzivatelID, $penezniCastka){
      try{
        $stmt = $this->conn->prepare("INSERT INTO adopce (KockaID, UzivatelID, Penezni_castka) VALUES(:kockaID, :uzivatelID, :penezniCastka)");
        $stmt->bindparam(":kockaID", $kockaID);
        $stmt->bindparam(":uzivatelID", $uzivatelID);
        $stmt->bindparam(":penezniCastka", $penezniCastka);
        $stmt->execute();
        return $stmt;
      }catch(PDOException $e){
        echo $e->getMessage();
      }
    }


    // Update
    public function update($id, $kockaID, $uzivatelID, $penezniCastka){
        try{
          $stmt = $this->conn->prepare("UPDATE adopce SET KockaID = :kockaID, UzivatelID = :uzivatelID, Penezni_castka = :penezniCastka WHERE id = :id");
          $stmt->bindparam(":kockaID", $kockaID);
          $stmt->bindparam(":uzivatelID", $uzivatelID);
          $stmt->bindparam(":penezniCastka", $penezniCastka);
          $stmt->bindparam(":id", $id);
          $stmt->execute();
          return $stmt;
        }catch(PDOException $e){
          echo $e->getMessage();
        }
    }

    // Select
    public function select($uzivatelID){
      try{
        $stmt = $this->conn->prepare("SELECT adopce.id, adopce.KockaID, adopce.Penezni_castka, kocka.Jmeno as KockaJmeno FROM adopce INNER JOIN kocka ON adopce.KockaID = kocka.KockaID WHERE adopce.UzivatelID = :UzivatelID");
        $stmt->bindparam(":UzivatelID", $uzivatelID);
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
        $stmt = $this->conn->prepare("DELETE FROM adopce WHERE id = :id");
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
