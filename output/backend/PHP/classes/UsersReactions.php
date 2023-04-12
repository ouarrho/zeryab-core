<?php

class UsersReactions {

  private $conn;

  public function __construct($conn) {
    $this->conn = $conn;
  }

  /**
   * Insert a new row into the users_reactions table.
   *
   * @param array $data An associative array of column names and their values to be inserted.
   * @return int The ID of the inserted row.
   */
  public function insert(array $data = []): int {
    $defaultValues = [
      'userReactionId' => null,
      'userId' => null,
      'reactionId' => null,
    ];

    $data = array_merge($defaultValues, $data);

    $sql = 'INSERT INTO users_reactions (`userReactionId`, `userId`, `reactionId`) VALUES (:userReactionId, :userId, :reactionId)';
    $stmt = $this->conn->prepare($sql);
    $stmt->bindValue(':userReactionId', $data['userReactionId']);
    $stmt->bindValue(':userId', $data['userId']);
    $stmt->bindValue(':reactionId', $data['reactionId']);
    $stmt->execute();
    return $this->conn->lastInsertId();
  }

}

?>