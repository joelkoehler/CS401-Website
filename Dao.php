<?php

class Dao {
  private $host = "us-cdbr-iron-east-01.cleardb.net";
  private $dbname = "heroku_730de82995f159a";
  private $username = "bdfb2a9821da69";
  private $password = "eac98319";
  //private $host = "127.0.0.1";
  //private $dbname = "test2";
  //private $username = "root";
  //private $password = "";

  private $uid = "";

  public function getConnection() {
    try {
      $connection = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password);
    }
    catch (Exception $e) {
      return null;
    }
    return $connection;
  }

    public function emailExists($em) {
      $conn = $this->getConnection();
      $resultQuery = "select * from User where email like :email";
      $q = $conn->prepare($resultQuery);
      $q->bindParam(":email", $em);
      $q->execute();
      $resultCount = $q->rowCount();
      if ($resultCount > 0) {
        return true;
      }
      return false;
    }

    public function passwordMatches($em, $pass) {
      $conn = $this->getConnection();

      $resultQuery = "select password from User where email like :email limit 1";
      $q = $conn->prepare($resultQuery);
      $q->bindParam(":email", $em);
      $q->execute();
      $result = $q->fetch(PDO::FETCH_ASSOC);
      // if ($pass == $result['password']) {
      //   return true;
      // }
      // return false;

      if (password_verify($pass, $result['password'])) {
         return true;
      }
      else {
         return false;
      }
    }

    public function userExists($em, $pass) {
      $conn = $this->getConnection();
      $resultQuery = "select * from User where email like :email and password like :pass";
      $q = $conn->prepare($resultQuery);
      $q->bindParam(":email", $em);

      $q->bindParam(":pass", $hashedPassword);
      $q->execute();
      $resultCount = $q->rowCount();
      if ($resultCount > 0) {
        return true;
      }
      return false;
    }

    public function saveUser($em, $pass) {
      $conn = $this->getConnection();
      $saveQuery = "insert into User (email, password) values (:email, :password)";
      $q = $conn->prepare($saveQuery);
      $q->bindParam(":email", $em);
      $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);
      $q->bindParam(":password", $hashedPassword);
      //$hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 13]);
      //$q->bindParam(":password", $pass); //$hashedPassword
      if (!$this->emailExists($em)) {
        $q->execute();
        return true;
      }
      return false;
    }

    public function saveOrder($pack, $lat, $lon, $msg, $uid) {
      $package = 0;
      if ($pack == 'std') {
        $package = 100;
      }
      elseif ($pack == 'exp') {
        $package = 200;
      }
      $conn = $this->getConnection();
      $saveQuery = "insert into Orders (ItemCode, Latitude, Longitude, Message, UserID) values (:package, :lat, :lon, :msg, :uid)";
      $q = $conn->prepare($saveQuery);
      $q->bindParam(":package", $package);
      $q->bindParam(":lat", $lat);
      $q->bindParam(":lon", $lon);
      $q->bindParam(":msg", $msg);
      $q->bindParam(":uid", $uid);
      $q->execute();
    }

    public function getUserID($em) {
      $conn = $this->getConnection();
      $saveQuery = "select ID from User where email = :email limit 1";
      $q = $conn->prepare($saveQuery);
      $q->bindParam(":email", $em);
      $q->execute();
      $result = $q->fetch();
      return $result['ID'];
    }

    public function getOrders() {
      $conn = $this->getConnection();
      $uid = $_SESSION['userid'];

      // $saveQuery = "select * from Orders where UserID = :uid";
      // $q = $conn->prepare($saveQuery);
      // $q->bindParam(":uid", $uid);
      // $q->execute();
      // $result = $q->fetch(PDO::FETCH_ASSOC);
      // return $result;
      return $conn->query("select * from Orders where UserID = $uid", PDO::FETCH_ASSOC);
    }

}
