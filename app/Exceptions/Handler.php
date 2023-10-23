<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * Gère une exception non authentifiée.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response|null
     * @throws \Exception
     */
    protected function unauthenticated($request, AuthenticationException $exception): ?RedirectResponse
    {
        return Redirect::route('login')->with('error', 'Votre session a expiré, veuillez vous reconnecter.');
    }

    // ...

    /**
     * Rend la réponse pour l'exception donnée.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof \Illuminate\Session\TokenMismatchException) {
            // Si l'exception est liée à un jeton CSRF expiré (session expirée), redirigez vers la page de connexion
            return Redirect::route('login')->with('error', 'Votre session a expiré, veuillez vous reconnecter.');
        }

        return parent::render($request, $exception);
    }
}
