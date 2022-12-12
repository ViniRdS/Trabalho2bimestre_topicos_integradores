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
    public function createvenda($idCliente,array $idProd, $precoTotal, $dtvenda,$fetchAll = true)
    {
        try {
            $query = $this->connection->query("INSERT INTO {$this->table}(
            id_cliente, id_produto_venda, precototal, dtvenda)
                VALUES ({$idCliente}, {$idProd}, {$precoTotal}, {$dtvenda});");
            //CASO O VALOR PADRÃO DO PARAMETRO SEJA TRUE RETORNA TODOSS OS REGISTRO DO BANCO.
            return $fetchAll ? $query->fetchAll() : $query->fetch();
        } catch (PDOException $e) {
            var_dump($e->getMessage());
        }
    }
}
