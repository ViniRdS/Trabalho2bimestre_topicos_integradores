<?php

namespace app\controllers;

use app\database\models\Produto;

class ControllerProduto extends Base
{
    //private $produto;
    public function __construct()
    {
        $this->produto = new Produto();
    }

    public function listaproduto($request, $response)
    {
        //Declaramos uma variavel para armazenar a lista de produtos.    
        $produtos = $this->produto->find();
        //RETORNAMOS A VIEW 
        return $this->getTwig()->render(
            $response,
            $this->setView("listaproduto"),
            [
                "titulo" => "Lista de produtos",
                "tituloModal" => "Dados do produto",
                "nome_prod" => "Nome",
                "marca" => "Marca",
                "descricao_prod" => "Descrição",
                "preco" => "Preço",
                "datafabricacao" => "Data de Fabricação",
                "col2" => "Nome",
                "col3" => "Marca",
                "col4" => "Descrição",
                "col5" => "Preço",
                "col6" => "Data de Fabricação",
                "produtos" => $produtos
            ]
        );
    }
    public function criarproduto($request, $response)
    {
        $salvarproduto = [
            'nome' => filter_input(INPUT_POST, 'nome_produto', FILTER_UNSAFE_RAW),
            'marca' => filter_input(INPUT_POST, 'marca_prod', FILTER_UNSAFE_RAW),
            'descricao' => filter_input(INPUT_POST, 'descricao_prod', FILTER_UNSAFE_RAW),
            'preco' => filter_input(INPUT_POST, 'preco_prod', FILTER_UNSAFE_RAW),
            'dtfabricacao' => filter_input(INPUT_POST, 'dtfabricacao', FILTER_UNSAFE_RAW),
        ];
        $res = $this->produto->create($salvarproduto);
        return $response;
    }
    public function readproduto($request, $response)
    {
        $produto = $this->produto->find();
        echo json_encode($produto);
        return $response;
    }
    public function updateproduto($request, $response, $args)
    {

        $updateproduto = [
            "fields" => [
                'nome' => filter_input(INPUT_POST, 'nome_produtoEditar', FILTER_UNSAFE_RAW),
                'marca' => filter_input(INPUT_POST, 'marca_prodEditar', FILTER_UNSAFE_RAW),
                'descricao' => filter_input(INPUT_POST, 'descricao_prodEditar', FILTER_UNSAFE_RAW),
                'preco' => filter_input(INPUT_POST, 'preco_prodEditar', FILTER_UNSAFE_RAW),
                'dtfabricacao' => filter_input(INPUT_POST, 'dtfabricacaoEditar', FILTER_UNSAFE_RAW),
            ],
            "where" => [
                "id" => filter_input(INPUT_POST, 'idEditar', FILTER_UNSAFE_RAW)
            ]
        ];

        var_dump($updateproduto);
        $res = $this->produto->update($updateproduto);
        return $response;
    }
    public function deleteproduto($request, $response, $args)
    {
        $id = intval($args['id']);
        $produtos = $this->produto->delete($id);

        return $response;
    }
}
