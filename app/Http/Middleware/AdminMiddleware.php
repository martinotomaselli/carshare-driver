<?php

namespace App\Http\Middleware;

use Closure;use Illuminate\Http\Request;use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware{
    public function handle(Request $r,Closure $next):Response{
        if(!$r->user()?->is_admin){abort(403,'Accesso riservato ai revisori.');
        }
        return $next($r);
    }}

