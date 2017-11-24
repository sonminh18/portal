<?php
/**
 * Created by PhpStorm.
 * User: Son Minh
 * Date: 11/8/2017
 * Time: 9:01 AM
 */
namespace App\Http\Middleware;

use Closure;
use session;

class CheckUserSession
{

    public function handle($request, Closure $next)
    {
        $action = $request->route();
        if (!$request->session()->exists('username') && !$request->session()->exists('password')) {
            // user value cannot be found in session
            return redirect('/');
        }

        return $next($request);
    }

}
