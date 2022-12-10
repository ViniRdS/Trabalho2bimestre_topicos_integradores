<?php

use app\controllers\ControllerCliente;
use app\controllers\ControllerProduto;
use app\controllers\ControllerVenda;
use app\controllers\ControllerHome;


$app->get('/', ControllerHome::class . ':home');
$app->get('/cliente', ControllerCliente::class . ':listacliente');
$app->get('/produto', ControllerProduto::class . ':listaproduto');
$app->get('/venda', ControllerVenda::class . ':venda');
$app->post('/cadastrarcliente', ControllerCliente::class . ':criarCliente');