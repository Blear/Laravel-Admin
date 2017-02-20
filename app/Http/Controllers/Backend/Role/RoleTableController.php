<?php

namespace App\Http\Controllers\Backend\Role;

use App\Http\Requests\Backend\Role\ManageRoleRequest;
use App\Models\Role\Role;
use App\Repositories\Backend\Role\RoleRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

class RoleTableController extends Controller
{
    protected $roles;
    public function __construct(RoleRepository $roles)
    {
        $this->roles=$roles;
    }

    public function __invoke(ManageRoleRequest $request)
    {
        return Datatables::of($this->roles->getForDataTable())
            ->addColumn('users',function($role){
                return $role->users->count();
            })
            ->addColumn('permissions', function($role) {
                if ($role->all)
                    return '<span class="label label-success">全局</span>';

                return $role->permissions->count() ?
                    implode("<br/>", $role->permissions->pluck('display_name')->toArray()) :
                    '<span class="label label-danger">无</span>';
            })
            ->addColumn('actions', function($role) {
                return $role->action_buttons;
            })
            ->make(true);
    }
}
