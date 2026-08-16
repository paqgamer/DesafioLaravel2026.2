<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        abort_if(
            ! $request->user() || ! $request->user()->is_admin,
            403,
            'Acesso restrito a administradores.'
        );

        return $next($request);
    }
}