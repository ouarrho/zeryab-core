<?php

class Reactions {

  private $conn;

  public function __construct($conn) {
    $this->conn = $conn;
  }

  /**
   * Insert a new row into the reactions table.
   *
   * @param array $data An associative array of column names and their values to be inserted.
   * @return int The ID of the inserted row.
   */
  public function insert(array $data = []): int {
    $defaultValues = [
      'reactionId' => null,
      'reactionName' => null,
    ];

    $data = array_merge($defaultValues, $data);

    $sql = 'INSERT INTO reactions (`reactionId`, `reactionName`) VALUES (:reactionId, :reactionName)';
    $stmt = $this->conn->prepare($sql);
    $stmt->bindValue(':reactionId', $data['reactionId']);
    $stmt->bindValue(':reactionName', $data['reactionName']);
    $stmt->execute();
    return $this->conn->lastInsertId();
  }

}

?>