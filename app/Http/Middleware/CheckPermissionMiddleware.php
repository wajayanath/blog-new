<?php

namespace App\Http\Middleware;

use Closure;

class CheckPermissionMiddleware
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
        //get current user
        $currentUser = $request->user();


        //get current action name
        $currentActionName = $request->route()->getActionName();
        list($controller, $method) = explode('@', $currentActionName);
        $controller = str_replace(["App\\Http\\Controllers\\Backend\\", "Controller"], "", $controller);
        dd("C: $controller M: $method");
        return $next($request);
    }
}
