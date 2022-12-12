<?php

namespace app\controllers;

use app\database\models\Cliente;
use app\database\models\Produto;
use app\database\models\Venda;
use app\database\models\Carrinho;
use app\database\models\CarrinhoGeral;

class ControllerVenda extends Base
{
    private $cliente;
    private $produto;
    private $venda;
    private $carrinho;
    private $carrinhogeral;

    public function __construct()
    {
        $this->carrinho = new Carrinho();
        $this->carrinhogeral = new CarrinhoGeral();
        $this->cliente = new Cliente();
        $this->produto = new Produto();
        $this->venda = new Venda();
    }
    

    public function venda($request, $response)
    {
        //Declaramos uma variavel para armazenar a lista de clientes.
       $produtos = $this->produto->find();    
       $clientes = $this->cliente->find();
       $vendas = $this->venda->findJoinVenda();
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
                "produtos" => $produtos,
                "vendas" => $vendas
            ]
        );
    }
    public function adicionarVenda($request, $response)
    {
        $carrinho = $this->carrinho->findJoinCarrinho();
       
    
        $hoje = date('Y-m-d');
        
        $salvarVenda = [
            'id_cliente' => filter_input(INPUT_POST, 'idcarrinho', FILTER_UNSAFE_RAW),
            'precototal' => filter_input(INPUT_POST, 'idtotal', FILTER_UNSAFE_RAW),
            'dtvenda' => $hoje
        ];
        $res =$this->venda->create($salvarVenda);
        
        $venda = $this->venda->findLastId();
        
        foreach ($carrinho as $key => $item){
            $salvarCarrinhoGeral = [
                'id_produto_carrinho' => intval($item['idprod']) ,
                'id_venda' => $venda['max'],
            ];
            var_dump($salvarCarrinhoGeral);
            $resp=$this->carrinhogeral->create($salvarCarrinhoGeral);
            var_dump($resp);

        }
        return $response;   
       
       
       
    }
}