<?php


use \App\Controllers\Page;
use \App\Http\Response;


$objRoutes->get('/auth',[ 

    function(){
        return new Response(200, Page\Index::getAuth(), 'text/html' );
    }
]);


// ADD NOVAS ROTAS DE PAGES CASO NECESSARIO