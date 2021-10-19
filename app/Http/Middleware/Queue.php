<?php

namespace App\Http\Middleware;

class Queue
{

    /**
     * Classe responsavel por executar as ações do middleware
     *
     */

    private $middleware = [];
    private $controller;
    private $controllerArgs = [];


    public function __construct($middleware, $controller, $controllerArgs)
    {
        $this->middleware = $middleware;
        $this->controller = $controller;
        $this->controllerArgs = $controllerArgs;
    }






 }// class
