<?php

namespace App\Http\Middleware;

use App\Models\Post;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckPostOwnership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $post = $request->route('post');

        if (auth()->user()->getAuthIdentifier() == $post->user_id || auth()->user()->hasRole('admin')) {
            return $next($request);
        }

        Session::flash('error', "Vous n'avez pas les droits pour accéder à cette page.");

        return redirect()->route('posts.index');
    }
}
