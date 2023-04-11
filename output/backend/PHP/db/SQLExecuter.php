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
        $this->execute_users();
        $this->execute_reactions();
        $this->execute_users_reactions();
        $this->execute_users_reactions_fk();
    }

    /**
     * Executes the users.sql SQL file.
     */
    public function execute_users() {
        $sql = file_get_contents($this->path . 'users.sql');
        try {
            $this->conn->exec($sql);
            echo 'users.sql executed successfully.';
        } catch (PDOException $e) {
            echo 'Error executing users.sql: ' . $e->getMessage();
        }
    }

    /**
     * Executes the reactions.sql SQL file.
     */
    public function execute_reactions() {
        $sql = file_get_contents($this->path . 'reactions.sql');
        try {
            $this->conn->exec($sql);
            echo 'reactions.sql executed successfully.';
        } catch (PDOException $e) {
            echo 'Error executing reactions.sql: ' . $e->getMessage();
        }
    }

    /**
     * Executes the users_reactions.sql SQL file.
     */
    public function execute_users_reactions() {
        $sql = file_get_contents($this->path . 'users_reactions.sql');
        try {
            $this->conn->exec($sql);
            echo 'users_reactions.sql executed successfully.';
        } catch (PDOException $e) {
            echo 'Error executing users_reactions.sql: ' . $e->getMessage();
        }
    }

    /**
     * Executes the users_reactions_fk.sql SQL file.
     */
    public function execute_users_reactions_fk() {
        $sql = file_get_contents($this->path . 'users_reactions_fk.sql');
        try {
            $this->conn->exec($sql);
            echo 'users_reactions_fk.sql executed successfully.';
        } catch (PDOException $e) {
            echo 'Error executing users_reactions_fk.sql: ' . $e->getMessage();
        }
    }

}

?>