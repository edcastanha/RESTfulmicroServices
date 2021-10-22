<?php

namespace App\Http;

use \Closure;
use \Exception;
use \ReflectionFunction;
use \App\Http\Middleware\Queue as MiddlewareQueue;

class Router
{
    private $url = '';
    private $prefix = '';
    private $request = Request::class;
    private $indexRoutes  = [];

    public function __construct($url)
    {
        $this->request  = new Request($this);
        $this->url      = $url;
        $this->setPrefix();
    }

    //Default prefix via função do PHP
    private function setPrefix()
    {
        $parseUrl = parse_url($this->url);
        $this->prefix = $parseUrl['path'] ?? '';
        
    }

    /**
     * Validação de rotas e parametros
     */
    private function addRoute($method, $route, $params = [])
    {
        foreach ($params as $key => $value) {
            if ($value instanceof Closure) {
                $params['controllers'] = $value;
                unset($params[$key]);
                continue;
            }
        }

        //Garantindo que exista MEDDLEWARES (array vazio por padrão caso não haja nenhum)
        $params['middlewares'] = $params['middlewares'] ?? [];

        /**
         * Verifica se as variaveis existe
         */
        $params['variables'] = [];
        $patternVariable = '/{(.*?)}/';
        if(preg_match_all($patternVariable, $route, $matches)){
            
            $route = preg_replace($patternVariable, '(.*?)', $route);
            $params['variables'] = $matches[1];
        }
     
        //Padrão de rotas  para validação-> '/^\/$/'
        $patternRoute = '/^' .str_replace('/', '\/', $route) . '$/';

        //Rota, metodo e parametros
        $this->indexRoutes[$patternRoute][$method] = $params;
        
    }//addRoute

    private function getUri()
    {
        // Remoção de prefixo da url
        $uriRoute = $this->request->getUri();
        $uri = strlen($this->prefix) ? explode($this->prefix, $uriRoute) : [$uriRoute];

        return end($uri);

    }//getURI

   private function getRoute()
   {
        $uri = $this->getUri();   
        $httpMethod = $this->request->getHttpMethod();
    
        foreach ($this->indexRoutes as $patternRoute=>$methods) {
            // Valida URI
            if(preg_match($patternRoute, $uri, $matches)) {
                // Validando a permissão do metodo
                if (isset($methods[$httpMethod])) {
                    unset($matches[0]);

                    $keys = $methods[$httpMethod]['variables'] ?? [];
                    $methods[$httpMethod]['variables'] = array_combine($keys, $matches);
                    $methods[$httpMethod]['variables']['request'] = $this->request;
                    
                    return $methods[$httpMethod];
                }

                throw new Exception("Método não permitido", 405);   
            }
        }
        throw new Exception("URL não encontrada", 404);
    }//getRoute
   
       
    public function get($route, $params=[])
    {
        return $this->addRoute('GET', $route, $params);
    }//get para page Auth(retorno de token)

    public function post($route, $params=[])
    {
        return $this->addRoute('POST', $route, $params);
    }//post

    public function put($route, $params=[])
    {
        return $this->addRoute('PUT', $route, $params);
    }//PUT

    public function delete($route, $params=[])
    {
        return $this->addRoute('DELETE', $route, $params);
    }//delete
   
     //Execução a rota
    public function run(){
        try {
            // throw new Exception("Error Processing Request", 404);
            
            //Obtendo a rota atual
            $route = $this->getRoute();

            if(!isset($route['controllers'])){
                throw new Exception("URL não pôde ser processada", 500);
            }

            $arguments = [];

            //função para obter as variaveis
            $reflection = new ReflectionFunction($route['controllers']);
            //foreach para obter os parametros
            foreach ($reflection->getParameters() as $param) {
                $name = $param->getName();
                $arguments[$name] = $route['variables'][$name] ?? '';
            }

            //Retorna Fila de Middlewares
            return (new MiddlewareQueue($route['middlewares'],$route['controllers'], $arguments))->next($this->request);
            

        } catch (Exception $th) {
            return new Response($th->getCode(), $th->getMessage());
        }
    }//RUN


}//classend