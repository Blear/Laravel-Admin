<?php
/**
 * Created by PhpStorm.
 * User: Blear
 * Date: 2017/2/20
 * Time: 9:20
 */

namespace App\Repositories\Backend\Permission;


use App\Models\Permission\Permission;
use App\Repositories\Repository;

class PermissionRepository extends Repository
{
    const MODEL=Permission::class;
}