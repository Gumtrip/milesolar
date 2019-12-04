<?php

namespace App\Http\Controllers\Api\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\LoginRequest;
use Auth;

class AuthorizationController extends Controller
{
    const GUARD='admin';

    /**
     * @param LoginRequest $request
     * @return mixed
     * @throws \ErrorException
     */
    public function store(LoginRequest $request)
    {
        if (!$token = auth(self::GUARD)->attempt($request->all())) {
            return response()->json->errorUnauthorized('用户名或密码错误');
        }
        return $this->respondWithToken($token);
    }

    public function update()
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

    private function respondWithToken($token ='',$code=201)
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

    public function destroy(){
//        auth(self::GUARD)->logout();
        return response(null, 204);
    }
}
