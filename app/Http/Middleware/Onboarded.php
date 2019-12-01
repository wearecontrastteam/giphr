<?php

namespace App\Http\Middleware;

use Closure;

class Onboarded
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->user()->hasAvatar() === false){
            return redirect()->route('profile.edit', $request->user());
        }

        return $next($request);
    }
}
