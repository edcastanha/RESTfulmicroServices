<?php


use \App\Http\Response;
use \App\Controllers\Api;

$objRoutes->get('/api/v1',[ 

    function($request){
        return new Response(200, Api\Api::getDetails($request));
    }
]);