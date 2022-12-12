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
            $query = $this->connection->query("select c.id,p.id as idProd, p.nome, p.marca, p.preco from produto p
            inner join {$this->table} c on p.id = c.id_produto_carrinho ");
            //CASO O VALOR PADRÃO DO PARAMETRO SEJA TRUE RETORNA TODOSS OS REGISTRO DO BANCO.
            return $fetchAll ? $query->fetchAll() : $query->fetch();
        } catch (PDOException $e) {
            var_dump($e->getMessage());
        }
    }
    public function findLastId()
    {
        try {
            $query = $this->connection->query("select max(id) from {$this->table}");
            
            return $query->fetch();
        } catch (PDOException $e) {
            var_dump($e->getMessage());
        }
    }
    public function findJoinVenda($fetchAll = true)
    {
        try {
            $query = $this->connection->query("select v.id,p.nome as nomeproduto, p.marca, p.preco as precoproduto,p.dtfabricacao, v.dtvenda,v.precototal, cli.nome, cli.cpf, cli.rg, cli.sobrenome, cli.dtnascimento from produto p
            inner join carrinhogeral c on p.id = c.id_produto_carrinho
            inner join venda v on v.id = c.id_venda
            inner join cliente cli on cli.id = v.id_cliente; ");
            return $fetchAll ? $query->fetchAll() : $query->fetch();
        } catch (PDOException $e) {
            var_dump($e->getMessage());
        }
    }
}
