<?php

namespace App\Http\Requests\Api;

use App\Exceptions\FormRequestException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{
    private $rules = [
        'register' => [
            'username' => 'required',
            'password' => 'required'
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
            'password.required' => '请填写您的注册密码'
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
