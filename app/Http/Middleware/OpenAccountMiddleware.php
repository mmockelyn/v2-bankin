<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class OpenAccountMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->customer->status_open_account != 'terminated') {
            return redirect()->route('suivi')->with('error', "Votre ouverture de compte n'est pas terminer");
        } else {
            return $next($request);
        }
    }
}
