<?php

namespace App\Http\Controllers\Backend\User;

use App\Models\User\User;
use App\Repositories\Backend\User\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserStatusController extends Controller
{
    protected $users;
    public function __construct(UserRepository $users)
    {
        $this->users=$users;
    }

    public function mark(User $user,$status)
    {
        $this->users->mark($user,$status);
        return redirect()->route('admin.user.index')->withFlashSuccess('修改用户状态成功!');
    }
}
