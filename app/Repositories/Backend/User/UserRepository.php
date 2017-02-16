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

    public function getForDataTable($trashed=false)
    {
        $dataTableQuery=$this->query()->select([
            'id',
            'name',
            'email',
            'created_at',
            'updated_at'
        ]);
        if($trashed==true){
            return $dataTableQuery->onlyTrashed();
        }
        return $dataTableQuery;
    }

    public function create(array $input)
    {
        $user=$this->createUser($input);
        if(parent::save($user)){
            return true;
        }
        throw new GeneralException('添加用户失败!');
    }

    public function update(Model $user,array $input)
    {
        $this->checkUserByEmail($input,$user);
        if(parent::update($user,$input)){
            return true;
        }
        throw new GeneralException('修改用户信息失败!');
    }

    public function delete(Model $user)
    {
        if(parent::delete($user)){
            return true;
        }
        throw new GeneralException('删除用户失败!');
    }


    protected function createUser($input){
        $user=self::MODEL;
        $user=new $user;
        $user['name']=$input['name'];
        $user['email']=$input['email'];
        $user['password']=bcrypt($input['password']);
        return $user;
    }

    protected function checkUserByEmail($input,$user)
    {
        if($user->email!=$input['email']){
            if($this->query()->where('email',$input['email'])->first()){
                throw new GeneralException("邮箱已被占用!");
            }
        }
    }

}