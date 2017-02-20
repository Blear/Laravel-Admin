<?php

namespace App\Http\Controllers\Backend\User;

use App\Http\Requests\Backend\User\StoreUserRequest;
use App\Http\Requests\Backend\User\UpdateUserRequest;
use App\Models\User\User;
use App\Repositories\Backend\Role\RoleRepository;
use App\Repositories\Backend\User\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    protected $users;
    protected $roles;
    public function __construct(UserRepository $users,RoleRepository $roles)
    {
        $this->users=$users;
        $this->roles=$roles;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.user.create')
            ->withRoles($this->roles->getAll());;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $this->users->create(['data' => $request->except('assignees_roles'), 'roles' => $request->only('assignees_roles')]);
        return redirect()->route('admin.user.index')->withFlashSuccess('用户添加成功!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('backend.user.edit')
            ->withUser($user)
            ->withUserRoles($user->roles->pluck('id')->all())
            ->withRoles($this->roles->getAll());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->users->update($user,['data'=>$request->except('assignees_roles'),'roles'=>$request->only('assignees_roles')]);
        return redirect()->route('admin.user.index')->withFlashSuccess('修改用户信息成功!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->users->delete($user);
        return redirect()->route('admin.user.index')->withFlashSuccess('删除用户成功!');
    }
}
