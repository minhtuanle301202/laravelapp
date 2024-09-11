<?php
namespace  App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class AddNewsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required',
            'published_date' => 'required|before_or_equal',
            'image' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Tiêu đề là bắt buộc.',
            'title.max' => 'Tiêu đề không được quá 255 ký tự',
            'content.required' => 'Nội dung là bắt buộc.',
            'published_date.before_or_equal' => 'Ngày đăng tin không thể sau ngày hiện tại.',
            'published_date.required' => 'Ngày đăng tin là bắt buộc'
        ];
    }
}

?>