<?php

namespace app\controllers;

use app\database\models\Cliente;

class ControllerVenda extends Base
{
    private $cliente;
    public function __construct()
    {
        $this->cliente = new Cliente();
    }

    public function venda($request, $response)
    {
        //Declaramos uma variavel para armazenar a lista de clientes.    
       // $clientes = $this->cliente->find();
        //RETORNAMOS A VIEW 
        return $this->getTwig()->render(
            $response,
            $this->setView("venda"),
            [
                
            ]
        );
    }
}