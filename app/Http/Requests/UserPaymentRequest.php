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
            'name' => 'required|string|min:3|max:50',
            'phone_number' => 'required|regex:/^[0-9]{10}$/',
            'address' => 'required|string',
            'payment_method' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Họ tên là bắt buộc.',
            'phone_number.required' => 'Số điện thoại là bắt buộc.',
            'phone_number.regex' => 'Số điện thoại không hợp lệ.',
            'address.required' => 'Địa chỉ là bắt buộc',
        ];
    }
}
?>