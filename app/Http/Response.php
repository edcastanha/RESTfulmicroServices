<?php

namespace App\Http;

class Response
{
    private $headers = [];
    private $contentType = '';
    private $httpCode = 201;
    private $content = '';
    


    public function __construct($httpCode, $content = '', $contentType  = 'application/json')
    {
        $this->httpCode = $httpCode;
        $this->content = $content;
        $this->setContentType($contentType);
    }


    public function setContentType($contentType)
    {
        $this->contentType = $contentType;
        $this->getHeader('Content-Type', $contentType);
    }

    //Alterar  cabeçalho
    public function getHeader($key,$value)
    {
        $this->headers[$key] = $value;
    }

    //Responsavel por enviar o cabeçalho
    private function sendHeaders()
    {
        http_response_code($this->httpCode);

        foreach ($this->headers as $key => $value) {
            header($key.':'.$value);
        }
    }

    public function sendResponse()
    {
        $this->sendHeaders();
        
        switch ($this->contentType) {
            
            case 'application/json':
                echo json_encode($this->content, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                exit;
                
            case 'text/html':
                echo $this->content;
                exit;
             
        }
    }
}
