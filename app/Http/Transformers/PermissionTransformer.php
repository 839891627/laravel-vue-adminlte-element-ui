<?php
namespace App\Http\Transformers;

use App\Permission;
use League\Fractal\TransformerAbstract;

class PermissionTransformer extends TransformerAbstract
{
    public function transform(Permission $permission)
    {
        return $permission->attributesToArray();
    }
}
