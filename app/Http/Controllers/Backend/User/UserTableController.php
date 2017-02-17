<?php

namespace App\Http\Controllers\Backend\User;

use App\Repositories\Backend\User\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

class UserTableController extends Controller
{
    protected $users;
    public function __construct(UserRepository $users)
    {
        $this->users=$users;
    }

    public function __invoke(Request $request)
    {
        return Datatables::of($this->users->getForDataTable($request->get('status'),$request->get('trashed')))
            ->addColumn('actions',function($user){
                return $user->action_buttons;
            })
            ->make(true);
    }

}
