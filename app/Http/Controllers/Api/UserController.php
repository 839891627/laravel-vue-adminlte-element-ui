<?php

namespace App\Http\Controllers\Api;

use App\Http\Transformers\UserTransformer;
use App\User;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    public function index()
    {
        $pageSize = request()->get('pageSize', 10);
        if ($name = request()->get('name')) {
            $user = User::where('name', 'like', '%' . $name . '%')->paginate($pageSize);
        } else {
            $user = User::paginate($pageSize);
        }
        return $this->response->paginator($user, new UserTransformer());
    }

    public function store(Request $request)
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
            return $this->response->created();
        } else {
            throw new \Dingo\Api\Exception\StoreResourceFailedException('Could not create new user.');
        }
    }

    public function destroy($id)
    {
        return User::destroy($id);
    }
}
