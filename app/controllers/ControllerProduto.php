<?php

namespace app\controllers;

use app\database\models\Cliente;

class ControllerProduto extends Base
{
    //private $cliente;
    public function __construct()
    {
        $this->cliente = new Cliente();
    }

    public function listaproduto($request, $response)
    {
        //Declaramos uma variavel para armazenar a lista de clientes.    
        //$clientes = $this->cliente->find();
        //RETORNAMOS A VIEW 
        return $this->getTwig()->render(
            $response,
            $this->setView("listaproduto"),
            [
                "titulo" => "Lista de produtos",
                "tituloModal" => "Dados do produto",
                "cpf_nome" => "Nome",
                "nome_marca" => "Marca",
                "sobrenome_descricao" => "Descrição",
                "rg_preco" => "Preço",
                "dataNascimento_fabricacao" => "Data de Fabricação",
                "type_rg_preco" => "number",
                "col2" => "Nome",
                "col3" => "Marca",
                "col4" => "Descrição",
                "col5" => "Preço",
                "col6" => "Data de Fabricação",
            ]
        );
    }
}
