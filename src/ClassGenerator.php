<?php

namespace Zeryab;

class ClassGenerator
{
    private $tables;
    private $relations;

    public function __construct(Tables $tables, Relations $relations)
    {
        $this->tables = $tables;
        $this->relations = $relations;
    }

    public function generate()
    {
        $classes = '';

        foreach ($this->tables->getAll() as $table) {
            $className = ucfirst($table->getName());
            $columns = '';
            foreach ($table->getColumns() as $column) {
                $columns .= "    private \${$column->getName()};\n";
            }
            $methods = '';
            foreach ($table->getColumns() as $column) {
                $methodName = ucfirst($column->getName());
                $methods .= "    public function get{$methodName}()\n";
                $methods .= "    {\n";
                $methods .= "        return \$this->{$column->getName()};\n";
                $methods .= "    }\n\n";
                $methods .= "    public function set{$methodName}(\$value)\n";
                $methods .= "    {\n";
                $methods .= "        \$this->{$column->getName()} = \$value;\n";
                $methods .= "    }\n\n";
            }

            $classes .= "class {$className}\n";
            $classes .= "{\n{$columns}\n{$methods}}\n\n";
        }

        return $classes;
    }
}
