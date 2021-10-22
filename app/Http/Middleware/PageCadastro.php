<?php

namespace App\Http\Middleware;

class PageCadastro{

    public function handle($request, $next)
    {
        if(AUTH == 'false'){
           throw new \Exception("Cadastro de Token desativado", 200);  
        }
        
        return $next($request);
    }//hanble

}//clas
