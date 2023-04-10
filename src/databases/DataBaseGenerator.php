<?php

/**
 * The DataBaseGenerator class is responsible for generating SQL files
 * containing the SQL code for creating tables and their foreign key
 * constraints based on the provided configuration.
 */
class DataBaseGenerator {

    /**
     * Generates SQL files for creating tables and foreign key constraints
     * based on the given configuration.
     *
     * @param $Config The configuration object containing table and relation information.
     * @param string $output The output path where the generated SQL files will be saved.
     * @return bool True if all files are successfully created and written, false otherwise.
     */
    public function generateSQLFiles( $Config, string $output = "../output/databases/tables/" ): bool {
        $tables = $Config->getTables();
        $relations = $Config->getRelations();
        $success = true;

        // Generate the SQL code for creating tables
        foreach ($tables as $table) {
            $tableName = $table['name'];
            $sql = $this->generateTableSQL($table);
            if (file_put_contents("{$output}{$tableName}.sql", $sql) === false) {
                $success = false;
            }
        }

        // Generate the SQL code for creating foreign key constraints for relations
        foreach ($relations as $relation) {
            $tableName = $relation['table'];
            $sql = $this->generateRelationSQL($relation);
            if (file_put_contents("{$output}{$tableName}_fk.sql", $sql, FILE_APPEND) === false) {
                $success = false;
            }
        }

        return $success;
    }

    /**
     * Generates SQL code for creating a table based on the given table information.
     *
     * @param array $table An array containing the table name and column information.
     * @return string The generated SQL code for creating the table.
     */
    private function generateTableSQL(array $table): string {

        $tableName = $table['name'];
        $columns = $table['columns'];

        $sql = "CREATE TABLE `{$tableName}` (\n";

        foreach ($columns as $column) {
            $columnName = $column['name'];
            $columnType = $column['type'];
            $primaryKey = !empty($column['primary_key']) ? ' PRIMARY KEY' : '';

            $sql .= "  `{$columnName}` {$columnType}{$primaryKey},\n";
        }

        $sql = rtrim($sql, ",\n");
        $sql .= "\n) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;\n\n";

        return $sql;
    }

    /**
     * Generates SQL code for creating foreign key constraints based on the given relation information.
     *
     * @param array $relation An array containing the relation and foreign key information.
     * @return string The generated SQL code for creating the foreign key constraints.
     */
    private function generateRelationSQL(array $relation): string {
        $tableName = $relation['table'];
        $foreignKeys = $relation['foreignKeys'];

        $sql = "ALTER TABLE `{$tableName}`\n";

        foreach ($foreignKeys as $foreignKey) {
            $columnName = $foreignKey['column'];
            $referenceTable = $foreignKey['table'];
            $referenceColumn = !empty($foreignKey['referenceColumn']) ? $foreignKey['referenceColumn'] : $columnName;

            $sql .= "  ADD CONSTRAINT `fk_{$tableName}_{$referenceTable}` FOREIGN KEY (`{$columnName}`) REFERENCES `{$referenceTable}` (`{$referenceColumn}`),\n";
        }

        $sql = rtrim($sql, ",\n");
        $sql .= ";\n\n";

        return $sql;
    }

}

?>