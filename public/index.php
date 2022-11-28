<?php
use Slim\Factory\AppFactory;
use Slim\Views\Twig;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();
$app->addRoutingMiddleware();
$errorMiddleware = $app->addErrorMiddleware(true, true, true);

$app->get('/', function ($request, $response) {
    //$response->getBody()->write("Hello");
    //return $response;

    return Twig::create('C:/www/app/views')->render(
        $response,
        "listacliente.html",
        [
            "cadastro"=>'cliente',
            "titulo"=>"Lista de clientes"
        ]
        );
});

$app->run();