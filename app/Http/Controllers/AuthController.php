<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * @param AuthRequest $request
     * @return mixed
     */
    public function register(AuthRequest $request){

        $user = User::where('phone',$request->phone)->first();
        if($user){
            return $this->failed('手机号已经注册');
        }
        $user = new User();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        //$user->password = $request->password;
        $user->save();
        return $this->success('注册成功');

    }

    public function login(AuthRequest $request)
    {
        // return $this->failed('失败');
        if(Auth::guard('api')->check());
        $credentials = $request->only(['phone', 'password']);
        if (! $token = auth('api')->attempt($credentials)) {
            return $this->failed('用户名或者密码错误');
        }
        return $this->success($this->respondWithToken($token));
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return $this->success(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('api')->logout();
        return $this->message('账户已经退出');
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ];
    }

    public function test(){
       session('fang','111');
       if(!session('fang')){
            return 111;
       }else{
           return session('fang');
       }

    }
}