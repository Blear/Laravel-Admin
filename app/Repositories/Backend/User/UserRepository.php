<?php
/**
 * Created by PhpStorm.
 * User: Blear
 * Date: 2017/2/16
 * Time: 10:58
 */

namespace App\Repositories\Backend\User;


use App\Exceptions\GeneralException;
use App\Models\User\User;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends Repository
{
    const MODEL=User::class;

    /**
     * DataTables接口
     * @param bool $trashed
     * @return mixed
     */
    public function getForDataTable($status,$trashed=false)
    {
        $dataTableQuery=$this->query()
            ->with('roles')
            ->select([
            'id',
            'name',
            'email',
            'status',
            'created_at',
            'updated_at',
            'deleted_at'
        ]);
        if($trashed=='true'){
            return $dataTableQuery->onlyTrashed();
        }
        return $dataTableQuery->active($status);
    }

    /**
     * 创建用户
     * @param array $input
     * @return bool
     * @throws GeneralException
     */
    public function create(array $input)
    {
        $data = $input['data'];
        $roles = $input['roles'];
        $user=$this->createUser($data);
        if(parent::save($user)){
            $user->attachRoles($roles['assignees_roles']);
            return true;
        }
        throw new GeneralException('添加用户失败!');
    }

    /**
     * 更新用户信息
     * @param Model $user
     * @param array $input
     * @return bool
     * @throws GeneralException
     */
    public function update(Model $user,array $input)
    {
        $data=$input['data'];
        $roles=$input['roles'];
        $this->checkUserByEmail($data,$user);
        $data['status'] = isset($data['status']) ? 1 : 0;
        $this->checkUserRolesCount($roles);
        if(parent::update($user,$data)){
            $this->flushRoles($roles, $user);
            return true;
        }
        throw new GeneralException('修改用户信息失败!');
    }

    /**
     * 删除用户
     * @param Model $user
     * @return bool
     * @throws GeneralException
     */
    public function delete(Model $user)
    {
        if(auth()->id()==$user->id){
            throw new GeneralException('您无法删除您自己的账号!');
        }
        if(parent::delete($user)){
            return true;
        }
        throw new GeneralException('删除用户失败!');
    }

    /**
     * 修改用户密码
     * @param Model $user
     * @param $input
     * @return bool
     * @throws GeneralException
     */
    public function updatePassword(Model $user,$input)
    {
        $user->password=bcrypt($input['password']);
        if(parent::save($user)){
            return true;
        }
        throw new GeneralException('密码修改失败!');
    }

    public function mark(Model $user,$status)
    {
        if(auth()->id()==$user->id&&$status==0){
            throw new GeneralException('您不能禁用自己的账号!');
        }
        $user->status=$status;
        if(parent::save($user)){
            return true;
        }
        throw new GeneralException('修改用户状态失败!');
    }

    public function forceDelete(Model $user)
    {
        if (is_null($user->deleted_at)) {
            throw new GeneralException('请先正常删除后,再进行彻底删除此用户!');
        }
        if (parent::forceDelete($user)) {
            return true;
        }

        throw new GeneralException('删除用户失败!');
    }


    public function restore(Model $user)
    {
        if (is_null($user->deleted_at)) {
            throw new GeneralException('改用户处于正常状态,无需恢复!');
        }
        if(parent::restore($user)){
            return true;
        }
        throw new GeneralException('用户恢复失败!');
    }

    /**
     * 创建用户实例
     * @param $input
     * @return mixed
     */
    protected function createUser($input){
        $user=self::MODEL;
        $user=new $user;
        $user['name']=$input['name'];
        $user['email']=$input['email'];
        $user['password']=bcrypt($input['password']);
        $user->status= isset($input['status']) ? 1 : 0;
        return $user;
    }

    /**
     * 检查邮箱是否被占用
     * @param $input
     * @param $user
     * @throws GeneralException
     */
    protected function checkUserByEmail($input,$user)
    {
        if($user->email!=$input['email']){
            if($this->query()->where('email',$input['email'])->first()){
                throw new GeneralException("邮箱已被占用!");
            }
        }
    }

    protected function checkUserRolesCount($roles)
    {
        if (count($roles['assignees_roles']) == 0) {
            throw new GeneralException('请至少选择一个用户角色!');
        }
    }

    protected function flushRoles($roles, $user)
    {
        //删除原来的角色，添加新的角色
        $user->detachRoles($user->roles);
        $user->attachRoles($roles['assignees_roles']);
    }

}