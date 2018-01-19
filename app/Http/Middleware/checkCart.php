<?php

namespace App\Http\Middleware;

use Closure;

class checkCart
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
        $cart = Cart::content();
        if($cart)
        {
            return $next($request);
        }
        else {
            return redirect('/cart');
        }
    }
}
