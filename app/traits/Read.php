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
    public function findJoinCarrinho($fetchAll = true)
    {
        try {
            $query = $this->connection->query("select c.id, p.nome, p.marca, p.preco from produto p
            inner join {$this->table} c on p.id = c.id_produto_carrinho ");
            //CASO O VALOR PADRÃO DO PARAMETRO SEJA TRUE RETORNA TODOSS OS REGISTRO DO BANCO.
            return $fetchAll ? $query->fetchAll() : $query->fetch();
        } catch (PDOException $e) {
            var_dump($e->getMessage());
        }
    }
}
