<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

// há  pouco tempo atrás, eu pensei que nunca mais iria mexer nessa merda de arquivo
// mas lá vamos nós


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'admin' => \App\Http\Middleware\EnsureUserIsAdmin::class,
        ]);

        $middleware->validateCsrfTokens(except: [
            'webhooks/mercadopago',
            // o vscodium diz "deprecated", mas se  ta funcionando então tá bom
        ]);

     
        // ngrok fdp, algum desgraçado ainda vai invadir meu  pc por  causa disso
        $middleware->trustProxies(at: '*');
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*'),
            // a  segurança que se  foda
        );
    })->create();