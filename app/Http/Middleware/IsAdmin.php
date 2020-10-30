<?php
/**
 * Created by PhpStorm.
 * User: Tom Faust
 * Date: 30-10-2020
 * Time: 01:32
 */

namespace App\Http\Middleware;

use Closure;
use Auth;

class IsAdmin
{
    public function handle($request, Closure $next)
    {
        if (Auth::user()->admin == 1) {
            return $next($request);
        }

        return redirect()->route('index'); // If user is not an admin.
    }
}