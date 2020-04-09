<?php

namespace App\Http\Middleware;

use Closure;

class DeviceHandle
{
    /**
     * Handle an incoming request.
     * 手机版设备调至至二级域名
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $serveName = $request->server('SERVER_NAME');//一级域名
        $requestUri = $request->getRequestUri();//完整地址包括参数
        $scheme = 'https';
        if(isMobile()&&!mobileDomain()){//是手机版且 不是二级域名
            return redirect($scheme.'://'.'m.'.$serveName.$requestUri);
        }elseif(!isMobile()&&mobileDomain()){//不是手机版 是二级域名
            return redirect($scheme.'://'.$serveName.$requestUri);
        }

        return $next($request);
    }
}
