<?php
require __DIR__ .'/__includes/app.php';

use \App\Http\Router;
use \App\Http\Response;
use \App\Controllers\Page\Auth;


define('URL', getenv('BASE_URL'));

$obRoutes = new Router(URL);

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