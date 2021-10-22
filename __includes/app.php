<?php

// Class responsavel por todos incldes e requests padrão do projeto
include_once  __DIR__.'/../vendor/autoload.php';

use \App\Utils\View;
use \App\Http\Middleware\Queue as MiddlewareQueue;
use \App\Common\Environments;
use \App\Common\Db\DBConection;

Environments::loadenv(__DIR__.'/../');

define('URL' , getenv('BASE_URL'));    
define('AUTH' , getenv('TOKEN'));
define('DB_HOST' , getenv('DB_HOST'));
define('DB_USER' , getenv('DB_USER'));
define('DB_PASS' , getenv('DB_PASS'));
define('DB_NAME' , getenv('DB_NAME'));


// echo '<pre>'; print_r('TOKEN :'.getenv('TOKEN')); echo'</pre>'; exit;
// DBConection::setConnection(DB_HOST,DB_USER,DB_PASS,DB_NAME);

//Chamada para definição de vars globais de page
View::init([
    'URL' => URL,
    'AUTH' => AUTH
]);

//! Definição para Midddleware Padrões para todas as rotas
MiddlewareQueue::setMap([
    'auth' => \App\Http\Middleware\PageCadastro::class
]);

MiddlewareQueue::setDefault([
    'auth'
]);
   