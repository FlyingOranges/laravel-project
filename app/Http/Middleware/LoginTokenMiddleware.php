<?php

namespace App\Http\Middleware;

use App\Exceptions\ApiException;
use App\vender\Auth\AuthUtils;
use Closure;

class LoginTokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * * @throws \Throwable
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $status = AuthUtils::check();

        throw_unless($status, ApiException::class, '您当前还未登录或登录信息已失效,请您重新登录后再操作');

        return $next($request);
    }
}
