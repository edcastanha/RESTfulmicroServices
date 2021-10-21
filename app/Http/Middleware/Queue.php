<?php

namespace App\Http\Middleware;

class Queue
{

    /**
     * Classe responsavel por gerenciar a fila das ações do middleware
     *
     */

    private $middlewares = [];
    private $controller;
    private $controllerArgs = [];
    private static $map = [];

    public function __construct($middlewares, $controller, $controllerArgs)
    {
        $this->middlewares = $middlewares;
        $this->controller = $controller;
        $this->controllerArgs = $controllerArgs;
    }

    public static function setMap($map)
    {
        self::$map = $map;
    }


    public function next($resquest)
    {
        if(empty($this->middlewares)){
            return call_user_func_array($this->controller, $this->controllerArgs);
        }
      
        //Verifica o Array de Middlewares e remove o primeiro
        $middleware = array_shift($this->middlewares);
    
        //Verifica se o middleware existe no map
        if(!isset(self::$map[$middleware])){
            throw new \Exception("Middleware {$middleware} não existe", 500);
        }

        //Proximo middleware
        $queue = $this;
        $next = function($request) use ($queue){
          return   $queue->next($request);
        };
        

        return (new self::$map[$middleware])->handle($resquest, $next);


    }





 }// class
