<?php

// Class responsavel por todos incldes e requests padrão do projeto
require __DIR__.'/../vendor/autoload.php';

use \App\Utils\View;
use \App\Http\Middleware\Queue as MiddlewareQueue;

\App\Common\Environments::loadenv(__DIR__.'/../');

define('URL' , getenv('BASE_URL'));    

//Chamada para definição de vars globais de page
View::init([
    'URL' => URL
]);

MiddlewareQueue::setMap([
    'AuthMiddleware' => \App\Http\Middleware\AuthMiddleware::class
]);
   