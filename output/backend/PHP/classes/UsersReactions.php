<?php
require_once '../db/Connection.php';

class UsersReactions extends Connection {
  private $pdo;

  public function __construct() {
    $connection = new Connection();
    $this->pdo = $connection->conn;
  }

	public function insert(array $data): bool {
  	$userReactionId = ( isset($data[ 'userReactionId' ]) && !empty($data[ 'userReactionId' ]) ) ? htmlspecialchars( $data[ 'userReactionId' ], ENT_QUOTES, 'UTF-8' ) : null;
  	$userId = ( isset($data[ 'userId' ]) && !empty($data[ 'userId' ]) ) ? htmlspecialchars( $data[ 'userId' ], ENT_QUOTES, 'UTF-8' ) : null;
  	$reactionId = ( isset($data[ 'reactionId' ]) && !empty($data[ 'reactionId' ]) ) ? htmlspecialchars( $data[ 'reactionId' ], ENT_QUOTES, 'UTF-8' ) : null;

  	$sql = "INSERT INTO users_reactions (userReactionId, userId, reactionId) VALUES (:userReactionId, :userId, :reactionId)";
  	$stmt = $this->pdo->prepare($sql);

  	$stmt->bindParam(':userReactionId', $userReactionId);
  	$stmt->bindParam(':userId', $userId);
  	$stmt->bindParam(':reactionId', $reactionId);

  	return $stmt->execute();
	}

}
?>