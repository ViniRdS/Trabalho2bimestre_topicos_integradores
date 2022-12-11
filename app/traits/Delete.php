<?php

namespace app\traits;

use PDOException;

trait Delete
{
    public function delete($field)
    {
        try {
            $sql = "delete from {$this->table} where id ={$field}";
            $prepared = $this->connection->prepare($sql);
            return $prepared->execute();
        } catch (PDOException $e) {
            var_dump($e->getMessage());
        }
    }
}