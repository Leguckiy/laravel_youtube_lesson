<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BasketIsNotEmpty
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
        $order = session('order');

        if (!is_null($order) && $order->getFullSum() > 0) {
            return $next($request);
        }

        session()->forget('order');
        session()->flash('warning', __('basket.cart_is_empty'));
        return redirect()->route('index');

    }
}
