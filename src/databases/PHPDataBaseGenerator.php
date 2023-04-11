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
        $code .= "require_once 'Connection.php';\n\n";
        $code .= "/**\n";
        $code .= " * The SQLExecuter class extends the Connection class and provides methods to execute SQL files.\n";
        $code .= " */\n";
        $code .= "class SQLExecuter extends Connection {\n\n";
        $code .= "    private \$path = '../../output/databases/tables/';\n\n";
    
        $code .= "    /**\n";
        $code .= "     * SQLExecuter constructor.\n";
        $code .= "     * @param string|null \$path The path to the SQL files.\n";
        $code .= "     */\n";
        $code .= "    public function __construct(\$path = null) {\n";
        $code .= "        parent::__construct();\n";
        $code .= "        if (\$path) {\n";
        $code .= "            \$this->path = \$path;\n";
        $code .= "        }\n";
        $code .= "    }\n\n";
    
        $code .= "    /**\n";
        $code .= "     * Executes all the SQL files.\n";
        $code .= "     */\n";
        $code .= "    public function execute_all() {\n";
        foreach ($sqlFiles as $sqlFile) {
            $methodName = 'execute_' . strtolower(pathinfo($sqlFile, PATHINFO_FILENAME));
            $code .= "        \$this->{$methodName}();\n";
        }
        $code .= "    }\n\n";

        foreach ($sqlFiles as $sqlFile) {
            $methodName = 'execute_' . strtolower(pathinfo($sqlFile, PATHINFO_FILENAME));
            $code .= "    /**\n";
            $code .= "     * Executes the {$sqlFile} SQL file.\n";
            $code .= "     */\n";
            $code .= "    public function {$methodName}() {\n";
            $code .= "        \$sql = file_get_contents(\$this->path . '{$sqlFile}');\n";
            $code .= "        try {\n";
            $code .= "            \$this->conn->exec(\$sql);\n";
            $code .= "            echo '{$sqlFile} executed successfully.';\n";
            $code .= "        } catch (PDOException \$e) {\n";
            $code .= "            echo 'Error executing {$sqlFile}: ' . \$e->getMessage();\n";
            $code .= "        }\n";
            $code .= "    }\n\n";
        }

        $code .= "}\n\n";
        $code .= "?>";

        return $code;
    }

}

?>