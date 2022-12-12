<?php

use app\controllers\ControllerCliente;
use app\controllers\ControllerProduto;
use app\controllers\ControllerVenda;
use app\controllers\ControllerHome;
use app\controllers\ControllerCarrinho;


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

$app->get('/carrinho', ControllerCarrinho::class . ':carrinho');
$app->post('/adicionarcarrinho', ControllerCarrinho::class . ':adicionarcarrinho');
$app->any('/deletarprodutoCarrinho/{id}', ControllerCarrinho::class . ':deleteprodutoCarrinho');
$app->any('/deletarCarrinho', ControllerCarrinho::class . ':deleteTudo');
$app->get('/listarcarrinho', ControllerCarrinho::class . ':readcarrinho');

$app->post('/adicionarvenda', ControllerVenda::class . ':adicionarVenda');
