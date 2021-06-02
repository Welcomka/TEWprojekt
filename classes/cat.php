<?php

require_once 'database.php';

class Cat {
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
    public function insert($name, $rasa, $vek){
      if($rasa == ""){
        $rasa = null;
      }
      if($vek <= 0){
        $vek = null;
      }
      try{
        $stmt = $this->conn->prepare("INSERT INTO kocka (Jmeno, Rasa, Vek) VALUES(:name, :rasa, :vek)");
        $stmt->bindparam(":name", $name);
        $stmt->bindparam(":rasa", $rasa);
        $stmt->bindparam(":vek", $vek);
        $stmt->execute();
        return $stmt;
      }catch(PDOException $e){
        echo $e->getMessage();
      }
    }


    // Update
    public function update($name, $rasa, $vek, $id ){
      if($rasa == ""){
        $rasa = null;
      }
      if($vek <= 0){
        $vek = null;
      }
        try{
          $stmt = $this->conn->prepare("UPDATE kocka SET Jmeno = :name, Rasa = :rasa, Vek = :vek WHERE KockaID = :id");
          $stmt->bindparam(":name", $name);
          $stmt->bindparam(":rasa", $rasa);
          $stmt->bindparam(":vek", $vek);
          $stmt->bindparam(":id", $id);
          $stmt->execute();
          return $stmt;
        }catch(PDOException $e){
          echo $e->getMessage();
        }
    }


    // Update adopce

        public function updateAdopce($id){
        try{
          $stmt = $this->conn->prepare("UPDATE adopce SET KockaID = null WHERE KockaID = :id");
          $stmt->bindparam(":id", $id);
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
        $stmt = $this->conn->prepare("DELETE FROM Kocka WHERE KockaID = :id");
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
