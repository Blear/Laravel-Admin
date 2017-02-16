<?php

namespace App\Http\Requests\Backend\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserPasswordRequest extends FormRequest
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
            'password'=>'required|min:6|confirmed'
        ];
    }

    public function messages()
    {
        return [
            'required'=>'密码为必填项',
            'min'=>'密码长度必须大于6位',
            'confirmed'=>'确认密码错误'
        ];
    }
}
