<?php

/**
 * The PHPDataBaseGenerator class is responsible for generating PHP code
 * to execute SQL files created by the DataBaseGenerator class.
 */
class PHPDataBaseGenerator {

    /**
     * Generates PHP code to execute the given SQL files and writes it to the specified output path.
     *
     * @param array $sqlFiles An array containing the names of the SQL files to execute.
     * @param string $output The output path where the generated SQLExecuter.php file will be saved.
     * @return bool True if the file is successfully created and written, false otherwise.
     */
    public function generate(array $sqlFiles, string $output = "../output/backend/PHP/db/"): bool {
        $code = $this->generateCode($sqlFiles);

        if (file_put_contents("{$output}SQLExecuter.php", $code) !== false) {
          return true;
        }

        return false;
    }

    /**
     * Generates object-oriented PHP code to execute the given SQL files.
     *
     * @param array $sqlFiles An array containing the names of the SQL files to execute.
     * @return string The generated PHP code for executing the SQL files.
     */
		private function generateCode(array $sqlFiles): string {
    		$code = "<?php\n\n";
    		$code .= "class SQLExecuter {\n\n";
    		$code .= "    private \$servername = 'localhost';\n";
    		$code .= "    private \$username = 'username';\n";
    		$code .= "    private \$password = 'password';\n";
    		$code .= "    private \$dbname = 'database_name';\n";
    		$code .= "    private \$conn;\n";
    		$code .= "    private \$path;\n\n";
    		$code .= "    public function __construct(\$path = '../../output/databases/tables/') {\n";
    		$code .= "        \$this->path = \$path;\n";
    		$code .= "        \$this->conn = new mysqli(\$this->servername, \$this->username, \$this->password, \$this->dbname);\n";
    		$code .= "        if (\$this->conn->connect_error) {\n";
    		$code .= "            die('Connection failed: ' . \$this->conn->connect_error);\n";
    		$code .= "        }\n";
    		$code .= "    }\n\n";
    		$code .= "    public function __destruct() {\n";
    		$code .= "        \$this->conn->close();\n";
    		$code .= "    }\n\n";

    		$code .= "    public function executeAll() {\n";
    		foreach ($sqlFiles as $sqlFile) {
        		$code .= "        \$this->execute_" . pathinfo($sqlFile, PATHINFO_FILENAME) . "();\n";
    		}
    		$code .= "    }\n\n";

    		foreach ($sqlFiles as $sqlFile) {
        		$code .= "    public function execute_" . pathinfo($sqlFile, PATHINFO_FILENAME) . "() {\n";
        		$code .= "        \$sql = file_get_contents(\$this->path . '{$sqlFile}');\n";
        		$code .= "        if (\$this->conn->multi_query(\$sql) === TRUE) {\n";
        		$code .= "            echo '{$sqlFile} executed successfully.';\n";
        		$code .= "        } else {\n";
        		$code .= "            echo 'Error executing {$sqlFile}: ' . \$this->conn->error;\n";
        		$code .= "        }\n";
        		$code .= "    }\n\n";
    		}

    		$code .= "}\n\n";
    		$code .= "?>";

    		return $code;
		}

}

?>