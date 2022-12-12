<?php

namespace app\controllers;

use app\database\models\Carrinho;
use app\database\models\Cliente;

class ControllerCarrinho extends Base
{
    private $carrinho;
    private $cliente;
    public function __construct()
    {
        $this->carrinho = new Carrinho();
        $this->cliente = new Cliente();
    }
    

    public function carrinho($request, $response)
    {   
       $carrinho = $this->carrinho->findJoinCarrinho();
       
       $clientes = $this->cliente->find();
       //RETORNAMOS A VIEW 
       return $this->getTwig()->render(
           $response,
           $this->setView("carrinho"),
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
               "carrinho" => $carrinho
           ]
       );
       var_dump($carrinho);
       return $response;

    }
    public function adicionarcarrinho($request, $response)
    {
        $salvarCarrinho = [
            'id_produto_carrinho' => filter_input(INPUT_POST, 'idproduto', FILTER_UNSAFE_RAW),
        ];
        $res =$this->carrinho->create($salvarCarrinho);
        return $response;   
       
       
       
    }

    public function deleteprodutoCarrinho($request, $response, $args){
        $id = intval($args['id']);
       $carrinho=$this->carrinho->delete($id);
       return $response;
                 
    }
    public function deleteTudo($request, $response, $args){
       $carrinho=$this->carrinho->deleteAll();
       return $response;
                 
    }
}