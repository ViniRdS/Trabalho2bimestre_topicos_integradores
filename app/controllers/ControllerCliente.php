<?php

namespace app\controllers;

use app\database\models\Cliente;

class ControllerCliente extends Base
{
    //private $cliente;
    public function __construct()
    {
        $this->cliente = new Cliente();
    }

    public function listacliente($request, $response)
    {
        //Declaramos uma variavel para armazenar a lista de clientes.    
        //$clientes = $this->cliente->find();
        //RETORNAMOS A VIEW 
        return $this->getTwig()->render(
            $response,
            $this->setView("lista"),
            [
                "titulo" => "Lista de clientes",
                "tituloModal" => "Dados do cliente",
                "cpf_nome" => "CPF",
                "nome_marca" => "Nome",
                "sobrenome_descricao" => "Sobrenome",
                "rg_preco" => "RG",
                "dataNascimento_fabricacao" => "Data de Nascimento",
                "type_rg_preco" => "text",
                "col2" => "Nome",
                "col3" => "Sobrenome",
                "col4" => "CPF",
                "col5" => "RG",
                "col6" => "Data de Nascimento",
            ]
        );
    }
}
