<?php

// Class responsavel por todos incldes e requests padrão do projeto
require __DIR__.'/../vendor/autoload.php';

use \App\Utils\View;
use \App\Http\Middleware\Queue as MiddlewareQueue;
use \App\Common\Environments;
use App\Common\Db\DBConection;

Environments::loadenv(__DIR__.'/../');

define('URL' , getenv('BASE_URL'));    

// DBConection::connenction(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASS'), getenv('DB_NAME'));

//Chamada para definição de vars globais de page
View::init([
    'URL' => URL
]);

//! Definição para Midddleware Padrões para todas as rotas
MiddlewareQueue::setDefault([
    'auth' => \App\Http\Middleware\Auth::class
]);

MiddlewareQueue::setMap([
    'auth'
]);
   