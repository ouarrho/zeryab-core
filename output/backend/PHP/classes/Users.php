<?php

class Users {

  private $conn;

  public function __construct($conn) {
    $this->conn = $conn;
  }

  /**
   * Insert a new row into the users table.
   *
   * @param array $data An associative array of column names and their values to be inserted.
   * @return int The ID of the inserted row.
   */
  public function insert(array $data = []): int {
    $defaultValues = [
      'userId' => null,
      'userName' => null,
    ];

    $data = array_merge($defaultValues, $data);

    $sql = 'INSERT INTO users (`userId`, `userName`) VALUES (:userId, :userName)';
    $stmt = $this->conn->prepare($sql);
    $stmt->bindValue(':userId', $data['userId']);
    $stmt->bindValue(':userName', $data['userName']);
    $stmt->execute();
    return $this->conn->lastInsertId();
  }

}

?>