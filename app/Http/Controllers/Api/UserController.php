<?php

namespace App\Http\Controllers\Api;

use App\Http\Transformers\UserTransformer;
use App\User;
use Dingo\Api\Exception\UpdateResourceFailedException;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    public function index()
    {
        $pageSize = request()->get('pageSize', 10);

        $query = new User();
        if ($name = request()->get('name')) {
            $query = $query->where('name', 'like', '%' . $name . '%');
        }
        if ($created_at = request()->get('created_at')) {
            $created_at = array_map(function ($item) {
                return date('Y-m-d H:i:s', strtotime($item));
            },$created_at);
            $query = $query->whereBetween('created_at', $created_at);
        }
        $user = $query->orderBy('id', 'desc')->paginate($pageSize);
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

    public function show($id)
    {
        $user = User::find($id);
        return $this->response->item($user, new UserTransformer());
    }

    public function destroy($id)
    {
        return User::destroy($id);
    }

    public function update(Request $request, $id)
    {
        $data = [
            'name' => $request->name,
            'password' => bcrypt($request->password)
        ];
        if (User::where('id', $id)->update($data)) {
            return $this->response->array(['status_code' => 200, 'message' => '更新成功！']);
        }
        throw new UpdateResourceFailedException('更新失败!');
    }
}
