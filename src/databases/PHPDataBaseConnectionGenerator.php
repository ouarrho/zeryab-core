<?php

/**
 * The PHPConnectionGenerator class is responsible for generating PHP code
 * to create a connection to a database using PDO in an object-oriented manner.
 */
class PHPConnectionGenerator {
    
    /**
     * Generates PHP code for a database connection using PDO and writes it to the specified output path.
     *
     * @param string $output The output path where the generated Connection.php file will be saved.
     * @return bool True if the file is successfully created and written, false otherwise.
     */
    public function generate(string $output = "../output/backend/PHP/db/"): bool {
        $code = $this->generateCode();

        if (file_put_contents("{$output}Connection.php", $code) !== false) {
            return true;
        }

        return false;
    }

    /**
     * Generates object-oriented PHP code for a database connection using PDO.
     *
     * @return string The generated PHP code for creating a PDO database connection.
     */
    private function generateCode(): string {
        $code = "<?php\n\n";
        $code .= "class Connection {\n\n";
        $code .= "    private \$servername = 'localhost';\n";
        $code .= "    private \$username = 'username';\n";
        $code .= "    private \$password = 'password';\n";
        $code .= "    private \$dbname = 'database_name';\n";
        $code .= "    private \$charset = 'utf8mb4';\n\n";
        $code .= "    protected \$conn;\n\n";
        $code .= "    public function __construct() {\n";
        $code .= "        try {\n";
        $code .= "            \$dsn = 'mysql:host=' . \$this->servername . ';dbname=' . \$this->dbname . ';charset=' . \$this->charset;\n";
        $code .= "            \$this->conn = new PDO(\$dsn, \$this->username, \$this->password);\n";
        $code .= "            \$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);\n";
        $code .= "        } catch (PDOException \$e) {\n";
        $code .= "            echo 'Connection failed: ' . \$e->getMessage();\n";
        $code .= "        }\n";
        $code .= "    }\n\n";
        $code .= "    public function __destruct() {\n";
        $code .= "        \$this->conn = null;\n";
        $code .= "    }\n\n";
        $code .= "}\n\n";
        $code .= "?>";

        return $code;
    }

}

?>