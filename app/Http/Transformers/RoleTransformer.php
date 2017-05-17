<?php
namespace App\Http\Transformers;

use App\Role;
use League\Fractal\TransformerAbstract;

class RoleTransformer extends TransformerAbstract
{
    public function transform(Role $permission)
    {
        return $permission->attributesToArray();
    }
}
