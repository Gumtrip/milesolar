<?php

namespace App\Http\Controllers\Api\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\LoginRequest;
use Auth;

class LoginController extends Controller
{
    const GUARD='admin';
    /** 登陆认证
     * @param LoginRequest $request
     * @return mixed|void
     */
    public function login(LoginRequest $request)
    {
        if (!$token = auth(self::GUARD)->attempt($request->all())) {
            return response()->json->errorUnauthorized('用户名或密码错误');
        }
        return $this->respondWithToken($token);
    }

    public function refreshToken()
    {
        $token = auth(self::GUARD)->refresh();
        return self::respondWithToken($token,200);
    }

    /** 刷新token
     * @param string $token
     * @param int $code
     * @return mixed
     * @throws \ErrorException
     */

    public function respondWithToken($token ='',$code=201)
    {
        $token = $token ? $token : auth(self::GUARD)->user();
        $expiresIn = auth(self::GUARD)->factory()->getTTL() * config('api.jwt.ttl');
        $expiresDate = now()->addSeconds($expiresIn)->toDateTimeString();
        return response()->json([
            'token' => 'Bearer'.' '.$token,
            'expires_in' => $expiresIn,
            'token_expired_at' => $expiresDate
        ])
            ->setStatusCode($code);
    }

    public function logout(){
//        Auth::guard(self::GUARD)->logout();
        return response()->noContent();
    }
}
