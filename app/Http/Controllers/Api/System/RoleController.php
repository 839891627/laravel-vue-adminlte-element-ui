<?php

namespace App\Http\Controllers\Api\System;

use App\Http\Controllers\Api\BaseController;
use App\Http\Transformers\RoleTransformer;
use App\Role;

class RoleController extends BaseController
{
	public function index()
	{
		$pageSize = request()->get('pageSize', 10);
		$roles = Role::orderBy('id', 'desc')->paginate($pageSize);
		return $this->response->paginator($roles, new RoleTransformer());
	}

	public function update($id)
	{
		Role::where('id', $id)->update(request()->only('display_name', 'description'));
		return $this->response->noContent();
	}

	public function store()
	{
//		Role::create(request()->all());
//		return $this->response->created();

		$data = request()->only('name', 'display_name', 'description');
		$data['created_at'] = $data['updated_at'] = date('Y-m-d H:i:s');
		$id = Role::insertGetId($data);
		return $this->response->array(['id' => $id]);
	}

	public function destroy($id)
	{
		return Role::where('id', $id)->delete();// 这里用 Role::destroy($id) 有问题，entrust包的问题
	}

	public function show($id)
	{
		$role = Role::find($id);
		return $this->response->item($role, new RoleTransformer());
	}
}
