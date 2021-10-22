<?php
require __DIR__ .'/__includes/app.php';

use \App\Http\Router;

//Definição de rotas
$objRoutes = new Router(URL);

include __DIR__ .'/routes/page.php';

//$objDBConn->select('tb_clientes');


/**
 * Returno da requisição ou renderização da página
 */
 $objRoutes->run()
          ->sendResponse();

