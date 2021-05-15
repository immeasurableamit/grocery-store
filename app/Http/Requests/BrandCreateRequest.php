<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandCreateRequest extends FormRequest
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
           // 'logo' => "dimensions:max_width=300,max_height=200",
            'meta_title' => 'required',
            'meta_description' => '',
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
            'meta_title.required' => 'The meta title field is required.',
            'meta_description.required' => 'The meta description field is required.',

        ];
    }
}
