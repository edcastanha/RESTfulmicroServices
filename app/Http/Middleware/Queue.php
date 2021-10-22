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
        // ! Responsavel por mapear as Middleware
        //! self por se tratatr de uma classe estatica
        self::$map = $map;
    }


    public function next($request)
    {

            // echo '<pre>'; print_r($this); echo'</pre>'; exit;
        if(empty($this->middlewares)){
            return call_user_func_array($this->controller, $this->controllerArgs);
        }
      
        //Verifica o Array de Middlewares e remove o primeiro
        $middleware = array_shift($this->middlewares);
        
        //Verifica mapeamento para caso não exista no $map
        if(!isset(self::$map[$middleware])){
            throw new \Exception("Erro ao processar Middleware {$middleware} da requisição", 500);
        }

        //Proximo middleware, passando a requisição para proxima função
        $queue = $this;
        $next = function($request) use ($queue){
          return   $queue->next($request);
        };
        
        // die(var_dump($next));

        //Executando o Middleware
        //PHP retornando exption verificar antes de finalizar.
        return (new self::$map[$middleware])->handle($request, $next);


    }//NEXT

 }// class
