<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserPaymentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'username' => 'required|string|min:3|max:50|unique:users',
            'phone' => 'required|regex:/^[0-9]{10,15}$/',
            'address' => 'required|string',
            'payment_method' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Tên người dùng là bắt buộc.',
            'username.unique' => 'Tên người dùng đã tồn tại.',
            'phone.required' => 'Số điện thoại là bắt buộc.',
            'phone.regex' => 'Số điện thoại không hợp lệ.',
        ];
    }
}
?>