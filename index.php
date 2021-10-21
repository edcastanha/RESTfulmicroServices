<?php
require __DIR__ .'/__includes/app.php';

use \App\Http\Router;
use \App\Common\Db\DBConection;

//Definição de rotas
$objRoutes = new Router(URL);
$objDBConn = new DBConection();

include __DIR__ .'/routes/page.php';

//$objDBConn->select('tb_clientes');


/**
 * Returno da requisição ou renderização da página
 */
 $objRoutes->run()
          ->sendResponse();

