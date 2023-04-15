<?php
require_once '../db/Connection.php';

class UsersReactions extends Connection {
  private $pdo;

  public function __construct() {
    $connection = new Connection();
    $this->pdo = $connection->conn;
  }

  public function insert(array $data): bool {
  $sql &#x3D; &quot;INSERT INTO users_reactions &quot;;
  $stmt &#x3D; $this-&gt;pdo-&gt;prepare($sql);

  $stmt-&gt;bindParam(&#x27;:&#x27;, $data[&#x27;userReactionId&#x27;]);
  $stmt-&gt;bindParam(&#x27;:&#x27;, $data[&#x27;userId&#x27;]);
  $stmt-&gt;bindParam(&#x27;:&#x27;, $data[&#x27;reactionId&#x27;]);

  return $stmt-&gt;execute();
}
/*
(userReactionId, userId, reactionId) VALUES (:, :, :)
*/

  

  

  
}
?>