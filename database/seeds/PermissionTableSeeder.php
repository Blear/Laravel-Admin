<?php

use Illuminate\Database\Seeder;
use App\Models\Permission\Permission;
use Carbon\Carbon;
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $permission=new Permission();
        $permission->name='view-backend';
        $permission->display_name='查看后台';
        $permission->sort=1;
        $permission->created_at   = Carbon::now();
        $permission->updated_at   = Carbon::now();
        $permission->save();

        $permission=new Permission();
        $permission->name='manage-users';
        $permission->display_name='用户管理';
        $permission->sort=2;
        $permission->created_at   = Carbon::now();
        $permission->updated_at   = Carbon::now();
        $permission->save();

        $permission=new Permission();
        $permission->name='manage-roles';
        $permission->display_name='角色管理';
        $permission->sort=3;
        $permission->created_at   = Carbon::now();
        $permission->updated_at   = Carbon::now();
        $permission->save();

    }
}
