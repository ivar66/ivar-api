<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Tymon\JWTAuth\Exceptions\JWTException;

class JWTRoleAuth
{
    /**
     * JWT 检测当前登录的平台
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  null $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role = null)
    {
        try {
            // 解析token角色
            $tokenRole = $this->auth->parseToken()->getClaim('role');
        } catch (JWTException $e) {
            /**
             * token解析失败，说明请求中没有可用的token。
             * 为了可以全局使用（不需要token的请求也可通过），这里让请求继续。
             * 因为这个中间件的责职只是校验token里的角色。
             */
            return $next($request);
        }
        // 判断token角色。
        if ($tokenRole != $role) {
            throw new UnauthorizedHttpException('jwt-auth', 'User role error');
        }
        return $next($request);
    }
}
