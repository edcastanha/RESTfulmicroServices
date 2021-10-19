<?php
require __DIR__ .'/vendor/autoload.php';

use \App\Http\Router;
use \App\Http\Response;
use \App\Controllers\Page\Auth;

define('BASE_URL', 'http://apirest');




$obRoutes = new Router(BASE_URL);

$obRoutes->get('/',[ 
    function(){
        return new Response(200, Auth::getAuth(), );
    }
]);

/**
 * Returno da requisição ou renderização da página
 */
 $obRoutes->run()
          ->sendResponse();