<?php

class DataBaseGenerator {

    public function generateSQLFiles( $Config, string $output = "../output/databases/tables/" ): void {
        $tables = $Config->getTables();
        $relations = $Config->getRelations();

        // Generate the SQL code for creating tables
        foreach ($tables as $table) {
            $tableName = $table['name'];
            $sql = $this->generateTableSQL($table);
            file_put_contents("{$output}{$tableName}.sql", $sql);
        }

        // Generate the SQL code for creating foreign key constraints for relations
        foreach ($relations as $relation) {
            $tableName = $relation['table'];
            $sql = $this->generateRelationSQL($relation);
            file_put_contents("{$output}{$tableName}_fk.sql", $sql, FILE_APPEND);
        }
    }

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