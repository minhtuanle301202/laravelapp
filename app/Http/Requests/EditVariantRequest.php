<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditVariantRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'price' => 'required|numeric|min:0',
            'color' => 'required|string',
            'capacity' => 'required|integer|min:0',
            'remain_quantity' => 'required|integer|min:0',
        ];
    }

    public function messages()
    {
        return [
            'price.required' => 'Giá sản phẩm là bắt buộc.',
            'price.min' => 'Giá sản phẩm không được nhỏ hơn 0.',
            'color.required' => 'Màu sắc sản phẩm là bắt buộc.',
            'color.string' => 'Màu sắc sản phẩm phải là một chuỗi ký tự.',
            'capacity.required' => 'Dung lượng sản phẩm là bắt buộc.',
            'capacity.min' => 'Dung lượng sản phẩm không được nhỏ hơn 0.',
            'remain_quantity.required' => 'Số lượng sản phẩm là bắt buộc.',
            'remain_quantity.min' => 'Số lượng còn lại không được nhỏ hơn 0.',
        ];
    }

}
?>