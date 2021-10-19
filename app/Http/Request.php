<?php

namespace App\Http;

class Request
{
    /**
     * Classe responsável em gerenciar as REQUISIÇÕES da aplicação
     */
    private $headers = [];
    private $uri ;
    private $queryParams = [];
    private $varPost = [];
    private $httpMethod ;

    public function __construct()
    {
        //Função do PHP que retorna todos os headers da requisição
        $this->headers      = getallheaders();
        //Não existindo retorna string vazia
        $this->uri          = $_SERVER['REQUEST_URI'] ?? '';
        $this->httpMethod   = $_SERVER['REQUEST_METHOD'] ?? '';
        $this->queryParams  = $_GET;
        $this->varPost      = $_POST;

    }

    /**
     * Metodos de retorno de dados
     */

    public function getHeaders()
    {
        return $this->headers;
    }

    public function getUri()
    {
        return $this->uri;
    }

    public function getQueryParams()
    {
        return $this->queryParams;
    }

    public function getVarPost()
    {
        return $this->varPost;
    }

    public function getHttpMethod()
    {
        return $this->httpMethod;
    }

    



}
