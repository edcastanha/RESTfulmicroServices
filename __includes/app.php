<?php

// Class responsavel por todos incldes e requests padrão do projeto
include_once  __DIR__.'/../vendor/autoload.php';

use \App\Utils\View;
use \App\Http\Middleware\Queue as MiddlewareQueue;
use \App\Common\Environments;
use \App\Common\Db\DBConnection;

Environments::loadenv(__DIR__.'/../');

define('URL' , getenv('BASE_URL'));    
define('AUTH' , getenv('TOKEN'));
// define('DB_HOST' , getenv('DB_HOST'));
// define('DB_USER' , getenv('DB_USER'));
// define('DB_PASS' , getenv('DB_PASS'));
// define('DB_NAME' , getenv('DB_NAME'));
// define('DB_PORT' , getenv('DB_PORT'));
define('DB_HOST' , 'localhost');
define('DB_USER' , 'root');
define('DB_PASS' , '');
define('DB_NAME' , 'db_api');
define('DB_PORT' , '3306');



//Chamada para definição de vars globais de page
View::init([
    'URL' => URL,
    'AUTH' => AUTH,
    'DB_HOST' => DB_HOST,
    'DB_USER' => DB_USER,
    'DB_PASS' => DB_PASS,
    'DB_NAME' => DB_NAME,
    'DB_PORT' => DB_PORT,
]);

DBConnection::config(DB_HOST, DB_NAME, DB_USER, DB_PASS, DB_PORT,);


//! Definição para Midddleware Padrões para todas as rotas
MiddlewareQueue::setMap([
    'auth' => \App\Http\Middleware\PageCadastro::class
]);

MiddlewareQueue::setDefault([
    'auth'
]);
   