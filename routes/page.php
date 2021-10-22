<?php


use \App\Controllers\Page;
use \App\Http\Response;


$objRoutes->get('/',[ 
    'middlewares' => [
        'auth'
    ],
    function(){
        return new Response(200, Page\Auth::getAuth(), 'text/html' );
    }
]);


// ADD NOVAS ROTAS DE PAGES CASO NECESSARIO