<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VariantRequest extends FormRequest
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
            'capacity' => [
                'required',
                'integer',
                'min:0',
                Rule::unique('product_variants')->where(function ($query) {
                    return $query->where('product_id', $this->product_id)
                        ->where('color', $this->color);
                })
            ],
            'remain_quantity' => 'required|integer|min:0',
            'product_id' => 'required|integer',
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
            'capacity.unique' => 'Biển thể này đã tồn tại rồi',
        ];
    }

}
?>