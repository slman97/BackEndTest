<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class twoFactorMiddleware
{

    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if (auth()->check() && $user->code){
             
            if(!$request->is('verfiy*')){
                return redirect()->route('verfiy.index');
            }
        }
        
        return $next($request);
    }
}
