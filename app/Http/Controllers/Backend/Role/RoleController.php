<?php

namespace App\Http\Controllers\Backend\Role;

use App\Http\Requests\Backend\Role\StoreRoleRequest;
use App\Http\Requests\Backend\Role\UpdateRoleRequest;
use App\Http\Requests\Backend\User\UpdateUserRequest;
use App\Models\Role\Role;
use App\Repositories\Backend\Role\RoleRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    protected $roles;
    public function __construct(RoleRepository $roles)
    {
        $this->roles=$roles;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.role.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.role.create')->withRoleCount($this->roles->getCount());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoleRequest $request)
    {
        $this->roles->create($request->all());
        return redirect()->route('admin.role.index')->withFlashSuccess('角色添加成功!');
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
    public function edit(Role $role)
    {
        return view('backend.role.edit')->withRole($role);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $this->roles->update($role,$request->all());
        return redirect()->route('admin.role.index')->withFlashSuccess('角色修改成功!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $this->roles->delete($role);
        return redirect()->route('admin.role.index')->withFlashSuccess('角色删除成功!');
    }
}
