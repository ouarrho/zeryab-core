<?php

declare(strict_types=1);

class Zeryab
{
    private Tables $tables;
    private Relations $relations;

    public function __construct(Tables $tables, Relations $relations)
    {
        $this->tables = $tables;
        $this->relations = $relations;
    }

    public function getTables(): Tables
    {
        return $this->tables;
    }

    public function getRelations(): Relations
    {
        return $this->relations;
    }
}
