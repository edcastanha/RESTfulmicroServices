<?php

// Class responsavel por todos incldes e requests padrão do projeto
include_once  __DIR__.'/../vendor/autoload.php';

use \App\Utils\View;
use \App\Http\Middleware\Queue as MiddlewareQueue;
use \App\Common\Environments;
use App\Common\Db\DBConection;

Environments::loadenv(__DIR__.'/../');

define('URL' , getenv('BASE_URL'));    
define('AUTH' , getenv('TOKEN'));    

// DBConection::connenction(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASS'), getenv('DB_NAME'));

//Chamada para definição de vars globais de page
View::init([
    'URL' => URL
]);

//! Definição para Midddleware Padrões para todas as rotas
MiddlewareQueue::setMap([
    'auth' => \App\Http\Middleware\PageCadastro::class
]);

MiddlewareQueue::setDefault([
    'auth'
]);
   