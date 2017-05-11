<?php

namespace App\Http\Controllers\Api\System;

use App\Http\Controllers\Api\BaseController;
use App\Http\Transformers\PermissionTransformer;
use App\Permission;

class PermissionController extends BaseController
{
	public function index()
	{
		$pageSize = request()->get('pageSize', 10);
		$permissions = Permission::orderBy('id', 'desc')->paginate($pageSize);
		return $this->response->paginator($permissions, new PermissionTransformer());
	}

	public function update($id)
	{
		Permission::where('id', $id)->update(request()->only('display_name', 'description'));
		return $this->response->noContent();
	}

	public function store()
	{
		$id = Permission::insertGetId(request()->all());
		return $this->response->array(['id' => $id]);
	}
}
