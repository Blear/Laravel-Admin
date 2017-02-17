<?php
/**
 * Created by PhpStorm.
 * User: Blear
 * Date: 2017/2/17
 * Time: 14:26
 */

namespace App\Repositories\Backend\Role;


use App\Exceptions\GeneralException;
use App\Models\Role\Role;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

class RoleRepository extends Repository
{
    const MODEL=Role::class;

    public function getForDataTable($orderBy='sort',$sort="asc")
    {
        $dataTableQuery=$this->query()
            ->with('users')
            ->orderBy($orderBy,$sort)
            ->select([
            'id',
            'name',
            'all',
            'sort'
        ]);
        return $dataTableQuery;
    }

    public function create(array $input)
    {
        if($this->query()->where('name',$input['name'])->first()){
            throw new GeneralException('该角色名称已存在!');
        }
        $role=self::MODEL;
        $role=new $role;
        $role->name=$input['name'];
        $role->sort=isset($input['sort'])&&strlen($input['sort'])>0&&is_numeric($input['sort'])?(int) $input['sort']:0;
        //权限暂时设置为全局
        $role->all=true;
        if(parent::save($role)){
            return true;
        }
        throw new GeneralException('角色添加失败!');
    }

    public function update(Model $role,array $input)
    {
        $role->name = $input['name'];
        $role->sort = isset($input['sort']) && strlen($input['sort']) > 0 && is_numeric($input['sort']) ? (int) $input['sort'] : 0;
        //权限暂时设置为全局
        $role->all=true;
        if(parent::save($role)){
            return true;
        }
        throw new GeneralException('角色更新失败!');
    }

    public function delete(Model $role)
    {
        if($role->id==1){
            throw new GeneralException('系统角色无法删除!');
        }
        if($role->users()->count()>0){
            throw new GeneralException('该角色下面有用户，无法删除!');
        }
        if(parent::delete($role)){
            return true;
        }
        throw new GeneralException('角色删除失败!');
    }
}