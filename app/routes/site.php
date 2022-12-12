<?php

use app\controllers\ControllerCliente;
use app\controllers\ControllerProduto;
use app\controllers\ControllerVenda;
use app\controllers\ControllerHome;


$app->get('/', ControllerHome::class . ':home');
$app->get('/cliente', ControllerCliente::class . ':listacliente');
$app->get('/venda', ControllerVenda::class . ':venda');
$app->post('/cadastrarcliente', ControllerCliente::class . ':criarCliente');
$app->get('/listarcliente', ControllerCliente::class . ':readCliente');
$app->any('/atualizarcliente/{id}', ControllerCliente::class . ':updateCliente');
$app->any('/deletarcliente/{id}', ControllerCliente::class . ':deleteCliente');

$app->get('/produto', ControllerProduto::class . ':listaproduto');
$app->post('/cadastrarproduto', ControllerProduto::class . ':criarproduto');
$app->get('/listarproduto', ControllerProduto::class . ':readproduto');
$app->any('/atualizarproduto/{id}', ControllerProduto::class . ':updateproduto');
$app->any('/deletarproduto/{id}', ControllerProduto::class . ':deleteproduto');