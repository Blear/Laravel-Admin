<?php

namespace App\Models\Permission;


use App\Models\Permission\Traits\Relationship\PermissionRelationship;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use PermissionRelationship;
    protected $fillable=[
        'name',
        'display_name',
        'sort'
    ];
}
