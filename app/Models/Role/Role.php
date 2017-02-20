<?php

namespace App\Models\Role;

use App\Models\Role\Traits\Attribute\RoleAttribute;
use App\Models\Role\Traits\Relationship\RoleRelationship;
use App\Models\Role\Traits\RoleAccess;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use RoleAttribute,
        RoleRelationship,
        RoleAccess;

    protected $fillable=[
        'name',
        'all',
        'sort'
    ];
}
