<?php
require_once '../db/Connection.php';

class Users extends Connection {
  private $pdo;

  public function __construct() {
    $connection = new Connection();
    $this->pdo = $connection->conn;
  }

	public function insert(array $data): bool {
  	$userId = ( isset($data[ 'userId' ]) && !empty($data[ 'userId' ]) ) ? htmlspecialchars( $data[ 'userId' ], ENT_QUOTES, 'UTF-8' ) : null;
  	$userName = ( isset($data[ 'userName' ]) && !empty($data[ 'userName' ]) ) ? htmlspecialchars( $data[ 'userName' ], ENT_QUOTES, 'UTF-8' ) : null;

  	$sql = "INSERT INTO users (userId, userName) VALUES (:userId, :userName)";
  	$stmt = $this->pdo->prepare($sql);

  	$stmt->bindParam(':userId', $userId);
  	$stmt->bindParam(':userName', $userName);

  	return $stmt->execute();
	}

}
?>