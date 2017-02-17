<?php
/**
 * Created by PhpStorm.
 * User: Blear
 * Date: 2017/2/17
 * Time: 14:56
 */

namespace App\Models\User\Traits\Relationship;


use App\Models\Role\Role;

trait UserRelationship
{
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}