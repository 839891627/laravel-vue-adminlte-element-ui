<?php

namespace App\Http\Controllers\Api;

use App\Http\Transformers\UserTransformer;
use App\User;

class UserController extends BaseController
{
    public function index()
    {
        $user = User::paginate(request()->get('pageSize', 10));
        return $this->response->paginator($user, new UserTransformer());
    }

    public function show()
    {

    }

    public function destroy($id)
    {
        return User::destroy($id);
    }
}
