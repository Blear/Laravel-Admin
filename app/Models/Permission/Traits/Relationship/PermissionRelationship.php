<?php
/**
 * Created by PhpStorm.
 * User: Blear
 * Date: 2017/2/20
 * Time: 9:11
 */

namespace App\Models\Permission\Traits\Relationship;


use App\Models\Role\Role;

trait PermissionRelationship
{
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}