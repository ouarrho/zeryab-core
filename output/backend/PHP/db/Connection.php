<?php

class Connection {

  private $servername = 'localhost';
  private $username = 'username';
  private $password = 'password';
  private $dbname = 'database_name';
  private $charset = 'utf8mb4';

  protected $conn;

  public function __construct() {
    try {
      $dsn = 'mysql:host=' . $this->servername . ';dbname=' . $this->dbname . ';charset=' . $this->charset;
      $this->conn = new PDO($dsn, $this->username, $this->password);
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      echo 'Connection failed: ' . $e->getMessage();
    }
  }

  public function __destruct() {
    $this->conn = null;
  }

}

?>