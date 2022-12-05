<?php

namespace app\traits;

use PDOException;

trait Create
{
    public function create(array $createFieldAndValues)
    {
        $sqlPacleHolder = sprintf(
            'insert into %s (%s) values (%s);',
            $this->table,
            implode(',', array_keys($createFieldAndValues)),
            ':' . implode(',:', array_keys($createFieldAndValues))
        );
        try {
            $prepared = $this->connection->prepare($sqlPacleHolder);
            return $prepared->execute($createFieldAndValues);
        } catch (PDOException $e) {
            var_dump($e->getMessage());
        }
    }
}
