<?php
/**
 * Created by PhpStorm.
 * User: Blear
 * Date: 2017/2/16
 * Time: 11:57
 */

namespace App\Models\User\Traits\Attribute;


trait UserAttribute
{

    /**
     * 用户记录操作
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return $this->getEditButtonAttribute().$this->getDeleteButtonAttribute();
    }

    /**
     * 编辑按钮
     * @return string
     */
    public function getEditButtonAttribute()
    {
        return '<a href="'.route('admin.user.edit',$this).'" class="btn btn-xs btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="编辑"></i></a> ';
    }

    /**
     * 删除按钮
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
            return '<a href="javascript:void(0);" onclick="_delete($(this))" name="delete" class="btn btn-xs btn-danger" ><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="删除"></i>
                <form action="'.route('admin.user.destroy',$this).'" method="POST" name="" style="display:none">
                    <input name="_method" value="delete" type="hidden">
                    <input name="_token" value="'.csrf_token().'" type="hidden">
                </form>
            </a> ';
    }

}