<?php
namespace  App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'address' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'order_date' => 'required|before_or_equal:today',
        ];
    }

    public function messages()
    {
        return [
            'address.required' => 'Địa chỉ là bắt buộc.',
            'phone.required' => 'Số điện thoại là bắt buộc.',
            'phone.max' => 'Số điện thoại không thể vượt quá 20 ký tự.',
            'order_date.before_or_equal' => 'Ngày đặt hàng không thể sau ngày hiện tại.'
        ];
    }
}

?>