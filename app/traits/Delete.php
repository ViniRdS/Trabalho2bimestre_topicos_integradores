<?php

namespace app\traits;

use PDOException;

trait Delete
{
    public function delete($field, $value)
    {
        try {
            $sql = "delete from {$this->table} where {$field} = :{$field};";
            $prepared = $this->connection->prepare($sql);
            $prepared->bindValue($field, $value);
            return $prepared->execute();
        } catch (PDOException $e) {
            var_dump($e->getMessage());
        }
    }
}