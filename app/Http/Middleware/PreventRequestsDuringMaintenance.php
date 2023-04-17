<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance as Middleware;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Closure;
class PreventRequestsDuringMaintenance extends Middleware
{
    /**
     * The URIs that should be reachable while maintenance mode is enabled.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
    ];


public function handle($request, Closure $next) {
    if ($this->app->isDownForMaintenance()) {

        /** if URL contains API, disable continue, don't keep maintenance */
        if(in_array('admin',$request->segments())){
            return $next($request);
        }

        abort(503);
    }

    return $next($request);
}

}
