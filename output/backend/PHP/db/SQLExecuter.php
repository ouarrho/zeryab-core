<?php

class SQLExecuter {

    private $servername = 'localhost';
    private $username = 'root';
    private $password = '';
    private $dbname = 'zeryab';
    private $conn;
    private $path;

    public function __construct($path = '../../output/databases/tables/') {
        $this->path = $path;
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die('Connection failed: ' . $this->conn->connect_error);
        }
    }

    public function __destruct() {
        $this->conn->close();
    }

    public function executeAll() {
        $this->execute_users();
        $this->execute_reactions();
        $this->execute_users_reactions();
        $this->execute_users_reactions_fk();
    }

    public function execute_users() {
        $sql = file_get_contents($this->path . 'users.sql');
        if ($this->conn->multi_query($sql) === TRUE) {
            echo 'users.sql executed successfully.';
        } else {
            echo 'Error executing users.sql: ' . $this->conn->error;
        }
    }

    public function execute_reactions() {
        $sql = file_get_contents($this->path . 'reactions.sql');
        if ($this->conn->multi_query($sql) === TRUE) {
            echo 'reactions.sql executed successfully.';
        } else {
            echo 'Error executing reactions.sql: ' . $this->conn->error;
        }
    }

    public function execute_users_reactions() {
        $sql = file_get_contents($this->path . 'users_reactions.sql');
        if ($this->conn->multi_query($sql) === TRUE) {
            echo 'users_reactions.sql executed successfully.';
        } else {
            echo 'Error executing users_reactions.sql: ' . $this->conn->error;
        }
    }

    public function execute_users_reactions_fk() {
        $sql = file_get_contents($this->path . 'users_reactions_fk.sql');
        if ($this->conn->multi_query($sql) === TRUE) {
            echo 'users_reactions_fk.sql executed successfully.';
        } else {
            echo 'Error executing users_reactions_fk.sql: ' . $this->conn->error;
        }
    }

}

?>