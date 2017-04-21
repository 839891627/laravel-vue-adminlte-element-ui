<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthenticateController extends BaseController
{

    public function register(Request $request)
    {
        $data = $request->only('name', 'email', 'password');
        $validator = validator($data, [
            'name' => 'bail|required',
            'email' => 'required|unique:users',
            'password' => 'required|min:3|max:12',
        ]);

        if ($validator->fails()) {
            throw new \Dingo\Api\Exception\StoreResourceFailedException('Could not create new user.',
                $validator->errors());
        }

        if (User::create($data)) {
            $token = JWTAuth::attempt(['email' => $data['email'], 'password' => $data['password']]);
            return response()->json(compact('token'));// 注册成功，直接返回token
        } else {
            throw new \Dingo\Api\Exception\StoreResourceFailedException('Could not create new user.');
        }
    }

    public function login(Request $request)
    {
        // grab credentials from the request
        $credentials = $request->only('email', 'password');

        try {
            // attempt to verify the credentials and create a token for the user
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => '用户名或密码不正确'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // all good so return the token
        return response()->json(compact('token'));
    }

}
