<?php

namespace app\controllers;

use app\database\models\Cliente;

class ControllerCliente extends Base
{
    private $cliente;

    public function __construct()
    {
        $this->cliente = new Cliente();
    }

    public function listacliente($request, $response)
    {
        //Declaramos uma variavel para armazenar a lista de clientes.    
        $clientes = $this->cliente->find();
       
        //RETORNAMOS A VIEW 
        return $this->getTwig()->render(
            $response,
            $this->setView("listacliente"),
            [
                "titulo" => "Lista de clientes",
                "tituloModal" => "Dados do cliente",
                "cpf" => "CPF",
                "nome" => "Nome",
                "sobrenome" => "Sobrenome",
                "rg" => "RG",
                "dtnascimento" => "Data de Nascimento",
                "col2" => "Nome",
                "col3" => "Sobrenome",
                "col4" => "CPF",
                "col5" => "RG",
                "col6" => "Data de Nascimento",
                "clientes" => $clientes
                
            ]
        );
         
            
        
    }
    public function criarCliente($request, $response){
        
        $salvarCliente = [
            'nome' => filter_input(INPUT_POST, 'nome', FILTER_UNSAFE_RAW),
            'cpf' => filter_input(INPUT_POST, 'cpf', FILTER_UNSAFE_RAW),
            'sobrenome' => filter_input(INPUT_POST, 'sobrenome', FILTER_UNSAFE_RAW),
            'rg' => filter_input(INPUT_POST, 'rg', FILTER_UNSAFE_RAW),
            'dtnascimento' => filter_input(INPUT_POST, 'dtnascimento', FILTER_UNSAFE_RAW),
        ];
        $res =$this->cliente->create($salvarCliente);
        echo('true');
    }
}
