<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryCreateRequest extends FormRequest
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
            'name' => 'required',
            'parent_id' => 'required',
            'order_level' => '',
            'banner' => '', // 1MB Max
            'icon' => '', // 1MB Max
            'meta_title' => 'required',
            'meta_description' => '',
            'commision_rate' => '',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {

        return [
            'name.required' => 'The name field is required.',
            'parent_id.required' => 'The parent category field is required.',
            'order_level.required' => 'The ordering number field is required.',
            'meta_title.required' => 'The name field is required.',

        ];
    }
}
