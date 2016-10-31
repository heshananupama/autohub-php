<?php

namespace App\Http\Middleware;

use Closure;

class Retailer
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

        if ( $request->user()->type !='r' )
        {
            return redirect('retailer/home');
        }

        return $next($request);

    }
}
