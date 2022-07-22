<?php

namespace Ndrto\Romen\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Ndrto\Romen\Facades\AuthMenu;

class VerifyAuthMenu
{

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        abort_if(!AuthMenu::check(), 404);

        return $next($request);
    }

}
