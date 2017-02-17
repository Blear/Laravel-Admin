<?php

namespace App\Http\Controllers\Backend\Role;

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

    public function __invoke()
    {
        return Datatables::of($this->roles->getForDataTable())
            ->addColumn('users',function($role){
                return $role->users->count();
            })
            ->addColumn('actions', function($role) {
                return $role->action_buttons;
            })
            ->make(true);
    }
}
