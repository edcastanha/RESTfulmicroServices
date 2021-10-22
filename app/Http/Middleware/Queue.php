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

    
    ///Mapeamento para todas rotas de Middleware
    private static $map = [];
    private static $default = [];

    public function __construct($middlewares, $controller, $controllerArgs)
    {

        $this->middlewares = array_merge(self::$default, $middlewares);
        $this->controller = $controller;
        $this->controllerArgs = $controllerArgs;
    }

    public static function setMap($map)
    { 
        //self por se tratatr de uma classe estatica
        self::$map = $map;
    }

    public static function setDefault($default)
    { 
        // ! Responsavel por mapear as Middleware padrões de todas as rotas
        self::$default = $default;
    }


    public function next($request)
    {
        // Caso não haja Middlewares aponta para a rota da Controller
        if(empty($this->middlewares)){
            return call_user_func_array($this->controller, $this->controllerArgs);
        }
    
        //Verifica a FILA de Middlewares e remove a primeira indice
        $middleware = array_shift($this->middlewares);

        
        //Verifica mapeamento de MIDDLEWARE cadastradas na aplicação
        if(!isset(self::$map[$middleware])){
            throw new \Exception("Erro ao processar {$middleware} da requisição", 500);
        }


        //Passando a requisição para proxima função
        $queue = $this;
        $next = function($request) use($queue){
            return   $queue->next($request);
        };

        // ! Observação: Dependendo o ambiente de desenvolvimento ou produção é necessario 
        // ! força a chamada via variavel.
        $middlewareExec = new self::$map[$middleware];

        //Retornando de forma dinamica o Middleware para execução
    return $middlewareExec->handle($request, $next);


    }//NEXT

 }// class
