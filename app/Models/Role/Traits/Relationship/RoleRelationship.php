<?php
/**
 * Created by PhpStorm.
 * User: Blear
 * Date: 2017/2/17
 * Time: 14:53
 */

namespace App\Models\Role\Traits\Relationship;


use App\Models\Permission\Permission;
use App\Models\User\User;

trait RoleRelationship
{
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}