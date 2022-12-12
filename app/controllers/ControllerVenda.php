<?php

namespace app\controllers;

use app\database\models\Cliente;
use app\database\models\Produto;

class ControllerVenda extends Base
{
    private $cliente;
    private $produto;
    public function __construct()
    {
        $this->cliente = new Cliente();
        $this->produto = new Produto();
    }
    

    public function venda($request, $response)
    {
        //Declaramos uma variavel para armazenar a lista de clientes.
       $produtos = $this->produto->find();    
       $clientes = $this->cliente->find();
        //RETORNAMOS A VIEW 
        return $this->getTwig()->render(
            $response,
            $this->setView("venda"),
            [
                "nome" => "Nome",
                "marca" => "Marca",
                "preco" => "Preço",
                "Quant" => "Quant",
                "col2" => "Nome",
                "col3" => "Marca",
                "col4" => "Preço",
                "col5" => "Quantidade",
                "clientes" => $clientes,
                "produtos" => $produtos
            ]
        );
    }
}