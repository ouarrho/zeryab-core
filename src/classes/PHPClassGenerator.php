<?php

class PHPClassGenerator {

  /**
   * Generates PHP classes for tables with methods for CRUD operations
   * and filtering.
   *
   * @param Config $config The Config object containing table and column information.
   * @param string $output The output path where the generated class files will be saved.
   * @return bool True if all files are successfully created and written, false otherwise.
   */
  public function generate(Config $config, string $output = "../output/backend/PHP/classes/"): bool {
    $tables = $config->getTables();

    foreach ($tables as $table) {
      if (!$this->generateClass($table[ "name" ], $table[ "columns" ], $output)) {
        return false;
      }
    }

    return true;
  }

  /**
   * Generates a PHP class for a given table with methods for CRUD operations
   * and filtering.
   *
   * @param string $tableName The name of the table to generate the class for.
   * @param array $columns An array of column names for the table.
   * @param string $output The output path where the generated class file will be saved.
   * @return bool True if the file is successfully created and written, false otherwise.
   */
  private function generateClass(string $tableName, array $columns, string $output): bool {
    $className = $this->convertToPascalCase($tableName);
    $code = $this->generateCode($tableName, $columns, $className);

    if (file_put_contents("{$output}{$className}.php", $code) !== false) {
      return true;
    }

    return false;
  }

