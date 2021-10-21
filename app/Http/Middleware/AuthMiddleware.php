<?php

namespace App\Http\Middleware;

class AuthMiddleware{

    public function hanble($request, $next){
        
        return $next($request);
    }
}
