<?php

use \App\Http\Response;
use \App\Controllers\{
    Api,
    Page
};

$objRouter->get('/', function () {
    return new Response(200, Auth::getAuth(), );

});