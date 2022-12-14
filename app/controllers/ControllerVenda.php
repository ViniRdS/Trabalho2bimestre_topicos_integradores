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
                "col2" => "Cliente",
                "col3" => "Data da venda",
                "col4" => "Preço Total",
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
        $res = $this->venda->create($salvarVenda);

        $venda = $this->venda->findLastId();

        foreach ($carrinho as $key => $item) {
            $salvarCarrinhoGeral = [
                'id_produto_carrinho' => intval($item['idprod']),
                'id_venda' => $venda['max'],
            ];
            
            $resp = $this->carrinhogeral->create($salvarCarrinhoGeral);
            
        }

        $updateVenda = [
            "fields" => [
                'id_venda' => $venda['max']
            ],
            "where" => [
                "id" => $venda['max']
            ]
        ];
        
        
        $res =$this->venda->update($updateVenda);
        return $response;
    }
    public function imprimir($request, $response)
    {
        $id = $_GET["id"];
        $venda = $this->venda->findByJoin( $id);
        $vendas = $this->venda->findByJoin( $id, false);
        
        $html1 = "
        <div style='background-color: #48B;'>
    <h1 style='width: 90%;
    display: flex;
    text-align: center;
    margin: 0px 60px 10px 30px;
    font-size: 80px;
    justify-content: center;'>Relatório da venda</h1>
    <h2 style='display: flex;
    width: 90%;
    flex-direction: row;
    text-align: center;
    justify-content: end;
    margin: 60px 60px 5px 450px;
    font-size: 40px;'>Suit Horse</h2>
</div>
<div style='display: flex; flex-direction: row;
width: 100%;background-color: #48B; justify-content: space-between; align-items: center;'>
<div style='color: powderblue;' width: 100%;>
    <ul style='list-style: none; margin: 10px 40px 0px 10px;padding-left: 10px;
    font-size: 25px;'>
        <li>Cliente: $vendas->nome $vendas->sobrenome</li>
        <li>CPF: $vendas->cpf</li>
        <li>RG: $vendas->rg</li>
        <li>Data de Nascimento: $vendas->dtnascimento</li>
    </ul>
</div>
<div width: 100%;>
    <ul style='list-style: none; margin: 20px 20px 5px 680px;;
    font-size: 25px;'>
        <li>Código da venda: $vendas->id_venda</li>
        <li>Data da venda: $vendas->dtvenda</li>
    </ul>
</div>
</div>
<div style='padding: 20px; display:flex;flex-direction: column; justify-content: center; align-items: center;' width: 100%;>
<h2 style='margin: 10px 60px 10px 400px;
font-size: 30px;'>Lista de Produtos</h2> 
<table cellspacing='0' style='border: solid 1px black; min-width: 500; margin: 10px 60px 10px 180px;'>
<thead>
    <tr>
        <th style='background-color: black;color: white;'>Nome</th>
        <th style='background-color: black;color: white;'>Marca</th>
        <th style='background-color: black;color: white;'>Preco Unitário</th>
        <th style='background-color: black;color: white;'>Data de Fabricação</th>
    </tr>
</thead>
<tbody>
        ";
        $html2 = "";
        
        foreach ($venda as $key => $value) {
           $html2 = $html2 ."
                    <tr>
                        <td style='padding: 3px;
                        padding-left: 40px;border: solid 1px;
                        '>{$value ->nomeproduto}</td>
                        <td style='padding: 3px;
                        padding-left: 50px;border: solid 1px;
                        '>{$value->marca}</td>
                        <td style='padding: 3px;
                        padding-left: 75px;border: solid 1px;
                        '>{$value->precoproduto}</td>
                        <td style='padding: 3px;
                        padding-left: 90px;border: solid 1px;
                        '>{$value->dtfabricacao}</td>
                    </tr>
                    ";
        }
        $html3 = "
        <tr>
        <th colspan='2' style='padding: 4px; padding-top: 7px;
        padding-left: 70px;'>Total: </th>
        <td colspan='2' style='padding: 4px; padding-top: 7px; font-weight: bold;
        padding-left: 73px;'>$vendas->precototal</td>
    </tr>
</tbody>
</table>
    <div style='background-color: white;'>
    <h6 style='width: 90%;
    display: flex;
    text-align: center;
    margin: 20px 60px 10px 30px;
    justify-content: center;'>Desenvolvido por Horse Corporation®</h6>
    </div>

        ";
        $htmlFinal = "";
        $htmlFinal = $htmlFinal . $html1;
        $htmlFinal = $htmlFinal . $html2;
        $htmlFinal = $htmlFinal . $html3;
        $this->print($htmlFinal);
        
        return $response;
    }
}
