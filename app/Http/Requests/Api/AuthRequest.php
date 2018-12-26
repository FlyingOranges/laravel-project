<?php

namespace App\Http\Requests\Api;

use App\Exceptions\FormRequestException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{
    private $rules = [
        'register' => [
            'username' => 'required|max:11|min:11',
            'password' => 'required|max:18|min:8|confirmed',
            'password_confirmation' => 'required|max:18|min:8',
        ],
    ];

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
        //获取当前请求方法的方法名
        $rules = str_after($this->route()->getActionName(), '@');

        return $this->rules[$rules];
    }

    /**
     * Tag 重构错误提示
     *
     * Users Flying Oranges
     * CreateTime 2018/9/14
     * @return array
     */
    public function messages()
    {
        return [
            'username.required' => '请填写您的注册账号',
            'username.max' => '注册账号位数长度溢出',
            'username.min' => '注册账号位数长度不足',
            'password.required' => '请填写您的注册密码',
            'password.max' => '密码长度超出最大值(18位)',
            'password.min' => '密码长度不足最小值(8位)',
            'password.confirmed' => '密码与确认密码不匹配',
            'password_confirmation.required' => '请填写确认密码'
        ];
    }

    /**
     * Tag 重构错误提示异常处理
     *
     * Users Flying Oranges
     * CreateTime 2018/9/14
     * @param Validator $validator
     * @throws FormRequestException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new FormRequestException($validator->getMessageBag()->first());
    }
}
