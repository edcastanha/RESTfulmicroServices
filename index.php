<?php
include_once  __DIR__ .'/__includes/app.php';

use \App\Http\Router;

//Objetode de rotas
$objRoutes = new Router(URL);


// Incluindo ROUTES de API - V1
// include __DIR__ .'/routes/api.php';

// Inclusão PAGE para cadastro e geração de TOKEN
include __DIR__ .'/routes/page.php';

/**
 * Returno da requisição ou renderização da página
 * Passando pela Fila de  Middlewares -> Controllers equivalente a requisição
 */
 $objRoutes->run()
          ->sendResponse();

