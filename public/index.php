<?php

use Slim\Factory\AppFactory;
use Slim\Views\Twig;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

$errorMiddleware = $app->addErrorMiddleware(true, true, true);

// Define app routes
$app->get('/hello', function ($request, $response) {
    $template= Twig::create('app/views/');
    return $template->render(
        'cliente.html',
        $response,
        []
    );
    
});

// Run app
$app->run();