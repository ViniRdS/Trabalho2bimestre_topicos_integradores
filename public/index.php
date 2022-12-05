<?php

use Slim\Factory\AppFactory;
use Slim\Views\Twig;

require __DIR__ . '/../vendor/autoload.php';
$app = AppFactory::create();
$errorMiddleware = $app->addErrorMiddleware(true, true, true);
//DIRETÓRIO BASE DA APLICAÇÃO.
define("ROOT", dirname(__FILE__, 2));
//DIRETÓRIO DAS VIEWS
define("DIR_VIEWS", ROOT . "/app/views/");
//EXTENSSÃO PADRÃO DAS VIEWS
define("EXT_VIEWS", ".html");

require __DIR__ . "/../app/routes/site.php";

$app->run();
