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

    /**
     * 获取已禁用的用户
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getDeactivated()
    {
        return view('backend.user.deactivated');
    }

    public function getDeleted()
    {
        return view('backend.user.deleted');
    }


    /**
     * 修改用户状态
     * @param User $user
     * @param $status
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function mark(User $user,$status)
    {
        $this->users->mark($user,$status);
        if($status==1)
            return redirect()->route('admin.user.index')->withFlashSuccess('修改用户状态成功!');
        else
            return redirect()->route('admin.user.deactivated')->withFlashSuccess('修改用户状态成功!');
    }
}
