<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBrandRequest extends FormRequest
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

            'name' => 'required|max:200|unique:brands,name,'.$this->brand->id,
            'address' => 'required',
            'image' => 'nullable|mimes:jpeg,png,jpg|max:5000000'

        ];

    }
}
