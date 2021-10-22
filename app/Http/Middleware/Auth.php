<?php

namespace App\Http\Middleware;

class Auth{

    public function hanble($request, $next)
    {
        if(getenv('AUTH_MIDDLEWARE') == 'true'){
           throw new Exception("Sistema em Manutenção", 204);  
        }
        
        return $next($request);
    }//hanble

}//clas
