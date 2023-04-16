<?php
require_once '../db/Connection.php';

class Reactions extends Connection {
  private $pdo;

  public function __construct() {
    $connection = new Connection();
    $this->pdo = $connection->conn;
  }

	public function insert(array $data): bool {
  	$reactionId = ( isset($data[ 'reactionId' ]) && !empty($data[ 'reactionId' ]) ) ? htmlspecialchars( $data[ 'reactionId' ], ENT_QUOTES, 'UTF-8' ) : null;
  	$reactionName = ( isset($data[ 'reactionName' ]) && !empty($data[ 'reactionName' ]) ) ? htmlspecialchars( $data[ 'reactionName' ], ENT_QUOTES, 'UTF-8' ) : null;

  	$sql = "INSERT INTO reactions (reactionId, reactionName) VALUES (:reactionId, :reactionName)";
  	$stmt = $this->pdo->prepare($sql);

  	$stmt->bindParam(':reactionId', $reactionId);
  	$stmt->bindParam(':reactionName', $reactionName);

  	return $stmt->execute();
	}

}
?>