<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * 登录接口
     * @param Request $request
     * @return JsonResponse|\Illuminate\Http\JsonResponse
     */
    public function login(Request $request){
        $credentials = request(['phone', 'password']);

        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * 退出登录
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request){
        auth('api')->logout();

        return api_response(['message' => 'Successfully logged out']);
    }

    /**
     * 获取个人信息接口
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function info(Request $request){
        return api_response(auth('api')->user());
    }

    /**
     * @param $token
     * @return JsonResponse
     */
    protected function respondWithToken($token)
    {
        return api_response([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}
