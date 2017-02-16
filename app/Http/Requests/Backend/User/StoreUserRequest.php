<?php

namespace App\Http\Requests\Backend\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'=>'required|email|unique:users,email',
            'name'=>'required|max:255',
            'password'=>'required|min:6|confirmed'
        ];
    }

    public function messages()
    {
        return [
            'required'=>':attribute 为必填项',
            'email'=>':attribute 格式错误',
            'unique'=>':attribute 已被占用',
            'name.max'=>'用户名长度必须小于255个字符',
            'password.min'=>'密码长度必须大于6个字符',
            'confirmed'=>'确认密码错误'
        ];
    }

    public function attributes()
    {
        return [
            'email'=>'邮箱',
            'name'=>'用户名',
            'password'=>'密码'
        ];
    }
}
