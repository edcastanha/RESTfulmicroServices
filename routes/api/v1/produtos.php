<?php

use \App\Http\Response;
use \App\Controllers\Api;


$objRoutes->get('/api/v1/produtos',[ 

    function($request){
        return new Response(200, Api\Products::getProdutosAll($request));
    }
]);

