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
        if(mobileView()&&isMobile()){//是手机版且 不是二级域名
            $serveName = $request->server('SERVER_NAME');//一级域名
            $requestUri = $request->getRequestUri();//完整地址包括参数
            return redirect($request->server('REQUEST_SCHEME').'://'.'m.'.$serveName.'/'.$requestUri);
        }

        return $next($request);
    }
}
