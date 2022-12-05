<?php

namespace app\traits;

use PDO;
use PDOException;

trait Read
{
    /** Caso o valor do parâmetro fetchAll seja o valor padrão true, 
     * retornará os registros.
     * 
     * @return self
     */
    public function find($fetchAll = true)
    {
        try {
            $query = $this->connection->query("select * from {$this->table}");
            //CASO O VALOR PADRÃO DO PARAMETRO SEJA TRUE RETORNA TODOSS OS REGISTRO DO BANCO.
            return $fetchAll ? $query->fetchAll() : $query->fetch();
        } catch (PDOException $e) {
            var_dump($e->getMessage());
        }
    }
}
