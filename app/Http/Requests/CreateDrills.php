<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateDrills extends FormRequest
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
            'title' => 'required | string | max:255',
            'category_id' => 'required',
            'question0' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'titleは必須です。',
            'title.string' => '文字のみで入力して下さい。',
            'title.max' => 'titleは255字以下で入力して下さい。',
            'question0.required' => '問題は必須です。',
        ];
    }
}
