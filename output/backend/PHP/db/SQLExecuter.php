<?php

require_once 'Connection.php';

/**
 * The SQLExecuter class extends the Connection class and provides methods to execute SQL files.
 */
class SQLExecuter extends Connection {

  private $path = '../../output/databases/tables/';

  /**
   * SQLExecuter constructor.
   * @param string|null $path The path to the SQL files.
   */
  public function __construct($path = null) {
    parent::__construct();
    if ($path) {
      $this->path = $path;
    }
  }

  /**
   * Executes all the SQL files.
   */
  public function execute_all() {
  }

}


?>