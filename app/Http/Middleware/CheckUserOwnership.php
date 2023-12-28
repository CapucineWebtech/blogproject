<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CheckUserOwnership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->route('user');

        if (auth()->user()->getAuthIdentifier() == $user->id || auth()->user()->hasRole('admin')) {
            return $next($request);
        }

        Session::flash('error', "Vous n'avez pas les droits pour accéder à cette page.");

        return redirect()->route('posts.index');
    }
}