  /**
   * Generates the PHP code for a class representing a table in the database,
   * including methods for CRUD operations and filtering.
   *
   * @param string $tableName The name of the table to generate the class for.
   * @param array $columns An array of column names for the table.
   * @param string $className The name of the class to generate.
   * @return string The generated PHP code for the class.
   */
  private function generateCode(string $tableName, array $columns, string $className): string {
    $code = "<?php\n\n";
    $code .= "class {$className} {\n\n";
    
    // Add class properties
    $code .= "  private \$conn;\n\n";
    
    // Add class constructor
    $code .= "  public function __construct(\$conn) {\n";
    $code .= "    \$this->conn = \$conn;\n";
    $code .= "  }\n\n";
    
    // Add CRUD methods
    $code .= $this->generateInsertMethod($tableName, $columns);
    //$code .= $this->generateSelectMethod($tableName, $columns);
    //$code .= $this->generateUpdateMethod($tableName, $columns);
    //$code .= $this->generateDeleteMethod($tableName, $columns);
    
    // Add filtering method
    //$code .= $this->generateFilterMethod($tableName, $columns);

    $code .= "}\n\n";
    $code .= "?>";

    return $code;
  }

private function generateInsertMethod(string $tableName, array $columns): string {
  $code = "  /**\n";
  $code .= "   * Insert a new row into the {$tableName} table.\n";
  $code .= "   *\n";
  $code .= "   * @param array \$data An associative array of column names and their values to be inserted.\n";
  $code .= "   * @return int The ID of the inserted row.\n";
  $code .= "   */\n";
  $code .= "  public function insert(array \$data = []): int {\n";
  
  $code .= "    \$defaultValues = [\n";
  foreach ($columns as $column) {
    $code .= "      '{$column['name']}' => null,\n";
  }
  $code .= "    ];\n\n";

  $code .= "    \$data = array_merge(\$defaultValues, \$data);\n\n";

  $code .= "    \$sql = 'INSERT INTO {$tableName} (";
  $code .= implode(", ", array_map(fn($col) => "`{$col['name']}`", $columns));
  $code .= ") VALUES (";
  $code .= implode(", ", array_map(fn($col) => ":{$col['name']}", $columns));
  $code .= ")';\n";

  $code .= "    \$stmt = \$this->conn->prepare(\$sql);\n";

  foreach ($columns as $column) {
    $code .= "    \$stmt->bindValue(':{$column['name']}', \$data['{$column['name']}']);\n";
  }

  $code .= "    \$stmt->execute();\n";
  $code .= "    return \$this->conn->lastInsertId();\n";
  $code .= "  }\n\n";

  return $code;
}


/*
 private function generateSelectMethod(string $tableName, array $columns): string {
  $code = "  public function select(array \$params = []) {\n";
  $code .= "    \$columns = isset(\$params['columns']) ? implode(', ', \$params['columns']) : '*';\n";
  $code .= "    \$sql = 'SELECT ' . \$columns . ' FROM {$tableName}';\n";

  // Add filters
  $code .= "    if (isset(\$params['filter'])) {\n";
  $code .= "      \$filters = [];\n";
  $code .= "      foreach (\$params['filter'] as \$key => \$value) {\n";
  $code .= "        \$filters[] = \$key . ' = :' . \$key;\n";
  $code .= "      }\n";
  $code .= "      \$sql .= ' WHERE ' . implode(' AND ', \$filters);\n";
  $code .= "    }\n";

  // Add group by
  $code .= "    if (isset(\$params['group'])) {\n";
  $code .= "      \$sql .= ' GROUP BY ' . implode(', ', \$params['group']);\n";
  $code .= "    }\n";

  // Add order by
  $code .= "    if (isset(\$params['order'])) {\n";
  $code .= "      \$sql .= ' ORDER BY ' . implode(', ', \$params['order']);\n";
  $code .= "    }\n";

  // Add limit
  $code .= "    if (isset(\$params['limit'])) {\n";
  $code .= "      \$sql .= ' LIMIT ' . \$params['limit'];\n";
  $code .= "    }\n";

  $code .= "    \$stmt = \$this->conn->prepare(\$sql);\n";

  // Bind filter values
  $code .= "    if (isset(\$params['filter'])) {\n";
  $code .= "      foreach (\$params['filter'] as \$key => \$value) {\n";
  $code .= "        \$stmt->bindValue(':' . \$key, \$value);\n";
  $code .= "      }\n";
  $code .= "    }\n";

  $code .= "    \$stmt->execute();\n";
  $code .= "    return \$stmt->fetchAll(PDO::FETCH_ASSOC);\n";
  $code .= "  }\n\n";

  return $code;
}
*/
/*
  // Helper methods to generate CRUD operations and filtering methods
private function generateInsertMethod(string $tableName, array $columns): string {
  $code = "  public function insert(";

  $params = [];
  foreach ($columns as $column) {
    $params[] = "\$" . $column['name'];
  }
  $code .= implode(", ", $params);
  $code .= ") {\n";

  $code .= "    \$sql = 'INSERT INTO {$tableName} (";
  $code .= implode(", ", array_map(fn($col) => "`{$col['name']}`", $columns));
  $code .= ") VALUES (";
  $code .= implode(", ", array_map(fn($col) => ":{$col['name']}", $columns));
  $code .= ")';\n";

  $code .= "    \$stmt = \$this->conn->prepare(\$sql);\n";

  foreach ($columns as $column) {
    $code .= "    \$stmt->bindValue(':{$column['name']}', \${$column['name']});\n";
  }

  $code .= "    return \$stmt->execute();\n";
  $code .= "  }\n\n";

  return $code;
}

private function generateSelectMethod(string $tableName, array $columns): string {
  $code = "  public function select(int \$id) {\n";
  $code .= "    \$sql = 'SELECT * FROM {$tableName} WHERE id = :id';\n";
  $code .= "    \$stmt = \$this->conn->prepare(\$sql);\n";
  $code .= "    \$stmt->bindValue(':id', \$id);\n";
  $code .= "    \$stmt->execute();\n";
  $code .= "    return \$stmt->fetch(PDO::FETCH_ASSOC);\n";
  $code .= "  }\n\n";

  return $code;
}

private function generateUpdateMethod(string $tableName, array $columns): string {
  $code = "  public function update(";
  $params = ['int $id'];
  foreach ($columns as $column) {
    $params[] = "\$" . $column['name'];
  }
  $code .= implode(", ", $params);
  $code .= ") {\n";

  $code .= "    \$sql = 'UPDATE {$tableName} SET ";
  $code .= implode(", ", array_map(fn($col) => "`{$col['name']}` = :{$col['name']}", $columns));
  $code .= " WHERE id = :id';\n";

  $code .= "    \$stmt = \$this->conn->prepare(\$sql);\n";
  $code .= "    \$stmt->bindValue(':id', \$id);\n";

  foreach ($columns as $column) {
    $code .= "    \$stmt->bindValue(':{$column['name']}', \${$column['name']});\n";
  }

  $code .= "    return \$stmt->execute();\n";
  $code .= "  }\n\n";

  return $code;
}
/*
private function generateDeleteMethod(string $tableName, array $columns): string {
  $code = "  public function delete(int \$id) {\n";
  $code .= "    \$sql = 'DELETE FROM {$tableName} WHERE id = :id';\n";
  $code .= "    \$stmt = \$this->conn->prepare(\$sql);\n";
  $code .= "    \$stmt->bindValue(':id', \$id);\n";
  $code .= "    return \$stmt->
}
*/
	private function convertToPascalCase(string $input): string {
    return str_replace('_', '', ucwords($input, '_'));
  }

}

?>