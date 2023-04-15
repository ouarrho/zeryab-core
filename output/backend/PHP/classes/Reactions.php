<?php
require_once '../db/Connection.php';

class Reactions extends Connection {
  private $pdo;

  public function __construct() {
    $connection = new Connection();
    $this->pdo = $connection->conn;
  }

  public function insert(array $data): bool {
  $sql &#x3D; &quot;INSERT INTO reactions &quot;;
  $stmt &#x3D; $this-&gt;pdo-&gt;prepare($sql);

  $stmt-&gt;bindParam(&#x27;:&#x27;, $data[&#x27;reactionId&#x27;]);
  $stmt-&gt;bindParam(&#x27;:&#x27;, $data[&#x27;reactionName&#x27;]);

  return $stmt-&gt;execute();
}
/*
(reactionId, reactionName) VALUES (:, :)
*/

  

  

  
}
?>