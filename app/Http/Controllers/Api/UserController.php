<?php

namespace App\Http\Controllers\Api;

use App\Http\Transformers\UserTransformer;
use App\User;

class UserController extends BaseController
{
    public function index()
    {
        $user = User::all();
        return $this->response->collection($user, new UserTransformer());
    }
    public function show()
    {
        $user = User::all();
//        return $this->response->array($user->toArray());
//        return $this->response->noContent();
//        return $this->response->created();
//        return $this->response->errorForbidden();
//        return $this->response->errorUnauthorized();
//        return $this->response->item($user, new UserTransformer)->withHeader('X-Foo', 'Bar');
        return $this->response->collection($user, new UserTransformer());

    }

    public function destroy($id)
    {
        return User::destroy($id);
    }
}
