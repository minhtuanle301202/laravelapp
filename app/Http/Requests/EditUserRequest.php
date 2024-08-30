<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'userId' => 'required|integer',
            'username' => 'required|string|max:255|unique:users,username,' .$this->userId,
            'email' => 'required|email|unique:users,email,' .$this->userId,
            'phone' => 'required|regex:/^[0-9]{10,15}$/',
        ];
    }

    public function messages(): array
    {
        return [
            'username.required' => 'Tên người dùng là bắt buộc.',
            'username.unique' => 'Tên người dùng đã tồn tại.',
            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Email không hợp lệ.',
            'email.unique' => 'Email đã tồn tại.',
            'phone.required' => 'Số điện thoại là bắt buộc.',
            'phone.regex' => 'Số điện thoại không hợp lệ.',
        ];
    }
}
